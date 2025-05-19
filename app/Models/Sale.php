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

    protected $fillable = ['client_id', 'totalValue', 'link'];

    public function client():BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function services():BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('quantity', 'valueUnity');;
    }

}
