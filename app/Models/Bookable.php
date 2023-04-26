<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bookable extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function bookableAdjective(): HasMany
    {
        return $this->hasMany(BookableAdjective::class);
    }

    public function bookableFeatures(): HasMany
    {
        return $this->hasMany(BookableFeature::class);
    }

    public function bookableFeaturesDisplayed()
    {
        return $this->hasMany(BookableFeature::class)->whereHas('feature', function ($query) {
            $query->where('display_as_feature', true);
        });
    }

    public function stockFor($from, $to): bool
    {
        return 0 === $this->bookings()->betweenDates($from, $to)->count();
    }

    public function priceRules()
    {
        return $this->hasMany(PriceRule::class)->orWhere('global', true);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }

    public function heroProduct(): HasOne
    {
        return $this->hasOne(HeroProduct::class);
    }

}
