<?php

namespace App\Filament\Resources\Workshop\CustomerResource\Pages;

use App\Filament\Resources\Workshop\CustomerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
