@extends('layouts.app')

@section('title', 'REPOHIVE - Neural Interface')

@section('content')
    <nav class="top-nav">
        <a href="{{ route('dashboard') }}" class="nav-btn">← Back to Dashboard</a>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
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