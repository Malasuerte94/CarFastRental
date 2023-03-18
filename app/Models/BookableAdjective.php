<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookableAdjective extends Model
{
    use HasFactory;

    public function bookable()
    {
        return $this->belongsToMany(Bookable::class);
    }
    public function adjective()
    {
        return $this->belongsToMany(Adjective::class);
    }
}
