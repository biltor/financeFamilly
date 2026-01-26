<?php

namespace App\Services;

use App\Models\reglement;
use App\Models\Caisse;
use App\Models\mouvement_caisse;
use Illuminate\Support\Facades\Auth;
use Exception;



class ReglementService
{
public function handleReglement(Reglement $reglement): void
    {
       $user = Auth::user();

        if (!$user) {
            throw new Exception("Utilisateur non authentifié.");
        }

        /**
         * Logique : 
         * 1. On cherche une caisse qui appartient à un client
         * 2. Ce client doit être lié à l'utilisateur connecté (user_id sur la table clients)
         * 3. La caisse doit correspondre à la devise du règlement
         */
        $caisse = Caisse::whereHas('client', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        //->where('devise', 'DZD')
         //->where('is_active', true) // À décommenter si vous avez ce champ
        ->first();

        if (!$caisse) {
            throw new Exception("Aucune caisse trouvée pour vos clients en {$reglement->devise}.");
        } 

        // Création du mouvement sorti
        mouvement_caisse::create([
            'caisse_id'   => $caisse->id,
            'type'        => 'debit',
            'montant'     => $reglement->montant,
            'devise'      => 'DZD',
            'date_mouv'   => $reglement->date_reglement,
            'description' => "Règlement Client: {$reglement->client->name} (Encaissé par: {$user->name})",
        ]);

        // Création du mouvement entrer
        mouvement_caisse::create([
            'caisse_id'   => $reglement->caisse_id,
            'type'        => 'credit',
            'montant'     => $reglement->montant,
            'devise'      => 'DZD',
            'date_mouv'   => $reglement->date_reglement,
            'description' => "Règlement Client: {$reglement->client->name} (Encaissé par: {$user->name})",
        ]);
    }
}
