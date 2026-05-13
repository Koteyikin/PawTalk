<?php

namespace App\Filament\Resources\FaqQuestions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FaqQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->label('Имя')
                    ->disabled(),

                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),

                Textarea::make('question')
                    ->label('Вопрос')
                    ->rows(6)
                    ->disabled()
                    ->columnSpanFull(),

                Textarea::make('answer')
                    ->label('Ответ модератора')
                    ->rows(8)
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'new' => 'Новый',
                        'answered' => 'Отвечен',
                        'rejected' => 'Отклонён',
                    ])
                    ->default('new')
                    ->required(),
            ]);
    }
}
