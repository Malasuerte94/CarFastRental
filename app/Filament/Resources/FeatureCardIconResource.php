<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureCardIconResource\Pages;
use App\Filament\Resources\FeatureCardIconResource\RelationManagers;
use App\Models\FeatureCardIcon;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeatureCardIconResource extends Resource
{
    protected static ?string $model = FeatureCardIcon::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Website Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('icon')
                ->preserveFilenames()
                ->image()
                ->imagePreviewHeight('50')
                ->loadingIndicatorPosition('left')
                ->uploadButtonPosition('left')
                ->uploadProgressIndicatorPosition('left')
                ->directory('assets'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                TextInput::make('order')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon'),
                TextColumn::make('title'),
                TextColumn::make('order'),
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
            'index' => Pages\ListFeatureCardIcons::route('/'),
            'create' => Pages\CreateFeatureCardIcon::route('/create'),
            'edit' => Pages\EditFeatureCardIcon::route('/{record}/edit'),
        ];
    }
}
