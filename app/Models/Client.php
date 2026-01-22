<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Client extends Model
{
    protected $fillable = [
        'name',
        'fonction_id'
    ];

    public function fonction(): BelongsTo
    {
        return $this->belongsTo(fonction::class);
    }
    
        public function Caisse(): HasMany
    {
        return $this->hasMany(Caisse::class);
    }

    public function scopeNonFamille($query)
    {
        return $query->whereHas('fonction', function ($q) {
            $q->where('name', '!=', 'famille');
        });
    }
}
