<?php
namespace App\Http\Controllers;

use App\Models\FinancialGoal;
use Illuminate\Http\Request;

class FinancialGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familyMemberId = session('family_member_id');
        $goals = FinancialGoal::where('family_member_id', $familyMemberId)->get();
        return view('financial_goals.index', compact('goals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financial_goals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'target_date' => 'required|date',
        ]);

        $goal = new FinancialGoal();
        $goal->family_member_id = session('family_member_id');
        $goal->name = $request->name;
        $goal->target_amount = $request->target_amount;
        $goal->target_date = $request->target_date;
        $goal->saved_amount = 0; // Initialize saved amount to 0
        $goal->save();

        return redirect()->route('financial_goals.index')->with('success', 'Financial goal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialGoal $goal)
    {
        // Optional: display details of a single goal
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialGoal $goal)
    {
        return view('financial_goals.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialGoal $goal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'target_date' => 'required|date',
        ]);

        $goal->name = $request->name;
        $goal->target_amount = $request->target_amount;
        $goal->target_date = $request->target_date;
        $goal->save();

        return redirect()->route('financial_goals.index')->with('success', 'Financial goal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialGoal $goal)
    {
        $goal->delete();
        return redirect()->route('financial_goals.index')->with('success', 'Financial goal deleted successfully!');
    }
}