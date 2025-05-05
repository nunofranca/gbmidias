<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sale_id', 
        'correlationID', 
        'totalValue', 
        'comment', 
        'paymentLinkUrl', 
        'qrCodeImage'
    ];


    public function sale():BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }


}
