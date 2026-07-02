<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Entreprise;
use App\Models\Paiement;
use App\Models\Recette;
use App\Models\Vente;
use App\Models\VenteItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
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
            'services' => 'required|array|min:1',
            'statut' ,
            'services.*.designation' => 'required',
            'services.*.quantite' => 'required|numeric|min:1',
            'services.*.prix' => 'required|numeric|min:0',
            'montant' => 'numeric|min:0',
            'client'
        ]);

        DB::beginTransaction();
    
        try {

        //Creation de fournisseur
            if($request->client) {
                
                $client= Client::create([
                    'nom' => $request->client
                ]);

            }

            // Creation vente item
            $entreprise= Entreprise::findOrFail(1); // Recuperation de la TVA de l'entreprise

                //dd($request->montant);
                $vente = Vente::create([
                    'client_id' =>  $request->client_id ?? $client->id  ?? null,
                    'reference' => 'VNT-' . time(),
                    'date' => now(),
                    'total' => 0,
                    'total_tva' => 0,
                    'total_ttc' => 0,
                    'statut' => 'impayee',
                    'user_id' => request()->user()->id,
                ]);

                $total = 0;
                $total_tva = 0;
                $total_ttc = 0;
            //dd($request->all());
            foreach ($request->services as $item) {

            
                if (empty($item['designation'])) {
                    continue;
                }
            
        
                VenteItem::create([
                    'vente_id' => $vente->id,
                    'service' => $item['designation'],
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $item['prix'],
                    'taux_tva' => $entreprise->taux_tva,
                    'montant_tva' => ($item['quantite'] * $item['prix']) * ($entreprise->taux_tva /100 ),
                    'total_ttc' => ($item['quantite'] * $item['prix']) + (($item['quantite'] * $item['prix']) * ($entreprise->taux_tva /100 )),
                    'total' => $item['quantite'] * $item['prix'],
                ]);


                // Calcule total + total_tva + total_ttc
                $total += $item['quantite'] *  $item['prix'];
                $total_tva += ($item['quantite'] * $item['prix']) * ($entreprise->taux_tva /100 );
                $total_ttc += ($item['quantite'] * $item['prix']) + (($item['quantite'] * $item['prix']) * ($entreprise->taux_tva /100 ));
                
                // Mise a jour total + total_tva + total_ttc
                $vente->update([
                    'total' => $total,
                    'total_tva' => $total_tva,
                    'total_ttc' => $total_ttc,
                ]);
                
            }
            
                // creation paiement
                $paiement = $vente;

                $totalPaye = $paiement->paiements()->where('statut','valide')->sum('montant');

                $paiements= Paiement::create([
                    'entreprise_id' => $entreprise->id,
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
                return redirect()->route('dashboard')->with('success', 'Facture effectuée avec succès');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('danger', 'Erreur lors de la conversion: ' . $e->getMessage());
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entreprise= Entreprise::findOrFail(1);
        $facture= Vente::with('client', 'items', 'paiements')->findOrFail($id);
//dd($facture);
        $facture->load(['client', 'items', 'paiements']);

        $pdf = Pdf::loadView('dashboard.factures.PDF', compact('facture', 'entreprise'));

        return $pdf->stream('Facture-' . $facture->reference . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facture= Vente::findOrFail($id);        
        $facture->destroy($id);

        return redirect()->route('dashboard')->with('success', 'Facture supprimée avec succès');
    }
}
