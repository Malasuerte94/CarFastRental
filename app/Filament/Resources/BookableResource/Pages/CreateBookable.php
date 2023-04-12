<?php

namespace App\Filament\Resources\BookableResource\Pages;

use App\Filament\Resources\BookableResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookable extends CreateRecord
{
    protected static string $resource = BookableResource::class;
}
