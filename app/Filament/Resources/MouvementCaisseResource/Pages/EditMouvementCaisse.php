<?php

namespace App\Filament\Resources\MouvementCaisseResource\Pages;

use App\Filament\Resources\MouvementCaisseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMouvementCaisse extends EditRecord
{
    protected static string $resource = MouvementCaisseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
