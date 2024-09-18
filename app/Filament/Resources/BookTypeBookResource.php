<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookTypeBookResource\Pages;
use App\Models\BookTypeBook;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookTypeBookResource extends Resource
{
    protected static ?string $model = BookTypeBook::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('book_id')
                    ->relationship('book', 'title')
                    ->label('Pilih Buku')
                    ->required(),
                Forms\Components\Select::make('book_type_id')
                    ->relationship('book_type', 'name')
                    ->label('Pilih Tipe')
                    ->required(),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('book_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('book_type_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
