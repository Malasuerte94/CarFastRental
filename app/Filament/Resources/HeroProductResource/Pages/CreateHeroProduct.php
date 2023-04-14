<?php

namespace App\Filament\Resources\HeroProductResource\Pages;

use App\Filament\Resources\HeroProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHeroProduct extends CreateRecord
{
    protected static string $resource = HeroProductResource::class;
}
