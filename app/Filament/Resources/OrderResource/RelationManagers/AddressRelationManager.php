<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name',)
                    ->label('Nama Depan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name',)
                    ->label('Nama Belakang')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('No Telepon')
                    ->required()
                    ->numeric()
                    ->maxLength(14),
                TextInput::make('city')
                    ->label('Kota')
                    ->required()
                    ->maxLength(255),
                TextInput::make('state')
                    ->label('Provinsi')
                    ->required()
                    ->maxLength(255),
                TextInput::make('postal_code')
                    ->label('Kode Pos')
                    ->required()
                    ->numeric()
                    ->maxLength(5),
                Textarea::make('street_address')
                    ->label('Alamat Lengkap')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                    ->label('Nama Lengkap'),
                TextColumn::make('phone')
                    ->label('No Telepon'),
                TextColumn::make('city')
                    ->label('Kota'),
                TextColumn::make('state')
                    ->label('Provinsi'),
                TextColumn::make('postal_code')
                    ->label('Kode Pos'),
                TextColumn::make('street_address')
                    ->label('Alamat Lengkap'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
