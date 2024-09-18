<?php

namespace App\Filament\Resources\BookTypeResource\Pages;

use App\Filament\Resources\BookTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookTypes extends ListRecords
{
    protected static string $resource = BookTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
