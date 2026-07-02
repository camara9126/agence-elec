<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchatDetails extends Model
{
    protected $fillable = [
        'achat_id',
        'designation',
        'quantite',
        'prix_unitaire',
        'total',
    ];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
