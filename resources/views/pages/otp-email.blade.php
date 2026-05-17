@extends('layouts.app')
@section('title', 'REPOHIVE - OTP Email')
@section('content')
    <div class="center-screen">
        <div class="card">
            <div class="brand">📧 Email Verification</div>
            <h1>Send OTP to Email</h1>
            <p class="muted">Enter your email address to receive a 6-digit code.</p>
            @if(session('email_error'))
                <div class="error">{{ session('email_error') }}</div>
            @endif
            <form method="POST" action="{{ route('otp.email.send') }}">
                @csrf
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" placeholder="example@company.com" value="{{ old('email') }}" required>

                @error('email')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <button type="submit" class="btn primary">Send OTP</button>
            </form>
            <a class="link" href="{{ route('index') }}">Back</a>
        </div>
    </div>
@endsection