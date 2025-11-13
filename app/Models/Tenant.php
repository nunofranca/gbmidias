<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


#[ObservedBy(Tenant::class)]
class Tenant extends Model
{
    use  SoftDeletes;

    protected $fillable = ['name', 'url', 'status', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
}
