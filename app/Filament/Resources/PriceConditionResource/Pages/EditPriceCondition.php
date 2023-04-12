<?php

namespace App\Filament\Resources\PriceConditionResource\Pages;

use App\Filament\Resources\PriceConditionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPriceCondition extends EditRecord
{
    protected static string $resource = PriceConditionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
