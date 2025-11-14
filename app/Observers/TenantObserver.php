<?php

namespace App\Observers;

use App\Models\Service;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TenantObserver
{
    /**
     * Handle the Tenant "created" event.
     */
    public function creating(Tenant $tenant): void
    {
        $tenant->user_id = $tenant->user_id ?? Auth::id();
    }

    /**
     * Handle the Tenant "updated" event.
     */
    public function created(Tenant $tenant): void
    {
        $tenant->user->removeRole('CLIENT');
        $tenant->user->assignRole(['ADMIN']);


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
