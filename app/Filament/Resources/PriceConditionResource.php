<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceConditionResource\Pages;
use App\Filament\Resources\PriceConditionResource\RelationManagers;
use App\Models\PriceCondition;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceConditionResource extends Resource
{
    protected static ?string $model = PriceCondition::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Price Rules';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('active'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(191),
                TextInput::make('description')
                    ->required()
                    ->maxLength(65535),
                TextInput::make('label')
                    ->required(),
                Radio::make('status')
                ->options([
                    'draft' => 'Weekends',
                    'scheduled' => 'Holiday',
                    'published' => 'Cart',
                    'payment' => 'Payment Method'
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                IconColumn::make('active')
                ->boolean()
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('name'),
                TextColumn::make('condition'),

                TextColumn::make('created_at')
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
            'index' => Pages\ListPriceConditions::route('/'),
            'create' => Pages\CreatePriceCondition::route('/create'),
            'edit' => Pages\EditPriceCondition::route('/{record}/edit'),
        ];
    }
}
