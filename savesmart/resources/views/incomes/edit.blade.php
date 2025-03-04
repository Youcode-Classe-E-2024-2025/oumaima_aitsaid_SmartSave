<!-- resources/views/incomes/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow-md max-w-md mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Income</h1>

        <form action="{{ route('incomes.update', $income->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount</label>
                <input type="number" step="0.01" name="amount" id="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $income->amount }}" required>
            </div>
            <div>
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                <input type="date" name="date" id="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $income->date }}" required>
            </div>
            <div>
                <label for="source" class="block text-gray-700 text-sm font-bold mb-2">Source</label>
                <input type="text" name="source" id="source" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $income->source }}">
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                <a href="{{ route('incomes.index') }}" class="inline-block bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection