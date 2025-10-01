<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingMail;
use App\Notifications\BookingStatusNotification;
use Illuminate\Support\Facades\Notification;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user')->latest()->get();
        return view('admin.bookingAdmin.index', compact('bookings'));
    }

    public function updateStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = $status;
        $booking->save();

        // لو حابب ترسل ايميل هنا
        // Mail::to($booking->user->email)->send(new BookingMail($booking));

        return redirect()->route('admin.bookingAdmin.index')->with('success', 'Booking updated successfully.');
    }

    public function accept($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'accepted';
        $booking->save();

        // إرسال إشعار للمستخدم
        $user = User::findOrFail($booking->user_id);
        $user->notify(new BookingStatusNotification($booking, 'accepted'));

        return redirect()->route('admin.bookingAdmin.index')->with('success', 'Booking accepted.');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        $user = User::findOrFail($booking->user_id);
        Notification::send($user, new BookingStatusNotification($booking, 'rejected'));

        return redirect()->route('admin.bookingAdmin.index')->with('success', 'Booking rejected.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookingAdmin.index')->with('success', 'Booking deleted successfully.');
    }
}
