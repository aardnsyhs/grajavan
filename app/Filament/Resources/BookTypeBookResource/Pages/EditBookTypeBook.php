<?php

namespace App\Filament\Resources\BookTypeBookResource\Pages;

use App\Filament\Resources\BookTypeBookResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookTypeBook extends EditRecord
{
    protected static string $resource = BookTypeBookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
