<?php

namespace App\Jobs;

use App\Models\Sale;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
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
    public function handle(): void
    {

       Http::upmidias()->post('/', [
            'key' => config('upmidias.token'),
           "action"=> "add"  ,
           "service"=> $this->sale->services[0]->service,
           "link" => $this->sale->link,
           "quantity"=> $this->sale->services[0]->pivot->quantity
        ])->json();

       $this->sale->cliente->decrement('balance',  $this->sale->services[0]->pivot->rate);
    }
}
