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

        try {


            $response = Http::withToken(config('services.repohive_sms.token'))
                ->acceptJson()
                ->timeout(10)
                ->post(
                    rtrim(config('services.repohive_sms.base_url'), '/') . '/messages',
                    [
                        'phone' => $phone,
                        'message' => 'Your verification code is 123456. Dont Share this to anyone!',
                    ]
                );

            if ($response->successful()) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'data' => $response->json(),
                    ]);
                }

                return redirect()
                    ->route('validate-otp')
                    ->with([
                        'otp_target' => $phone,
                        'otp_type' => 'phone',
                        'otp_sent' => true,
                    ]);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send SMS.',
                    'error' => $response->json(),
                ], 500);
            }

            return back()
                ->withInput()
                ->with('sms_error', 'COMMUNICATION FAILURE: Unable to dispatch OTP.');
        } catch (\Exception $e) {
            Log::error('SMS Sending Failed: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'SYSTEM ERROR: Server unreachable.',
                ], 503);
            }
            
            return back()
                ->withInput()
                ->with('sms_error', 'SYSTEM ERROR: External communication server is currently down or unreachable.');
        }
    }
}