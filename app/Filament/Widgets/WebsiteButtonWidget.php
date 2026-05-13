<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WebsiteButtonWidget extends StatsOverviewWidget
{
    protected static ?int $sort = -2;
    protected int | string | array $columnSpan = 'full';
    protected static bool $isLazy = false;
    protected function getStats(): array
    {
        return [

            Stat::make('Перейти на сайт', 'PawTalk')
                ->description('Открыть пользовательскую часть сайта')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('gray')
                ->url('/')
                ->openUrlInNewTab(),

        ];
    }
}
