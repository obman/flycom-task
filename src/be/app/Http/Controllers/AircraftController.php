<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use App\Http\Resources\AircraftMinimalResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AircraftController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AircraftMinimalResource::collection(Aircraft::all());
    }

    public function getAircraftsByTask(Task $task): AnonymousResourceCollection
    {
        $aircrafts = $task->getCompatibleAircraftsByTaskEquipment();
        return AircraftMinimalResource::collection($aircrafts);
    }
}
