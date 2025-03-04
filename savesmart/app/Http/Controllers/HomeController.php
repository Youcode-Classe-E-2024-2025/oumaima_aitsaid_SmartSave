<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FamilyMember;
use App\Models\Family; 
use App\Models\Expense;
use App\Models\Income;
use App\Models\FinancialGoal;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (session('family_member_id')) {
            // Family member is logged in
            $familyMember = FamilyMember::find(session('family_member_id'));
            if (!$familyMember) {
                abort(404, 'Family member not found');
            }
            return view('home', ['user' => $familyMember, 'userType' => 'family_member']);
        } else {
            // Main user is logged in (or no one is logged in)
            if (!$user) {
                return redirect('/login');
            }

            // Check if the user has a family
            $family = $user->family; // Access the relationship
            if ($family) {
                // User has a family, display family information
                return view('home', ['user' => $user, 'userType' => 'main_user', 'family' => $family]);
            } else {
                // User does not have a family, prompt to create one
                return view('home', ['user' => $user, 'userType' => 'main_user', 'family' => null]);
            }
        }
    }
    public function dashboard() //Changed the index method so it does
    {
    $user = Auth::user();

    if (session('family_member_id')) {
        // Family member is logged in
        $familyMember = FamilyMember::find(session('family_member_id'));
        if (!$familyMember) {
            abort(404, 'Family member not found');
        }

        $expenses = Expense::where('family_member_id', $familyMember->id)->get();
        $incomes = Income::where('family_member_id', $familyMember->id)->get();
        $goals = FinancialGoal::where('family_member_id', $familyMember->id)->get();
    } else {
        // Main user is logged in (or no one is logged in)
        if (!$user) {
            return redirect('/login');
        }

        $expenses = Expense::where('family_member_id', $user->id)->get();
        $incomes = Income::where('family_member_id', $user->id)->get();
        $goals = FinancialGoal::where('family_member_id', $user->id)->get();
    }

    $totalIncome = $incomes->sum('amount');
    $totalExpenses = $expenses->sum('amount');

    // Calculate expenses for needs, wants, and savings (replace category IDs with your actual IDs)
    $needs = $expenses->where('category_id', 1)->sum('amount');
    $wants = $expenses->where('category_id', 2)->sum('amount');
    $savings = $expenses->where('category_id', 5)->sum('amount');
    //In this part, you can change the number.

    $viewData = [
        'user' => $user,
        'familyMemberId' => session('family_member_id'),
        'expenses' => $expenses,
        'incomes' => $incomes,
        'goals' => $goals,
        'totalIncome' => $totalIncome,
        'totalExpenses' => $totalExpenses,
        'needs' => $needs,
        'wants' => $wants,
        'savings' => $savings,
    ];

    return view('dashboard', $viewData);
}
}