<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use  SoftDeletes;

    protected $fillable = ['name', 'url'];

    public function user():BelongsTo
    {
        return  $this->hasMany(User::class);
    }
}
