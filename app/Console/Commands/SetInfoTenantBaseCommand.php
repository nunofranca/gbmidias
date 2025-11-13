<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;

class SetInfoTenantBaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-user-tenant-base-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenant = Tenant::where('name', 'GBMidias')->first();

        User::get()->each(function ($user) use ($tenant) {
            $user->update(['tenant_id' => $tenant->id]);
        });
    }
}
