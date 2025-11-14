<?php

namespace App\Jobs;

use App\Models\Service;
use App\Models\User;
use App\Services\Service\ServiceServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ModifyRateWithPercentJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected User $user, protected Service $service, protected string $percent)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ServiceServiceInterface $serviceService): void
    {

        $serviceService->modifyRateWithPercent($this->user, $this->service, $this->percent);

    }
}
