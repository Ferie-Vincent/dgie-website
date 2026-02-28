@extends('back-end.layouts.admin')

@section('title', 'Centre de Messagerie')
@section('breadcrumb', 'Messagerie')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Centre de Messagerie</h1>
        <p class="content-subtitle">Gérez les informations de contact et répondez aux messages des visiteurs.</p>
    </div>
</div>

{{-- Stats Overview --}}
<div class="msg-stats-grid">
    <div class="msg-stat-card">
        <div class="msg-stat-header">
            <span class="msg-stat-label">Messages reçus (Mois)</span>
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="#94a3b8" fill="none" stroke-width="2"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
        </div>
        <div class="msg-stat-value">
            <span class="msg-stat-number">{{ $stats['total_month'] }}</span>
            <span class="msg-stat-badge msg-stat-badge--green">Ce mois</span>
        </div>
    </div>
    <div class="msg-stat-card">
        <div class="msg-stat-header">
            <span class="msg-stat-label">Non lus</span>
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="#f59e0b" fill="none" stroke-width="2"><path d="M22 10.5V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12.5"/><path d="m22 7l-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/><path d="M20 14v4"/><path d="M20 22v.01"/></svg>
        </div>
        <div class="msg-stat-value">
            <span class="msg-stat-number">{{ $stats['unread'] }}</span>
            <span class="msg-stat-hint">Nécessite une action</span>
        </div>
    </div>
    <div class="msg-stat-card">
        <div class="msg-stat-header">
            <span class="msg-stat-label">Temps de réponse moyen</span>
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="#94a3b8" fill="none" stroke-width="2"><line x1="10" x2="14" y1="2" y2="2"/><line x1="12" x2="15" y1="14" y2="11"/><circle cx="12" cy="14" r="8"/></svg>
        </div>
        <div class="msg-stat-value">
            <span class="msg-stat-number">{{ $stats['avg_response_time'] }}</span>
            <span class="msg-stat-badge msg-stat-badge--green">Moyen</span>
        </div>
    </div>
</div>

{{-- Informations Publiques --}}
@if($contactInfo)
<div class="admin-card" style="position: relative; margin-bottom: 16px;">
    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
        <span style="width: 4px; height: 16px; background: var(--green, #1D8C4F); border-radius: 2px;"></span>
        <h2 style="font-size: 11px; font-weight: 700; color: var(--text-900); text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Informations Publiques</h2>
    </div>
    <p style="font-size: 11px; color: var(--text-400); margin: 0 0 20px 12px;">Ces informations sont visibles sur la page "Contact" du site public.</p>

    <div class="msg-contact-grid">
        <div class="msg-contact-item">
            <div class="msg-contact-icon" style="background: rgba(29,140,79,0.08); color: var(--green, #1D8C4F);">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
                <h4 class="msg-contact-label">Adresse Physique</h4>
                <p class="msg-contact-value" style="white-space: pre-line;">{{ $contactInfo->address }}</p>
            </div>
        </div>
        <div class="msg-contact-item">
            <div class="msg-contact-icon" style="background: rgba(29,140,79,0.08); color: var(--green, #1D8C4F);">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div>
                <h4 class="msg-contact-label">Téléphone & Fax</h4>
                <p class="msg-contact-value" style="font-family: monospace;">
                    {{ $contactInfo->phone_1 }}
                    @if($contactInfo->phone_2)<br>{{ $contactInfo->phone_2 }}@endif
                </p>
            </div>
        </div>
        <div class="msg-contact-item">
            <div class="msg-contact-icon" style="background: rgba(29,140,79,0.08); color: var(--green, #1D8C4F);">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </div>
            <div>
                <h4 class="msg-contact-label">Courrier Électronique</h4>
                <p class="msg-contact-value">{{ $contactInfo->email }}</p>
                <span style="font-size: 10px; color: var(--text-300); display: block; margin-top: 2px;">Réponse sous 48h ouvrables</span>
            </div>
        </div>
    </div>

    <button type="button" class="msg-edit-info-btn" onclick="openEditInfoModal()">
        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="M15 5l4 4"/></svg>
        Modifier
    </button>
