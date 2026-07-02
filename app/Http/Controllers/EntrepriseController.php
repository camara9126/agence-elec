<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntrepriseController extends Controller
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
            'nom' => 'string',
            'telephone' => 'nullable|string|max:50',
            'email',
            'taux_tva' => 'numeric|max:100',
            'adresse' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ninea' => 'nullable',
            'tel2' => 'nullable',
            'telfixe' => 'nullable',
        ]);

        // Gestion des logo
        if ($request->hasFile('logo')) {

            $filename = time().$request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logo', $filename, 'public');
            $request['logo'] = '/storage/' . $path;
           
        } 

        Entreprise::create([
            'telephone' => $request->telephone,
            'email' => $request->email,
            'taux_tva' => $request->taux_tva,
            'adresse' => $request->adresse,
            'logo' => $path  ?? null,
            'ninea' => $request->ninea  ?? null,
            'rccm' => $request->rccm  ?? null,
            'rib' => $request->rib  ?? null,
        ]);

        return redirect()->back()->with('success', 'Entreprise cree avec success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $entreprise = Entreprise::FindOrFail($id);

         $request->validate([
            'telephone' => 'nullable|string|max:50',
            'email',
            'taux_tva' => 'numeric|max:100',
            'adresse' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ninea' => 'nullable',
            'tel2' => 'nullable',
            'telfixe' => 'nullable',
        ]);

        // Gestion des logo
        if ($request->hasFile('logo')) {
            
            if($entreprise->logo){
                Storage::delete('public/logo/'.$entreprise->logo);
            }

            $filename = time().$request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logo', $filename, 'public');
            $request['logo'] = '/storage/' . $path;
           
        } else {
            $entreprise->logo;
        }

        $entreprise->update([
            'telephone' => $request->telephone,
            'email' => $request->email,
            'taux_tva' => $request->taux_tva,
            'adresse' => $request->adresse,
            'logo' => $path  ?? $entreprise->logo,
            'ninea' => $request->ninea  ?? null,
            'rccm' => $request->rccm  ?? null,
            'rib' => $request->rib  ?? null,
        ]);


        return redirect()->back()->with('success', 'Entreprise mise a jour avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
