<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function loginWithGoogle(Request $request)
    {
        // Simulate Google Login success
        $request->session()->put('authenticated', true);
        return redirect()->route('dashboard');
    }

    public function showValidateOtp(Request $request)
    {
        // Only show if OTP has been sent
        if (!$request->session()->has('otp_sent')) {
            return redirect()->route('index');
        }

        return view('pages.validate-otp');
    }

    public function validateOtp(Request $request)
    {
        try {
            $request->validate([
                'otp' => ['required', 'array', 'size:6'],
                'otp.*' => ['required', 'numeric', 'digits:1'],
            ]);

            $otpCode = implode('', $request->otp);

            if ($otpCode !== '123456') {
                return back()->with('otp_error', 'ACCESS DENIED: Invalid or expired OTP code.');
            }

            // Simulate OTP validation success
            $request->session()->put('authenticated', true);
            $request->session()->forget('otp_sent'); // Clear the flag
            
            return redirect()->route('dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('otp_error', 'FORMAT ERROR: OTP must be exactly 6 digits.');
        } catch (\Exception $e) {
            Log::error('OTP Validation Error: ' . $e->getMessage());
            return back()->with('otp_error', 'SYSTEM ERROR: Unable to process OTP validation at this time.');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('authenticated');
        return redirect()->route('index');
    }
}
