@extends('layout.app')

@section('title', 'User Profile')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <!-- Profile Info -->
    <h2 class="text-3xl font-bold mb-6 text-gray-800">User Profile</h2>

    <div class="bg-white p-6 rounded-xl shadow mb-8">
        <h3 class="text-xl font-semibold mb-4 text-gray-700">Your Information</h3>
        <div class="space-y-2 text-gray-600">
            <p><span class="font-semibold">Name:</span> {{ $user->name }}</p>
            <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
            <p><span class="font-semibold">Phone:</span> {{ $user->phone }}</p>
            <p><span class="font-semibold">Address:</span> {{ $user->address }}</p>
        </div>
        <div class="mt-4">

            <a href="{{ url('/profile/edit') }}"
               class="inline-block bg-gradient-to-r from-gray-400 to-blue-500 hover:bg-green-800 text-white px-4 py-2 rounded shadow ml-2">
                Edit Profile
            </a>
        </div>
    </div>

    <!-- Bookings -->
    <h3 class="text-2xl font-bold mb-4 text-gray-800">Your Bookings</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        @forelse($user->bookings as $booking)
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <p><span class="font-semibold text-gray-700">Booking Name:</span> {{ $booking->username }}</p>
                <p><span class="font-semibold text-gray-700">Status:</span>
                    <span class="px-2 py-1 rounded text-white
                        {{ $booking->status == 'Pending' ? 'bg-yellow-500' : '' }}
                        {{ $booking->status == 'Approved' ? 'bg-green-500' : '' }}
                        {{ $booking->status == 'Rejected' ? 'bg-red-500' : '' }}">
                        {{ $booking->status }}
                    </span>
                </p>
                <p><span class="font-semibold text-gray-700">Date:</span> {{ $booking->booking_date }}</p>
                <p><span class="font-semibold text-gray-700">Time:</span> {{ $booking->booking_time }}</p>
                <p><span class="font-semibold text-gray-700">Guests:</span> {{ $booking->guests }}</p>
                <p><span class="font-semibold text-gray-700">Special Requests:</span> {{ $booking->special_requests }}</p>

                <div class="mt-4 flex gap-2">
                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('booking.edit', $booking->id) }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow">
                        Edit
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-600">No bookings yet.</p>
        @endforelse
    </div>


</div>
@endsection
