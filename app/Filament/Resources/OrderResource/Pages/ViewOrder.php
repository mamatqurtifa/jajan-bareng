<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('changeStatus')
                ->label('Change Status')
                ->form([
                    Forms\Components\Select::make('status')
                        ->label('Order Status')
                        ->options([
                            'pending' => 'Pending',
                            'delivered' => 'Delivered',
                            'completed' => 'Completed',
                            'canceled' => 'Canceled',
                        ])
                        ->required()
                        ->default(fn (Model $record) => $record->status),
                ])
                ->action(function (array $data): void {
                    $this->record->update([
                        'status' => $data['status'],
                    ]);
                    
                    Notification::make()
                        ->title('Order status updated successfully')
                        ->success()
                        ->send();
                })
                ->icon('heroicon-o-check-circle'),
        ];
    }
}