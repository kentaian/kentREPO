# iREPO UI/UX Design Documentation

**Reference Document:** [HCI-1-FINAL-REQUIREMENTS.PDF](./HCI-1-FINAL-REQUIREMENTS.PDF)

This document contains all the UI/UX source codes (HTML structural layouts and CSS styling) for the pages and indexes of the application. The functional backend logic (routes, session data, etc.) has been stripped or replaced with placeholders to focus strictly on the frontend design. It ensures traceability and consistency with the final project requirements defined in the reference document.

## HCI Principles Applied

1. **Visibility of System Status**
   The system provides immediate visual feedback for user actions. Dynamic neon accents highlight active input fields (e.g., OTP digits), and clear, color-coded error/success messages appear for events like failed connections or successful OTP validation.

2. **Consistency and Standards**
   The entire interface follows a strict Neomorphic Cyber-Industrial design system using a core `#121824` color palette. The recurring use of glassmorphism, structured grid layouts, and standardized UI controls across both the Mailbox and AI Chatbot ensures users do not have to wonder if different actions mean the same thing.

3. **Error Prevention and Handling**
   The system is designed to minimize user errors. It automatically advances focus during OTP entry, validates the code only when all fields are completely filled, and gracefully clears incorrect inputs to facilitate an immediate retry without frustration.

## User Flow

1. User accesses the iREPO login screen.
2. User enters their phone number or opts for Google Login.
3. System sends an OTP to the user's selected contact method.
4. User enters the OTP into the dynamically focused input fields.
5. System automatically validates the OTP once all digits are entered.
6. User successfully accesses the unified Neomorphic Cyber-Industrial Dashboard (Mailbox & AI Chatbot).

## Global Stylesheet

**File Location:** resources/css/styles.css

