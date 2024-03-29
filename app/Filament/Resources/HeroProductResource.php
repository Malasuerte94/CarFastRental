<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroProductResource\Pages;
use App\Models\HeroProduct;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class HeroProductResource extends Resource
{
    protected static ?string $model = HeroProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Website Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bookable_id')->relationship('bookable', 'title')->nullable(),
                Toggle::make('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Bookable.title'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListHeroProducts::route('/'),
            'create' => Pages\CreateHeroProduct::route('/create'),
            'edit' => Pages\EditHeroProduct::route('/{record}/edit'),
        ];
    }
}
