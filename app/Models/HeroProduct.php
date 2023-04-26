<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeroProduct extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

   public function bookable(): BelongsTo
    {
        return $this->belongsTo(Bookable::class);
    }
}
