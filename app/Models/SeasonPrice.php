<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonPrice extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

}
