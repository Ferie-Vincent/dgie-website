@extends('back-end.layouts.admin')

@section('title', 'Nouvel utilisateur')
@section('breadcrumb', 'Utilisateurs / Créer')

@section('content')
<div class="content-header">
    <div><h1 class="content-title">Nouvel utilisateur</h1></div>
    <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.utilisateurs.store') }}">
    @csrf
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom complet <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="role">Rôle <span class="required">*</span></label>
                <select id="role" name="role" class="form-select" required>
                    <option value="redacteur" {{ old('role') == 'redacteur' ? 'selected' : '' }}>Rédacteur</option>
                    <option value="editeur" {{ old('role') == 'editeur' ? 'selected' : '' }}>Éditeur</option>
                    <option value="super-admin" {{ old('role') == 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                </select>
                @error('role') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe <span class="required">*</span></label>
                <input type="password" id="password" name="password" class="form-input" required>
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe <span class="required">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
            <a href="{{ route('admin.utilisateurs.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
