<?php

namespace App\Providers;

use App\Repositories\Aircrafts\AircraftRepository;
use App\Repositories\EloquentAircraftRepository;
use App\Repositories\EloquentReservationRepository;
use App\Repositories\ReservationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AircraftRepository::class, EloquentAircraftRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
