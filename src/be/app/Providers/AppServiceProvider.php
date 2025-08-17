<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Aircraft\AircraftRepository;
use App\Repositories\Task\EloquentTaskRepository;
use App\Repositories\Reservation\ReservationRepository;
use App\Repositories\Aircraft\EloquentAircraftRepository;
use App\Repositories\Reservation\EloquentReservationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AircraftRepository::class, EloquentAircraftRepository::class);
        $this->app->bind(TaskRepository::class, EloquentTaskRepository::class);
        $this->app->bind(ReservationRepository::class, EloquentReservationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.debug')) {
            DB::listen(function($query) {
                Log::debug(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
            });
        }
    }
}
