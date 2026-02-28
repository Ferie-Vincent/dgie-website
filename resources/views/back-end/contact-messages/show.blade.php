@extends('back-end.layouts.admin')

@section('title', 'Message de contact')
@section('breadcrumb', 'Messages de contact / Voir')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Message de contact</h1>
        <p class="content-subtitle">Reçu le {{ $contact_message->created_at->format('d/m/Y à H:i') }}</p>
    </div>
    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<div class="admin-card">
    <div class="form-grid">
        <div class="form-group">
            <label>De</label>
            <div class="form-input" style="background: var(--admin-bg); border-color: transparent; cursor: default;">{{ $contact_message->name }}</div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <div class="form-input" style="background: var(--admin-bg); border-color: transparent; cursor: default;">
                <a href="mailto:{{ $contact_message->email }}" style="color: var(--admin-primary);">{{ $contact_message->email }}</a>
            </div>
        </div>

        <div class="form-group full-width">
            <label>Sujet</label>
            <div class="form-input" style="background: var(--admin-bg); border-color: transparent; cursor: default;">{{ $contact_message->subject }}</div>
        </div>

        <div class="form-group full-width">
            <label>Date</label>
            <div class="form-input" style="background: var(--admin-bg); border-color: transparent; cursor: default;">{{ $contact_message->created_at->format('d/m/Y à H:i') }}</div>
        </div>

        <div class="form-group full-width">
            <label>Message</label>
            <div class="form-input" style="background: var(--admin-bg); border-color: transparent; cursor: default; min-height: 120px; white-space: pre-wrap; height: auto; padding: 12px;">{{ $contact_message->message }}</div>
        </div>
    </div>

    <div class="form-actions">
        <form id="delete-message-{{ $contact_message->id }}" action="{{ route('admin.contact-messages.destroy', $contact_message) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
        <button class="btn btn-danger" data-delete-form="delete-message-{{ $contact_message->id }}">
            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            Supprimer ce message
        </button>
        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline">Retour à la liste</a>
    </div>
</div>
@endsection
