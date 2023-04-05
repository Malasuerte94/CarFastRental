<?php

namespace App\Filament\Resources\SeasonPriceResource\Pages;

use App\Filament\Resources\SeasonPriceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeasonPrices extends ListRecords
{
    protected static string $resource = SeasonPriceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
