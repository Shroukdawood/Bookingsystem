@extends('layout.app')

@section('title', 'Home')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-gray-800">My Bookings</h2>

    @guest
        <!-- If the user is NOT logged in -->
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mb-6">
            <p class="font-semibold">Welcome to the Booking System 👋</p>
            <p class="text-sm">Please login or register to manage your bookings.</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('login') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition">
                Register
            </a>
        </div>
    @endguest

    @auth
        <!-- If the user IS logged in -->
        @if (auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}"
               class="inline-block mb-6 bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded shadow transition">
                Admin Panel
            </a>
        @endif

        @if($booking->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($bookings as $booking)
                    <div class="p-6 bg-white border rounded-xl shadow hover:shadow-lg transition">
                        <p class="mb-2 flex items-center gap-2">
                            <span class="font-semibold text-gray-700">Name:</span> {{ $booking->username }}
                        </p>

                        <p class="mb-2 flex items-center gap-2">
                            <span class="font-semibold text-gray-700">Status:</span>
                            <span class="px-2 py-1 rounded text-white
                                {{ $booking->status == 'Pending' ? 'bg-yellow-500' : '' }}
                                {{ $booking->status == 'Approved' ? 'bg-green-500' : '' }}
                                {{ $booking->status == 'Rejected' ? 'bg-red-500' : '' }}">
                                {{ $booking->status }}
                            </span>
                        </p>

                        <p class="mb-2"><span class="font-semibold">Date:</span> {{ $booking->booking_date }}</p>
                        <p class="mb-2"><span class="font-semibold">Time:</span> {{ $booking->booking_time }}</p>
                        <p class="mb-2"><span class="font-semibold">Guests:</span> {{ $booking->guests }}</p>
                        <p class="mb-3"><span class="font-semibold">Requests:</span> {{ $booking->special_requests }}</p>

                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PUT')
                                <label for="status_{{ $booking->id }}" class="block mb-1 text-gray-700 font-semibold">Update Status:</label>
                                <select name="status" id="status_{{ $booking->id }}"
                                        class="w-full border rounded px-2 py-2 mb-3 focus:ring focus:ring-blue-200">
                                    <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Approved" {{ $booking->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="Rejected" {{ $booking->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <button type="submit"
                                        class="w-full bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded shadow transition">
                                    Save
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-100 text-gray-600 p-4 rounded shadow">
                No bookings found.
            </div>
        @endif
    @endauth
@endsection
