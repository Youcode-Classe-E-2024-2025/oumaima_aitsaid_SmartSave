<?php 
namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familyMemberId = session('family_member_id');
        $incomes = Income::where('family_member_id', $familyMemberId)->get();
        return view('incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'source' => 'nullable|string|max:255',
        ]);

        $income = new Income();
        $income->family_member_id = session('family_member_id');
        $income->amount = $request->amount;
        $income->date = $request->date;
        $income->source = $request->source;
        $income->save();

        return redirect()->route('incomes.index')->with('success', 'Income created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //Optional: display details
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        return view('incomes.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'source' => 'nullable|string|max:255',
        ]);

        $income->amount = $request->amount;
        $income->date = $request->date;
        $income->source = $request->source;
        $income->save();

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully!');
    }
}