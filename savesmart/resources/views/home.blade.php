<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow-md">
        @if ($userType === 'main_user')
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, {{ $user->name }}!</h1>
            <p class="text-gray-600">You are logged in as the main user.</p>

            @if ($family)
                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">Your Family: {{ $family->name }}</h2>
                <a href="{{ route('families.show', $family->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Manage Family Members</a>
            @else
                <p class="text-gray-600 mt-4">You haven't created a family yet.</p>
                <a href="{{ route('families.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Family</a>
            @endif

        @elseif ($userType === 'family_member')
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, {{ $user->name }}!</h1>
            <p class="text-gray-600">You are logged in as a family member.</p>
        @else
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Welcome!</h1>
            <p class="text-gray-600">Please log in.</p>
        @endif
    </div>
@endsection