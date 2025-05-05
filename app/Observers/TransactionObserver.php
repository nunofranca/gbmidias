<?php

namespace App\Observers;

use App\Enum\StatusPaymentEnum;
use App\Models\Transaction;

use Illuminate\Support\Facades\Http;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */


    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        if($transaction->isDirty('status')){
            if($transaction->status == StatusPaymentEnum::PAID){
                $sale = $transaction->sale;              

                    Http::upmidias()->post('/', [
                        'key' => config('upmidias.token'),
                       "action"=> "add"  ,                  
                       "service"=> $sale->services[0]->service,
                       "link" => $sale->link,
                       "quantity"=> $sale->services->quantity
                    ])->json();
            }
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
  
}
