<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

//    protected function getHeaderActions(): array
//    {
//        return [
//            CreateAction::make(),
//        ];
//    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Все'),
            'pending' => Tab::make('На модерации')->modifyQueryUsing(fn ($query) => $query->where('status', 'pending')),
            'published' => Tab::make('Опубликованы')->modifyQueryUsing(fn ($query) => $query->where('status', 'published')),
        ];
    }
}
