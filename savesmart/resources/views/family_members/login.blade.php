<!-- resources/views/family_members/login.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow-md max-w-md mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Login as Family Member</h1>

        @if($errors->any())
            <div class="bg-red-200 border-red-500 text-red-700 p-2 mb-4 rounded" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('family_members.authenticate') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="family_member_id" class="block text-gray-700 text-sm font-bold mb-2">Family Member</label>
                <select name="family_member_id" id="family_member_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Select Family Member</option>
                    @if(auth()->user()->family)
                         @foreach(auth()->user()->family->familyMembers as $member)
                            @if(isset($family_member_id))
                                <option value="{{ $member->id }}" @if($family_member_id == $member->id) selected @endif>{{ $member->name }}</option>
                            @else
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
        </form>
    </div>
@endsection