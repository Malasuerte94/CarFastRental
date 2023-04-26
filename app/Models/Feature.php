<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    protected $guarded = [
        'id',
    ];

    public function bookableFeature(): BelongsToMany
    {
        return $this->belongsToMany(BookableFeature::class);
    }


    public function scopeDisplayAsFeature($query)
    {
        return $query->where('display_as_feature', true);
    }

    use HasFactory;
}
