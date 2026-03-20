<?php

namespace App\Filament\Resources\CouponUsages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class CouponUsageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('coupon_id')
                    ->relationship('coupon', 'code')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->nullable(),
                DateTimePicker::make('used_at')
                    ->required(),
                TextInput::make('ip_address'),
            ]);
    }
}
