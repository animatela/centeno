<?php

namespace App\Filament\Resources\Workshop\CustomerResource\Pages;

use App\Filament\Resources\Workshop\CustomerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
