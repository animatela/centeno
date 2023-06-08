<?php

namespace App\Filament\Resources\Workshop\ReservationResource\Pages;

use App\Filament\Resources\Workshop\ReservationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
