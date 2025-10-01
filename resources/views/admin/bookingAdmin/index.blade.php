@extends('layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">All Bookings</h2>

    @if(session('success'))
        <div class="mb-4 rounded bg-green-100 border border-green-300 text-green-800 px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Guests</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Special Request</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->username }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->booking_date ?? $booking->date }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->booking_time ?? $booking->time }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->guests }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->special_requests }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if($booking->status == 'pending')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Pending</span>
                            @elseif($booking->status == 'accepted')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Accepted</span>
                            @elseif($booking->status == 'rejected')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            @if($booking->status === 'pending')
                                <form method="POST" action="{{ route('admin.bookingAdmin.updateStatus', [$booking->id, 'accepted']) }}" class="inline">
                                    @csrf
                                    <button class="inline-flex items-center gap-1 px-3 py-1 bg-green-600 text-white text-xs font-medium rounded shadow hover:bg-green-700 transition">
                                        <!-- Check Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Accept
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.bookingAdmin.updateStatus', [$booking->id, 'rejected']) }}" class="inline">
                                    @csrf
                                    <button class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-600 text-white text-xs font-medium rounded shadow hover:bg-yellow-700 transition">
                                        <!-- X Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Reject
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('bookingAdmin.destroy', $booking->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                @csrf
                                @method('DELETE')
                                <button class="inline-flex items-center gap-1 px-3 py-1 bg-red-600 text-white text-xs font-medium rounded shadow hover:bg-red-700 transition">
                                    <!-- Trash Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0v4m4-4v4M6 7h12" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center px-6 py-4 text-gray-500">No Booking Now, Thank You</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
