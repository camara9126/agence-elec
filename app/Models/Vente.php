<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        'client_id',
        'reference',
        'date',
        'total',
        'statut',
        'user_id',
        'total_tva',
        'total_ttc',
    ];

    public function items()
    {
        return $this->hasMany(VenteItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
