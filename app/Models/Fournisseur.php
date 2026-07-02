<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
     protected $fillable = [
        'nom',
        'telephone',
        'email',
        'adresse',
        'statut',
    ];

    public function service() {
        return $this->hasMany(Service::class);
    }


    public function achat() {
        return $this->hasMany(Achat::class);
    }
}
