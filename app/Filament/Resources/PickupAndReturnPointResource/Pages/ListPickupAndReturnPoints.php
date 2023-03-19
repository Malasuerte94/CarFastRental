<?php

namespace App\Filament\Resources\PickupAndReturnPointResource\Pages;

use App\Filament\Resources\PickupAndReturnPointResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPickupAndReturnPoints extends ListRecords
{
    protected static string $resource = PickupAndReturnPointResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
