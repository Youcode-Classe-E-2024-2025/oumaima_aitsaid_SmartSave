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
    public function dashboard()
    {
        $user = Auth::user();
        $familyMemberId = session('family_member_id');
        $viewingAsFamilyMember = false;

        if ($familyMemberId) {
            // Family member is logged in
            $familyMember = FamilyMember::find($familyMemberId);
            if (!$familyMember) {
                abort(404, 'Family member not found');
            }

            $expenses = Expense::where('family_member_id', $familyMember->id)->get();
            $incomes = Income::where('family_member_id', $familyMember->id)->get();
            $goals = FinancialGoal::where('family_member_id', $familyMember->id)->get();

            $viewingAsFamilyMember = true;
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
        $netBalance = $totalIncome - $totalExpenses;

        // Calculate expenses for needs, wants, and savings (replace category IDs with your actual IDs)
        $needs = $expenses->where('category_id', 1)->sum('amount');
        $wants = $expenses->where('category_id', 2)->sum('amount');
        $savings = $expenses->where('category_id', 5)->sum('amount');

        $budgetingRule = $user->budgeting_rule ?? '50/30/20';

        // Calculate recommended allocation based on selected rule
        $recommendedNeeds = 0;
        $recommendedWants = 0;
        $recommendedSavings = 0;

        if ($budgetingRule === '70/20/10') {
            $recommendedNeeds = $totalIncome * 0.7;
            $recommendedWants = 0;
            $recommendedSavings = $totalIncome * 0.2;
        } else {
            // Default to 50/30/20
            $recommendedNeeds = $totalIncome * 0.5;
            $recommendedWants = $totalIncome * 0.3;
            $recommendedSavings = $totalIncome * 0.2;
        }

        $viewData = [
            'user' => $user,
            'familyMemberId' => $familyMemberId,
            'expenses' => $expenses,
            'incomes' => $incomes,
            'goals' => $goals,
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'netBalance' => $netBalance,
            'needs' => $needs,
            'wants' => $wants,
            'savings' => $savings,
            'recommendedNeeds' => $recommendedNeeds,
            'recommendedWants' => $recommendedWants,
            'recommendedSavings' => $recommendedSavings,
        ];

        return view('dashboard', $viewData);
    }
}