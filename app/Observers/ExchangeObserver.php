<?php

namespace App\Observers;

use App\Models\Exchange;
use App\Services\MouvementCaisseService;

class ExchangeObserver
{
    public function created(Exchange $exchange): void
    {
        app(MouvementCaisseService::class)->handle($exchange);
    }
}

/**
 *                   // ───── Type d’opération
            Tables\Columns\BadgeColumn::make('type_operation')
                ->label('Opération')
                ->colors([
                    'primary' => 'exch',
                    'success' => 'trans',
                ])
                ->formatStateUsing(fn ($state) =>
                    $state === 'exch' ? 'Exchange' : 'Transfert'
                )
                ->sortable(),
 */