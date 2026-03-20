<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Category Name'),
                TextInput::make('slug')
                 ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->label('Slug'),
              FileUpload::make('icon')
                 ->image()
                    ->directory('category-icons')
                     ->disk('public')
                    ->label('Icon')
                    ->helperText('Upload a category icon (optional).'),
            ]);
    }
}
