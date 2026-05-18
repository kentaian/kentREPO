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

            <form action="{{ route('login.google') }}" method="POST">
                @csrf
                <button type="submit" class="btn google">
                    <img src="./assets/Google_Favicon_2025.svg.webp" alt="" height="32">
                    Login with Google Account
                </button>
            </form>
        </div>
    </div>
@endsection