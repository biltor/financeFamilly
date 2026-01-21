<?php

namespace App\Filament\Resources\CaisseResource\Pages;

use App\Filament\Resources\CaisseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaisses extends ListRecords
{
    protected static string $resource = CaisseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
