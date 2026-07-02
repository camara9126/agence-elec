<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required','string',
            'description' => 'nullable',
            'prix' ,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
        // Gestion de l'images principal
        if ($request->hasFile('image')) {
            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('imgService', $filename, 'public');
            $request['image'] = '/storage/' . $path;
        }

        // creation du service
        Service::create([
            'nom' => $request->nom,
            'description' => $request->description ?? null,
            'prix' => $request->prix,
            'reference' => 'REF-' . now()->timestamp,
            'image' => $path ?? null,
        ]);

         return redirect()->back()->with('success', 'Service ajouté avec success.');
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
        $service= Service::findorFail($id);

         $request->validate([
            'nom' => 'required','string',
            'description' => 'nullable',
            'prix' ,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

       
        // Gestion de l'images principal
        if ($request->hasFile('image')) {

            // Suppression de l'ancien image gal
            if($service->image){
                Storage::delete('public/storage/imgService/'.$service->image);
            }

            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('imgService', $filename, 'public');
            $request['image'] = '/storage/' . $path;

        } 

        // creation du service
        $service->update([
            'nom' => $request->nom,
            'description' => $request->description ?? null,
            'prix' => $request->prix,
            'image' => $path ?? null ?? $service->image,
        ]);

         return redirect()->back()->with('success', 'Service ajouté avec success.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service= Service::findOrFail($id);

        $service->destroy($id);

        return redirect()->back()->with('success', 'Service supprimée avec success.');
    }
}
