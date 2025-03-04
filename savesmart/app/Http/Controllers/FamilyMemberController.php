<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FamilyMemberController extends Controller
{
    public function create(Family $family)
    {
        return view('family_members.create', compact('family'));
    }

    public function store(Request $request, Family $family)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $familyMember = new FamilyMember();
        $familyMember->family_id = $family->id;
        $familyMember->name = $request->name;
        $familyMember->password = $request->password; // Password will be hashed by the model
        $familyMember->save();

        return redirect()->route('families.show', $family->id)->with('success', 'Family member created successfully!');
    }

    public function loginForm($family_member_id = null)
    {
        // Logic to display the login form
        $families = FamilyMember::all();
        return view('family_members.login', compact('family_member_id', 'families'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'family_member_id' => 'required|exists:family_members,id',
            'password' => 'required|string',
        ]);

        $familyMember = FamilyMember::find($request->family_member_id);

        if (Hash::check($request->password, $familyMember->password)) {
            // Passwords match!  Log them in (virtually) by storing the ID in the session.
            session(['family_member_id' => $familyMember->id, 'family_member_name' => $familyMember->name]);
            return redirect()->route('dashboard')->with('success', 'Logged in as ' . $familyMember->name);
        } else {
            // Passwords don't match.
            return back()->withErrors(['password' => 'Invalid password.']);
        }
    }

    public function show(Family $family)
    {
        // Load the family members relationship
        $family->load('familyMembers');
    
        // Pass the family data to the view
        return view('families.show', compact('family'));
    }
}