<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookableResource\Pages;
use App\Filament\Resources\BookableResource\RelationManagers\BookingsRelationManager;
use App\Models\Bookable;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class BookableResource extends Resource
{
    protected static ?string $model = Bookable::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Main Resources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(191)->columnSpanFull(),
                RichEditor::make('description')
                    ->required()
                    ->maxLength(65535)->columnSpanFull(),
                //TextInput::make('main_image'),
                FileUpload::make('main_image')
                ->preserveFilenames()
                ->image()
                ->imagePreviewHeight('250')
                ->loadingIndicatorPosition('left')
                ->uploadButtonPosition('left')
                ->uploadProgressIndicatorPosition('left')
                ->directory('uploads/product-images'),
                TextInput::make('price')
                    ->required(),
                Repeater::make('bookableAdjective')
                ->relationship()
                ->schema([
                    TextInput::make('value')->required(),
                    Select::make('adjective_id')->relationship('adjective', 'name')->required(),
                ])
                ->columns(2)->createItemButtonLabel('Add New')
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
                ImageColumn::make('main_image'),
                TextColumn::make('price'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            BookingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookables::route('/'),
            'create' => Pages\CreateBookable::route('/create'),
            'edit' => Pages\EditBookable::route('/{record}/edit'),
            'view' => Pages\ViewBookable::route('/{record}'),
        ];
    }
}
