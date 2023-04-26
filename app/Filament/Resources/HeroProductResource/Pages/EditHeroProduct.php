<?php

namespace App\Filament\Resources\HeroProductResource\Pages;

use App\Filament\Resources\HeroProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeroProduct extends EditRecord
{
    protected static string $resource = HeroProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
