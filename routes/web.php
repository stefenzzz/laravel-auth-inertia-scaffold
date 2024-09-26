<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;


Route::inertia('/','Home')->name('home');

Route::middleware('guest')->group(function(){

    Route::inertia('/register','Auth/Register')->name('register');
    Route::inertia('/login','Auth/Login')->name('login');
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
});


Route::middleware('auth')->group(function(){
    
    Route::inertia('/profile','Profile')->name('profile')->middleware('verified');
    Route::inertia('/verify-email','Auth/VerifyEmail')->name('verify-email')->middleware('unverified');
    Route::post('/verify-email', [EmailController::class,'verifyEmail'] )->middleware('unverified');   
    //route when user click the email verifiation link that was sent to their email
    Route::get('/email/verify/{id}/{hash}',[EmailController::class,'emailVerification'])->name('verification.verify')->middleware('signed');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    
});
    
