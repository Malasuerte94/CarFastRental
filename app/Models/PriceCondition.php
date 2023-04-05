<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceCondition extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function priceRule(): BelongsTo
    {
        return $this->belongsTo(PriceRule::class);
    }
}
