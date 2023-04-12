<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookableAdjective()
    {
        return $this->hasMany(BookableAdjective::class);
    }

    public function stockFor($from, $to): bool
    {
        return 0 === $this->bookings()->betweenDates($from, $to)->count();
    }

    public function priceRules()
    {
        return $this->hasMany(PriceRule::class)->orWhere('global', true);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

}
