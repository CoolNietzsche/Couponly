<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Total number of users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Total Coupons', Coupon::count())
                ->description('Total number of coupons')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('warning'),
            Stat::make('Total Categories', Category::count())
                ->description('Total number of categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
            Stat::make('Total Stores', Store::count())
                ->description('Total number of stores')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('danger'),
        ];
    }
}
