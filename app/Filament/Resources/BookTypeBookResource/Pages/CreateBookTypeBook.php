<?php

namespace App\Filament\Resources\BookTypeBookResource\Pages;

use App\Filament\Resources\BookTypeBookResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookTypeBook extends CreateRecord
{
    protected static string $resource = BookTypeBookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
