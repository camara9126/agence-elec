<?php

use App\Http\Controllers\AchatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VenteController;
use App\Models\Achat;
use App\Models\Client;
use App\Models\Contrat;
use App\Models\Devis;
use App\Models\Fournisseur;
use App\Models\Service;
use App\Models\Vente;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Accueil
Route::get('/', function () {
    return view('site.index');
})->name('accueil');

// Apropos 
Route::get('apropos', function () {
    return view('site.apropos');
})->name('apropos');

// Boutique 
Route::get('shop', function () {
    return view('site.boutique');
})->name('boutique');

// Contact
Route::get('contact', function () {
    return view('site.contact');
})->name('contact');

// Service
Route::get('services', function () {
    return view('site.services');
})->name('services');



Route::get('/dashboard', function () {

    $contrats= Contrat::latest()->get();
    $services= Service::latest()->get();
    $clients= Client::latest()->get();
    $devis= Devis::latest()->get();
    $fournisseurs= Fournisseur::latest()->get();
    $achats= Achat::latest()->get();
    $factures= Vente::latest()->get();

    return view('dashboard.index', compact('contrats','achats','services', 'clients', 'devis', 'fournisseurs', 'factures'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Dashboard
Route::resource('/achat', AchatController::class)->middleware(['auth', 'verified']);
Route::resource('/facture', VenteController::class)->middleware(['auth', 'verified']);
Route::resource('/fournisseur', FournisseurController::class)->middleware(['auth', 'verified']);
Route::resource('/service', ServiceController::class)->middleware(['auth', 'verified']);
Route::resource('/client', ClientController::class)->middleware(['auth', 'verified']);
Route::resource('/contrat', ContratController::class)->middleware(['auth', 'verified']);
Route::resource('/devis', DevisController::class)->middleware(['auth', 'verified']);
Route::get('/devis/{id}/facture', [DevisController::class, 'facture'])->middleware(['auth', 'verified'])->name('devis.facture');
Route::get('/devis/{id}/valider', [DevisController::class, 'valider'])->middleware(['auth', 'verified'])->name('devis.valider');
Route::get('devis/{devis}/convertir', [DevisController::class, 'convertir'])->middleware(['auth', 'verified'])->name('devis.convertir');

Route::resource('/entreprise', EntrepriseController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
