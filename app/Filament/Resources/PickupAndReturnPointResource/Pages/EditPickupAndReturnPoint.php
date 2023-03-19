<?php

namespace App\Filament\Resources\PickupAndReturnPointResource\Pages;

use App\Filament\Resources\PickupAndReturnPointResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPickupAndReturnPoint extends EditRecord
{
    protected static string $resource = PickupAndReturnPointResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
