<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Aircraft;
use App\DTO\ReservationDto;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use App\Repositories\Reservation\ReservationRepository;

class ReservationService
{
    public function __construct(
        private ReservationRepository $reservationRepository,
    )
    {}

    public function getDates(Task $task, Aircraft $aircraft, Carbon $month): Collection
    {
        $tasks = $aircraft->getCompatibleTasksByAircraftEquipment();
        if ($tasks->isEmpty()) {
            throw new \Exception('No compatible tasks.');
        }
        $aircrafts = $task->getCompatibleAircraftsByTaskEquipment();
        if ($aircrafts->isEmpty()) {
            throw new \Exception('No compatible aircrafts.');
        }

        $taskIds = $tasks->pluck('id')->toArray();
        $aircraftIds = $aircrafts->pluck('id')->toArray();
        $dates = $this->reservationRepository->getAvailableDatesForMonth($taskIds, $aircraftIds, $month);
        return collect($dates)->values()->map(function ($date, $index) {
            return [
                'id' => $index + 1,
                'date' => $date,
            ];
        });
    }

    public function reserve(ReservationDto $dto)
    {
        $this->reservationRepository->store($dto);
    }
}
