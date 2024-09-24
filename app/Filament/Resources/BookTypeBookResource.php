<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookTypeBookResource\Pages;
use App\Models\BookTypeBook;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookTypeBookResource extends Resource
{
    protected static ?string $model = BookTypeBook::class;

    protected static ?string $navigationGroup = 'Library';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make(2)
                        ->schema([
                            Select::make('book_id')
                                ->relationship('book', 'title')
                                ->label('Pilih Buku')
                                ->required(),
                            Select::make('book_type_id')
                                ->relationship('bookType', 'name')
                                ->label('Pilih Tipe')
                                ->required(),
                        ]),
                    Grid::make(1)
                        ->schema([
                            TextInput::make('stock')
                                ->required()
                                ->label('Stok')
                                ->numeric(),
                        ]),
                    Toggle::make('is_active')
                        ->required()
                        ->default(true),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book.title')->label('Judul Buku')->sortable()->searchable(),
                TextColumn::make('bookType.name')->label('Tipe Buku')->sortable()->searchable(),
                TextColumn::make('stock')->numeric()->label('Stok')->sortable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBookTypeBooks::route('/'),
            'create' => Pages\CreateBookTypeBook::route('/create'),
            'edit' => Pages\EditBookTypeBook::route('/{record}/edit'),
        ];
    }
}
