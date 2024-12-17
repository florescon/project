<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Post;
use App\Models\Shop\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PostsPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Pedidos';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Trend::model(Order::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->dateColumn('created_at')
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'No. de Pedidos',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
