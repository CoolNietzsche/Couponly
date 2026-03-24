<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Illuminate\Support\Str;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
           Select::make('store_id')
                    ->relationship('store', 'name')
                    ->required(),
              Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
           TextInput::make('code')
    ->required()
    ->unique()
    ->maxLength(255)
    ->default(fn () => strtoupper(Str::random(8)))
    ->suffixAction(
        Action::make('regenerate')
            ->icon('heroicon-o-arrow-path')
            ->action(fn ($set) => $set('code', strtoupper(Str::random(8))))
    ),
               Select::make('type')
                    ->options([
                        'Percentage' => 'Percentage',
                        'Fixed Amount' => 'Fixed Amount',
                        'Free Shipping' => 'Free Shipping',
                              'Buy One Get One' => 'Buy One Get One',
                    ])
                    ->required()
                    ->reactive(),
                TextInput::make('title')
                    ->required(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('expire_date')
                    ->required(),
                TextInput::make('amount_of_discount')
                    ->label('Amount of Discount')
                    ->numeric()
                    ->minValue(0)
                    ->visible(fn ($get) => in_array($get('type'), ['Percentage', 'Fixed Amount'])),
        Toggle::make('is_exclusive')
                    ->default(false)->reactive(),
            TextInput::make('exclusive_amount')
    ->numeric()
    ->minValue(0)
    ->visible(fn ($get) => (bool) $get('is_exclusive')),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('assets/images'),
                Toggle::make('active')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}
