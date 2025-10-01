<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->latest()->get();
        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        return view('booking.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'booking_date' => 'required|date',
            'booking_time' => ['required', 'regex:/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/'],
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:255',
            'table_preference' => 'nullable|string|max:255',
        ]);

        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->username = Auth::user()->name;
        $booking->email = $validated['email'];
        $booking->phone = $validated['phone'];
        $booking->booking_date = $validated['booking_date'];
        $booking->booking_time = $validated['booking_time'];
        $booking->guests = $validated['guests'];
        $booking->special_requests = $validated['special_requests'] ?? null;
        $booking->table_preference = $validated['table_preference'] ?? null;
        $booking->status = 'Pending';
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Booking created successfully.');
    }

    public function show(string $id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.show', compact('booking'));
    }
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.edit', compact('booking'));
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'booking_date' => 'required|date',
            'booking_time' => ['required', 'regex:/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/'],
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:255',
            'table_preference' => 'nullable|string|max:255',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->username = $validated['username'];
        $booking->email = $validated['email'];
        $booking->phone = $validated['phone'];
        $booking->booking_date = $validated['booking_date'];
        $booking->booking_time = $validated['booking_time'];
        $booking->guests = $validated['guests'];
        $booking->special_requests = $validated['special_requests'] ?? null;
        $booking->table_preference = $validated['table_preference'] ?? null;
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        if ($booking->user && $booking->user->email) {
            Mail::to($booking->user->email)->send(new BookingMail($booking));
        }

        return redirect()->back()->with('success', 'Status updated and email sent.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully.');
    }
}
