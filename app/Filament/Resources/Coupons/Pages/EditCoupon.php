<?php

namespace App\Filament\Resources\Coupons\Pages;

use App\Filament\Resources\Coupons\CouponResource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditCoupon extends EditRecord
{
    protected static string $resource = CouponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    
    protected function authorizeAccess(): void
    {
        $this->authorize('update', $this->getRecord());
    }
    
    protected function getFormSchema(): array
    {
        // Check if current user is a merchant
        $isMerchant = auth()->user()?->hasRole('merchant') ?? false;
        
        $storeComponent = Select::make('store_id')
            ->relationship('store', 'name')
            ->required();
        
        // If the user is a merchant, modify the store selection
        if ($isMerchant) {
            $storeComponent = $storeComponent
                ->options(auth()->user()->store->pluck('name', 'id'))
                ->disabled(); // Disable the field so merchants can't change it
        }
        
        return [
            $storeComponent,
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
                ->image(),
            Toggle::make('active')
                ->label('Active')
                ->default(true),
        ];
    }
}
