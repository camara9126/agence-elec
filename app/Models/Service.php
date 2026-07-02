<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Service extends Model
{
    protected $fillable = [
        'reference',
        'nom',
        'slug',
        'prix',
        'description',
        'image',
        'statut'
    ];

    // creation de slug a chaque service
        protected static function boot()
            {
                parent::boot();
            
                static::saving(function ($service) {
                    if (empty($service->slug)) {
                        $slug = Str::slug($service->nom);
                        $originalSlug = $slug;
            
                        // Vérifier l'unicité du slug
                        $count = 1;
                        while (Service::where('slug', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $count;
                            $count++;
                        }
            
                        $service->slug = $slug;
                    }
                });
            }
}
