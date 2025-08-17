<?php

namespace App\Repositories\Reservation;

use App\Models\Task;
use App\Models\Aircraft;
use App\DTO\ReservationDto;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentReservationRepository implements ReservationRepository
{
    public function getAvailableDatesForMonth(Aircraft $aircraft, Task $task, Carbon $month): array
    {
        $start = $month->copy()->startOfMonth();
        $end = $month->copy()->endOfMonth();

        // Get all reservations of the aircraft in the month
        $reservations = $aircraft->reservations()
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('reserved_from', [$start, $end])
                    ->orWhereBetween('reserved_to', [$start, $end])
                    ->orWhere(function ($q) use ($start, $end) {
                        $q->where('reserved_from', '<', $start)
                            ->where('reserved_to', '>', $end);
                    });
            })->get();

        // Task required equipment and quantity
        $requiredEquipment = DB::table('equipment_task')
            ->where('task_id', $task->id)
            ->get();

        // Aircraft's equipment with quantities
        $aircraftEquipment = DB::table('equipment_aircraft')
            ->where('aircraft_id', $aircraft->id)
            ->get()
            ->keyBy('equipment_id');

        $availableDates = [];
        $current = $start->copy();

        while ($current->lte($end)) {
            // Check reservation overlap for current date
            $isReserved = $reservations->contains(
                fn($res) =>
                $current->between(
                    Carbon::parse($res->reserved_from),
                    Carbon::parse($res->reserved_to)->subDay()
                )
            );

            if ($isReserved) {
                $current->addDay();
                continue;
            }

            // Check equipment availability
            $hasEnoughEquipment = true;

            foreach ($requiredEquipment as $eqReq) {
                $available = $aircraftEquipment->get($eqReq->equipment_id)?->quantity ?? 0;

                if ($available < $eqReq->quantity_required) {
                    $hasEnoughEquipment = false;
                    break;
                }
            }

            if ($hasEnoughEquipment) {
                $availableDates[] = $current->toDateString();
            }

            $current->addDay();
        }

        return $availableDates;
    }

    public function store(ReservationDto $dto): void
    {
        $reservation = new Reservation();
        $reservation->aircraft_id = $dto->aircraftId;
        $reservation->task_id = $dto->taskId;
        $reservation->reserved_from = $dto->from;
        $reservation->reserved_to = $dto->to;
        $reservation->createdBy()->associate($dto->user);
        $reservation->save();
    }
}