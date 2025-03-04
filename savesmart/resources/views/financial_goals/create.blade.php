<!-- resources/views/financial_goals/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow-md max-w-md mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Add Financial Goal</h1>

        <form action="{{ route('financial_goals.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div>
                <label for="target_amount" class="block text-gray-700 text-sm font-bold mb-2">Target Amount</label>
                <input type="number" step="0.01" name="target_amount" id="target_amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div>
                <label for="target_date" class="block text-gray-700 text-sm font-bold mb-2">Target Date</label>
                <input type="date" name="target_date" id="target_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save</button>
        </form>
    </div>
@endsection