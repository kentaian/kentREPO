@extends('layouts.app')

@section('title', 'REPOHIVE - Secure Mailbox')

@section('content')
    <nav class="top-nav">
        <a href="{{ route('dashboard') }}" class="nav-btn">← Back to Dashboard</a>
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
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