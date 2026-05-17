<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\EmailController;

Route::view('/','index')->name('index');
Route::view('/otp-phone','pages.otp-phone')->name('otp-phone');
Route::view('/otp-email','pages.otp-email')->name('otp-email');
Route::view('/validate-otp','pages.validate-otp')->name('validate-otp');
Route::view('/mailbox','pages.mailbox')->name('mailbox');
Route::view('/ai-chatbot','pages.ai-chatbot')->name('ai-chatbot');


Route::post('/otp/phone', [SmsController::class, 'sendSms'])->name('otp.phone.send');
Route::post('/otp/email', [EmailController::class, 'sendEmail'])->name('otp.email.send');