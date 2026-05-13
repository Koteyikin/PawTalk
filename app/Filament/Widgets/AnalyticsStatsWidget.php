<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\FaqQuestion;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnalyticsStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Статьи', Article::count())
                ->description('Всего статей')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            Stat::make('Пользователи', User::count())
                ->description('Всего зарегистрировано')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('FAQ Вопросы', FaqQuestion::count())
                ->description('Всего вопросов')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('warning'),

            Stat::make(
                'Новые вопросы',
                FaqQuestion::where('status', 'new')->count()
            )
                ->description('Требуют ответа')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger'),
        ];
    }
}
