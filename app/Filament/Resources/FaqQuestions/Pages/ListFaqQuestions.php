<?php

namespace App\Filament\Resources\FaqQuestions\Pages;

use App\Filament\Resources\FaqQuestions\FaqQuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFaqQuestions extends ListRecords
{
    protected static string $resource = FaqQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
