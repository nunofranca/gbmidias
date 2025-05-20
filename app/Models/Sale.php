<?php

namespace App\Models;

use App\Observers\SaleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([SaleObserver::class])]
class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'link', 'quantity','totalValue', 'valueUnity', 'service_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function services():BelongsTo
    {
        return $this->belongsTo(Service::class);
    }



}
