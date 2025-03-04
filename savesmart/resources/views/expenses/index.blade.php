<!-- resources/views/expenses/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Expenses</h1>

        <a href="{{ route('expenses.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-block mb-4">Add Expense</a>

        @if (count($expenses) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Amount
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $expense->date }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $expense->category->name }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">${{ $expense->amount }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $expense->description }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <a href="{{ route('expenses.edit', $expense->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-700">No expenses recorded yet.</p>
        @endif
    </div>
@endsection