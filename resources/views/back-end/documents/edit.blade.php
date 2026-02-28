@extends('back-end.layouts.admin')

@section('title', 'Modifier le document')
@section('breadcrumb', 'Documents / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier le document</h1>
        <p class="content-subtitle">{{ $document->title }}</p>
    </div>
    <a href="{{ route('admin.documents.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.documents.update', $document) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $document->title) }}" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="file">Fichier</label>
                @if($document->file_path)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" style="font-size: 13px; color: var(--admin-primary);">
                            {{ basename($document->file_path) }} ({{ $document->file_size }})
                        </a>
                    </div>
                @endif
                <input type="file" id="file" name="file" class="form-input">
                <span class="form-help">Laisser vide pour conserver le fichier actuel. Max 10 Mo.</span>
                @error('file') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="type">Type <span class="required">*</span></label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Sélectionner un type</option>
                    <option value="juridique" {{ old('type', $document->type) == 'juridique' ? 'selected' : '' }}>Juridique</option>
                    <option value="rapport" {{ old('type', $document->type) == 'rapport' ? 'selected' : '' }}>Rapport</option>
                    <option value="organigramme" {{ old('type', $document->type) == 'organigramme' ? 'selected' : '' }}>Organigramme</option>
                    <option value="autre" {{ old('type', $document->type) == 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $document->order) }}" min="0">
            </div>

            <div class="form-group">
                <label for="is_active">Statut</label>
                <label class="toggle-label">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $document->is_active) ? 'checked' : '' }}>
                    Actif
                </label>
            </div>

            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea" rows="4">{{ old('description', $document->description) }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Mettre à jour
            </button>
            <a href="{{ route('admin.documents.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
