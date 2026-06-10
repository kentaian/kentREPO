@extends('layouts.app')

@section('title', 'RepoHive - Login')

@section('content')
    <div class="center-screen">
        <div class="card">
            <div class="brand glitch-text" data-text="🐝 iREPO App Hub">🐝 iREPO App Hub</div>

            <h1 class="glitch-text" data-text="Welcome to iREPO">Welcome to iREPO</h1>
            <p class="muted">
                Authenticate to access your dashboard, mailbox, and AI assistant tools.
            </p>

            <a class="btn primary" href="{{ route('otp-phone') }}">📱 Send OTP via SMS</a>
            <a class="btn light" href="{{ route('otp-email') }}">📧 Send OTP via Email</a>

            <br>
            <hr>

            <a href="{{ route('login.google') }}" class="btn google" style="display: flex; align-items: center; justify-content: center; text-decoration: none;">
                <img src="./assets/Google_Favicon_2025.svg.webp" alt="" height="32" style="margin-right: 10px;">
                Login with Google Account
            </a>
        </div>
    </div>
@endsection