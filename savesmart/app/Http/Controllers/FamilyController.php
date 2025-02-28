<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $families = Family::where("user_id", "=", Auth::user()->id)->get();
        
        return view('families.index', compact('families'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Auth::user()->families()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('families.index')->with('success', 'Famille créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        // Vous pouvez ajouter une logique ici si vous souhaitez afficher les détails d'une famille spécifique
        return view('families.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        return view('families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $family->update([
            'name' => $request->name,
        ]);

        return redirect()->route('families.index')->with('success', 'Famille mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        $family->delete();

        return redirect()->route('families.index')->with('success', 'Famille supprimée avec succès.');
    }
}