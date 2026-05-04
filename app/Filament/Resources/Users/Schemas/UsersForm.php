<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nickname')
                    ->helperText('Псевдоним для пользователя'),
                TextInput::make('email'),
                TextInput::make('password'),
            ]);
    }
}
