@extends('back-end.layouts.admin')

@section('title', 'Créer un événement')
@section('breadcrumb', 'Événements / Créer')

@section('content')
<div class="content-header">
    <div><h1 class="content-title">Créer un événement</h1></div>
    <a href="{{ route('admin.evenements.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.evenements.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="event_date">Date et heure <span class="required">*</span></label>
                <input type="datetime-local" id="event_date" name="event_date" class="form-input" value="{{ old('event_date') }}" required>
                @error('event_date') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="location">Lieu</label>
                <input type="text" id="location" name="location" class="form-input" value="{{ old('location') }}" placeholder="Ex: Abidjan, Plateau">
            </div>
            <div class="form-group">
                <label for="status">Statut <span class="required">*</span></label>
                <select id="status" name="status" class="form-select">
                    <option value="brouillon">Brouillon</option>
                    <option value="publie">Publié</option>
                    <option value="archive">Archivé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section <span class="required">*</span></label>
                <select id="section" name="section" class="form-select">
                    <option value="general" {{ old('section') == 'general' ? 'selected' : '' }}>Général (Accueil)</option>
                    <option value="diaspora" {{ old('section') == 'diaspora' ? 'selected' : '' }}>Diaspora (Coin des Diasporas)</option>
                </select>
                <span class="form-help">Détermine où l'événement apparaîtra.</span>
            </div>
            <div class="form-group">
                <label for="is_featured">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="margin-right: 6px;">
                    Mettre en vedette (modale accueil)
                </label>
            </div>
            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea wysiwyg" rows="6">{{ old('description') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.evenements.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
