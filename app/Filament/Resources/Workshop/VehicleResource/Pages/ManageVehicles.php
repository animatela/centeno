<?php

namespace App\Filament\Resources\Workshop\VehicleResource\Pages;

use App\Filament\Resources\Workshop\VehicleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVehicles extends ManageRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
