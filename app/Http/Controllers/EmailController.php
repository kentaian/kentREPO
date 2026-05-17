<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = $validated['email'];

        $response = Http::withToken(config('services.repohive_email.token'))
            ->acceptJson()
            ->timeout(30)
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
                ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email.',
                'error' => $response->json(),
            ], 500);
        }

        return back()
            ->withInput()
            ->with('email_error', 'Failed to send OTP. Please try again.');
    }
}