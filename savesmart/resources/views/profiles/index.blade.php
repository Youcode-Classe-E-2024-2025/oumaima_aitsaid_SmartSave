@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Membres de la famille : {{ $family->name }}</h1>

        <a href="{{ route('families.profiles.create', $family) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Ajouter un nouveau membre
        </a>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($profiles as $profile)
                <div class="bg-white shadow-md rounded p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $profile->name }}</h2>
                    <p class="text-gray-700">Email: {{ $profile->email }}</p>
                    <div class="mt-4">
                        <a href="{{ route('families.profiles.edit', [$family, $profile]) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-block">
                            Modifier
                        </a>
                        <form action="{{ route('families.profiles.destroy', [$family, $profile]) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('families.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
            Retour à la liste des familles
        </a>
    </div>
@endsection