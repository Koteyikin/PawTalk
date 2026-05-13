<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminActionsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Управление статьями', 'Модерация')
                ->description('Просмотр, редактирование и публикация статей')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info')
                ->url('/admin/articles'),

            Stat::make('Пользователи', 'Управление')
                ->description('Просмотр профилей и активности')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->url('/admin/users'),

            Stat::make('FAQ Вопросы', 'Поддержка')
                ->description('Ответы на вопросы пользователей')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('warning')
                ->url('/admin/faq-questions'),

            Stat::make('Статистика', 'Аналитика')
                ->description('Статистика платформы и активности')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('danger')
                ->url('/admin/analytics'),

        ];
    }
}
