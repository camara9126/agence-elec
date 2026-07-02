<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevisDetails extends Model
{
    protected $fillable = [
        'devis_id',
        'designation',
        'quantite',
        'prix_unitaire',
        'total',
    ];

    public function details()
    {
        return $this->hasMany(DevisDetails::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
