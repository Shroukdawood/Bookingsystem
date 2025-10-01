@extends('layout.app')

@section('title', 'Edit Booking')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Booking</h2>

    <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="username" id="username"
                value="{{ old('username', $booking->username) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                value="{{ old('email', $booking->email) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="booking_date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="booking_date" id="booking_date"
                    value="{{ old('booking_date', $booking->booking_date) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="booking_time" class="block text-sm font-medium text-gray-700">Time</label>
                <input type="time" name="booking_time" id="booking_time" step="1"
                    value="{{ old('booking_time', $booking->booking_time) }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
        </div>

        <div>
            <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
            <input type="number" name="guests" id="guests"
                value="{{ old('guests', $booking->guests) }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests</label>
            <textarea name="special_requests" id="special_requests" rows="3"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('special_requests', $booking->special_requests) }}</textarea>
        </div>

        @if(auth()->check() && auth()->user()->is_admin)
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        @endif

        <div class="flex items-center justify-between">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                Update Booking
            </button>
            <a href="{{ route('booking.index') }}" class="text-blue-600 hover:underline">Back to Bookings</a>
        </div>
    </form>
</div>
@endsection
