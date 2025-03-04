@extends('layouts.app')

@section('content')
    <h1>My Family</h1>

    @if($family)
        <p>Family Name: {{ $family->name }}</p>
        <a href="{{ route('families.show', $family->id) }}" class="btn btn-primary">View Family Members</a>
    @else
        <p>You haven't created a family yet.</p>
        <a href="{{ route('families.create') }}" class="btn btn-primary">Create Family</a>
    @endif
@endsection

