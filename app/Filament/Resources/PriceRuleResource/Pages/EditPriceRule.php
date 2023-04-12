<?php

namespace App\Filament\Resources\PriceRuleResource\Pages;

use App\Filament\Resources\PriceRuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPriceRule extends EditRecord
{
    protected static string $resource = PriceRuleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
