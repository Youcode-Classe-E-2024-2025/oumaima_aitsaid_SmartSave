<!-- resources/views/families/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Family: {{ $family->name }}</h1>

        <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">Family Members</h2>
        <ul>
            @foreach ($family->familyMembers as $member)
                <li class="py-2 px-4 border-b border-gray-200 flex items-center justify-between">
                    <span>{{ $member->name }}</span>
                    <a href="{{ route('family_members.login', ['family_member_id' => $member->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">Login as {{ $member->name }}</a>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('family_members.create', $family->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Family Member</a>
    </div>
@endsection