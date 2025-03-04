<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function create()
    {
        return view('families.create'); // Create a view for the form
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $family = new Family();
        $family->name = $request->name;
        $family->user_id = Auth::id(); // The logged-in user is the admin
        $family->save();

        return redirect()->route('home')->with('success', 'Family created successfully!');
    }
    public function show(Family $family)
    {
        // Logic to display the family and its members
        return view('families.show', compact('family'));
    }
}