<?php

namespace App\Filament\Resources\BookTypeBookResource\Pages;

use App\Filament\Resources\BookTypeBookResource;
use Filament\Resources\Pages\EditRecord;

class EditBookTypeBook extends EditRecord
{
    protected static string $resource = BookTypeBookResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
