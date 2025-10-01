<!-- @extends('layout.app')

@section('title', 'Bookings')

@section('content')
<h2>Bookings</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ url('/booking/create') }}" class="btn">Add New Booking</a>

@foreach($bookings as $booking)
<div>
    <p>Booking Name: {{ $booking->username }}</p>
    <p>Status: {{ $booking->status }}</p>
    <p>Date: {{ $booking->booking_date }}</p>
    <p>Time: {{ $booking->booking_time }}</p>
    <p>Guests: {{ $booking->guests }}</p>
    <p>Special Requests: {{ $booking->special_requests }}</p>
    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="status">Update Status:</label>
        <input name="status" id="status"/>

    </form>
</div>
@endforeach
@endsection -->
@extends('layout.app')

@section('title', 'Bookings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Bookings</h2>

    <div class="mb-6 text-center">
        <a href="{{ url('/booking/create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition">
            + Add New Booking
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($bookings as $booking)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <p class="mb-1"><span class="font-semibold">Booking Name:</span> {{ $booking->username }}</p>
                <p class="mb-1"><span class="font-semibold">Status:</span> {{ $booking->status }}</p>
                <p class="mb-1"><span class="font-semibold">Date:</span> {{ $booking->booking_date }}</p>
                <p class="mb-1"><span class="font-semibold">Time:</span> {{ $booking->booking_time }}</p>
                <p class="mb-1"><span class="font-semibold">Guests:</span> {{ $booking->guests }}</p>
                <p class="mb-4"><span class="font-semibold">Special Requests:</span> {{ $booking->special_requests }}</p>

                {{-- Form to update status --}}
                <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="space-y-2">
                    @csrf
                    @method('PUT')
                    <label for="status_{{ $booking->id }}" class="block text-sm font-medium">Update Status:</label>
                    <select name="status" id="status_{{ $booking->id }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mb-2 text-sm">
                        <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ $booking->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $booking->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                        Save
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection

