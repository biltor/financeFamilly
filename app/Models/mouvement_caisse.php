<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mouvement_caisse extends Model
{
    //
    protected $fillable = [
        'caisse_id',
        'type',
        'montant',
        'devise',
        'description',
        'date_mouv',
        'exchange_id'
    ];

    public function exchange()
    {
        return $this->belongsTo(exchange::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }
}
