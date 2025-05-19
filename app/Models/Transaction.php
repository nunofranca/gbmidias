<?php

namespace App\Models;

use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'correlationID',
        'value',
        'comment',
        'paymentLinkUrl',
        'qrCodeImage',
        'status'
    ];

    public function client():BelongsTo
    {
        return $this->belongsTo(Client::class);
    }



}
