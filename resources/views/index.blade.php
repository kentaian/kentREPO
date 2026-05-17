@extends('layouts.app')

@section('title', 'RepoHive')

@section('content')
    <div class="center-screen">
        <div class="card">
            <div class="brand">🐝 {Rename} App Hub</div>

            <h1>Welcome to {Rename}</h1>
            <p class="muted">
                Access your verification, mailbox, and AI assistant tools from one dashboard.
            </p>

            <a class="btn primary" href="{{ route('otp-phone') }}">📱 Send OTP via SMS</a>
            <a class="btn light" href="{{ route('otp-email') }}">📧 Send OTP via Email</a>
            <a class="btn light" href="{{ route('validate-otp') }}">🔐 Validate OTP</a>
            <a class="btn light" href="{{ route('mailbox') }}">📬 Open Mailbox</a>
            <a class="btn light" href="{{ route('ai-chatbot') }}">🤖 AI Chatbot</a>

            <br>
            <hr>

            <button class="btn google" onclick="loginWithGoogle()">
                <img src="./assets/Google_Favicon_2025.svg.webp" alt="" height="32">
                Login with Google Account
            </button>

            <p class="note">
                Prototype pages are connected using simple HTML, CSS, JavaScript, and localStorage.
            </p>
        </div>
    </div>
@endsection