`css
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700;800&family=Syncopate:wght@400;700&display=swap');

:root {
--bg: #121824;
--card-bg: #121824;
--text-main: #E2E8F0;
--text-muted: #64748b;
--accent: #00E5FF;
--accent-hover: #00B8D4;
--error: #FF3D00;

    --shadow-light: #1a2335;
    --shadow-dark: #0a0d13;

    --neu-shadow: -6px -6px 12px var(--shadow-light), 6px 6px 12px var(--shadow-dark);
    --neu-inset: inset -4px -4px 8px var(--shadow-light), inset 4px 4px 8px var(--shadow-dark);
    --neu-pressed: inset -2px -2px 5px var(--shadow-light), inset 2px 2px 5px var(--shadow-dark);

}

- {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  scrollbar-width: thin;
  scrollbar-color: rgba(0, 229, 255, 0.2) var(--bg);
  }

/_ Custom WebKit Scrollbar _/
::-webkit-scrollbar {
width: 8px;
height: 8px;
}

::-webkit-scrollbar-track {
background: var(--bg);
border-radius: 4px;
}

::-webkit-scrollbar-thumb {
background: rgba(0, 229, 255, 0.2);
border-radius: 4px;
border: 1px solid rgba(0, 229, 255, 0.1);
}

::-webkit-scrollbar-thumb:hover {
background: rgba(0, 229, 255, 0.4);
border: 1px solid rgba(0, 229, 255, 0.3);
}

::-webkit-scrollbar-corner {
background: var(--bg);
}

body {
font-family: 'Outfit', sans-serif;
background: var(--bg);
color: var(--text-main);
min-height: 100vh;
}

h1, h2, h3, .brand {
font-family: 'Syncopate', sans-serif;
letter-spacing: -1px;
}

.center-screen {
min-height: 100vh;
display: grid;
place-items: center;
padding: 24px;
}

.card {
width: 100%;
max-width: 460px;
background: var(--card-bg);
border-radius: 12px;
padding: 34px;
box-shadow: var(--neu-shadow);
border: 1px solid rgba(0, 229, 255, 0.05);
animation: powerOn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}

@keyframes powerOn {
0% {
opacity: 0;
transform: scale(0.95);
filter: brightness(0);
}
10% {
opacity: 1;
filter: brightness(1.2);
}
15% {
opacity: 0.8;
filter: brightness(0.8);
}
20% {
opacity: 1;
filter: brightness(1);
}
100% {
opacity: 1;
transform: scale(1);
}
}

/_ Cyber Glitch for headings _/
.glitch-text {
position: relative;
display: inline-block;
}

.glitch-text::before,
.glitch-text::after {
content: attr(data-text);
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
opacity: 0.8;
}

.glitch-text::before {
color: var(--accent);
z-index: -1;
animation: glitch-anim-1 3s infinite linear alternate-reverse;
}

.glitch-text::after {
color: var(--error);
z-index: -2;
animation: glitch-anim-2 2.5s infinite linear alternate-reverse;
}

@keyframes glitch-anim-1 {
0%, 100% { clip-path: inset(0 0 0 0); transform: translate(0); }
10% { clip-path: inset(20% 0 80% 0); transform: translate(-2px, 1px); }
20% { clip-path: inset(60% 0 10% 0); transform: translate(2px, -1px); }
30% { clip-path: inset(40% 0 50% 0); transform: translate(-2px, 2px); }
40%, 90% { clip-path: inset(0 0 0 0); transform: translate(0); }
}

@keyframes glitch-anim-2 {
0%, 100% { clip-path: inset(0 0 0 0); transform: translate(0); }
15% { clip-path: inset(10% 0 60% 0); transform: translate(2px, -2px); }
25% { clip-path: inset(30% 0 20% 0); transform: translate(-2px, 1px); }
35% { clip-path: inset(70% 0 10% 0); transform: translate(2px, 2px); }
45%, 85% { clip-path: inset(0 0 0 0); transform: translate(0); }
}

.top-nav {
display: flex;
justify-content: space-between;
align-items: center;
padding: 20px 40px;
background: var(--bg);
border-bottom: 1px solid var(--shadow-dark);
box-shadow: 0 4px 10px rgba(0,0,0,0.2);
position: sticky;
top: 0;
z-index: 50;
}

.top-nav .nav-btn {
background: transparent;
border: 1px solid rgba(0, 229, 255, 0.2);
color: var(--accent);
padding: 8px 16px;
border-radius: 4px;
font-family: 'Syncopate', sans-serif;
font-size: 11px;
text-transform: uppercase;
text-decoration: none;
cursor: pointer;
box-shadow: var(--neu-shadow);
transition: all 0.3s ease;
}

.top-nav .nav-btn:hover {
box-shadow: var(--neu-inset);
background: rgba(0, 229, 255, 0.05);
}

.top-nav .nav-btn.danger {
color: var(--error);
border-color: rgba(255, 61, 0, 0.2);
}

.top-nav .nav-btn.danger:hover {
background: rgba(255, 61, 0, 0.05);
}

.brand {
font-weight: 700;
font-size: 20px;
color: var(--accent);
margin-bottom: 22px;
text-transform: uppercase;
}

h1 {
font-size: 24px;
margin-bottom: 10px;
text-transform: uppercase;
}

.muted {
color: var(--text-muted);
margin-bottom: 20px;
font-size: 14px;
}

label {
display: block;
font-size: 12px;
font-weight: 700;
margin: 14px 0 7px;
text-transform: uppercase;
color: var(--accent);
}

input,
textarea {
width: 100%;
padding: 14px;
background: var(--bg);
border: 1px solid transparent;
border-radius: 8px;
font: inherit;
color: var(--text-main);
outline: none;
box-shadow: var(--neu-inset);
transition: all 0.3s ease;
}

textarea {
min-height: 150px;
resize: vertical;
}

input:focus,
textarea:focus {
border-color: rgba(0, 229, 255, 0.3);
box-shadow: var(--neu-inset), 0 0 10px rgba(0, 229, 255, 0.1);
}

.btn {
display: block;
width: 100%;
text-align: center;
border: 1px solid transparent;
border-radius: 8px;
padding: 14px;
margin-top: 14px;
font-weight: 700;
text-decoration: none;
cursor: pointer;
font-family: 'Syncopate', sans-serif;
font-size: 13px;
text-transform: uppercase;
transition: all 0.3s ease;
box-shadow: var(--neu-shadow);
color: var(--text-main);
background: var(--bg);
}

.btn:hover {
color: var(--accent);
box-shadow: var(--neu-shadow), 0 0 15px rgba(0, 229, 255, 0.2);
border-color: rgba(0, 229, 255, 0.3);
transform: translateY(-2px);
}

.btn:active {
color: var(--accent);
box-shadow: var(--neu-pressed), 0 0 10px rgba(0, 229, 255, 0.2);
border-color: rgba(0, 229, 255, 0.4);
transform: translateY(0);
}

/_ Ensure empty overrides do not interfere _/
.btn.primary {}
.btn.light {}

.link {
display: block;
text-align: center;
margin-top: 18px;
color: var(--text-muted);
text-decoration: none;
font-size: 14px;
transition: color 0.2s;
}

.link:hover {
color: var(--accent);
}

.success {
background: rgba(0, 229, 255, 0.05);
color: var(--accent);
border: 1px solid rgba(0, 229, 255, 0.2);
padding: 12px;
border-radius: 8px;
margin-bottom: 18px;
box-shadow: var(--neu-inset);
}

.error {
background: rgba(255, 61, 0, 0.05);
color: var(--error);
border: 1px solid rgba(255, 61, 0, 0.2);
padding: 12px;
border-radius: 8px;
margin-bottom: 18px;
box-shadow: var(--neu-inset);
}
.field-error {
color: var(--error);
font-size: 12px;
margin-top: 4px;
}

.otp-box {
display: grid;
grid-template-columns: repeat(6, 1fr);
gap: 10px;
}

.otp {
text-align: center;
font-size: 22px;
font-weight: 800;
}

hr {
border: 0;
height: 1px;
background: var(--shadow-dark);
margin: 24px 0;
box-shadow: 0 1px 0 var(--shadow-light);
}

.google {
display: flex;
align-items: center;
justify-content: center;
gap: 10px;
background: var(--bg);
}

.google img {
border-radius: 50%;
background: white;
padding: 2px;
}

/_ Mailbox _/
.mailbox {
min-height: 100vh;
display: grid;
grid-template-columns: 260px 1fr;
background: var(--bg);
}

.sidebar {
background: var(--bg);
padding: 24px;
border-right: 1px solid var(--shadow-dark);
box-shadow: 5px 0 15px rgba(0,0,0,0.2);
z-index: 10;
display: flex;
flex-direction: column;
}

.sidebar .compose-btn {
display: block;
width: 100%;
background: var(--bg);
color: var(--accent);
border: 1px solid rgba(0, 229, 255, 0.2);
padding: 12px;
border-radius: 8px;
text-align: center;
font-family: 'Syncopate', sans-serif;
font-size: 12px;
cursor: pointer;
margin-bottom: 24px;
box-shadow: var(--neu-shadow);
transition: all 0.3s ease;
}

.sidebar .compose-btn:hover {
box-shadow: var(--neu-inset);
background: rgba(0, 229, 255, 0.05);
}

.menu {
display: flex;
justify-content: space-between;
padding: 13px;
border-radius: 8px;
color: var(--text-muted);
text-decoration: none;
cursor: pointer;
margin-bottom: 10px;
transition: all 0.2s ease;
}

.menu:hover,
.menu.active {
color: var(--accent);
box-shadow: var(--neu-inset);
}

.main {
display: grid;
grid-template-rows: auto 1fr;
}

.topbar {
padding: 24px;
border-bottom: 1px solid var(--shadow-dark);
box-shadow: 0 5px 15px rgba(0,0,0,0.1);
display: flex;
justify-content: space-between;
align-items: center;
gap: 20px;
z-index: 5;
}

.topbar input {
max-width: 320px;
}

.mail-area {
display: grid;
grid-template-columns: 360px 1fr;
overflow: hidden;
}

.mail-list {
border-right: 1px solid var(--shadow-dark);
overflow-y: auto;
padding: 12px;
}

.mail-item {
padding: 18px;
border-radius: 8px;
cursor: pointer;
margin-bottom: 12px;
box-shadow: var(--neu-shadow);
transition: all 0.2s ease;
}

.mail-item:hover,
.mail-item.active {
box-shadow: var(--neu-pressed);
}

.mail-item strong {
display: block;
color: var(--text-main);
margin-bottom: 4px;
}

.mail-item small {
color: var(--text-muted);
}

.preview {
padding: 34px;
overflow-y: auto;
}

.preview h2 {
color: var(--accent);
}

/_ Modal _/
.modal {
position: fixed;
inset: 0;
background: rgba(10, 13, 19, 0.85);
backdrop-filter: blur(4px);
display: none;
align-items: center;
justify-content: center;
padding: 24px;
z-index: 100;
}

.modal.active {
display: flex;
}

.modal-card {
width: 100%;
max-width: 600px;
background: var(--bg);
border-radius: 12px;
padding: 28px;
position: relative;
box-shadow: var(--neu-shadow), 0 0 30px rgba(0, 229, 255, 0.1);
border: 1px solid rgba(0, 229, 255, 0.05);
}

.close {
position: absolute;
top: -15px;
right: -15px;
width: 40px;
height: 40px;
border-radius: 50%;
border: none;
background: var(--bg);
color: var(--accent);
box-shadow: var(--neu-shadow);
font-size: 22px;
cursor: pointer;
display: grid;
place-items: center;
}
.close:active {
box-shadow: var(--neu-pressed);
}

@media (max-width: 850px) {
.mailbox,
.mail-area {
grid-template-columns: 1fr;
}
.sidebar, .preview {
display: none;
}
.topbar {
flex-direction: column;
align-items: stretch;
}
}

/_ AI Chatbot Page _/
.chatbot-page {
min-height: 100vh;
display: grid;
grid-template-columns: 260px 1fr;
background: var(--bg);
}

.chatbot-only-page {
min-height: 100vh;
display: grid;
place-items: center;
padding: 24px;
background: radial-gradient(circle at center, #1a2335 0%, #121824 100%);
}

.chat-panel {
width: 100%;
max-width: 880px;
height: 86vh;
background: var(--bg);
border: 1px solid rgba(0, 229, 255, 0.1);
border-radius: 12px;
overflow: hidden;
box-shadow: var(--neu-shadow);
display: grid;
grid-template-rows: auto 1fr auto;
}

.chat-header {
padding: 20px 24px;
display: flex;
gap: 14px;
align-items: center;
border-bottom: 1px solid var(--shadow-dark);
box-shadow: 0 4px 10px rgba(0,0,0,0.2);
z-index: 5;
}

.ai-orb {
width: 48px;
height: 48px;
border-radius: 50%;
display: grid;
place-items: center;
background: var(--bg);
box-shadow: var(--neu-shadow), inset 0 0 10px rgba(0, 229, 255, 0.5);
color: var(--accent);
border: 1px solid rgba(0, 229, 255, 0.2);
animation: pulseOrb 2s infinite ease-in-out;
}

.chat-header h2 {
margin: 0;
color: var(--accent);
}

.chat-window {
padding: 24px;
overflow-y: auto;
scroll-behavior: smooth;
}

.chat-message {
display: flex;
gap: 12px;
margin-bottom: 16px;
align-items: flex-end;
}

.chat-message.user {
justify-content: flex-end;
}

.chat-message.user .avatar {
order: 2;
}

.avatar {
width: 38px;
height: 38px;
border-radius: 50%;
display: grid;
place-items: center;
background: var(--bg);
box-shadow: var(--neu-shadow);
flex-shrink: 0;
}

.bubble {
max-width: 680px;
padding: 14px 16px;
border-radius: 12px;
background: var(--bg);
box-shadow: var(--neu-inset);
color: var(--text-main);
line-height: 1.6;
}

.chat-message.user .bubble {
color: var(--accent);
border: 1px solid rgba(0, 229, 255, 0.1);
}

.chat-input-bar {
display: flex;
gap: 12px;
padding: 18px;
background: var(--bg);
border-top: 1px solid var(--shadow-dark);
box-shadow: 0 -4px 10px rgba(0,0,0,0.2);
}

.chat-input-bar input {
flex: 1;
}

.chat-input-bar button {
border: 1px solid transparent;
background: var(--bg);
color: var(--accent);
padding: 0 22px;
border-radius: 8px;
font-weight: 800;
cursor: pointer;
box-shadow: var(--neu-shadow);
font-family: 'Syncopate', sans-serif;
transition: all 0.3s ease;
}

.chat-input-bar button:hover {
box-shadow: var(--neu-shadow), 0 0 15px rgba(0, 229, 255, 0.2);
border-color: rgba(0, 229, 255, 0.3);
color: #fff;
text-shadow: 0 0 8px var(--accent);
}

.chat-input-bar button:active {
box-shadow: var(--neu-pressed), 0 0 10px rgba(0, 229, 255, 0.2);
border-color: rgba(0, 229, 255, 0.4);
}

@keyframes pulseOrb {
0%, 100% {
box-shadow: var(--neu-shadow), inset 0 0 10px rgba(0, 229, 255, 0.5);
}
50% {
box-shadow: var(--neu-shadow), inset 0 0 25px rgba(0, 229, 255, 0.8), 0 0 15px rgba(0, 229, 255, 0.2);
}
}

.suggest-btn {
background: transparent;
border: 1px solid rgba(0, 229, 255, 0.2);
color: var(--accent);
padding: 8px 14px;
border-radius: 20px;
font-size: 12px;
cursor: pointer;
font-family: 'Outfit', sans-serif;
transition: all 0.3s ease;
box-shadow: var(--neu-shadow);
}
.suggest-btn:hover {
background: rgba(0, 229, 255, 0.05);
box-shadow: var(--neu-inset);
border-color: rgba(0, 229, 255, 0.4);
}

/_ --- CYBER DASHBOARD --- _/
.dash-layout {
display: grid;
grid-template-columns: 1fr 1fr;
min-height: 100vh;
padding: 40px;
gap: 40px;
background: var(--bg);
position: relative;
overflow: hidden;
}

/_ Decorative background elements _/
.dash-layout::before {
content: '+';
position: absolute;
top: 40px; left: 40px;
color: var(--accent);
font-size: 24px;
opacity: 0.5;
}
.dash-layout::after {
content: '+';
position: absolute;
bottom: 40px; right: 40px;
color: var(--accent);
font-size: 24px;
opacity: 0.5;
}

.dash-identity {
display: flex;
flex-direction: column;
justify-content: center;
position: relative;
z-index: 2;
animation: fadeSlideUp 0.8s ease-out forwards;
}

.dash-identity h1 {
font-size: 64px;
line-height: 1;
margin-bottom: 20px;
color: var(--text-main);
text-shadow: 0 0 20px rgba(0,229,255,0.2);
}

.dash-status {
display: inline-flex;
align-items: center;
gap: 10px;
padding: 10px 20px;
background: rgba(0, 229, 255, 0.05);
border: 1px solid rgba(0, 229, 255, 0.2);
border-radius: 4px;
font-family: 'JetBrains Mono', monospace;
font-size: 14px;
color: var(--accent);
box-shadow: var(--neu-inset);
width: fit-content;
margin-bottom: 40px;
}
.dash-status .dot {
width: 8px;
height: 8px;
background: var(--accent);
border-radius: 50%;
animation: blink 1.5s infinite;
}

.dash-terminal {
font-family: 'JetBrains Mono', monospace;
color: var(--text-muted);
font-size: 14px;
margin-top: auto;
border-left: 2px solid var(--accent);
padding-left: 15px;
height: 40px;
display: flex;
align-items: center;
}

.dash-actions {
display: flex;
flex-direction: column;
justify-content: center;
gap: 30px;
position: relative;
z-index: 2;
animation: fadeSlideUp 0.8s ease-out 0.2s forwards;
opacity: 0;
}

.dash-card {
background: var(--card-bg);
border: 1px solid rgba(0,229,255,0.05);
border-radius: 12px;
padding: 40px;
box-shadow: var(--neu-shadow);
text-decoration: none;
color: var(--text-main);
display: block;
position: relative;
overflow: hidden;
transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.dash-card::before {
content: '';
position: absolute;
top: 0; left: 0; right: 0; bottom: 0;
background: linear-gradient(45deg, transparent, rgba(0,229,255,0.05));
opacity: 0;
transition: opacity 0.3s ease;
}

.dash-card:hover {
transform: translateX(-10px) translateY(-5px);
border-color: rgba(0,229,255,0.3);
box-shadow: var(--neu-shadow), 0 10px 30px rgba(0, 229, 255, 0.15);
}
.dash-card:hover::before {
opacity: 1;
}

.dash-card h2 {
font-size: 24px;
color: var(--accent);
margin-bottom: 10px;
display: flex;
align-items: center;
gap: 15px;
}

.dash-card p {
color: var(--text-muted);
font-size: 14px;
line-height: 1.6;
}

.dash-card .icon {
font-size: 32px;
}

.dash-logout {
position: absolute;
top: 40px;
right: 40px;
animation: fadeSlideUp 0.8s ease-out 0.4s forwards;
opacity: 0;
}

.dash-logout button {
background: transparent;
border: 1px solid var(--error);
color: var(--error);
padding: 10px 20px;
border-radius: 4px;
font-family: 'Syncopate', sans-serif;
font-size: 12px;
cursor: pointer;
transition: all 0.3s ease;
box-shadow: var(--neu-shadow);
}
.dash-logout button:hover {
background: rgba(255, 61, 0, 0.1);
box-shadow: var(--neu-inset);
}

@keyframes fadeSlideUp {
from {
opacity: 0;
transform: translateY(30px);
}
to {
opacity: 1;
transform: translateY(0);
}
}
@keyframes blink {
0%, 100% { opacity: 1; box-shadow: 0 0 8px var(--accent); }
50% { opacity: 0.3; box-shadow: none; }
}

@media (max-width: 900px) {
.dash-layout {
grid-template-columns: 1fr;
padding: 20px;
gap: 20px;
}
.dash-identity h1 {
font-size: 40px;
}
.dash-logout {
position: static;
margin-top: 30px;
}
}

`

