<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookTypeResource\Pages;
use App\Models\BookType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
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

class BookTypeResource extends Resource
{
    protected static ?string $model = BookType::class;

    protected static ?string $navigationGroup = 'Library';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make([
                Grid::make(1)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Section::make('Foto')->schema([
                            FileUpload::make('image')
                                ->hiddenLabel()
                                ->image()
                                ->required()
                                ->directory('bookTypes')
                        ]),
                        Toggle::make('is_active')
                            ->required()
                            ->default(true),
                    ]),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListBookTypes::route('/'),
            'create' => Pages\CreateBookType::route('/create'),
            'edit' => Pages\EditBookType::route('/{record}/edit'),
        ];
    }
}
