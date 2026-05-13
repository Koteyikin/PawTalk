<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ArticlesChartWidget extends ChartWidget
{
    protected ?string $heading = 'Статьи за последние 7 дней';
    protected int|string|array $columnSpan = 2;
    protected function getData(): array
    {
        $data = collect(range(6, 0))
            ->map(function ($day) {
                $date = Carbon::now()->subDays($day);

                return Article::whereDate('created_at', $date)->count();
            });

        return [
            'datasets' => [
                [
                    'label' => 'Статьи',
                    'data' => $data,
                ],
            ],

            'labels' => [
                '6 дн',
                '5 дн',
                '4 дн',
                '3 дн',
                '2 дн',
                'Вчера',
                'Сегодня',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
