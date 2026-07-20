@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to MyApp</h1>
    <p class="text-xl text-gray-600 mb-8">A simple authentication system built with Laravel</p>

    @guest
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Login</a>
            <a href="{{ route('register') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">Register</a>
        </div>
    @endguest

    @auth
        <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Go to Dashboard</a>
    @endauth
</div>
@endsection