<?php

namespace App\Observers;

use App\Enum\StatusPaymentEnum;
use App\Models\Transaction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function creating(Transaction $transaction)
    {
        $transaction->user_id = Auth::id();
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        if ($transaction->isDirty('status')) {
            if ($transaction->status == StatusPaymentEnum::PAID) {

                $transaction->user()->increment('balance', $transaction->value);

            }
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */

}
