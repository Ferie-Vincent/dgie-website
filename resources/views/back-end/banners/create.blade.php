@extends('back-end.layouts.admin')

@section('title', 'Nouvelle bannière')
@section('breadcrumb', 'Bannières / Créer')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Nouvelle bannière</h1>
        <p class="content-subtitle">Ajoutez une bannière publicitaire</p>
    </div>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" placeholder="Titre de la bannière">
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="position">Position <span class="required">*</span></label>
                <select id="position" name="position" class="form-select" required>
                    <option value="">Sélectionner une position</option>
                    <option value="top" {{ old('position') == 'top' ? 'selected' : '' }}>Top</option>
                    <option value="sidebar" {{ old('position') == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                    <option value="popup" {{ old('position') == 'popup' ? 'selected' : '' }}>Popup</option>
                </select>
                @error('position') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="image">Image <span class="required">*</span></label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*" required>
                <span class="form-help">Formats acceptés : JPG, PNG, WebP. Max 2 Mo.</span>
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="alt_text">Texte alternatif</label>
                <input type="text" id="alt_text" name="alt_text" class="form-input" value="{{ old('alt_text') }}" placeholder="Description de l'image">
                @error('alt_text') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="url">URL de destination</label>
                <input type="text" id="url" name="url" class="form-input" value="{{ old('url') }}" placeholder="https://...">
                @error('url') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', 0) }}" min="0">
            </div>

            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="margin-right: 6px;">
                    Actif
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Enregistrer
            </button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
