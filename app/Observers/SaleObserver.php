<?php

namespace App\Observers;

use App\Jobs\SendServiceUpMidias;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     */

    public function creating(Sale $sale)
    {
        $sale->user_id = Auth::id();
        $sale->totalValue = (int) ceil(($sale->rate * $sale->quantity) / 1000);
        $sale->valueUnity = (int) ceil($sale->rate / 1000);

    }

    public function created(Sale $sale): void
    {
        SendServiceUpMidias::dispatch($sale)->onQueue('gbmidias-default');

    }

    /**
     * Handle the Sale "updated" event.
     */
    public function updated(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "deleted" event.
     */
    public function deleted(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "restored" event.
     */
    public function restored(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     */
    public function forceDeleted(Sale $sale): void
    {
        //
    }
}
