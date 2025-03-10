<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('order_id')
                ->relationship('order', 'id')
                ->required(),
            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')
                ->required(),
            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->default(1),
            Forms\Components\TextInput::make('subtotal')
                ->numeric()
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.id')->sortable(),
                Tables\Columns\TextColumn::make('product.name')->sortable(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('subtotal')->money('IDR', true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->filters([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
