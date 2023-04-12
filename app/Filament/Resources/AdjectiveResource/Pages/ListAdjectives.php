<?php

namespace App\Filament\Resources\AdjectiveResource\Pages;

use App\Filament\Resources\AdjectiveResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdjectives extends ListRecords
{
    protected static string $resource = AdjectiveResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
