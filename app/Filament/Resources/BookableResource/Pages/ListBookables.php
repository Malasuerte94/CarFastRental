<?php

namespace App\Filament\Resources\BookableResource\Pages;

use App\Filament\Resources\BookableResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookables extends ListRecords
{
    protected static string $resource = BookableResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
