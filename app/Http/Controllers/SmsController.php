<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:11', 'regex:/^09\d{9}$/'],
        ], [
            'phone.regex' => 'INVALID FORMAT: Please enter a valid 11-digit phone number (e.g. 09000000000).'
        ]);

        $phone = $validated['phone'];
        $otp = (string) rand(100000, 999999);

        // Store OTP variables persistently in session
        session([
            'otp_code' => $otp,
            'otp_target' => $phone,
            'otp_type' => 'phone',
            'otp_sent' => true,
        ]);

        try {
            $response = Http::withToken(config('services.repohive_sms.token'))
                ->acceptJson()
                ->timeout(10)
                ->post(
                    rtrim(config('services.repohive_sms.base_url'), '/') . '/messages',
                    [
                        'phone' => $phone,
                        'message' => 'Your verification code is ' . $otp . '. Dont Share this to anyone! - Kent Aian Tabuelog, Chat ma ha kung nadawat or wala',
                    ]
                );

            if ($response->successful()) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'data' => $response->json(),
                    ]);
                }

                return redirect()->route('validate-otp');
            }

            // Log failure and return error response
            Log::error("SMS API failed with status {$response->status()}: " . $response->body());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'SMS sending failed (API error).',
                ], 500);
            }

            return back()->withInput()->with('sms_error', 'COMMUNICATION FAILURE: Unable to dispatch SMS OTP at this time.');

        } catch (\Exception $e) {
            // Log exception and return error response
            Log::error("SMS Sending Failed: " . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'SMS sending failed (Connection error).',
                ], 500);
            }
            
            return back()->withInput()->with('sms_error', 'CONNECTION ERROR: The SMS service is currently unreachable.');
        }
    }
}