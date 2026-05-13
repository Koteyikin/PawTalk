<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

use App\Filament\Widgets\AdminActionsWidget;
use App\Filament\Widgets\AnalyticsStatsWidget;
use App\Filament\Widgets\ArticlesChartWidget;
use App\Filament\Widgets\LatestQuestionsWidget;
use App\Filament\Widgets\WebsiteButtonWidget;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            AdminActionsWidget::class,
            AnalyticsStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            LatestQuestionsWidget::class,
            ArticlesChartWidget::class,
        ];
    }
}
