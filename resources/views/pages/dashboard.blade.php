@extends('layouts.app')

@section('title', 'RepoHive - Core System')

@section('content')
    <nav class="top-nav">
        <a href="{{ url('/') }}" class="nav-btn">← Back to Home</a>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
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
            <a href="{{ route('mailbox') }}" class="dash-card" data-hover-text="> INITIALIZING SECURE MAILBOX PROTOCOL...">
                <h2><span class="icon">📬</span> Secure Mailbox</h2>
                <p>Access encrypted communications, manage access requests, and review system logs.</p>
            </a>

            <a href="{{ route('ai-chatbot') }}" class="dash-card" data-hover-text="> CONNECTING TO NEURAL NETWORK...">
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