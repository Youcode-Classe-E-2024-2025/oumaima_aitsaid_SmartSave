<!-- resources/views/financial_goals/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow-md max-w-md mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Financial Goal</h1>

        <form action="{{ route('financial_goals.update', $goal->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $goal->name }}" required>
            </div>
            <div>
                <label for="target_amount" class="block text-gray-700 text-sm font-bold mb-2">Target Amount</label>
                <input type="number" step="0.01" name="target_amount" id="target_amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $goal->target_amount }}" required>
            </div>
            <div>
                <label for="target_date" class="block text-gray-700 text-sm font-bold mb-2">Target Date</label>
                <input type="date" name="target_date" id="target_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $goal->target_date }}" required>
            </div>
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                <a href="{{ route('financial_goals.index') }}" class="inline-block bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection