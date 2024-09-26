<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verifyEmail(Request $request)
    {

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/profile');
        }

        $request->user()->sendEmailVerificationNotification();

        return inertia('Auth/VerifyEmail', ['status' => true] );
    }

    public function emailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('profile')->with('flash_message','You have successfully verified your account.');
    }
}
