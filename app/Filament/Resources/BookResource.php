<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationGroup = 'Library';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->label('Judul'),
                            TextInput::make('author')
                                ->required()
                                ->maxLength(255)
                                ->label('Pengarang'),
                        ]),
                    Grid::make(2)
                        ->schema([
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->label('Kategori')
                                ->required(),
                            TextInput::make('year')
                                ->numeric()
                                ->required()
                                ->label('Tahun Terbit'),
                        ]),
                    MarkdownEditor::make('description')
                        ->label('Deskripsi')
                        ->required()
                        ->maxLength(1000),
                    TextInput::make('rating')
                        ->numeric()
                        ->required()
                        ->step(0.1)
                        ->label('Rating'),
                ]),
                Section::make('Foto')->schema([
                    FileUpload::make('image')
                        ->hiddenLabel()
                        ->image()
                        ->required()
                        ->directory('books')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul')->sortable()->searchable()->formatStateUsing(fn (string $state): string => Str::words($state, 5, '...')),
                TextColumn::make('category.name')->label('Kategori')->sortable(),
                TextColumn::make('author')->label('Pengarang')->sortable()->searchable(),
                TextColumn::make('year')->label('Tahun')->sortable(),
                TextColumn::make('rating')->label('Rating')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
