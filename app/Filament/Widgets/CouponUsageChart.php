<?php

namespace App\Filament\Widgets;

use App\Models\CouponUsage;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CouponUsageChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Coupon Usage Chart';

    protected function getData(): array
    {
        $data = CouponUsage::selectRaw('DATE(created_at) as date, count(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Coupon Usage',
                    'data' => $data->map(fn ($value) => $value->count),
                    'backgroundColor' => $this->getColor(),
                    'borderColor' => $this->getColor(),
                ],
            ],
            'labels' => $data->map(fn ($value) => Carbon::parse($value->date)->format('M d')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getColor(): string
    {
        return 'warning';
    }
}