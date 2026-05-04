<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id()),
                TextInput::make('title'),
                TextInput::make('slug'),
                TextInput::make('excerpt')
                    ->afterLabel(
                        Action::make('help')
                            ->icon(Heroicon::QuestionMarkCircle)
                            ->color('primary')
                            ->tooltip('Введите загаловок вашей статьи')
                    ),
                RichEditor::make('body')
                    ->required(),
//                FileUpload::make('cover_image')
//                    ->disk('public')
//                    ->visibility('public'),
                Hidden::make('is_featured')
                    ->default(false),
                DatePicker::make('published_at'),
                Hidden::make('status')
                    ->default('pending'),
                Hidden::make('reading_time')
                    ->default(0),
                Hidden::make('views_count')
                    ->default(0),
            ]);
    }
}
