<?php

namespace App\Filament\Resources\Stores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class StoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                  ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                   ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('country')
                    ->maxLength(255),
              FileUpload::make('logo')
    ->image()
    ->disk('public')
    ->directory('assets/images')   
            ]);
    }
}
