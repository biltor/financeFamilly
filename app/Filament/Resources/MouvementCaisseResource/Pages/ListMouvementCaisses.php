<?php

namespace App\Filament\Resources\MouvementCaisseResource\Pages;

use App\Filament\Resources\MouvementCaisseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMouvementCaisses extends ListRecords
{
    protected static string $resource = MouvementCaisseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
