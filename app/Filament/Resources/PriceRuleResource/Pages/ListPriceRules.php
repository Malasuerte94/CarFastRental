<?php

namespace App\Filament\Resources\PriceRuleResource\Pages;

use App\Filament\Resources\PriceRuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriceRules extends ListRecords
{
    protected static string $resource = PriceRuleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
