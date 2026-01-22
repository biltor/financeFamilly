<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reglement extends Model
{
    protected $fillable = [
        'project_id',
        'caisse_id',
        'client_id',
        'montant',
        'devise',
        'date_reglement',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(project::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
