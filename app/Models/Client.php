<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'phone', 'threadId'];

    public function sales():HasMany
    {
        return $this->hasMany(Sale::class);
    }


    public function asks():HasMany
    {
        return $this->hasMany(Ask::class);
    }
}
