<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Observers\WithdrawObserver;


#[ObservedBy([WithdrawObserver::class])]
class Withdraw extends Model
{

    use SoftDeletes;

    protected $fillable = ['user_id', 'value', 'status', 'keyPix', 'name'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
