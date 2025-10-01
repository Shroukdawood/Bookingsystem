<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // ✅ صفحة البروفايل
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();

        return view('profile.index', compact('user', 'bookings'));
    }

    // ✅ صفحة تعديل البروفايل
    public function edit()
    {
        $user = Auth::user();
        return view('profile.update', compact('user'));
    }

    // ✅ تحديث بيانات البروفايل
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
        ]);

        $user = Auth::user();
        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    // ✅ حذف البروفايل (اختياري)
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect()->route('home')->with('success', 'Profile deleted successfully.');
    }
}
