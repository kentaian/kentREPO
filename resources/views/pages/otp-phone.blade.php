@extends('layouts.app')

@section('title', 'REPOHIVE - OTP Phone')

@section('content')
    <div class="center-screen">
        <div class="card">
            <div class="brand">📱 Phone Verification</div>
            <h1>Send OTP to Phone</h1>
            <p class="muted">Enter your phone number to receive a 6-digit code.</p>

            @if(session('sms_error'))
                <div class="error">{{ session('sms_error') }}</div>
            @endif
            <form method="POST" action="{{ route('otp.phone.send') }}">
                @csrf

                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="tel" placeholder="+63 900 000 0000" autocomplete="tel"
                    value="{{ old('phone') }}" required>

                @error('phone')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <button class="btn primary" type="submit">Send OTP</button>
            </form>
            <a class="link" href="{{ route('index') }}">Back</a>

        </div>
    </div>
@endsection