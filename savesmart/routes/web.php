<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/home', [AuthController::class, 'home'])->name('home')->middleware('auth'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/families/create', [FamilyController::class, 'create'])->name('families.create')->middleware('auth');
Route::resource('families', FamilyController::class)->middleware('auth');
Route::resource('families/{family}/profiles', ProfileController::class)->middleware('auth');