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
        ], [
            'email.email' => 'INVALID FORMAT: Please enter a valid email address.'
        ]);

        $email = $validated['email'];

        try {


            $response = Http::withToken(config('services.repohive_email.token'))
                ->acceptJson()
                ->timeout(10)
                ->post(rtrim(config('services.repohive_email.base_url'), '/') . '/email/send', [
                    'to' => $email,
                    'subject' => 'Verify your account',
                    'html' => '<p>Your code is <strong>123456</strong>.</p>',
                    'text' => 'Your code is 123456.',
                ]);

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
                        'otp_target' => $email,
                        'otp_type' => 'email',
                        'otp_sent' => true,
                    ]);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email.',
                    'error' => $response->json(),
                ], 500);
            }

            Log::error('Email API Error: ' . $response->body());

            return back()
                ->withInput()
                ->with('email_error', 'COMMUNICATION FAILURE: Unable to dispatch OTP to the provided email.');
        } catch (\Exception $e) {
            Log::error('Email Sending Failed: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'SYSTEM ERROR: Server unreachable.',
                ], 503);
            }

            return back()
                ->withInput()
                ->with('email_error', 'SYSTEM ERROR: External communication server is currently down or unreachable.');
        }
    }
}