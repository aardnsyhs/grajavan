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
        return [Actions\CreateAction::make()];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'New' => Tab::make('New')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'New')),
            'Processing' => Tab::make('Processing')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Processing')),
            'Shipped' => Tab::make('Shipped')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Shipped')),
            'Delivered' => Tab::make('Delivered')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Delivered')),
            'Cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn ($query) => $query->where('status', 'Cancelled')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return OrderResource::getWidgets();
    }
}
