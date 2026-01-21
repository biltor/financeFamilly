<?php

namespace App\Filament\Resources\CaisseResource\Pages;

use App\Filament\Resources\CaisseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaisse extends EditRecord
{
    protected static string $resource = CaisseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
