<?php

namespace App\Models;

use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sale_id', 
        'correlationID', 
        'value', 
        'comment', 
        'paymentLinkUrl', 
        'qrCodeImage',
        'status'
    ];


    public function sale():BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }


}
