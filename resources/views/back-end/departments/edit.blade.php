@extends('back-end.layouts.admin')

@section('title', 'Modifier la sous-direction')
@section('breadcrumb', 'Sous-directions / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier la sous-direction</h1>
        <p class="content-subtitle">{{ $department->acronym }} — {{ $department->name }}</p>
    </div>
    <a href="{{ route('admin.departments.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.departments.update', $department) }}">
    @csrf
    @method('PUT')

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="acronym">Acronyme <span class="required">*</span></label>
                <input type="text" id="acronym" name="acronym" class="form-input" value="{{ old('acronym', $department->acronym) }}" required maxlength="20">
                @error('acronym') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="name">Nom complet <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $department->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea" rows="4">{{ old('description', $department->description) }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="icon">Icône</label>
                <input type="text" id="icon" name="icon" class="form-input" value="{{ old('icon', $department->icon) }}" placeholder="Ex: fa-building ou classe CSS">
                <span class="form-help">Classe CSS d'icône (FontAwesome, etc.)</span>
                @error('icon') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="link">Lien</label>
                <input type="text" id="link" name="link" class="form-input" value="{{ old('link', $department->link) }}" placeholder="URL ou chemin vers la page">
                @error('link') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $department->order) }}" min="0">
            </div>

            <div class="form-group">
                <label for="is_active">Statut</label>
                <label class="toggle-label">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $department->is_active) ? 'checked' : '' }}>
                    Actif
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Mettre à jour
            </button>
            <a href="{{ route('admin.departments.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
