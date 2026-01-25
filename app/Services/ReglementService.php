<?php

namespace App\Services;

use App\Models\reglement;
use App\Models\mouvement_caisse;
use Illuminate\Support\Facades\Auth;


class ReglementService
{
    public function handle(reglement $reglement): void
    {

        $user = Auth::user();

        if (! $user) {
            return;
        }

        // caisse DZD uniquement
        $caisse = $user->client->Caisse()
            ->where('devise', 'DZD')
            ->first();

        if (! $caisse) {
            throw new \Exception('Aucune caisse DZD trouvée pour cet utilisateur');
        }
        // ➖ SORTIE caisse source
        mouvement_caisse::create([
            'caisse_id'  => $caisse,
            'type'       => 'debit',
            'montant'    => $reglement->montant,
            'devise'     => $reglement->currency_src,
            'date_mouv'  => $reglement->date_change,
            'description' => 'reglement',

        ]);

        // ➕ ENTRÉE (exchange ou transfert)
        if ($exchange->currency_src !== $exchange->currency_dest) {
            mouvement_caisse::create([
                'caisse_id'  => $exchange->caisse_dest_id,
                'type'       => 'credit',
                'montant'    => $exchange->montant * $exchange->taux,
                'devise'     => $exchange->currency_dest,
                'date_mouv'  => $exchange->date_change,
                'description' => ucfirst($source) . ' - crédit',
                'exchange_id' => $exchange->id,
            ]);
        }
    }
}
