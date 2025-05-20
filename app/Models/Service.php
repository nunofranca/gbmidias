<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\ServiceObserver;


#[ObservedBy([ServiceObserver::class])]
class Service extends Model
{
    use SoftDeletes;

    protected $fillable =[

        'service',
        'name',
        'type',
        'rate',
        'coast',
        'min',
        'max',
        'dripfeed',
        'refill',
        'cancel',
        'category',
        'status'
    ];
    protected function casts(): array
    {
        return [
            'dripfeed' => 'boolean',
            'refill'  => 'boolean',
            'cancel' => 'boolean',
            'status' => 'boolean'
        ];
    }

    public function category():BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }

    public function sales():HasMany
    {
        return $this->hasMany(Sale::class);
    }

}
