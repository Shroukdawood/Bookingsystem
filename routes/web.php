<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BookingAdminController;

Route::get('/', function () {
    return view('home');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Booking Routes
// Route::resource('booking', BookingController::class);
Route::middleware('auth')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

Route::get('/booking/{booking}/edit', [BookingController::class, 'edit'])->name('booking.edit');
Route::put('/booking/{booking}', [BookingController::class, 'update'])->name('booking.update');

// ✅ Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        if (!Auth::user()->is_admin) abort(403);
        return app(AdminController::class)->dashboard();
    })->name('admin.dashboard');

    Route::get('/users', function () {
        if (!Auth::user()->is_admin) abort(403);
        return app(AdminController::class)->users();
    })->name('admin.users');

    Route::get('/booking', [BookingAdminController::class, 'index'])->name('admin.bookingAdmin.index');
    Route::post('/bookingAdmin/{id}/{status}', [BookingAdminController::class, 'updateStatus'])->name('admin.bookingAdmin.updateStatus');
    Route::get('/bookingAdmin/{id}/accepted', [BookingAdminController::class, 'accept'])->name('bookingAdmin.accept');
    Route::get('/bookingAdmin/{id}/rejected', [BookingAdminController::class, 'reject'])->name('bookingAdmin.reject');
    Route::delete('/bookingAdmin/{id}', [BookingAdminController::class, 'destroy'])->name('bookingAdmin.destroy');


});



