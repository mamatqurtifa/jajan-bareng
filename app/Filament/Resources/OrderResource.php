<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Organization;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;
use App\Filament\Resources\OrderResource\RelationManagers;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    public static function table(Tables\Table $table): Tables\Table
    {
        $user = Filament::auth()->user();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Order ID')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->sortable()->label('Customer'),
                Tables\Columns\TextColumn::make('user.phone')->label('Customer Phone'),
                Tables\Columns\TextColumn::make('organization.name')
                    ->sortable()
                    ->visible(fn() => $user->roles->contains('name', 'super_admin')),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('total_price')->money('IDR', true),
                Tables\Columns\TextColumn::make('note')->label('Note'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'delivered' => 'Delivered',
                        'completed' => 'Completed',
                        'canceled' => 'Canceled',
                    ])
                    ->label('Status'),
                Tables\Filters\SelectFilter::make('organization_id')
                    ->options(Organization::all()->pluck('name', 'id')->toArray())
                    ->label('Organization')
                    ->visible(fn() => $user->roles->contains('name', 'super_admin')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('changeStatus')
                ->label('Change Status')
                ->icon('heroicon-o-check-circle')
                ->form([
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'delivered' => 'Delivered',
                            'completed' => 'Completed',
                            'canceled' => 'Canceled',
                        ])
                        ->required()
                        ->default(fn (Model $record) => $record->status),
                ])
                ->action(function (Order $record, array $data): void {
                    $record->update([
                        'status' => $data['status'],
                    ]);
                })
                ->successNotificationTitle('Order status updated'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Order Information')
                    ->schema([
                        Infolists\Components\TextEntry::make('id')
                            ->label('Order ID'),
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Customer'),
                        Infolists\Components\TextEntry::make('user.phone')
                            ->label('Customer Phone'),
                        Infolists\Components\TextEntry::make('organization.name')
                            ->label('Organization'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge(),
                        Infolists\Components\TextEntry::make('total_price')
                            ->money('IDR', true),
                        Infolists\Components\TextEntry::make('note')
                            ->label('Note'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->dateTime(),
                    ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Filament::auth()->user();

        if ($user->roles->contains('name', 'organization_admin')) {
            return $query->where('organization_id', $user->organization_id);
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }

    public static function canView($record): bool
    {
        $user = Filament::auth()->user();

        return $user->roles->contains('name', 'super_admin') ||
            ($user->roles->contains('name', 'organization_admin') &&
                $record->organization_id == $user->organization_id);
    }

    public static function canCreate(): bool
    {
        return false;
    }
}