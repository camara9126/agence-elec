<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Entreprise;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContratController extends Controller
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
            'titre' => 'required','string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'contenu' => 'string',
            'date' => 'string',
            'editeur'
        ]);

        // creation du contrat

            // Gestion de l'images principal
            if ($request->hasFile('image')) {
                $filename = time().$request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('imgContrat', $filename, 'public');
                $request['image'] = '/storage/' . $path;
            }

        Contrat::create([
            'reference' => 'REF-' . now()->timestamp,
            'titre' => $request->titre,
            'image' => $path ?? null,
            'contenu' => $request->contenu,
            'date' => now(),
            'editeur' => $request->editeur ?? request()->user()->name,
        ]);
        // dd($categories);
        return redirect()->back()->with('success', 'Contrat crée avec success.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entreprise= Entreprise::findOrFail(1);

        $contrat = Contrat::findOrFail($id);

        $contrat->load('entreprise');

        $pdf = Pdf::loadView('dashboard.contrat.pdf', compact('entreprise', 'contrat'));

        return $pdf->stream ('Contrat-' . $contrat->reference . '.pdf');
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
        $contrat= Contrat::findorFail($id);

        $request->validate([
            'titre' => 'required','string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'contenu' => 'string',
            'date' => 'string',
            'editeur' => 'string'
        ]);
        

        // Gestion de l'images principal
        if ($request->hasFile('image')) {

        // Suppression de l'ancien image gal
        if($contrat->image){
            Storage::delete('public/storage/imgContrat/'.$contrat->image);
        }
            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('imgContrat', $filename, 'public');
            $request['image'] = '/storage/' . $path;
        }

        $contrat->update([
            'reference' => 'REF-' . now()->timestamp,
            'titre' => $request->titre,
            'image' => $path,
            'contenu' => $request->contenu,
            'date' => now(),
            'editeur' => $request->editeur ?? request()->user()->name,
            'statut' => $request->statut,
        ]);
        // dd($categories);

        return redirect()->back()->with('success', 'Contrat modifié avec success.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contrat= Contrat::findOrFail($id);

        $contrat->destroy($id);

        return redirect()->back()->with('success', 'Contrat supprimée avec success.');
    }
}
