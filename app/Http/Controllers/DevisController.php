<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Devis;
use App\Models\DevisDetails;
use App\Models\Entreprise;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' ,
            'services' => 'required|array',
            'services.*.designation' => 'required|string',
            'services.*.quantite' => 'required|numeric|min:1',
            'services.*.prix' => 'required|numeric|min:0',
            'objet' => 'nullable'
        ]);

        // Création du devis
        $devis = Devis::create([
            'reference' => 'DEV-' . strtoupper(Str::random(6)),
            'client_id' => $request->client_id ?? 2,
            'total' => 0,
            'statut' => 'en_attente',
            'date_devis' => now(),
            'date_expiration' => now()->addMonth(),
            'objet' => $request->objet,
        ]);

        $total = 0;

        // Enregistrement des produits
        foreach ($request->services as $item) {

            $ligneTotal = $item['quantite'] * $item['prix'];

                DevisDetails::create([
                'devis_id' => $devis->id,
                'designation' => $item['designation'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
                'total' => $ligneTotal,
            ]);
           

            $total += $ligneTotal;
        }

        // Mise à jour du total
        $devis->update([
            'total' => $total
        ]);

        return redirect()->back()->with('success', 'Devis créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $services= Service::latest()->get();

        $devis = Devis::with('client', 'details')->findOrFail($id);
//dd($devis);
        return view('dashboard.devis.devisShow', compact('devis','services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $devis= Devis::with('client', 'details')->findOrFail($id);

        $clients = Client::all();
        $services = Service::all();

        return view('dashboard.devis.devisEdit', compact('devis', 'clients', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' ,
            'services' => 'required|array',
            'services.*.designation' => 'required',
            'services.*.quantite' => 'required|numeric|min:1',
            'services.*.prix' => 'numeric|min:0',
            'objet' => 'nullable'
        ]);

        $devis= Devis::with('client', 'details')->findOrFail($id);

        // Suppressionm des anciens details devis
        $devis->details()->delete();

        $total = 0;
        //dd($request->services);

        // Recreer les nouveaux details
        foreach ($request->services as $item) {

            $ligneTotal = $item['quantite'] * $item['prix'];

            DevisDetails::create([
                'devis_id' => $devis->id,
                'designation' => $item['designation'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $item['prix'],
                'total' => $ligneTotal,
            ]);

            $total += $ligneTotal;
        }

        // Mise à jour du total
        $devis->update([
            'client_id' => $request->client_id,
            'total' => $total,
            'date_devis' => now(),
            'objet' => $request->objet
        ]);

        return redirect()->back()->with('success', 'Devis modifié avec succès');
    }


    /**
     * Validation devis.
     */
    public function valider(Request $request, string $id)
    {
        $devis = Devis::with('client', 'details')->findOrFail($id);
        
        // Vérifier si le devis est déjà converti
        if ($devis->statut == 'valide') {
            return redirect()->back()->with('success', 'Ce devis a déjà été validé !.');
        } 

        $devis->update(['statut' => 'valide']);

        return redirect()->back()->with('success', 'Devis validé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $devis = Devis::findOrFail($id);
        $devis->delete();

        return redirect()->route('dashboard')->with('success', 'Devis supprimé');
    }


    public function facture($id)
    {
        $entreprise= Entreprise::findOrFail(1);

        $devis = Devis::with('client', 'details', 'entreprise')->findOrFail($id);

        $devis->load(['client', 'details']);

        $pdf = Pdf::loadView('dashboard.devis.devisFacture', compact('devis', 'entreprise'));

        return $pdf->stream ('Facture-' . $devis->reference . '.pdf');
    }
}
