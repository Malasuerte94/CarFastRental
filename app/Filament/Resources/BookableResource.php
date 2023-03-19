<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookableResource\Pages;
use App\Filament\Resources\BookableResource\RelationManagers;
use App\Models\Bookable;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookableResource extends Resource
{
    protected static ?string $model = Bookable::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
                TextInput::make('main_image'),
                TextInput::make('price')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
                TextColumn::make('title'),
                TextColumn::make('description'),
                ImageColumn::make('main_image'),
                TextColumn::make('price'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookables::route('/'),
            'create' => Pages\CreateBookable::route('/create'),
            'edit' => Pages\EditBookable::route('/{record}/edit'),
        ];
    }    
}
