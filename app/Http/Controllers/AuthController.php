<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{
    public function showlogin(){
        return view('auth.login');
    }

    //  public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (! $user || ! Hash::check($request->password, $user->password)) {
    //         return response()->json([
    //             'message' => 'Invalid credentials'
    //         ], 401);
    //     }

    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
    // }

public function login(Request $request)
    {      $credential = $request->only('email', 'password');
        $user= User::where('email' , $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        if (Auth::attempt($credential)) {
            return redirect()->route('booking.index')->with('success', 'Login successful');

        }

        return back()->withErrors(['message' => 'Invalid login please check your email and password'])->withInput();
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
     public function showregister(){
        return view('auth.register');
    }
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users,phone',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'name.required'=>'Name is required',
            'password.required'=>'password is required'
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
                          return redirect()->route('login')->with('success', 'Registration successful, please login');
        return back()->withErrors(['message' => 'you have acount please check your email and password'])->withInput();

                Mail::to($request->email)->send(New WelcomeMail());
               $user = Socialite::driver('google')->user();

}
}
