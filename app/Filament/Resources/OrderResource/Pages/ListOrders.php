<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListOrders extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'Pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Pending')),
            'Processing' => Tab::make('Processing')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Processing')),
            'Completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Completed')),
            'Cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Cancelled')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return OrderResource::getWidgets();
    }
}
