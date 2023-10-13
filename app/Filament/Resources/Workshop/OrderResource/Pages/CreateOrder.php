<?php

namespace App\Filament\Resources\Workshop\OrderResource\Pages;

use App\Filament\Resources\Workshop\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