## Master App Layout

**File Location:** resources/views/layouts/app.blade.php

`html

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RepoHive')</title>
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>

<body>
    @yield('content')

    @yield('scripts')

</body>

</html>
`

## Index / Login Gateway

**File Location:** resources/views/index.blade.php

`html
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

            <a class="btn primary" href="#">📱 Send OTP via SMS</a>
            <a class="btn light" href="#">📧 Send OTP via Email</a>

            <br>
            <hr>

            <form action="#" method="POST">
                @csrf
                <button type="submit" class="btn google">
                    <img src="./assets/Google_Favicon_2025.svg.webp" alt="" height="32">
                    Login with Google Account
                </button>
            </form>
        </div>
    </div>

@endsection
`

## Dashboard Interface

**File Location:** resources/views/pages/dashboard.blade.php

`html
@extends('layouts.app')

@section('title', 'RepoHive - Core System')

@section('content')
<nav class="top-nav">
<a href="{{ url('/') }}" class="nav-btn">← Back to Home</a>
<form action="#" method="POST" style="margin:0;">
@csrf
<button type="submit" class="nav-btn danger">Terminate Session</button>
</form>
</nav>

    <div class="dash-layout" style="min-height: calc(100vh - 70px);">
        <div class="dash-identity">
            <div class="dash-status">
                <div class="dot"></div>
                SYSTEM: ONLINE // AUTHENTICATED
            </div>

            <h1 class="brand">REPOHIVE<br>CORE</h1>
            <p class="muted" style="max-width: 400px; margin-bottom: 40px;">
                Welcome back to the main terminal. All primary subsystems are nominal. Select an operations module to
                proceed.
            </p>

            <div class="dash-terminal" id="dashTerminal">
                > AWAITING COMMAND...
            </div>
        </div>

        <div class="dash-actions">
            <a href="#" class="dash-card" data-hover-text="> INITIALIZING SECURE MAILBOX PROTOCOL...">
                <h2><span class="icon">📬</span> Secure Mailbox</h2>
                <p>Access encrypted communications, manage access requests, and review system logs.</p>
            </a>

            <a href="#" class="dash-card" data-hover-text="> CONNECTING TO NEURAL NETWORK...">
                <h2><span class="icon">🤖</span> Neural Interface</h2>
                <p>Engage with the AI assistant for advanced querying, system diagnostics, and automated tasks.</p>
            </a>
        </div>
    </div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
const terminal = document.getElementById('dashTerminal');
const cards = document.querySelectorAll('.dash-card');

            const defaultText = '> AWAITING COMMAND...';
            let typingTimeout;

            function typeWriter(element, text, i = 0) {
                if (i === 0) {
                    element.innerText = '';
                    element.style.color = 'var(--accent)';
                }
                if (i < text.length) {
                    element.innerText += text.charAt(i);
                    typingTimeout = setTimeout(() => typeWriter(element, text, i + 1), 20);
                }
            }

            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    clearTimeout(typingTimeout);
                    typeWriter(terminal, card.getAttribute('data-hover-text'));
                });

                card.addEventListener('mouseleave', () => {
                    clearTimeout(typingTimeout);
                    terminal.innerText = defaultText;
                    terminal.style.color = 'var(--text-muted)';
                });
            });
        });
    </script>

@endsection
`