</div>
@endif

{{-- Inbox Area --}}
<div class="admin-card" style="padding: 0; overflow: hidden;">
    {{-- Tabs & Search Toolbar --}}
    <div class="msg-toolbar">
        <div class="msg-tabs">
            <a href="{{ route('admin.contact-messages.index') }}" class="msg-tab {{ !request('status') ? 'msg-tab--active' : '' }}">Tous</a>
            <a href="{{ route('admin.contact-messages.index', ['status' => 'unread']) }}" class="msg-tab {{ request('status') === 'unread' ? 'msg-tab--active' : '' }}">Non lus</a>
            <a href="{{ route('admin.contact-messages.index', ['status' => 'replied']) }}" class="msg-tab {{ request('status') === 'replied' ? 'msg-tab--active' : '' }}">Répondus</a>
        </div>
        <div class="msg-search">
            <svg viewBox="0 0 24 24" width="14" height="14" stroke="#94a3b8" fill="none" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.34-4.34"/></svg>
            <input type="text" id="live-search" onkeyup="liveSearch()" placeholder="Rechercher en direct...">
        </div>
    </div>

    {{-- Table --}}
    <div class="admin-table-wrapper">
        <table class="admin-table" id="messagesTable">
            <thead>
                <tr>
                    <th style="width: 40px; padding-left: 16px;">
                        <label class="msg-checkbox"><input type="checkbox" id="selectAll" onchange="toggleSelectAll()"><span class="msg-checkbox-box"></span></label>
                    </th>
                    <th>Expéditeur</th>
                    <th>Sujet / Message</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th style="text-align: right;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                <tr class="{{ $message->status === 'unread' ? 'msg-row--unread' : '' }}" data-status="{{ $message->status }}">
                    <td style="padding-left: 16px;">
                        <label class="msg-checkbox"><input type="checkbox" class="msg-check-item"><span class="msg-checkbox-box"></span></label>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="msg-avatar {{ $message->status === 'unread' ? 'msg-avatar--new' : '' }}">
                                {{ strtoupper(substr($message->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="msg-sender-name">{{ $message->name }}</div>
                                <div class="msg-sender-email">{{ $message->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="max-width: 300px;">
                        <div class="msg-subject">{{ $message->subject }}</div>
                        <div class="msg-excerpt">{{ Str::limit($message->message, 80) }}</div>
                    </td>
                    <td>
                        <div class="msg-status">
                            @if($message->status === 'unread')
                            <span class="msg-status-dot msg-status-dot--new"></span>
                            <span class="msg-status-text msg-status-text--bold">Nouveau</span>
                            @elseif($message->status === 'replied')
                            <svg viewBox="0 0 24 24" width="14" height="14" stroke="var(--green, #1D8C4F)" fill="none" stroke-width="2"><polyline points="9 17 4 12 9 7"/><path d="M20 18v-2a4 4 0 0 0-4-4H4"/></svg>
                            <span class="msg-status-text">Répondu</span>
                            @else
                            <span class="msg-status-dot msg-status-dot--read"></span>
                            <span class="msg-status-text">Lu</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="msg-date">{{ $message->created_at->format('d M') }}</div>
                        <div class="msg-time">{{ $message->created_at->format('H:i') }}</div>
                    </td>
                    <td style="text-align: right; padding-right: 16px;">
                        <button type="button" class="msg-read-btn"
                            data-id="{{ $message->id }}"
                            data-name="{{ $message->name }}"
                            data-email="{{ $message->email }}"
                            data-subject="{{ $message->subject }}"
                            data-message="{{ $message->message }}"
                            data-reply="{{ $message->reply_message ?? '' }}"
                            data-date="{{ $message->created_at->format('d M Y à H:i') }}"
                            data-status="{{ $message->status }}"
                            onclick="openMessageModal(this)">
                            Lire
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 60px 16px; text-align: center;">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <div style="width: 56px; height: 56px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                                <svg viewBox="0 0 24 24" width="28" height="28" stroke="#94a3b8" fill="none" stroke-width="1.5"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            </div>
                            <h3 style="font-size: 14px; font-weight: 600; color: var(--text-900); margin: 0 0 4px;">Aucun message</h3>
                            <p style="font-size: 12px; color: var(--text-400); margin: 0;">Il n'y a aucun message pour le moment.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($messages->hasPages())
    <div class="admin-pagination" style="border-top: 1px solid var(--border-light, #e2e8f0);">
        <div class="pagination-info">
            Affichage de <strong>{{ $messages->firstItem() ?? 0 }}</strong> à <strong>{{ $messages->lastItem() ?? 0 }}</strong> sur <strong>{{ $messages->total() }}</strong> messages
        </div>
        <div class="pagination-links">
            {{ $messages->links() }}
        </div>
    </div>
    @else
    <div style="padding: 12px 16px; border-top: 1px solid var(--border-light, #e2e8f0);">
        <p style="font-size: 11px; color: var(--text-400); margin: 0;">
            Affichage de <strong>{{ $messages->firstItem() ?? 0 }}</strong> à <strong>{{ $messages->lastItem() ?? 0 }}</strong> sur <strong>{{ $messages->total() }}</strong> messages
        </p>
    </div>
    @endif
</div>

{{-- Modal: Lecture & Réponse --}}
<div class="admin-modal-overlay" id="messageOverlay">
    <div class="admin-modal modal-fullpage" style="max-width: 640px;">
        <div class="modal-fp-header">
            <div>
                <h3 style="margin: 0;">Lecture du message</h3>
                <div style="display: flex; align-items: center; gap: 6px; margin-top: 4px;">
                    <span id="modalStatusDot" class="msg-status-dot msg-status-dot--new" style="width: 8px; height: 8px;"></span>
                    <span id="modalDate" style="font-size: 11px; color: var(--text-400);"></span>
                </div>
            </div>
            <button type="button" class="modal-fp-close" onclick="closeMessageModal()">
                <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-fp-body" style="background: #f8fafc; padding: 20px;">
            <div style="max-height: 60vh; overflow-y: auto;">
                {{-- Sender Info Card --}}
                <div class="msg-modal-sender">
                    <div style="display: flex; align-items: start; gap: 12px;">
                        <div id="modalInitials" class="msg-avatar msg-avatar--new" style="width: 40px; height: 40px; font-size: 13px;"></div>
                        <div>
                            <div id="modalName" style="font-weight: 600; font-size: 13px; color: var(--text-900);"></div>
                            <div id="modalEmail" style="font-size: 11px; color: var(--text-400); font-family: monospace; margin-top: 2px;"></div>
                            <div style="margin-top: 8px; display: inline-flex; align-items: center; padding: 4px 8px; border-radius: 4px; background: #f1f5f9; border: 1px solid var(--border-light, #e2e8f0); font-size: 10px; color: var(--text-600); font-weight: 500;">
                                Sujet : <span id="modalSubject" style="margin-left: 4px;"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Message Body --}}
                <div style="margin-top: 16px;">
                    <label class="msg-section-label">Message du visiteur</label>
                    <div id="modalBody" class="msg-modal-body"></div>
                </div>

                {{-- Reply Area --}}
                <div style="margin-top: 16px;">
                    <label class="msg-section-label">Votre réponse</label>
                    <textarea id="replyMessage" class="msg-reply-textarea" placeholder="Rédigez votre réponse ici..."></textarea>
                </div>
            </div>
        </div>
        <div class="modal-fp-footer" style="justify-content: space-between;">
            <label id="markReadContainer" style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" id="markReadCheckbox" onchange="markAsRead()" style="width: 16px; height: 16px; accent-color: var(--green, #1D8C4F);">
                <span style="font-size: 12px; font-weight: 500; color: var(--text-700);">Marquer comme lu</span>
            </label>
            <div style="display: flex; gap: 8px;">
                <button type="button" class="btn btn-outline" onclick="closeMessageModal()">Annuler</button>
                <button type="button" id="sendReplyBtn" class="btn btn-primary" onclick="sendReply()" style="display: flex; align-items: center; gap: 6px;">
                    Envoyer la réponse
                    <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2"><path d="m22 2l-7 20l-4-9l-9-4z"/><path d="M22 2L11 13"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Modifier les coordonnées --}}
<div class="admin-modal-overlay" id="editInfoOverlay">
    <div class="admin-modal modal-fullpage modal-sm">
        <div class="modal-fp-header">
            <h3>Modifier les coordonnées</h3>
            <button type="button" class="modal-fp-close" onclick="closeEditInfoModal()">
                <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-fp-body">
            <div class="modal-fp-section">
                <div class="form-group">
                    <label for="editAddress">
                        <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        Adresse physique
                    </label>
                    <textarea id="editAddress" class="form-input" rows="3" style="resize: none;">{{ $contactInfo->address ?? '' }}</textarea>
                </div>
            </div>
            <div class="modal-fp-section">
                <div class="form-group">
                    <label for="editPhone1">
                        <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Téléphone(s)
                    </label>
                    <input type="text" id="editPhone1" class="form-input" value="{{ $contactInfo->phone_1 ?? '' }}" placeholder="Téléphone principal">
                    <input type="text" id="editPhone2" class="form-input" value="{{ $contactInfo->phone_2 ?? '' }}" placeholder="Téléphone secondaire (optionnel)" style="margin-top: 8px;">
                </div>
            </div>
            <div class="modal-fp-section">
                <div class="form-group">
                    <label for="editEmail">
                        <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        Courrier électronique
                    </label>
                    <input type="email" id="editEmail" class="form-input" value="{{ $contactInfo->email ?? '' }}">
                    <p style="font-size: 10px; color: var(--text-400); margin: 4px 0 0;">C'est l'adresse où les messages du formulaire seront envoyés.</p>
                </div>
            </div>
        </div>
        <div class="modal-fp-footer">
            <button type="button" class="btn btn-outline" onclick="closeEditInfoModal()">Annuler</button>
            <button type="button" id="saveInfoBtn" class="btn btn-primary" onclick="saveContactInfo()">Enregistrer les modifications</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentMessageId = null;
let currentMessageStatus = null;

// Live search
function liveSearch() {
    const val = document.getElementById('live-search').value.toLowerCase();
    const rows = document.querySelectorAll('#messagesTable tbody tr[data-status]');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(val) ? '' : 'none';
    });
}

// Select all checkboxes
function toggleSelectAll() {
    const checked = document.getElementById('selectAll').checked;
    document.querySelectorAll('.msg-check-item').forEach(cb => cb.checked = checked);
}

// Open message modal
function openMessageModal(btn) {
    currentMessageId = btn.dataset.id;
    currentMessageStatus = btn.dataset.status;

    document.getElementById('modalInitials').textContent = btn.dataset.name.substring(0, 2).toUpperCase();
    document.getElementById('modalName').textContent = btn.dataset.name;
    document.getElementById('modalEmail').textContent = btn.dataset.email;
    document.getElementById('modalSubject').textContent = btn.dataset.subject;
    document.getElementById('modalBody').textContent = btn.dataset.message;
    document.getElementById('modalDate').textContent = 'Reçu le ' + btn.dataset.date;

    const reply = btn.dataset.reply;
    const textarea = document.getElementById('replyMessage');
    const sendBtn = document.getElementById('sendReplyBtn');
    textarea.value = reply;

    if (currentMessageStatus === 'replied' && reply) {
        textarea.disabled = true;
        textarea.style.background = '#f8fafc';
        sendBtn.disabled = true;
        sendBtn.style.opacity = '0.5';
    } else {
        textarea.disabled = false;
        textarea.style.background = '';
        sendBtn.disabled = false;
        sendBtn.style.opacity = '';
    }

    const dot = document.getElementById('modalStatusDot');
    if (currentMessageStatus === 'unread') {
        dot.className = 'msg-status-dot msg-status-dot--new';
    } else if (currentMessageStatus === 'replied') {
        dot.className = 'msg-status-dot msg-status-dot--replied';
    } else {
        dot.className = 'msg-status-dot msg-status-dot--read';
    }

    const cb = document.getElementById('markReadCheckbox');
    if (currentMessageStatus === 'replied' || currentMessageStatus === 'read') {
        cb.checked = true;
        cb.disabled = true;
    } else {
        cb.checked = false;
        cb.disabled = false;
    }

    document.getElementById('messageOverlay').classList.add('active');
}

function closeMessageModal() {
    document.getElementById('messageOverlay').classList.remove('active');
}

// Mark as read
function markAsRead() {
    const cb = document.getElementById('markReadCheckbox');
    if (!currentMessageId || currentMessageStatus !== 'unread') {
        cb.checked = true;
        return;
    }
    if (!cb.checked) { cb.checked = true; return; }
    cb.disabled = true;

    fetch(`/admin/contact-messages/${currentMessageId}/mark-as-read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            currentMessageStatus = data.status;
            document.getElementById('modalStatusDot').className = 'msg-status-dot msg-status-dot--read';
            document.querySelector('#markReadContainer span').textContent = '✓ Marqué comme lu';
            document.querySelector('#markReadContainer span').style.color = 'var(--green, #1D8C4F)';
            setTimeout(() => location.reload(), 1200);
        }
    })
    .catch(() => { cb.checked = false; cb.disabled = false; });
}

// Send reply
function sendReply() {
    const msg = document.getElementById('replyMessage').value;
    if (!msg.trim()) { showToast('warning', 'Veuillez saisir un message de réponse.'); return; }
    if (!currentMessageId) return;

    const btn = document.getElementById('sendReplyBtn');
    btn.disabled = true;
    btn.textContent = 'Envoi en cours...';

    fetch(`/admin/contact-messages/${currentMessageId}/reply`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ reply_message: msg })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            setTimeout(() => location.reload(), 1000);
        }
    })
    .catch(() => showToast('error', 'Erreur lors de l\'envoi.'))
    .finally(() => { btn.disabled = false; btn.textContent = 'Envoyer la réponse'; });
}

// Edit contact info modal
function openEditInfoModal() {
    document.getElementById('editInfoOverlay').classList.add('active');
}
function closeEditInfoModal() {
    document.getElementById('editInfoOverlay').classList.remove('active');
}

function saveContactInfo() {
    const address = document.getElementById('editAddress').value;
    const phone1 = document.getElementById('editPhone1').value;
    const phone2 = document.getElementById('editPhone2').value;
    const email = document.getElementById('editEmail').value;

    if (!address || !phone1 || !email) {
        showToast('warning', 'Veuillez remplir tous les champs obligatoires.');
        return;
    }

    const btn = document.getElementById('saveInfoBtn');
    btn.disabled = true;
    btn.textContent = 'Enregistrement...';

    fetch('/admin/contact-messages/contact-info', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ address, phone_1: phone1, phone_2: phone2, email })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            setTimeout(() => location.reload(), 800);
        }
    })
    .catch(() => showToast('error', 'Erreur lors de la sauvegarde.'))
    .finally(() => { btn.disabled = false; btn.textContent = 'Enregistrer les modifications'; });
}
</script>
@endsection
