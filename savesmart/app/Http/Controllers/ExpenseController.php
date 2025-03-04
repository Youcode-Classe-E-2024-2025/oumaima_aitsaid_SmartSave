<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $familyMemberId = session('family_member_id');
        $expenses = Expense::where('family_member_id', $familyMemberId)->get();
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $expense = new Expense();
        $expense->family_member_id = session('family_member_id');
        $expense->category_id = $request->category_id;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->description = $request->description;
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        // If you need to display details of a single expense
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $expense->category_id = $request->category_id;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->description = $request->description;
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }
}