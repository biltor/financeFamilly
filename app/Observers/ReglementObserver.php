<?php

namespace App\Observers;

use App\Models\reglement;
use App\Services\ReglementService;
use Illuminate\Support\Facades\Auth;


class ReglementObserver
{
    /**
     * Handle the reglement "created" event.
     */
    public function created(reglement $reglement): void
    {
      app(ReglementService::class)->handleReglement($reglement);
    }

    /**
     * Handle the reglement "updated" event.
     */
    public function updated(reglement $reglement): void
    {
        //
    }

    /**
     * Handle the reglement "deleted" event.
     */
    public function deleted(reglement $reglement): void
    {
        //
    }

    /**
     * Handle the reglement "restored" event.
     */
    public function restored(reglement $reglement): void
    {
        //
    }

    /**
     * Handle the reglement "force deleted" event.
     */
    public function forceDeleted(reglement $reglement): void
    {
        //
    }
}
