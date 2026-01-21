<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caisse extends Model
{
    protected $fillable = [
        'title',
        'client_id',
        'init_solde',
        'Active',
        'Type',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function exchange(): HasMany
    {
        return $this->hasMany(exchange::class);
    }
}
