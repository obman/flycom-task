<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskMinimalResource;
use App\Models\Aircraft;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TaskMinimalResource::collection(Task::all());
    }

    public function getTasksByAircraft(Aircraft $aircraft): AnonymousResourceCollection
    {
        $tasks = $aircraft->getCompatibleTasksByAircraftEquipment();
        return TaskMinimalResource::collection($tasks);
    }
}
