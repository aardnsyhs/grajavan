<?php

namespace App\Filament\Resources\BookTypeResource\Pages;

use App\Filament\Resources\BookTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookType extends CreateRecord
{
    protected static string $resource = BookTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
