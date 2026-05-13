<?php

namespace App\Filament\Resources\FaqQuestions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FaqQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('question')
                    ->label('Вопрос')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('user.nickname')
                    ->label('Пользователь')
                    ->default('Гость')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'new',
                        'success' => 'answered',
                        'danger' => 'rejected',
                    ]),

                TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
