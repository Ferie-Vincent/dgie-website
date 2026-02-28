@extends('back-end.layouts.admin')

@section('title', 'Nouveau contenu culturel')
@section('breadcrumb', 'Contenus culturels / Créer')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Nouveau contenu culturel</h1>
        <p class="content-subtitle">Ajoutez un contenu au coin culturel</p>
    </div>
    <a href="{{ route('admin.cultural-items.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.cultural-items.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="type">Type <span class="required">*</span></label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Sélectionner un type</option>
                    <option value="musique" {{ old('type') == 'musique' ? 'selected' : '' }}>Musique</option>
                    <option value="livre" {{ old('type') == 'livre' ? 'selected' : '' }}>Livre</option>
                    <option value="film" {{ old('type') == 'film' ? 'selected' : '' }}>Film</option>
                    <option value="gastronomie" {{ old('type') == 'gastronomie' ? 'selected' : '' }}>Gastronomie</option>
                </select>
                @error('type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required placeholder="Titre du contenu">
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea" rows="4" placeholder="Description du contenu culturel...">{{ old('description') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                <span class="form-help">Formats acceptés : JPG, PNG, WebP. Max 2 Mo.</span>
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
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
            <a href="{{ route('admin.cultural-items.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
