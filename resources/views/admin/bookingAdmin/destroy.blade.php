@extends('layout.app')

@section('content')
<div class="container mt-4">
    @foreach($bookings as $booking)

       <form method="DELETE" action="{{ route('admin.bookingAdmin.updateStatus', [$booking->id, 'rejected']) }}" class="d-inline">
                    @csrf
                    <button
  class="px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded
         shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
         transition duration-200 ease-in-out">
    Delete
</button>
-
                </form>
       @endforeach
</div>
@endsection
