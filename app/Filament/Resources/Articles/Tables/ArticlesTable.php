<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Filament\Resources\Users\UsersResource;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author.nickname')
                    ->label('Пользователь')
                    ->url(fn ($record) => UsersResource::getUrl('view', ['record' => $record->author]))
                    ->color('primary')
                    ->openUrlInNewTab(),

                TextColumn::make('title')
                    ->label('Заголовок статьи'),

                BadgeColumn::make('status')
                    ->label('Статус')
                    ->colors([
                        'success' => 'published',
                        'warning' => 'pending',
                        'gray'    => 'draft',
                        'danger'  => 'rejected',
                    ]),

                TextColumn::make('category.name')
                    ->label('Категория'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Дата публикации'),

                IconColumn::make('is_featured')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),

                // Кнопка смены статуса
                Action::make('changeStatus')
                    ->label('Статус')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->form([
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Выберите статус')
                            ->options([
                                'published' => '✅ Опубликовать',
                                'pending'   => '⏳ На проверке',
                                'draft'     => '📝 Черновик',
                                'rejected'  => '❌ Отклонить',
                            ])
                            ->required()
                            ->default(fn ($record) => $record->status)
                            ->live(), // ← обязательно для реактивности

                        \Filament\Forms\Components\Textarea::make('reason')
                            ->label('Причина')
                            ->placeholder('Укажите причину отклонения или переноса в черновик...')
                            ->rows(3)
                            ->required()
                            ->hidden(fn (\Filament\Schemas\Components\Utilities\Get $get) =>
                            !in_array($get('status'), ['rejected', 'draft'])
                            ),
                    ])
                    ->action(function (array $data, $record): void {
                        $record->update([
                            'status' => $data['status'],
                            // Сохраняем причину если она есть
                            'reject_reason' => $data['reason'] ?? null,
                        ]);

                        // Уведомляем автора если отклонили или перенесли в черновик
                        if (in_array($data['status'], ['rejected', 'draft'])) {
                            // Можно добавить уведомление автору
                            // Notification::make()->title('Ваша статья отклонена')->sendToDatabase($record->author);
                        }
                    })
                    ->successNotificationTitle('Статус успешно изменён'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
