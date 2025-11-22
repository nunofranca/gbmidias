<?php

namespace App\Observers;

use App\Models\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConfigObserver
{
    /**
     * Handle the Config "created" event.
     */
    public function creating(Config $config): void
    {

        $config->user_id = Auth::id();
        $config->whatsapp = Str::remove(['(', ')', ' ', '-'], $config->whatsapp);

    }

}
