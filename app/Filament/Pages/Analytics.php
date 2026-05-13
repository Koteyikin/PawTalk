<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AnalyticsStatsWidget;
use App\Filament\Widgets\ArticlesChartWidget;
use App\Filament\Widgets\LatestQuestionsWidget;
use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;

class Analytics extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';

    protected string $view = 'filament.pages.analytics';

    protected static ?string $navigationLabel = 'Статистика';

    protected static ?string $title = 'Статистика сайта';

    protected static string | UnitEnum | null $navigationGroup= 'Администрирование';

    protected function getHeaderWidgets(): array
    {
        return [
            AnalyticsStatsWidget::class,
            ArticlesChartWidget::class,
            LatestQuestionsWidget::class,
        ];
    }
}
