<?php

namespace App\Services;

use App\Models\Exchange;
use App\Models\mouvement_caisse;
use App\Models\MouvementCaisse;

class MouvementCaisseService
{
    public function handle(Exchange $exchange): void
    {
        $source = match ($exchange->type_operation) {
            'exch'  => 'Exchange',
            'trans' => 'Transfert',
            default => 'unknown',
        };

        // ➖ SORTIE caisse source
        mouvement_caisse::create([
            'caisse_id'  => $exchange->caisse_src_id,
            'type'       => 'debit',
            'montant'    => $exchange->montant,
            'devise'     => $exchange->currency_src,
            'date_mouv'  => $exchange->date_change,
            'description'=> ucfirst($source) . ' - débit',
            'exchange_id'=> $exchange->id,
        ]);

        // ➕ ENTRÉE (exchange ou transfert)
        if ($exchange->currency_src !== $exchange->currency_dest) {
            mouvement_caisse::create([
            'caisse_id'  => $exchange->caisse_dest_id,
            'type'       => 'credit',
            'montant'    => $exchange->montant * $exchange->taux,
            'devise'     => $exchange->currency_dest,
            'date_mouv'  => $exchange->date_change,
            'description'=> ucfirst($source) . ' - crédit',
            'exchange_id'=> $exchange->id,
            ]);
        }
    }
}
