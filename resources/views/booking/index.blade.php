@extends('layout.app')

@section('title', 'Bookings')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h2 class="text-2xl font-bold mb-6 text-center">My Bookings</h2>

    <div class="mb-6 text-center">
        <a href="{{ url('/booking/create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition">
            + Add New Booking
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($bookings as $booking)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg hover:scale-105  transition">
                <div class="space-y-1">
                    <p><span class="font-semibold">Name:</span> {{ $booking->username }}</p>
                    <p><span class="font-semibold">Status:</span>
                        <span class="px-2 py-1 text-xs rounded
                            @if($booking->status === 'Approved') bg-green-100 text-green-800
                            @elseif($booking->status === 'Pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $booking->status }}
                        </span>
                    </p>
                    <p><span class="font-semibold">Date:</span> {{ $booking->booking_date }}</p>
                    <p><span class="font-semibold">Time:</span> {{ $booking->booking_time }}</p>
                    <p><span class="font-semibold">Guests:</span> {{ $booking->guests }}</p>
                    <p><span class="font-semibold">Requests:</span> {{ $booking->special_requests }}</p>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 mt-4">
                    <a href="{{ route('booking.edit', $booking->id) }}"
                       class="flex-1 px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 text-center text-sm">
                        Edit
                    </a>
                    <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this booking?')"
                            class="w-full px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                            Delete
                        </button>
                    </form>
                </div>

                {{-- Admin only status update --}}
                @if(auth()->check() && auth()->user()->is_admin)
                    <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <label for="status_{{ $booking->id }}" class="block mb-1 text-sm font-medium">Update Status:</label>
                        <select name="status" id="status_{{ $booking->id }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 mb-2 text-sm">
                            <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ $booking->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ $booking->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit"
                            class="w-full bg-green-500 hover:bg-green-600 hover:underline text-white px-3 py-1 rounded text-sm">
                            Save
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
