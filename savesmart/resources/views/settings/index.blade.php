<!-- resources/views/settings/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Settings</h1>

        <div class="w-full max-w-md">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('settings.update') }}">
                @csrf
                @method('PUT')

                <!-- Budgeting Rule Selection -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Budgeting Rule:</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="budgeting_rule" value="50/30/20" {{ Auth::user()->budgeting_rule == '50/30/20' ? 'checked' : '' }}>
                            <span class="ml-2">50/30/20</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" class="form-radio" name="budgeting_rule" value="70/20/10" {{ Auth::user()->budgeting_rule == '70/20/10' ? 'checked' : '' }}>
                            <span class="ml-2">70/20/10</span>
                        </label>
                    </div>
                </div>

                <!-- Other settings fields (e.g., name, email) - Add more fields as needed -->

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection