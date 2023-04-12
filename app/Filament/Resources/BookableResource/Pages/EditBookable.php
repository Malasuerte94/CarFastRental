<?php

namespace App\Filament\Resources\BookableResource\Pages;

use App\Filament\Resources\BookableResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookable extends EditRecord
{
    protected static string $resource = BookableResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
