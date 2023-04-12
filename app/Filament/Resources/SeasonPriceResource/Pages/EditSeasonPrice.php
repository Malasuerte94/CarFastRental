<?php

namespace App\Filament\Resources\SeasonPriceResource\Pages;

use App\Filament\Resources\SeasonPriceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeasonPrice extends EditRecord
{
    protected static string $resource = SeasonPriceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
