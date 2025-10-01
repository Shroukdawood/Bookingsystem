<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Show the admin dashboard.
     */
  public function dashboard()
{
    $bookings = Booking::latest()->get();
        return view('admin.bookingAdmin.index', compact('bookings'));
     $users = User::all()->get();return view('admin.users', compact('users'));
        $admins = User::where('is_admin', true)->get();
        return view('admin.users', compact('users', 'admins'));
}

    /**
     * Show all registered users.
     */
    public function users()
    {

        $users = User::where('is_admin', false)->get();
        $admins = User::where('is_admin', true)->get();
        return view('admin.users', compact('users'));
    }
    //  public function users()
    // {
    //     $users = User::latest()->paginate(10);
    //     return view('admin.users', compact('users'));
    // }

    /**
     * Show all booking requests.
     */
    public function bookings()
    {
        $bookings = Booking::latest()->get();
        return view('admin.bookingAdmin.index', compact('bookings'));
    }

    /**
     * Show all menu items.
     */
   public function index()
{
    $bookings = Booking::latest()->get();
        return view('admin.bookingAdmin.index', compact('bookings'));
}
}
