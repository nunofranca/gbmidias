<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Str;

class ServiceObserver
{
 
    /**
     * Handle the Service "updated" event.
     */
    public function updating(Service $service): void
    {
        $service['rate'] =  Str::remove(['.', ','], $service['rate']);
    }

}
