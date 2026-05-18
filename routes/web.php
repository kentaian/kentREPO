<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAuthenticated;

Route::view('/', 'index')->name('index');
Route::view('/otp-phone', 'pages.otp-phone')->name('otp-phone');
Route::view('/otp-email', 'pages.otp-email')->name('otp-email');

Route::post('/otp/phone', [SmsController::class, 'sendSms'])->name('otp.phone.send');
Route::post('/otp/email', [EmailController::class, 'sendEmail'])->name('otp.email.send');

Route::get('/validate-otp', [AuthController::class, 'showValidateOtp'])->name('validate-otp');
Route::post('/otp/validate', [AuthController::class, 'validateOtp'])->name('otp.validate');
Route::post('/login/google', [AuthController::class, 'loginWithGoogle'])->name('login.google');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([CheckAuthenticated::class])->group(function () {
    Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
    Route::view('/mailbox', 'pages.mailbox')->name('mailbox');
    Route::view('/ai-chatbot', 'pages.ai-chatbot')->name('ai-chatbot');
});