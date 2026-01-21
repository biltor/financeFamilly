<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reglement extends Model
{
    protected $fillable = ['projet_id', 'caisse_id', 'montant', 'devise', 'date_reglement', 'description'];

    public function projet()
    {
        return $this->belongsTo(Project::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }
}
