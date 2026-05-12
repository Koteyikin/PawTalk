<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

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

                Tabs::make('ArticleTabs')
                    ->tabs([

                        /*
                        |--------------------------------------------------------------------------
                        | ОСНОВНОЕ
                        |--------------------------------------------------------------------------
                        */
                        Tab::make('Основное')
                            ->icon('heroicon-o-document-text')
                            ->schema([

                                /*
                                |--------------------------------------------------------------------------
                                | HERO
                                |--------------------------------------------------------------------------
                                */
                                Section::make()
                                    ->schema([

                                        ImageEntry::make('image')
                                            ->hiddenLabel()
                                            ->disk('public')
                                            ->height(320)
                                            ->extraImgAttributes([
                                                'class' => 'rounded-2xl object-cover shadow-xl border border-gray-200',
                                            ])
                                            ->placeholder('Нет изображения'),

                                        Grid::make(3)
                                            ->schema([

                                                Grid::make(1)
                                                    ->schema([

                                                        TextEntry::make('title')
                                                            ->label('Заголовок')
                                                            ->size(TextSize::Large)
                                                            ->weight(FontWeight::Bold),

                                                        TextEntry::make('excerpt')
                                                            ->label('Описание')
                                                            ->color('gray')
                                                            ->columnSpanFull(),

                                                    ])
                                                    ->columnSpan(2),

                                                Grid::make(1)
                                                    ->schema([

                                                        TextEntry::make('status')
                                                            ->label('Статус')
                                                            ->badge()
                                                            ->color(fn(string $state): string => match ($state) {
                                                                'published' => 'success',
                                                                'pending' => 'warning',
                                                                'draft' => 'gray',
                                                                'rejected' => 'danger',
                                                                default => 'gray',
                                                            }),

                                                        TextEntry::make('is_featured')
                                                            ->label('Самая популярная')
                                                            ->badge()
                                                            ->formatStateUsing(fn(bool $state) => $state ? 'Да' : 'Нет')
                                                            ->color(fn(bool $state) => $state ? 'success' : 'gray'),

                                                        TextEntry::make('category.name')
                                                            ->label('Категория')
                                                            ->badge()
                                                            ->color('info'),

                                                        TextEntry::make('created_at')
                                                            ->label('Дата публикации')
                                                            ->dateTime('d.m.Y H:i'),

                                                    ]),

                                            ]),

                                    ]),

                                /*
                                |--------------------------------------------------------------------------
                                | BODY
                                |--------------------------------------------------------------------------
                                */
                                Section::make('Содержимое статьи')
                                    ->icon('heroicon-o-pencil-square')
                                    ->schema([

                                        TextEntry::make('body')
                                            ->hiddenLabel()
                                            ->html()
                                            ->prose(),

                                    ]),

                                /*
                                |--------------------------------------------------------------------------
                                | TAGS
                                |--------------------------------------------------------------------------
                                */
                                Section::make('Теги')
                                    ->icon('heroicon-o-hashtag')
                                    ->schema([

                                        TextEntry::make('tags.name')
                                            ->badge()
                                            ->separator(',')
                                            ->label('Теги'),
                                    ]),


                                /*
                                |--------------------------------------------------------------------------
                                | AUTHOR
                                |--------------------------------------------------------------------------
                                */
                                Section::make('Автор статьи')
                                    ->icon('heroicon-o-user')
                                    ->schema([

                                        Grid::make(4)
                                            ->schema([

                                                ImageEntry::make('author.aboutUser.avatar')
                                                    ->hiddenLabel()
                                                    ->disk('public')
                                                    ->circular()
                                                    ->defaultImageUrl('https://api.dicebear.com/9.x/adventurer/svg?seed=user')
                                                    ->columnSpan(1),

                                                Grid::make(2)
                                                    ->schema([

                                                        TextEntry::make('author.nickname')
                                                            ->label('Никнейм')
                                                            ->weight(FontWeight::Bold),

                                                        TextEntry::make('author.email')
                                                            ->label('Email')
                                                            ->copyable(),

                                                        TextEntry::make('author.aboutUser.city')
                                                            ->label('Город')
                                                            ->badge()
                                                            ->color('info'),

                                                        TextEntry::make('author.aboutUser.status.status')
                                                            ->label('Статус')
                                                            ->badge()
                                                            ->color('success'),

                                                    ])
                                                    ->columnSpan(3),

                                            ]),

                                    ]),

                            ]),

                        /*
                        |--------------------------------------------------------------------------
                        | АКТИВНОСТЬ
                        |--------------------------------------------------------------------------
                        */
                        Tab::make('Активность')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([

                                Grid::make(4)
                                    ->schema([

                                        Section::make()
                                            ->schema([

                                                TextEntry::make('views_count')
                                                    ->label('Просмотры')
                                                    ->icon('heroicon-o-eye')
                                                    ->size(TextSize::Large)
                                                    ->weight(FontWeight::Bold),

                                            ]),

                                        Section::make()
                                            ->schema([

                                                TextEntry::make('likes_count')
                                                    ->label('Лайки')
                                                    ->state(fn($record) => $record->likes()->count())
                                                    ->icon('heroicon-o-heart')
                                                    ->size(TextSize::Large)
                                                    ->weight(FontWeight::Bold),

                                            ]),

                                        Section::make()
                                            ->schema([

                                                TextEntry::make('comments_count')
                                                    ->label('Комментарии')
                                                    ->state(fn($record) => $record->comments()->count())
                                                    ->icon('heroicon-o-chat-bubble-left')
                                                    ->size(TextSize::Large)
                                                    ->weight(FontWeight::Bold),

                                            ]),

                                        Section::make()
                                            ->schema([

                                                TextEntry::make('reading_time')
                                                    ->label('Время чтения')
                                                    ->suffix(' мин')
                                                    ->icon('heroicon-o-clock')
                                                    ->size(TextSize::Large)
                                                    ->weight(FontWeight::Bold),

                                            ]),

                                    ]),

                            ]),

                        /*
                        |--------------------------------------------------------------------------
                        | КОММЕНТАРИИ
                        |--------------------------------------------------------------------------
                        */
                        Tab::make('Комментарии')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->badge(fn($record) => $record->comments()->count())
                            ->schema([

                                Section::make('Комментарии статьи')
                                    ->schema([

                                        RepeatableEntry::make('comments')
                                            ->hiddenLabel()
                                            ->schema([

                                                Grid::make(1)
                                                    ->schema([

                                                        Grid::make(3)
                                                            ->schema([

                                                                TextEntry::make('author.nickname')
                                                                    ->label('Автор')
                                                                    ->weight(FontWeight::Bold),

                                                                TextEntry::make('created_at')
                                                                    ->label('Дата')
                                                                    ->since(),

                                                                TextEntry::make('is_approved')
                                                                    ->label('Модерация')
                                                                    ->badge()
                                                                    ->formatStateUsing(fn(bool $state) => $state ? 'Одобрен' : 'На проверке')
                                                                    ->color(fn(bool $state) => $state ? 'success' : 'warning'),

                                                            ]),

                                                        TextEntry::make('body')
                                                            ->label('Комментарий')
                                                            ->markdown(),

                                                        TextEntry::make('likes_count')
                                                            ->label('Лайки')
                                                            ->state(fn($record) => $record->likes()->count())
                                                            ->badge()
                                                            ->color('danger'),

                                                        /*
                                                        |--------------------------------------------------------------------------
                                                        | REPLIES
                                                        |--------------------------------------------------------------------------
                                                        */
                                                        RepeatableEntry::make('replies')
                                                            ->label('Ответы')
                                                            ->schema([

                                                                Grid::make(2)
                                                                    ->schema([

                                                                        TextEntry::make('author.nickname')
                                                                            ->label('Автор')
                                                                            ->weight(FontWeight::Bold),

                                                                        TextEntry::make('created_at')
                                                                            ->label('Дата')
                                                                            ->since(),

                                                                    ]),

                                                                TextEntry::make('body')
                                                                    ->label('Ответ')
                                                                    ->markdown(),

                                                            ])
                                                            ->contained(true),

                                                    ]),

                                            ])
                                            ->contained(true),

                                    ]),

                            ]),

                        /*
                        |--------------------------------------------------------------------------
                        | СИСТЕМА
                        |--------------------------------------------------------------------------
                        */
                        Tab::make('Система')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([

                                Section::make('Системная информация')
                                    ->columns(2)
                                    ->schema([

                                        TextEntry::make('id')
                                            ->label('ID статьи')
                                            ->badge()
                                            ->color('gray'),

                                        TextEntry::make('created_at')
                                            ->label('Создано')
                                            ->dateTime('d.m.Y H:i')
                                            ->icon('heroicon-o-calendar'),

                                        TextEntry::make('updated_at')
                                            ->label('Обновлено')
                                            ->dateTime('d.m.Y H:i')
                                            ->icon('heroicon-o-clock'),

                                        TextEntry::make('published_at')
                                            ->label('Опубликовано')
                                            ->dateTime('d.m.Y H:i')
                                            ->placeholder('Не опубликовано'),

                                    ]),

                            ]),

                    ])
                    ->columnSpanFull(),

            ]);
    }
}
