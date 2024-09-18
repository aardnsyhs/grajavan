<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\BookType;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookCategoryOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Book::count()),
            Stat::make('Total Kategori', Category::count()),
            Stat::make('Total Tipe Buku', BookType::count()),
        ];
    }
}
