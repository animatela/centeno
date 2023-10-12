<?php

namespace App\Filament\Resources\Workshop\ReservationResource\Pages;

use App\Filament\Resources\Workshop\ReservationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
