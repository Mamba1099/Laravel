@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Welcome to your Dashboard!</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-600">Hello, {{ Auth::user()->name }}!</h3>
            <p class="text-sm text-gray-600">You are logged in.</p>
        </div>

        <div class="bg-green-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-green-600">Account Info</h3>
            <p class="text-sm text-gray-600">Email: {{ Auth::user()->email }}</p>
            <p class="text-sm text-gray-600">Role: {{ Auth::user()->role }}</p>
        </div>

        <div class="bg-purple-50 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-purple-600">Stats</h3>
            <p class="text-sm text-gray-600">Member since: {{ Auth::user()->created_at->format('M d, Y') }}</p>
        </div>
    </div>
</div>
@endsection