<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\OrderItem;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')
                ->required(),
            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('subtotal')
                ->numeric()
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->sortable(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('subtotal')->money('IDR', true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->filters([]);
    }
}