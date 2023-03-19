<?php

namespace App\Filament\Resources\AdjectiveResource\Pages;

use App\Filament\Resources\AdjectiveResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdjective extends EditRecord
{
    protected static string $resource = AdjectiveResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
