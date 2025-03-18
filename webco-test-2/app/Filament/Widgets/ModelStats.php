<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductType;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ModelStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Products', Product::count()),
            Stat::make('Product Categories', ProductCategory::count()),
            Stat::make('Product Colors', ProductColor::count()),
            Stat::make('Product Types', ProductType::count()),
        ];
    }
}