<?php

namespace App\Models;

use App\Observers\ConfigObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


#[ObservedBy([ConfigObserver::class])]
class Config extends Model
{
    use SoftDeletes;
    protected $fillable =['user_id', 'instagram', 'whatsapp', 'logo'];

    public function user():BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
}
