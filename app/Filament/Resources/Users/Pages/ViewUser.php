<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UsersResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use app\Models\AboutUser;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\TextSize;

class ViewUser extends ViewRecord
{
    protected static string $resource = UsersResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Tab 1')
                            ->schema([
                                ImageEntry::make('aboutUser.avatar'),
                                TextEntry::make('aboutUser.name'),
                                TextEntry::make('aboutUser.surname'),
                                TextEntry::make('aboutUser.contact'),
                                TextEntry::make('aboutUser.interests'),
                                TextEntry::make('aboutUser.city'),
                                TextEntry::make('aboutUser.description'),
                                TextEntry::make('aboutUser.status.status'),
                                TextEntry::make('aboutUser.gender.gender'),
                            ]),
                        Tab::make('Tab 2')
                            ->schema([
                                // ...
                            ]),
                        Tab::make('Tab 3')
                            ->schema([
                                // ...
                            ]),
                    ])
//                Tab::make('Tabs')
//                    ->tabs([
//                        Tab::make('About User')
//                            ->schema([

//                            ]),
//                    ]),
            ]);
    }
}
