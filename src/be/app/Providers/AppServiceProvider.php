<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Aircraft\EloquentAircraftRepository;
use App\Repositories\Aircraft\AircraftRepository;

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
