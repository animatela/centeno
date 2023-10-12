<?php

namespace App\Filament\Resources\Workshop\ServiceResource\Pages;

use App\Filament\Resources\Workshop\ServiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
