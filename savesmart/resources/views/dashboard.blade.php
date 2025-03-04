
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-bold text-[#2C3E50] mb-6">Dashboard</h1>

        @if(session('family_member_id'))
            <div class="bg-[#ECF0F1] p-4 rounded-lg shadow-md mb-6">
                <p class="text-lg text-[#2C3E50]">Connecté en tant que : <span class="font-semibold">{{ \App\Models\FamilyMember::find(session('family_member_id'))->name }}</span></p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('expenses.index') }}" class="block px-6 py-3 bg-[#27AE60] text-white rounded-lg text-center font-semibold hover:bg-[#219653] transition duration-300">Voir les Dépenses</a>
            <a href="{{ route('incomes.index') }}" class="block px-6 py-3 bg-[#27AE60] text-white rounded-lg text-center font-semibold hover:bg-[#219653] transition duration-300">Voir les Revenus</a>
            <a href="{{ route('financial_goals.index') }}" class="block px-6 py-3 bg-[#27AE60] text-white rounded-lg text-center font-semibold hover:bg-[#219653] transition duration-300">Voir les Objectifs Financiers</a>
            <a href="{{ route('categories.index') }}" class="block px-6 py-3 bg-[#27AE60] text-white rounded-lg text-center font-semibold hover:bg-[#219653] transition duration-300">Voir les Categories</a>
        </div>
    </div>
@endsection