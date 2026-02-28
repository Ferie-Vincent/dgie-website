@extends('back-end.layouts.admin')

@section('title', 'Modifier l\'utilisateur')
@section('breadcrumb', 'Utilisateurs / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier l'utilisateur</h1>
        <p class="content-subtitle">{{ $utilisateur->name }}</p>
    </div>
    <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.utilisateurs.update', $utilisateur) }}">
    @csrf @method('PUT')
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom complet <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $utilisateur->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $utilisateur->email) }}" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="role">Rôle <span class="required">*</span></label>
                <select id="role" name="role" class="form-select" required>
                    <option value="redacteur" {{ old('role', $utilisateur->role) == 'redacteur' ? 'selected' : '' }}>Rédacteur</option>
                    <option value="editeur" {{ old('role', $utilisateur->role) == 'editeur' ? 'selected' : '' }}>Éditeur</option>
                    <option value="super-admin" {{ old('role', $utilisateur->role) == 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
            </div>
            <div class="form-group full-width" style="border-top: 1px solid var(--admin-border); padding-top: 20px; margin-top: 4px;">
                <p style="font-size: 13px; color: var(--admin-text-light); margin-bottom: 16px;">Laisser vide pour ne pas modifier le mot de passe.</p>
            </div>
            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" class="form-input">
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmer</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
