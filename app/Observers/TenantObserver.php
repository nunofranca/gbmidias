<?php

namespace App\Observers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TenantObserver
{
    /**
     * Handle the Tenant "created" event.
     */
    public function created(Tenant $tenant): void
    {
        User::withoutEvents(function () use ($tenant){
           $user = Auth::user();
           $user->update([
               'tenant_id' => $tenant->id
           ]);
        });
    }

    /**
     * Handle the Tenant "updated" event.
     */
    public function updated(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "deleted" event.
     */
    public function deleted(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "restored" event.
     */
    public function restored(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "force deleted" event.
     */
    public function forceDeleted(Tenant $tenant): void
    {
        //
    }
}
