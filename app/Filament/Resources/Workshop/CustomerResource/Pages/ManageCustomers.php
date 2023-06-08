<?php

namespace App\Filament\Resources\Workshop\CustomerResource\Pages;

use App\Filament\Resources\Workshop\CustomerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCustomers extends ManageRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
