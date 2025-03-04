<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\FinancialGoalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\Expense; 
use App\Models\Income;
use App\Models\FinancialGoal;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Family Routes (for the main user)
    Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
    Route::get('/families/create', [FamilyController::class, 'create'])->name('families.create');
    Route::post('/families', [FamilyController::class, 'store'])->name('families.store');
    Route::get('/families/{family}', [FamilyController::class, 'show'])->name('families.show');

    // Family Member Routes (create new account for family under the family account)
    Route::get('/families/{family}/members/create', [FamilyMemberController::class, 'create'])->name('family_members.create');
    Route::post('/families/{family}/members', [FamilyMemberController::class, 'store'])->name('family_members.store');

    // Family Member Login (login as other account beside the family admin user)
    Route::get('/family_members/login/{family_member_id?}', [FamilyMemberController::class, 'loginForm'])->name('family_members.login');
    Route::post('/family_members/authenticate', [FamilyMemberController::class, 'authenticate'])->name('family_members.authenticate');

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    // Expense Routes
    Route::resource('expenses', ExpenseController::class);

    // Income Routes
    Route::resource('incomes', IncomeController::class);

    // Financial Goal Routes
    Route::resource('financial_goals', FinancialGoalController::class);
});
Route::resource('categories',CategoryController::class);