## Secure Mailbox Interface

**File Location:** resources/views/pages/mailbox.blade.php

`html
@extends('layouts.app')

@section('title', 'REPOHIVE - Secure Mailbox')

@section('content')
<nav class="top-nav">
<a href="#" class="nav-btn">← Back to Dashboard</a>
<form action="#" method="POST" style="margin:0;">
@csrf
<button type="submit" class="nav-btn danger">Terminate Session</button>
</form>
</nav>

    <div class="mailbox">
        <aside class="sidebar">
            <div class="brand white">🐝 REPOHIVE</div>

            <button class="compose-btn" onclick="openCompose()">+ COMPOSE SECURE MSG</button>

            <a class="menu active" onclick="switchFolder('inbox', this)">Inbox <span id="inboxCount">3</span></a>
            <a class="menu" onclick="switchFolder('sent', this)">Sent <span id="sentCount">0</span></a>
            <a class="menu" onclick="switchFolder('drafts', this)">Drafts <span id="draftCount">0</span></a>
            <a class="menu" onclick="switchFolder('archived', this)">Archived <span id="archivedCount">4</span></a>
        </aside>

        <main class="main">
            <header class="topbar">
                <div>
                    <h2 id="mailTitle" style="font-family: 'Syncopate', sans-serif;">Inbox</h2>
                    <small id="userEmail" class="muted">Verified System User</small>
                </div>
                <input id="searchMail" placeholder="Search encrypted mail..." onkeyup="filterMail()">
            </header>

            <section class="mail-area">
                <div id="mailList" class="mail-list"></div>

                <div class="preview">
                    <h2 id="previewTitle" style="font-family: 'Syncopate', sans-serif; margin-bottom:10px;">Select a transmission</h2>
                    <p id="previewMeta" class="muted" style="margin-bottom: 20px;"></p>
                    <div id="previewBody" style="line-height: 1.8;"></div>
                </div>
            </section>
        </main>
    </div>

    <!-- COMPOSE MODAL -->
    <div id="composeModal" class="modal">
        <div class="modal-card">
            <button class="close" onclick="closeCompose()">×</button>
            <h2 style="font-family: 'Syncopate', sans-serif; margin-bottom:20px;">NEW TRANSMISSION</h2>

            <label>Recipient Address</label>
            <input id="composeTo" type="email" placeholder="agent@repohive.sys">

            <label>Subject Line</label>
            <input id="composeSubject" type="text" placeholder="Operation details...">

            <label>Encrypted Payload (Message)</label>
            <textarea id="composeBody" placeholder="Begin typing your secure message here..."></textarea>

            <button class="btn primary" onclick="sendEmail()" style="margin-top:20px;">ENCRYPT & SEND</button>
        </div>
    </div>

@endsection

@section('scripts')

<script>
    const emails = {
        inbox: [
            { id: 1, sender: 'Admin', subject: 'System Security Update', body: 'Please review the latest patches applied to the core system.', date: '10:45 AM' },
            { id: 2, sender: 'Ops Team', subject: 'Deployment Successful', body: 'The recent push to production was successful with zero downtime.', date: 'Yesterday' },
            { id: 3, sender: 'Security', subject: 'Login from new device', body: 'We noticed a login from a new IP address. If this was you, you can ignore this.', date: 'Oct 12' }
        ],
        sent: [],
        drafts: [],
        archived: [
            { id: 4, sender: 'System', subject: 'Welcome to RepoHive', body: 'Initialization complete. Welcome to the core system.', date: 'Oct 01' }
        ]
    };

    let currentFolder = 'inbox';

    function switchFolder(folder, element) {
        currentFolder = folder;
        document.getElementById('mailTitle').innerText = folder.charAt(0).toUpperCase() + folder.slice(1);
        
        // Update active class
        document.querySelectorAll('.sidebar .menu').forEach(el => el.classList.remove('active'));
        if(element) element.classList.add('active');
        
        renderEmails();
        clearPreview();
    }

    function renderEmails(filter = '') {
        const list = document.getElementById('mailList');
        list.innerHTML = '';
        
        const folderEmails = emails[currentFolder].filter(m => 
            m.subject.toLowerCase().includes(filter.toLowerCase()) || 
            m.sender.toLowerCase().includes(filter.toLowerCase())
        );

        if (folderEmails.length === 0) {
            list.innerHTML = '<div style="padding: 20px; color: var(--text-muted); text-align:center;">No transmissions found.</div>';
            return;
        }

        folderEmails.forEach(mail => {
            const el = document.createElement('div');
            el.className = 'mail-item';
            el.innerHTML = `
                <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
                    <strong style="font-family: 'JetBrains Mono', monospace; font-size:12px; color:var(--accent);">${mail.sender}</strong>
                    <small style="font-family: 'JetBrains Mono', monospace; font-size:10px;">${mail.date}</small>
                </div>
                <div style="font-weight: 500; margin-bottom:5px;">${mail.subject}</div>
                <div style="font-size: 13px; color: var(--text-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    ${mail.body}
                </div>
            `;
            el.onclick = () => openEmail(mail, el);
            list.appendChild(el);
        });
        
        updateCounts();
    }

    function openEmail(mail, element) {
        document.querySelectorAll('.mail-item').forEach(el => el.classList.remove('active'));
        if(element) element.classList.add('active');

        document.getElementById('previewTitle').innerText = mail.subject;
        document.getElementById('previewMeta').innerText = `From: ${mail.sender} | Date: ${mail.date}`;
        document.getElementById('previewBody').innerText = mail.body;
    }

    function clearPreview() {
        document.getElementById('previewTitle').innerText = 'Select a transmission';
        document.getElementById('previewMeta').innerText = '';
        document.getElementById('previewBody').innerText = '';
    }

    function filterMail() {
        const term = document.getElementById('searchMail').value;
        renderEmails(term);
    }

    function openCompose() {
        document.getElementById('composeModal').classList.add('active');
        document.getElementById('composeTo').value = '';
        document.getElementById('composeSubject').value = '';
        document.getElementById('composeBody').value = '';
    }

    function closeCompose() {
        document.getElementById('composeModal').classList.remove('active');
    }

    function sendEmail() {
        const to = document.getElementById('composeTo').value;
        const subject = document.getElementById('composeSubject').value;
        const body = document.getElementById('composeBody').value;
        
        if (!to || !subject) {
            alert('Please specify a recipient and subject.');
            return;
        }

        emails.sent.push({
            id: Date.now(),
            sender: 'You',
            subject: subject,
            body: body,
            date: 'Just now'
        });
        
        closeCompose();
        
        // Show subtle notification or just switch to sent
        if (currentFolder === 'sent') {
            renderEmails();
        } else {
            // Optional: Auto switch to sent
            switchFolder('sent', document.querySelectorAll('.sidebar .menu')[1]);
        }
    }
    
    function updateCounts() {
        document.getElementById('inboxCount').innerText = emails.inbox.length;
        document.getElementById('sentCount').innerText = emails.sent.length;
        document.getElementById('draftCount').innerText = emails.drafts.length;
        document.getElementById('archivedCount').innerText = emails.archived.length;
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderEmails();
    });
</script>

@endsection
`

