<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookableResource\Pages;
use App\Filament\Resources\BookableResource\RelationManagers\BookingsRelationManager;
use App\Models\Bookable;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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

        //0x3c16c0292761162a41341d487e81374b9cbf077a


        return $form
            ->schema([
                Tabs::make('Heading')
                    ->tabs([
                        Tab::make('General')
                            ->icon('heroicon-o-bell')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(191)->columnSpanFull(),
                                RichEditor::make('description')
                                    ->required()
                                    ->maxLength(65535)->columnSpanFull(),
                                FileUpload::make('main_image')
                                    ->preserveFilenames()
                                    ->image()
                                    ->imagePreviewHeight('250')
                                    ->loadingIndicatorPosition('left')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->directory('uploads/product-images')->columns(2),
                                TextInput::make('price')
                                    ->required(),
                                TextInput::make('year')
                                    ->required(),
                            ]),
                        Tab::make('Properties')
                            ->icon('heroicon-o-bell')
                            ->schema([
                                Repeater::make('bookableAdjective')
                                    ->relationship()
                                    ->schema([
                                        Select::make('adjective_id')->relationship('adjective', 'name')->required(),
                                        TextInput::make('value')->required(),
                                    ])
                                    ->columns(2)->createItemButtonLabel('Add New'),
                            ]),
                        Tab::make('Features')
                            ->icon('heroicon-o-bell')
                            ->schema([
                                Repeater::make('bookableFeatures')
                                    ->relationship()
                                    ->schema([
                                        Select::make('feature_id')->relationship('feature', 'name')->required(),
                                        TextInput::make('value'),
                                    ])
                                    ->columns(2)->createItemButtonLabel('Add New')
                            ]),
                    ])->columnSpan('full'),
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
            'index'  => Pages\ListBookables::route('/'),
            'create' => Pages\CreateBookable::route('/create'),
            'edit'   => Pages\EditBookable::route('/{record}/edit'),
            'view'   => Pages\ViewBookable::route('/{record}'),
        ];
    }
}
