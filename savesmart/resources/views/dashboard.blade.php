@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h1>

        {{-- Greetings and Family Member Context --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            @auth
                <h2 class="text-xl font-semibold text-gray-700 mb-2">
                    Welcome, {{ Auth::user()->name }}!
                </h2>
            @endauth

            @if(session('family_member_name'))
                <p class="text-gray-600">Viewing as: <span class="font-semibold">{{ session('family_member_name') }}</span></p>
                {{-- Add a link to switch back to main account --}}
            @endif
        </div>

        {{-- Financial Summary Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Income</h3>
                <p class="text-2xl text-green-500 font-bold">${{ number_format($totalIncome, 2) }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Expenses</h3>
                <p class="text-2xl text-red-500 font-bold">${{ number_format($totalExpenses, 2) }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Net Balance</h3>
                <p class="text-2xl text-gray-800 font-bold">${{ number_format($netBalance, 2) }}</p>
            </div>
        </div>

        {{-- Budget Allocation Table --}}
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Recommended Budget Allocation</h2>
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-sm font-semibold">
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Category</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-right">Recommended</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-right">Actual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">Needs</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-right">${{ number_format($recommendedNeeds, 2) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-right">${{ number_format($needs, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">Wants</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-right">${{ number_format($recommendedWants, 2) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-right">${{ number_format($wants, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">Savings</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-right">${{ number_format($recommendedSavings, 2) }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 text-right">${{ number_format($savings, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Goal Progress --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Financial Goals</h2>
            @if (count($goals) > 0)
                <ul>
                    @foreach ($goals as $goal)
                        <li class="mb-2">
                            <h3 class="font-semibold text-gray-700">{{ $goal->name }}</h3>
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                                    <div style="width:{{ min(($goal->saved_amount / $goal->target_amount) * 100, 100) }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-500">
                                    <span>${{ number_format($goal->saved_amount, 2) }} Saved</span>
                                    <span>Target: ${{ number_format($goal->target_amount, 2) }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">No financial goals set yet.</p>
                @endif
                <a href="{{ route('financial_goals.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Add New Goal</a>
            </div>
        </div>

        {{-- Action Links --}}
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('expenses.create') }}" class="block px-6 py-3 bg-red-500 text-white rounded-lg text-center font-semibold hover:bg-red-700 transition duration-300">Add Expense</a>
                <a href="{{ route('incomes.create') }}" class="block px-6 py-3 bg-green-500 text-white rounded-lg text-center font-semibold hover:bg-green-700 transition duration-300">Add Income</a>
                <a href="{{ route('financial_goals.create') }}" class="block px-6 py-3 bg-blue-500 text-white rounded-lg text-center font-semibold hover:bg-blue-700 transition duration-300">Set Financial Goal</a>
                 <a href="{{ route('categories.index') }}" class="block px-6 py-3 bg-gray-500 text-white rounded-lg text-center font-semibold hover:bg-gray-700 transition duration-300">Gerer Categories</a>
            </div>
        </div>
    </div>
@endsection