<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class exchange extends Model
{
    protected $fillable = [

        'caisse_src_id',
        'montant',
        'currency_src',
        'taux',
        'currency_dest',
        'date_change',
        'caisse_dest_id'
    ];

    public function caisseSource()
    {
        return $this->belongsTo(Caisse::class, 'caisse_src_id');
    }

    public function caisseDestination()
    {
        return $this->belongsTo(Caisse::class, 'caisse_dest_id');
    }

    public function mouvements()
    {
        return $this->hasMany(mouvement_caisse::class);
    }
}
