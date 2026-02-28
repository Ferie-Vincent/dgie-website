@extends('back-end.layouts.admin')

@section('title', 'Modifier l\'événement')
@section('breadcrumb', 'Événements / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier l'événement</h1>
        <p class="content-subtitle">{{ $evenement->title }}</p>
    </div>
    <a href="{{ route('admin.evenements.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.evenements.update', $evenement) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $evenement->title) }}" required>
            </div>
            <div class="form-group">
                <label for="event_date">Date et heure <span class="required">*</span></label>
                <input type="datetime-local" id="event_date" name="event_date" class="form-input" value="{{ old('event_date', $evenement->event_date->format('Y-m-d\TH:i')) }}" required>
            </div>
            <div class="form-group">
                <label for="location">Lieu</label>
                <input type="text" id="location" name="location" class="form-input" value="{{ old('location', $evenement->location) }}">
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="brouillon" {{ old('status', $evenement->status) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publie" {{ old('status', $evenement->status) == 'publie' ? 'selected' : '' }}>Publié</option>
                    <option value="archive" {{ old('status', $evenement->status) == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section</label>
                <select id="section" name="section" class="form-select">
                    <option value="general" {{ old('section', $evenement->section) == 'general' ? 'selected' : '' }}>Général (Accueil)</option>
                    <option value="diaspora" {{ old('section', $evenement->section) == 'diaspora' ? 'selected' : '' }}>Diaspora (Coin des Diasporas)</option>
                </select>
                <span class="form-help">Détermine où l'événement apparaîtra.</span>
            </div>
            <div class="form-group">
                <label for="is_featured">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $evenement->is_featured) ? 'checked' : '' }} style="margin-right: 6px;">
                    Mettre en vedette
                </label>
            </div>
            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea wysiwyg" rows="6">{{ old('description', $evenement->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                @if($evenement->image)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $evenement->image) }}" alt="">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                <span class="form-help">Laisser vide pour conserver l'image actuelle.</span>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.evenements.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
