@extends('layout.app')

@section('content')
<div class="container mt-4">
    @foreach($bookings as $booking)
       <form method="POST" action="{{ route('admin.bookingAdmin.updateStatus', [$booking->id, 'accepted']) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm">Accept</button>
                </form>

                <form method="POST" action="{{ route('admin.bookingAdmin.updateStatus', [$booking->id, 'rejected']) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
       @endforeach
</div>
@endsection

