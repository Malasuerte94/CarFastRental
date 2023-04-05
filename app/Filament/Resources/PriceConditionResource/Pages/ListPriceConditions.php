<?php

namespace App\Filament\Resources\PriceConditionResource\Pages;

use App\Filament\Resources\PriceConditionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriceConditions extends ListRecords
{
    protected static string $resource = PriceConditionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
