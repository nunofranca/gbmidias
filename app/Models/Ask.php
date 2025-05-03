<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ask extends Model
{
    use SoftDeletes;

    protected $fillable = ['client_id', 'ask', 'askId'];

    public function client():BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
