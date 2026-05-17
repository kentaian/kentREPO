<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function sendSms(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
        ]);

        $phone = $validated['phone'];

        $response = Http::withToken(config('services.repohive_sms.token'))
            ->acceptJson()
            ->timeout(30)
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
            ->with('sms_error', 'Failed to send OTP. Please try again.');
    }
}