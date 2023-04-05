<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeasonPriceResource\Pages;
use App\Filament\Resources\SeasonPriceResource\RelationManagers;
use App\Models\SeasonPrice;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
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

class SeasonPriceResource extends Resource
{
    protected static ?string $model = SeasonPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Price Rules';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('active'),
                Toggle::make('global'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(191),
                TextInput::make('description')
                    ->required()
                    ->maxLength(65535),
                TextInput::make('label')
                    ->required(),

                DatePicker::make('start_date')->required(),
                DatePicker::make('end_date')->required(),

                Select::make('operation')
                    ->options([
                        'add' => 'Add',
                        'subtract' => 'Subtract',
                        'multiply' => 'Multiply',
                        'divide' => 'Divide',
                    ])
                    ->required(),

                Radio::make('type')
                ->options([
                    'fixed' => 'Fixed',
                    'percentage' => 'Percentage',
                ]),

                TextInput::make('value')
                    ->required()
                    ->type('number')
                    ->step('0.01'),

                Select::make('multiplier')
                    ->options([
                        'per_day' => 'Per Day',
                        'once' => 'Once',
                    ])
                    ->required(),

                TextInput::make('order')
                    ->required()
                    ->type('number')
                    ->step('1'),

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
                TextColumn::make('start_date'),
                TextColumn::make('end_date'),
                TextColumn::make('operation'),
                TextColumn::make('type'),
                TextColumn::make('value'),
                IconColumn::make('global')
                ->boolean()
                ->trueIcon('heroicon-o-badge-check')
                ->falseIcon('heroicon-o-x-circle'),
                TextColumn::make('order')
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
            'index' => Pages\ListSeasonPrices::route('/'),
            'create' => Pages\CreateSeasonPrice::route('/create'),
            'edit' => Pages\EditSeasonPrice::route('/{record}/edit'),
        ];
    }
}