## AI Chatbot / Neural Interface

**File Location:** resources/views/pages/ai-chatbot.blade.php

`html
@extends('layouts.app')

@section('title', 'REPOHIVE - Neural Interface')

@section('content')
<nav class="top-nav">
<a href="#" class="nav-btn">← Back to Dashboard</a>
<form action="#" method="POST" style="margin:0;">
@csrf
<button type="submit" class="nav-btn danger">Terminate Session</button>
</form>
</nav>

    <div class="chatbot-only-page" style="padding-top: 0; min-height: calc(100vh - 70px);">
        <main class="chat-panel">
            <header class="chat-header">
                <div class="ai-orb">🤖</div>
                <div>
                    <h2 style="font-family: 'Syncopate', sans-serif;">REPOHIVE AI</h2>
                    <small>Neural Interface • Online</small>
                </div>
            </header>

            <section class="chat-window" id="chatWindow">
                <div class="chat-message bot">
                    <div class="avatar">🤖</div>
                    <div class="bubble">
                        System initialized. I am your Neural Interface assistant. State your query or select from the suggested system queries below to understand my limits.
                    </div>
                </div>

                <div class="suggestions" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px; padding: 0 10px;">
                    <button class="suggest-btn" onclick="document.getElementById('chatInput').value = this.innerText; sendChat();">Generate a system diagnostic report</button>
                    <button class="suggest-btn" onclick="document.getElementById('chatInput').value = this.innerText; sendChat();">Show me my recent encrypted mailbox logs</button>
                    <button class="suggest-btn" onclick="document.getElementById('chatInput').value = this.innerText; sendChat();">What are the current active system modules?</button>
                    <button class="suggest-btn" onclick="document.getElementById('chatInput').value = this.innerText; sendChat();">Check for unread secure communications</button>
                </div>
            </section>

            <footer class="chat-input-bar">
                <input id="chatInput" placeholder="Enter command sequence..." onkeydown="handleChatKey(event)">
                <button onclick="sendChat()">TRANSMIT</button>
            </footer>
        </main>
    </div>

@endsection

@section('scripts')

<script>
    function handleChatKey(event) {
        if (event.key === 'Enter') {
            sendChat();
        }
    }

    function sendChat() {
        const input = document.getElementById('chatInput');
        const text = input.value.trim();
        if (!text) return;

        appendMessage('user', text);
        input.value = '';

        // Hide suggestions once the user starts chatting
        const suggestions = document.querySelector('.suggestions');
        if (suggestions) {
            suggestions.style.display = 'none';
        }

        // Simulate AI thinking
        setTimeout(() => {
            let response = "";
            const lowerText = text.toLowerCase();
            
            if (lowerText.includes("diagnostic report")) {
                response = "Diagnostic Report: All core modules (Mailbox, Dashboard, Neural Interface) are operating at 100% efficiency. Memory usage is nominal.";
            } else if (lowerText.includes("mailbox logs")) {
                response = "Accessing logs... You have 3 recent login attempts via OTP. All authentication protocols passed successfully.";
            } else if (lowerText.includes("active system modules")) {
                response = "Currently active modules: 1) Secure Mailbox Protocol 2) Neural Interface Assistant 3) Authentication Gateway.";
            } else if (lowerText.includes("unread secure communications")) {
                response = "Scanning mailbox... You have 0 unread secure communications at this time.";
            } else {
                const responses = [
                    "I am limited to system diagnostics, mailbox logs, and module status. Please ask a valid query.",
                    "That query is outside my operational parameters. Try asking about system diagnostics.",
                    "Error: Query not recognized. I can only provide information regarding the iREPO core system.",
                    "I cannot perform that action. I am restricted to system monitoring and mailbox queries."
                ];
                response = responses[Math.floor(Math.random() * responses.length)];
            }
            
            appendMessage('bot', response);
        }, 800);
    }

    function appendMessage(sender, text) {
        const window = document.getElementById('chatWindow');
        const el = document.createElement('div');
        el.className = `chat-message ${sender}`;
        
        const avatar = sender === 'bot' ? '🤖' : '👤';
        
        el.innerHTML = `
            <div class="avatar">${avatar}</div>
            <div class="bubble">${text}</div>
        `;
        
        window.appendChild(el);
        window.scrollTop = window.scrollHeight;
    }
</script>

@endsection
`

