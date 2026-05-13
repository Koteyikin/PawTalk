<?php

namespace App\Filament\Resources\FaqQuestions;

use App\Filament\Resources\FaqQuestions\Pages\CreateFaqQuestion;
use App\Filament\Resources\FaqQuestions\Pages\EditFaqQuestion;
use App\Filament\Resources\FaqQuestions\Pages\ListFaqQuestions;
use App\Filament\Resources\FaqQuestions\Schemas\FaqQuestionForm;
use App\Filament\Resources\FaqQuestions\Tables\FaqQuestionsTable;
use App\Models\FaqQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FaqQuestionResource extends Resource
{
    protected static ?string $navigationLabel = 'Вопросы по сайту';

    protected static ?string $model = FaqQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'FaqQuestion';

    public static function form(Schema $schema): Schema
    {
        return FaqQuestionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FaqQuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFaqQuestions::route('/'),
            'create' => CreateFaqQuestion::route('/create'),
            'edit' => EditFaqQuestion::route('/{record}/edit'),
        ];
    }
}
