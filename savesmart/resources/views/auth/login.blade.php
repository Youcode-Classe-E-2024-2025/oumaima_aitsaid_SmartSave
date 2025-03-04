@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-bold text-[#2C3E50] mb-6">Connexion</h1>
        <div class="bg-white shadow-md rounded-lg p-8 max-w-md mx-auto">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-[#2C3E50] text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-[#27AE60]" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-[#2C3E50] text-sm font-bold mb-2">Mot de passe</label>
                    <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-[#27AE60]" name="password" required autocomplete="current-password">
                </div>
                <div class="mb-4 flex items-center">
                    <input class="form-check-input mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="text-[#2C3E50]" for="remember">Se souvenir de moi</label>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-[#27AE60] hover:bg-[#219653] text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-[#27AE60]">
                        Se connecter
                    </button>
                    @if (Route::has('password.request'))
                        <a class="text-[#27AE60] hover:text-[#219653]" href="{{ route('password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
