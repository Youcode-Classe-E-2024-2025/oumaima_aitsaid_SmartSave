@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Mes Familles</h1>

        <a href="{{ route('families.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Créer une nouvelle famille
        </a>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @if (count($families) > 0)
            @foreach ($families as $family)
                <div class="bg-white shadow-md rounded p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $family->name }}</h2>
                    <div class="mt-4">
                        <a href="{{ route('families.edit', $family) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded inline-block">
                            Modifier
                        </a>
                        <form action="{{ route('families.destroy', $family) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @else
    <p>Aucune famille n'a été trouvée.</p>
@endif
        </div>
    </div>
@endsection