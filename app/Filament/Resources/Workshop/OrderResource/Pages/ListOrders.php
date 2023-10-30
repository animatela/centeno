<?php

namespace App\Filament\Resources\Workshop\OrderResource\Pages;

use App\Filament\Resources\Workshop\OrderResource;
use Filament\Actions;
use Filament\Resources\Components;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return OrderResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Components\Tab::make('Todos'),
            'new' => Components\Tab::make('Nuevo')->query(fn ($query) => $query->where('status', 'new')),
            'processing' => Components\Tab::make('Procesando')->query(fn ($query) => $query->where('status', 'processing')),
            'shipped' => Components\Tab::make('Completado')->query(fn ($query) => $query->where('status', 'shipped')),
            'delivered' => Components\Tab::make('Entregado')->query(fn ($query) => $query->where('status', 'delivered')),
            'cancelled' => Components\Tab::make('Cancelado')->query(fn ($query) => $query->where('status', 'cancelled')),
        ];
    }
}
