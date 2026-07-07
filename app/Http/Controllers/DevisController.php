<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Devis;
use App\Models\DevisDetails;
use App\Models\Entreprise;
use App\Models\Paiement;
use App\Models\Recette;
use App\Models\Service;
use App\Models\Vente;
use App\Models\VenteItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'reference' => 'DEV-' . now(), //strtoupper(Str::random(6)),
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
     * Convertir devis en vente
     */
    public function convertir(Request $request, string $id)
    {
        DB::beginTransaction();
    
        try {
            $devis = Devis::with('client', 'details')->findOrFail($id);
        
            // Vérifier si le devis est déjà converti
                if ($devis->converti_en_vente) {
                    return redirect()->back()->with('danger', 'Ce devis a déjà été converti en vente.');
                } 

            // Créer la vente
            $vente = Vente::create([
                'reference' => 'VNT-' . time(),
                'date' => now(),
                'client_id' => $devis->client_id,
                'total' => $devis->total,
                'total_tva' => 0,
                'total_ttc' => 0,
                'statut' => 'impayee',
                'user_id' => $request->user()->id,
            ]);

                $total = 0;
                $total_tva = 0;
                $total_ttc = 0;

            // Ajouter les produits
            foreach ($devis->details as $detail) {

                $entreprise= Entreprise::findOrFail(1); // Recuperation de la TVA de l'entreprise

                VenteItem::create([
                    'vente_id' => $vente->id,
                    'service' => $detail->designation,
                    'quantite' => $detail->quantite,
                    'prix_unitaire' => $detail->prix_unitaire,
                    'taux_tva' => $entreprise->taux_tva,
                    'montant_tva' => ($detail['quantite'] * $detail['prix_unitaire']) * ($entreprise->taux_tva /100 ),
                    'total_ttc' => ($detail['quantite'] * $detail['prix_unitaire']) + (($detail['quantite'] * $detail['prix_unitaire']) * ($entreprise->taux_tva /100 )),
                    'total' => $detail['quantite'] * $detail['prix_unitaire'],
                ]);

                // Calcule total + total_tva + total_ttc
                $total += $detail['quantite'] *  $detail['prix_unitaire'];
                $total_tva += ($detail['quantite'] * $detail['prix_unitaire']) * ($entreprise->taux_tva /100 );
                $total_ttc += $detail['quantite'] *  $detail['prix_unitaire'] + ($detail['quantite'] * $detail['prix_unitaire']) * ($entreprise->taux_tva /100 );

                // Mise a jour total + total_tva + total_ttc
                $vente->update([
                    'total' => $total,
                    'total_tva' => $total_tva,
                    'total_ttc' => $total_ttc,
                ]);
                
            }

            // Mise a jour Devis
            $devis->update([
                'statut' => 'valide',
                'converti_en_vente' => 1
            ]);

            // creation paiement
                $paiement = $vente;

                $totalPaye = $paiement->paiements()->where('statut','valide')->sum('montant');

                $paiements= Paiement::create([
                    'vente_id' => $vente->id,
                    'user_id' => request()->user()->id,
                    'montant' => $vente->total_ttc,
                    'mode_paiement' => 'cash',
                    'date_paiement' => now(),
                    'statut' => 'valide',
                    'reference' => 'PAY-' . time()
                ]);


                // Mise à jour du statut de la vente
                $vente = $paiements->vente;

                $totalPaye = $vente->paiements()->where('statut','valide')->sum('montant');

                $vente->statut = $totalPaye == 0 ? 'impayee' : ($totalPaye < $vente->total_ttc ? 'partielle' : 'payee');

                $vente->save();


                // 2. Création automatique de la recette
                if($vente->statut == 'payee') {
                    Recette::create([
                        'user_id' => $request->user()->id,
                        'paiement_id' => $paiements->id,
                        'reference' => 'REC-' . now()->timestamp,
                        'libelle' => 'Paiement vente ' . $vente->reference,
                        'montant' => $vente->total_ttc,
                        'date_recette' => now(),
                        'mode_paiement' => 'cash',
                        'statut' => 'recu',
                    ]);
                }

                DB::commit();
                return redirect()->route('dashboard', $vente->id)->with('success', 'Devis converti en Bon de Commande');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('danger', 'Erreur lors de la conversion: ' . $e->getMessage());
            }
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
