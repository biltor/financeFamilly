<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $fillable = ['title',  'montant_total', 'statut'];



    public function reglements()
    {
        return $this->hasMany(reglement::class);
    }

    // Calcul du montant total payé
    public function getMontantPayeAttribute()
    {
        return $this->reglements()->sum('montant');
    }

    // Calcul du montant restant
    public function getMontantRestantAttribute()
    {
        return $this->montant_total - $this->montant_paye;
    }
}
