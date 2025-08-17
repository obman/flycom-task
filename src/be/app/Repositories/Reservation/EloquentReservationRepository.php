<?php

namespace App\Repositories\Reservation;

use App\DTO\ReservationDto;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentReservationRepository implements ReservationRepository
{
    public function getAvailableDatesForMonth(array $taskIds, array $aircraftIds, Carbon $month): array
    {
        $start = $month->copy()->startOfMonth();
        $end = $month->copy()->endOfMonth();

        $reservationDays = DB::table('reservation_days')
            ->join('reservations', 'reservation_days.reservation_id', '=', 'reservations.id')
            ->whereIn('reservations.task_id', $taskIds)
            ->whereIn('reservations.aircraft_id', $aircraftIds)
            ->whereBetween('reservation_days.reserved_date', [$start, $end])
            ->pluck('reservation_days.reserved_date')
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        return $reservationDays;
    }

    public function store(ReservationDto $dto): void
    {
        $reservation = new Reservation();
        $reservation->aircraft_id = $dto->aircraftId;
        $reservation->task_id = $dto->taskId;
        $reservation->createdBy()->associate($dto->user);
        $reservation->save();

        DB::transaction(function () use ($dto) {
            $reservation = new Reservation();
            $reservation->aircraft_id = $dto->aircraftId;
            $reservation->task_id = $dto->taskId;
            $reservation->createdBy()->associate($dto->user);
            $reservation->save();

            $days = [];
            $now = now();
            foreach ($dto->expandedDates() as $date) {
                $days[] = [
                    'reservation_id' => $reservation->id,
                    'reserved_date' => $date,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('reservation_days')->insert($days);
        });
    }
}