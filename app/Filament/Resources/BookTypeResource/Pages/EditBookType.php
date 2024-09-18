<?php

namespace App\Filament\Resources\BookTypeResource\Pages;

use App\Filament\Resources\BookTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookType extends EditRecord
{
    protected static string $resource = BookTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}