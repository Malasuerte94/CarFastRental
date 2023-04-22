<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookableFeature extends Model
{
    protected $guarded = [
        'id',
    ];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    use HasFactory;
}
