@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Admin Panel</h2>
     <div>
        <p class="text-gray-600 mb-6 text-center">Welcome to the admin dashboard. Use the links below to manage users and bookings.</p>
     </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Users -->
        <a href="{{ route('admin.users') }}"
           class="block bg-white shadow-lg rounded-lg p-6 text-center
                  hover:bg-indigo-50 hover:shadow-2xl transform hover:-translate-y-1
                  transition duration-300 ease-in-out">
            <div class="flex items-center justify-center mb-3">
                <!-- User Icon -->
                <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9.955 9.955 0 0012 20c2.21 0 4.264-.715 5.879-1.922M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div class="text-indigo-600 text-xl font-semibold mb-1">Users</div>
            <p class="text-gray-500 text-sm">Manage registered users</p>
        </a>

        <!-- Booking -->
        <a href="{{ route('admin.bookingAdmin.index') }}"
           class="block bg-white shadow-lg rounded-lg p-6 text-center
                  hover:bg-indigo-50 hover:shadow-2xl transform hover:-translate-y-1
                  transition duration-300 ease-in-out">
            <div class="flex items-center justify-center mb-3">
                <!-- Calendar/Booking Icon -->
                <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="text-indigo-600 text-xl font-semibold mb-1">Bookings</div>
            <p class="text-gray-500 text-sm">View and manage bookings</p>
        </a>


    </div>
</div>
@endsection
