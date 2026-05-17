@extends('layouts.app')


@section('title', 'REPOHIVE - AI Chatbot')

@section('content')
    <div class="chatbot-only-page">
        <main class="chat-panel">
            <header class="chat-header">
                <div class="ai-orb">🤖</div>
                <div>
                    <h2>{Rename} AI Assistant</h2>
                    <small>Online • Ready to help</small>
                </div>
            </header>

            <section class="chat-window" id="chatWindow">
                <div class="chat-message bot show">
                    <div class="avatar">🤖</div>
                    <div class="bubble">
                        Hi! I'm your {Rename} AI Assistant. How can I help you today?
                    </div>
                </div>
            </section>

            <footer class="chat-input-bar">
                <input id="chatInput" placeholder="Type your message..." onkeydown="handleChatKey(event)">
                <button onclick="sendChat()">Send</button>
            </footer>
        </main>
    </div>
@endsection