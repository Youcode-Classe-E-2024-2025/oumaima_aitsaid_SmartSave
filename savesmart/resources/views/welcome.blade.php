@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-[#2C3E50] to-[#27AE60] text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-6">Gérez vos finances intelligemment</h1>
            <p class="text-xl mb-8">SaveSmart vous aide à suivre vos dépenses, économiser de l'argent et atteindre vos objectifs financiers.</p>
            <div class="space-x-4">
                <a href="#" class="px-6 py-3 bg-[#27AE60] text-white rounded-lg font-semibold hover:bg-[#219653]">Commencer</a>
                <a href="#" class="px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-[#2C3E50]">En savoir plus</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-[#ECF0F1]">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-[#2C3E50]">Fonctionnalités</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-center mb-4 text-[#2C3E50]">Suivi des dépenses</h3>
                    <p class="text-gray-600 text-center">Visualisez et analysez vos dépenses en temps réel.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-center mb-4 text-[#2C3E50]">Objectifs d'épargne</h3>
                    <p class="text-gray-600 text-center">Définissez et atteignez vos objectifs financiers.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-center mb-4 text-[#2C3E50]">Rapports détaillés</h3>
                    <p class="text-gray-600 text-center">Générez des rapports pour mieux comprendre vos finances.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-[#2C3E50]">Tarifs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-[#ECF0F1] rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-center mb-4 text-[#2C3E50]">Gratuit</h3>
                    <p class="text-4xl font-bold text-center mb-4 text-[#2C3E50]">0€<span class="text-gray-500 text-sm">/mois</span></p>
                    <a href="#" class="block px-6 py-3 bg-[#27AE60] text-white rounded-lg text-center hover:bg-[#219653]">Commencer</a>
                </div>
            </div>
        </div>
    </section>
@endsection