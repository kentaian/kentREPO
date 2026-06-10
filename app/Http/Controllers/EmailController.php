<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = $validated['email'];
        $otp = (string) rand(100000, 999999);

        // Store OTP variables persistently in session
        session([
            'otp_code' => $otp,
            'otp_target' => $email,
            'otp_type' => 'email',
            'otp_sent' => true,
        ]);

        try {
            $response = Http::withToken(config('services.repohive_email.token'))
                ->acceptJson()
                ->timeout(10)
                ->post(rtrim(config('services.repohive_email.base_url'), '/') . '/email/send', [
                    'to' => $email,
                    'subject' => 'Kent Aian Tabuelog',
                    'html' => '<p>Your OTP code is <strong>' . $otp . '</strong></p>',
                    'text' => 'Your OTP code is ' . $otp,
                ]);

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
            Log::error("Email API failed with status {$response->status()}: " . $response->body());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sending failed (API error).',
                ], 500);
            }

            return back()->withInput()->with('email_error', 'COMMUNICATION FAILURE: Unable to dispatch email OTP at this time.');

        } catch (\Exception $e) {
            // Log exception and return error response
            Log::error("Email Sending Failed: " . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sending failed (Connection error).',
                ], 500);
            }

            return back()->withInput()->with('email_error', 'CONNECTION ERROR: The email service is currently unreachable.');
        }
    }
}