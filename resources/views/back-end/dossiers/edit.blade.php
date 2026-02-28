@extends('back-end.layouts.admin')

@section('title', 'Modifier le dossier')
@section('breadcrumb', 'Dossiers / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier le dossier</h1>
        <p class="content-subtitle">{{ $dossier->title }}</p>
    </div>
    <a href="{{ route('admin.dossiers.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.dossiers.update', $dossier) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $dossier->title) }}" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="brouillon" {{ old('status', $dossier->status) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publie" {{ old('status', $dossier->status) == 'publie' ? 'selected' : '' }}>Publié</option>
                    <option value="archive" {{ old('status', $dossier->status) == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="order">Ordre</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $dossier->order) }}" min="0">
            </div>
            <div class="form-group full-width">
                <label for="description">Description courte</label>
                <textarea id="description" name="description" class="form-textarea" rows="3">{{ old('description', $dossier->description) }}</textarea>
            </div>
            <div class="form-group full-width">
                <label for="content">Contenu <span class="required">*</span></label>
                <textarea id="content" name="content" class="form-textarea" rows="10" required>{{ old('content', $dossier->content) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                @if($dossier->image)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $dossier->image) }}" alt="">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                <span class="form-help">Laisser vide pour conserver l'image actuelle.</span>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.dossiers.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
