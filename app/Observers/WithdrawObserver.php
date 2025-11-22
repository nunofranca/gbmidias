<?php
declare(strict_types=1);
namespace App\Observers;

use App\Models\Withdraw;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class WithdrawObserver
{
    /**
     * Handle the Withdraw "created" event.
     */
    public function creating(Withdraw $withdraw): void
    {



        $withdraw->user_id = Auth::id();
        $withdraw->value = Str::remove(['.', '-', ',', ' '], $withdraw->value);


    }

}
