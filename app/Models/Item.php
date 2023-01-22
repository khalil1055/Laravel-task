<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 */
class Item extends Model
{
    use HasFactory;

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
