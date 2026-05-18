@extends('layouts.app')
@section('title', 'REPOHIVE - Validate OTP')
@section('content')
    <div class="center-screen">
        <div class="card">
            <div class="brand">🔐 OTP Verification</div>
            <h1>Validate OTP</h1>
            <p class="muted">
                Code sent to: <strong id="otpTarget">{{ session('otp_target') }}</strong>
            </p>

            <div class="success">Prototype OTP: <strong>123456</strong></div>

            @if(session('otp_error'))
                <div class="error">{{ session('otp_error') }}</div>
            @endif

            <form action="{{ route('otp.validate') }}" method="POST">
                @csrf
                <div class="otp-box">
                    <input maxlength="1" class="otp" name="otp[]" required>
                    <input maxlength="1" class="otp" name="otp[]" required>
                    <input maxlength="1" class="otp" name="otp[]" required>
                    <input maxlength="1" class="otp" name="otp[]" required>
                    <input maxlength="1" class="otp" name="otp[]" required>
                    <input maxlength="1" class="otp" name="otp[]" required>
                </div>

                <button class="btn primary" type="submit">Verify OTP</button>
            </form>

            <p id="message" class="muted center"></p>
            <a class="link" href="{{ route('index') }}">Back</a>
        </div>
    </div>
@endsection