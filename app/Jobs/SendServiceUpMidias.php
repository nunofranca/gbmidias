<?php

namespace App\Jobs;

use App\Models\Sale;
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
    public function handle(): void
    {

        if($this->sale->services[0]->pivot->rate > Auth::user()->balance) return;

       Http::upmidias()->post('/', [
            'key' => config('upmidias.token'),
           "action"=> "add"  ,
           "service"=> $this->sale->services[0]->service,
           "link" => $this->sale->link,
           "quantity"=> $this->sale->services[0]->pivot->quantity
        ])->json();

       $this->sale->client()->decrement('balance',  $this->sale->services[0]->pivot->rate);
    }
}
