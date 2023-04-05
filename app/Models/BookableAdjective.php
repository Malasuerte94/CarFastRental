<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookableAdjective extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }
    public function adjective()
    {
        return $this->belongsTo(Adjective::class);
    }
}