## OTP Phone Request Page

**File Location:** resources/views/pages/otp-phone.blade.php

`html
@extends('layouts.app')

@section('title', 'REPOHIVE - OTP Phone')

@section('content')
<div class="center-screen">
<div class="card">
<div class="brand">📱 Phone Verification</div>
<h1>Send OTP to Phone</h1>
<p class="muted">Enter your phone number to receive a 6-digit code.</p>

            @if(session('sms_error'))
                <div class="error">Placeholder Data</div>
            @endif
            <form method="POST" action="#">
                @csrf

                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="tel" placeholder="0900 000 0000" autocomplete="tel"
                    value="" required>

                @error('phone')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <button class="btn primary" type="submit">Send OTP</button>
            </form>
            <a class="link" href="#">Back</a>

        </div>
    </div>

@endsection
`

## OTP Email Request Page

**File Location:** resources/views/pages/otp-email.blade.php

`html
@extends('layouts.app')
@section('title', 'REPOHIVE - OTP Email')
@section('content')
<div class="center-screen">
<div class="card">
<div class="brand">📧 Email Verification</div>
<h1>Send OTP to Email</h1>
<p class="muted">Enter your email address to receive a 6-digit code.</p>
@if(session('email_error'))
<div class="error">Placeholder Data</div>
@endif
<form method="POST" action="#">
@csrf
<label for="email">Email Address</label>
<input id="email" name="email" type="email" placeholder="example@company.com" value="" required>

                @error('email')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <button type="submit" class="btn primary">Send OTP</button>
            </form>
            <a class="link" href="#">Back</a>
        </div>
    </div>

@endsection
`

## Validate OTP Page

**File Location:** resources/views/pages/validate-otp.blade.php

`html
@extends('layouts.app')
@section('title', 'REPOHIVE - Validate OTP')
@section('content')
<div class="center-screen">
<div class="card">
<div class="brand">🔐 OTP Verification</div>
<h1>Validate OTP</h1>
<p class="muted">
Code sent to: <strong id="otpTarget">Placeholder Data</strong>
</p>

            <div class="success">Prototype OTP: <strong>123456</strong></div>

            @if(session('otp_error'))
                <div class="error">Placeholder Data</div>
            @endif

            <form action="#" method="POST">
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
            <a class="link" href="#">Back</a>
        </div>
    </div>

@endsection
`
