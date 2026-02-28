@extends('back-end.layouts.admin')

@section('title', 'Créer un dossier')
@section('breadcrumb', 'Dossiers / Créer')

@section('content')
<div class="content-header">
    <div><h1 class="content-title">Créer un dossier</h1></div>
    <a href="{{ route('admin.dossiers.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.dossiers.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="brouillon" {{ old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publie" {{ old('status') == 'publie' ? 'selected' : '' }}>Publié</option>
                    <option value="archive" {{ old('status') == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', 0) }}" min="0">
            </div>
            <div class="form-group full-width">
                <label for="description">Description courte</label>
                <textarea id="description" name="description" class="form-textarea" rows="3">{{ old('description') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group full-width">
                <label for="content">Contenu <span class="required">*</span></label>
                <textarea id="content" name="content" class="form-textarea" rows="10" required>{{ old('content') }}</textarea>
                @error('content') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.dossiers.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
