<?php

namespace App\Filament\Resources\Workshop\MakerResource\Pages;

use App\Filament\Resources\Workshop\MakerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMakers extends ManageRecords
{
    protected static string $resource = MakerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
