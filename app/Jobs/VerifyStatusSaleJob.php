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

         

            if($order['status'] == 'Pending' || $order['status'] == 'Partial' || $order['status'] == 'Processing' || $order['status'] == 'In progress'){
                

                $status = match($order['status']){                
                    'pending' => 'Pendente',
                    'partial' => 'Parcial',
                    'processing' => 'Processando',
                    'in progress' => 'Em andamento',
                };
               
                
                VerifyStatusSaleJob::dispatch($this->sale)->delay(now()->addMinutes(1)); 
                $this->sale->update(['status' => $status]);
                return;               
            };

            if($order['status'] == 'Canceled'){
                $this->sale->update(['status' => 'Cancelado']);
                return;               
            };
              if($order['status'] == 'Completed'){

                $userStore = $this->sale->service->user;
                $commission = ($this->sale->quantity * ($this->sale->service->rate/1000)) - ($this->sale->quantity * ($this->sale->service->coast/1000)) ;
                $userStore->increment('balance', $commission);

                $this->sale->update(['status' => 'Completo']);
                            
            };
            


        

        
    }
}
