<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'budgeting_rule' => 'required|in:50/30/20,70/20/10',
        // Add validation rules for other settings fields
    ]);

    $user->budgeting_rule = $request->budgeting_rule;
    // Update other settings fields as needed

    $user->save();

    return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
}
}