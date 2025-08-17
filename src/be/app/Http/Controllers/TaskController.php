<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskMinimalResource;
use App\Models\Aircraft;
use Illuminate\Http\Request;
use App\Repositories\Task\TaskRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function __construct(
        private TaskRepository $repository
        )
    {}

    public function getTasksByAircraft(Aircraft $aircraft): AnonymousResourceCollection
    {
        $tasks = $this->repository->getTasksByAircraftEquipment($aircraft);
        return TaskMinimalResource::collection($tasks);
    }
}
