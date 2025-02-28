<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller 
{
    public function showRegistrationForm()
    {
        return view('register');
    }

public function register(Request $request){

    $validator =Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email'=>'required|string|email|max:255|unique:users',
        'password'=>'required|string|max:8',
    ]);
    if($validator->fails()){
        return redirect('register')
        ->withErrors($validator)
        ->withInput();
    }

  $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('home');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return redirect('login')->withErrors(['message' => 'Identifiants incorrects.']);
    }

    public function home()
    {
        return view('home');
    }
}