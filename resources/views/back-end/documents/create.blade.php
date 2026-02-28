@extends('back-end.layouts.admin')

@section('title', 'Ajouter un document')
@section('breadcrumb', 'Documents / Créer')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Ajouter un document</h1>
        <p class="content-subtitle">Téléversez un nouveau document</p>
    </div>
    <a href="{{ route('admin.documents.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required placeholder="Titre du document">
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="file">Fichier <span class="required">*</span></label>
                <input type="file" id="file" name="file" class="form-input" required>
                <span class="form-help">Tous types de fichiers acceptés. Max 10 Mo.</span>
                @error('file') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="type">Type <span class="required">*</span></label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Sélectionner un type</option>
                    <option value="juridique" {{ old('type') == 'juridique' ? 'selected' : '' }}>Juridique</option>
                    <option value="rapport" {{ old('type') == 'rapport' ? 'selected' : '' }}>Rapport</option>
                    <option value="organigramme" {{ old('type') == 'organigramme' ? 'selected' : '' }}>Organigramme</option>
                    <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', 0) }}" min="0" placeholder="0">
            </div>

            <div class="form-group">
                <label for="is_active">Statut</label>
                <label class="toggle-label">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    Actif
                </label>
            </div>

            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea" rows="4" placeholder="Description du document (facultatif)">{{ old('description') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Enregistrer
            </button>
            <a href="{{ route('admin.documents.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
