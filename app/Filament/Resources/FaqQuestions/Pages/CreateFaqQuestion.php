<?php

namespace App\Filament\Resources\FaqQuestions\Pages;

use App\Filament\Resources\FaqQuestions\FaqQuestionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFaqQuestion extends CreateRecord
{
    protected static string $resource = FaqQuestionResource::class;
}
