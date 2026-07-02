<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\AchatDetails;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AchatController extends Controller
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
            'fournisseur_id' ,
            'fournisseur',
            'services' => 'required|array',
            'services.*.designation' => 'required',
            'services.*.quantite' => 'required|numeric|min:1',
            'services.*.prix' => 'required|numeric|min:0',
            'note' => 'nullable',
        ]);

         DB::beginTransaction();
    
        try {

            //Creation de fournisseur
            if($request->fournisseur) {
                
                $fournisseur= Fournisseur::create([
                    'nom' => $request->fournisseur
                ]);

            }

            // Création du bon de commande
            $achat = Achat::create([
                'reference' => 'ACH-' . strtoupper(Str::random(6)),
                'fournisseur_id' => $request->fournisseur_id ?? $fournisseur->id,
                'total' => 0,
                'note' => $request->note ?? 'null',
            ]);

            $total = 0;

            foreach ($request->services as $item) {

                $ligneTotal = $item['quantite'] * $item['prix'];

                AchatDetails::create([
                    'achat_id' => $achat->id,
                    'designation' => $item['designation'],
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $item['prix'],
                    'total' => $ligneTotal,
                ]);

                $total += $ligneTotal;

            }

            // Mise à jour du total
            $achat->update([
                'total' => $total
            ]);


        DB::commit();

        return redirect()->route('achats.index')->with('success', 'Achat créé avec succès');

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
        $achat = Achat::with('fournisseur', 'details.service')->findOrFail($id);

        return view('dashboard.achats.achatShow', compact('achat'));
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
        $achat = Achat::findOrFail($id);
        $achat->delete();

        return back()->with('success', 'Achat supprimé');
    }
}
