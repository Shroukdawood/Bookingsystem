@extends('layout.app')

@section('content')
<div class="container mt-4">
    @foreach($bookings as $booking)
       <form method="POST" action="{{ route('admin.bookingAdmin.updateStatus', [$booking->id, 'accepted']) }}" class="d-inline">
                    @csrf
                    <button
  class="px-3 py-1.5 bg-green-600 text-white text-sm font-medium rounded
         shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2
         transition duration-200 ease-in-out">
  Accept
</button>
                </form>

       @endforeach
</div>
@endsection
