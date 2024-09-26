<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $formFields = $request->validate([
            'name' => 'required|string|max:30|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|string|confirmed',
            'password_confirmation' => 'required|min:3|string'
        ]);

        $user =  User::create($formFields);

        Auth::login($user);

        // trigger event for new registered user to send email verification
        event(new Registered($user));

        $request->session()->regenerate();

        return redirect()->intended('/profile');

    }
    public function login(Request $request)
    {
        
        $formFields = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        $user = User::where('email',$formFields['email'])->first();

        if($user && Hash::check($formFields['password'],$user->password) )
        {

            Auth::login($user);
            
            $request->session()->regenerate();

            return redirect()->intended('/profile')->with('flash_message', 'You have successfully logged in.');
        }

        return back()->withErrors(['password' => 'Credentials are incorrect'])->onlyInput('password');
            
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('login');
    }


}
