@extends('layouts.app')
@section('title', 'REPOHIVE - Validate OTP')
@section('content')
    <div class="center-screen">
        <div class="card">
            <div class="brand">🔐 OTP Verification</div>
            <h1>Validate OTP</h1>
            <p class="muted">
                Code sent to: <strong id="otpTarget"></strong>
            </p>

            <div class="success">Prototype OTP: <strong>123456</strong></div>

            <div class="otp-box">
                <input maxlength="1" class="otp">
                <input maxlength="1" class="otp">
                <input maxlength="1" class="otp">
                <input maxlength="1" class="otp">
                <input maxlength="1" class="otp">
                <input maxlength="1" class="otp">
            </div>

            <button class="btn primary" onclick="validateOtp()">Verify OTP</button>
            <p id="message" class="muted center"></p>
            <a class="link" href="{{ route('index') }}">Back</a>
        </div>
    </div>
@endsection