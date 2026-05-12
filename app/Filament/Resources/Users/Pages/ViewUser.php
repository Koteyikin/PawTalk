<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UsersResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Infolists\Components\RepeatableEntry;

class ViewUser extends ViewRecord
{
    protected static string $resource = UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Редактировать')
                ->icon('heroicon-o-pencil'),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([

                        // ── Вкладка 1: Профиль ──
                        Tab::make('Профиль')
                            ->icon('heroicon-o-user')
                            ->schema([

                                // Аватар + основная инфо
                                Section::make()
                                    ->schema([
                                        Grid::make(4)
                                            ->schema([
                                                ImageEntry::make('aboutUser.avatar')
                                                    ->label('Аватар')
                                                    ->disk('public')
                                                    ->circular()
                                                    ->defaultImageUrl('https://api.dicebear.com/9.x/adventurer/svg?seed=default')
                                                    ->columnSpan(1),

                                                Grid::make(1)
                                                    ->schema([
                                                        TextEntry::make('nickname')
                                                            ->label('Никнейм')
                                                            ->size(TextSize::Large)
                                                            ->weight(\Filament\Support\Enums\FontWeight::Bold)
                                                            ->icon('heroicon-o-at-symbol'),

                                                        TextEntry::make('email')
                                                            ->label('Email')
                                                            ->icon('heroicon-o-envelope')
                                                            ->copyable()
                                                            ->copyMessage('Email скопирован'),

                                                        TextEntry::make('aboutUser.status.status')
                                                            ->label('Статус')
                                                            ->badge()
                                                            ->color('success'),
                                                    ])
                                                    ->columnSpan(3),
                                            ]),
                                    ])
                                    ->columnSpanFull(),

                                // Личные данные
                                Section::make('Личные данные')
                                    ->icon('heroicon-o-identification')
                                    ->columns(2)
                                    ->schema([
                                        TextEntry::make('aboutUser.name')
                                            ->label('Имя')
                                            ->icon('heroicon-o-user'),

                                        TextEntry::make('aboutUser.surname')
                                            ->label('Фамилия')
                                            ->icon('heroicon-o-user'),

                                        TextEntry::make('aboutUser.gender.gender')
                                            ->label('Пол')
                                            ->icon('heroicon-o-user-circle')
                                            ->badge()
                                            ->color('info'),

                                        TextEntry::make('aboutUser.city')
                                            ->label('Город')
                                            ->icon('heroicon-o-map-pin'),

                                        TextEntry::make('aboutUser.contact')
                                            ->label('Контакты')
                                            ->icon('heroicon-o-phone')
                                            ->columnSpanFull(),

                                        TextEntry::make('aboutUser.interests')
                                            ->label('Интересы')
                                            ->icon('heroicon-o-heart')
                                            ->columnSpanFull(),

                                        TextEntry::make('aboutUser.description')
                                            ->label('О себе')
                                            ->icon('heroicon-o-chat-bubble-left')
                                            ->columnSpanFull()
                                            ->html(),
                                    ]),

                                // Системная информация
                                Section::make('Системная информация')
                                    ->icon('heroicon-o-information-circle')
                                    ->columns(2)
                                    ->collapsed()
                                    ->schema([
                                        TextEntry::make('id')
                                            ->label('ID пользователя')
                                            ->badge()
                                            ->color('gray'),

                                        TextEntry::make('created_at')
                                            ->label('Дата регистрации')
                                            ->icon('heroicon-o-calendar')
                                            ->dateTime('d.m.Y H:i'),

                                        TextEntry::make('updated_at')
                                            ->label('Последнее обновление')
                                            ->icon('heroicon-o-clock')
                                            ->dateTime('d.m.Y H:i'),

                                        TextEntry::make('email_verified_at')
                                            ->label('Email подтверждён')
                                            ->icon('heroicon-o-check-circle')
                                            ->dateTime('d.m.Y H:i')
                                            ->placeholder('Не подтверждён'),
                                    ]),
                            ]),

                        // ── Вкладка 2: Статьи ──
                        Tab::make('Статьи')
                            ->icon('heroicon-o-document-text')
                            ->badge(fn($record) => $record->articles()->count())
                            ->schema([
                                Section::make('Статьи пользователя')
                                    ->schema([
                                        RepeatableEntry::make('articles')
                                            ->label('')
                                            ->schema([
                                                Grid::make(3)
                                                    ->schema([
                                                        TextEntry::make('title')
                                                            ->label('Заголовок')
                                                            ->weight(\Filament\Support\Enums\FontWeight::Bold)
                                                            ->columnSpan(2),

                                                        TextEntry::make('status')
                                                            ->label('Статус')
                                                            ->badge()
                                                            ->color(fn(string $state): string => match($state) {
                                                                'published' => 'success',
                                                                'pending'   => 'warning',
                                                                'draft'     => 'gray',
                                                                'rejected'  => 'danger',
                                                                default     => 'gray',
                                                            }),

                                                        TextEntry::make('category.name')
                                                            ->label('Категория')
                                                            ->badge()
                                                            ->color('info'),

                                                        TextEntry::make('views_count')
                                                            ->label('Просмотры')
                                                            ->icon('heroicon-o-eye'),

                                                        TextEntry::make('created_at')
                                                            ->label('Дата создания')
                                                            ->dateTime('d.m.Y')
                                                            ->icon('heroicon-o-calendar'),
                                                    ]),
                                            ])
                                            ->contained(false),
                                    ]),
                            ]),

                        // ── Вкладка 3: Питомцы ──
                        Tab::make('Питомцы')
                            ->icon('heroicon-o-heart')
                            ->badge(fn($record) => $record->aboutUser?->animal ? 1 : 0)
                            ->schema([
                                Section::make('Питомцы пользователя')
                                    ->schema([
                                        RepeatableEntry::make('animals')
                                            ->label('')
                                            ->schema([
                                                Grid::make(3)
                                                    ->schema([
                                                        ImageEntry::make('picture')
                                                            ->label('Фото')
                                                            ->disk('public')
                                                            ->circular()
                                                            ->defaultImageUrl('https://api.dicebear.com/9.x/adventurer/svg?seed=pet'),

                                                        TextEntry::make('name')
                                                            ->label('Кличка')
                                                            ->weight(\Filament\Support\Enums\FontWeight::Bold),

                                                        TextEntry::make('status_animal.name')
                                                            ->label('Статус')
                                                            ->badge()
                                                            ->color('success'),

                                                        TextEntry::make('view')
                                                            ->label('Вид'),

                                                        TextEntry::make('age')
                                                            ->label('Возраст')
                                                            ->suffix(' г'),

                                                        TextEntry::make('description')
                                                            ->label('Описание')
                                                            ->columnSpanFull(),
                                                    ]),
                                            ])
                                            ->contained(false),
                                    ]),
                            ]),

                        // ── Вкладка 4: Активность ──
                        Tab::make('Активность')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        Section::make()
                                            ->schema([
                                                TextEntry::make('articles_count')
                                                    ->label('Статей')
                                                    ->state(fn($record) => $record->articles()->count())
                                                    ->size(TextSize::Large)
                                                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                                                    ->icon('heroicon-o-document-text'),
                                            ]),

                                        Section::make()
                                            ->schema([
                                                TextEntry::make('comments_count')
                                                    ->label('Комментариев')
                                                    ->state(fn($record) => $record->comments()->count())
                                                    ->size(TextSize::Large)
                                                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                                                    ->icon('heroicon-o-chat-bubble-left'),
                                            ]),

                                        Section::make()
                                            ->schema([
                                                TextEntry::make('likes_count')
                                                    ->label('Лайков')
                                                    ->state(fn($record) => $record->likes()->count())
                                                    ->size(TextSize::Large)
                                                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                                                    ->icon('heroicon-o-heart'),
                                            ]),

                                        Section::make()
                                            ->schema([
                                                TextEntry::make('bookmarks_count')
                                                    ->label('Закладок')
                                                    ->state(fn($record) => $record->bookmarks()->count())
                                                    ->size(TextSize::Large)
                                                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                                                    ->icon('heroicon-o-bookmark'),
                                            ]),
                                    ]),
                            ]),

                    ])
                    ->columnSpanFull(),
            ]);
    }
}
