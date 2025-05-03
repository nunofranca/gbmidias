<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = ['client_id', 'quantity', 'valueUnity', 'totalValue'];

    public function client():BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function transaction():HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
