<?php

namespace App\Http\Controllers;

use App\Models\Aircraft;
use Illuminate\Http\Request;
use App\Http\Resources\AircraftMinimalResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AircraftController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AircraftMinimalResource::collection(Aircraft::all());
    }
}
