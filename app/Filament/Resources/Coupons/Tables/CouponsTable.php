<?php

namespace App\Filament\Resources\Coupons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
                    TextColumn::make('title')
                        ->searchable(),
           TextColumn::make('store.name')->sortable()->searchable(),
               TextColumn::make('category.name')->sortable()->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('amount_of_discount')
                    ->label('Amount of Discount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('expire_date')
                    ->date()
                    ->sortable(),
                IconColumn::make('active')
                    ->boolean(),
                IconColumn::make('is_exclusive')
                    ->boolean(),
                TextColumn::make('exclusive_amount')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('image'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
