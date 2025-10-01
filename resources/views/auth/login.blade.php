@extends('layout.app')

@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div class="flex items-center">
            <input type="checkbox" name="remember" id="remember" class="mr-2 rounded text-indigo-600 focus:ring-indigo-500">
            <label for="remember" class="text-sm text-gray-600">Remember Me</label>
        </div>
        <button
            type="submit"
            class="w-full bg-gradient-to-r from-gray-400 to-blue-500 cursor-pointer px-4 py-2 text-gray-800 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition">
            Login
        </button>
    </form>

    <div class="mt-4 text-center">
        <span class="text-sm text-gray-600">Don't have an account?</span>
        <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:underline">Register</a>
    </div>
</div>
@endsection
