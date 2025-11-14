<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Services\Service\ServiceServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SendServiceUpMidias implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Sale $sale)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ServiceServiceInterface $serviceService): void
    {

        if($this->sale->totalValue > $this->sale->user->balance) return;

        $service = $serviceService->getById($this->sale->service_id);

       Http::upmidias()->post('/', [
            'key' => config('upmidias.token'),
           "action"=> "add"  ,
           "service"=> $service->service,
           "link" => $this->sale->link,
           "quantity"=> $this->sale->quantity
        ])->json();

       $this->sale->user->decrement('balance',  $this->sale->totalValue);

       $userStore = $this->sale->service->user;
       $commission = $this->sale->service->rate - $this->sale->service->coast;
       $userStore->increment('balance', $commission);

    }
}
