<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ChangeDeviseService;
use App\Models\exchange;
use App\Models\reglement;
use App\Observers\ExchangeObserver;
use App\Observers\ReglementObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        exchange::observe(ExchangeObserver::class);
        reglement::observe(ReglementObserver::class);
    }
}
