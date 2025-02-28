<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Family $family)
    {
        $profiles = $family->profiles;
        return view('profiles.index', compact('family', 'profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Family $family)
    {
        return view('profiles.create', compact('family'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Family $family)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles|max:255',
            'password' => 'required|string|min:8',
        ]);

        $family->profiles()->create([
            'user_id' => auth()->id(), // L'utilisateur connecté est le créateur du profil
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('families.profiles.index', $family)->with('success', 'Profil créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family, Profile $profile)
    {
        // Vous pouvez ajouter une logique ici si vous souhaitez afficher les détails d'un profil spécifique
        return view('profiles.show', compact('family', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family, Profile $profile)
    {
        return view('profiles.edit', compact('family', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family, Profile $profile)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email,' . $profile->id . '|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        $profile->name = $request->name;
        $profile->email = $request->email;
        if ($request->filled('password')) {
            $profile->password = Hash::make($request->password);
        }
        $profile->save();

        return redirect()->route('families.profiles.index', $family)->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family, Profile $profile)
    {
        $profile->delete();

        return redirect()->route('families.profiles.index', $family)->with('success', 'Profil supprimé avec succès.');
    }
}