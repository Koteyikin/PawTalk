<?php

namespace App\Filament\Resources\FaqQuestions\Pages;

use App\Filament\Resources\FaqQuestions\FaqQuestionResource;
use App\Models\Faq;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFaqQuestion extends EditRecord
{
    protected static string $resource = FaqQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('publishFaq')
                ->label('Опубликовать в FAQ')
                ->icon('heroicon-o-megaphone')
                ->color('success')

                ->action(function () {

                    Faq::create([
                        'question' => $this->record->question,
                        'answer' => $this->record->answer,
                        'is_published' => true,
                    ]);
                }),

        ];
    }
}
