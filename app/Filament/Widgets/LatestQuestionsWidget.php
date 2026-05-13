<?php

namespace App\Filament\Widgets;

use App\Models\FaqQuestion;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestQuestionsWidget extends BaseWidget
{
    protected static ?string $heading = 'Последние вопросы';
    protected int | string | array $columnSpan = 'full';


    public function table(Table $table): Table
    {
        return $table
            ->query(
                FaqQuestion::query()->latest()
            )
            ->columns([

                TextColumn::make('question')
                    ->label('Вопрос')
                    ->limit(50),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'answered' => 'success',
                        'rejected' => 'danger',
                    }),

                TextColumn::make('created_at')
                    ->since(),
            ]);
    }
}
