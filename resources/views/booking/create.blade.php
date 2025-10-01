@extends('layout.app')

@section('title', 'Book a Table')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Book a Table</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST" class="space-y-5">
        @csrf
        @method("POST")

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Name:</label>
            <input type="text" name="username" id="username" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
            <input type="email" name="email" id="email" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
            <input type="text" name="phone" id="phone" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="booking_date" class="block text-sm font-medium text-gray-700">Date:</label>
                <input type="date" name="booking_date" id="booking_date" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="booking_time" class="block text-sm font-medium text-gray-700">Time:</label>
                <input type="time" name="booking_time" id="booking_time" required step="1"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>

        <div>
            <label for="guests" class="block text-sm font-medium text-gray-700">Guests:</label>
            <input type="number" name="guests" id="guests" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests:</label>
            <textarea name="special_requests" id="special_requests" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>

        <div>
            <label for="table_preference" class="block text-sm font-medium text-gray-700">Table Preference:</label>
            <input type="text" name="table_preference" id="table_preference"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="text-center">
            <button type="submit"
                onclick="return confirm('Are you sure you want to create a New Booking?')"
                class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-md shadow hover:bg-gray-300 hover:text-gray-800 transition">
                Submit
            </button>
        </div>
    </form>
</div>
@endsection
