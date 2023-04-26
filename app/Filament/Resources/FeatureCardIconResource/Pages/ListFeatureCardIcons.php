<?php

namespace App\Filament\Resources\FeatureCardIconResource\Pages;

use App\Filament\Resources\FeatureCardIconResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeatureCardIcons extends ListRecords
{
    protected static string $resource = FeatureCardIconResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
