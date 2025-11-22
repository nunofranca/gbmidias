<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Sale;
use Illuminate\Support\Facades\Http;
class VerifyStatusSaleJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Sale $sale)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         //$this->sale->user->decrement('balance', $this->sale->totalValue);

          $order = Http::upmidias()->post('/', [
                'key' => config('upmidias.token'),
                "action" => "status",
                "order" => $this->sale->order
            ])->json();

            if($order['status'] == 'Pending'){
                VerifyStatusSaleJob::dispatch($this->sale)->delay(now()->addMinutes(1)); 
                return;               
            };


        

        $userStore = $this->sale->service->user;
        $commission = ($this->sale->quantity * ($this->sale->service->rate/1000)) - $this->sale->service->coast;
        $userStore->increment('balance', $commission);
    }
}
