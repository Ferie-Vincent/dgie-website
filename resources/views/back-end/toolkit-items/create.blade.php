@extends('back-end.layouts.admin')

@section('title', 'Nouvel outil')
@section('breadcrumb', 'Boîte à outils / Créer')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Nouvel outil</h1>
        <p class="content-subtitle">Ajoutez un outil à la boîte à outils</p>
    </div>
    <a href="{{ route('admin.toolkit-items.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.toolkit-items.store') }}">
    @csrf

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required placeholder="Titre de l'outil">
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea" rows="4" placeholder="Description de l'outil...">{{ old('description') }}</textarea>
                @error('description') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="icon_color">Couleur de l'icône</label>
                <input type="text" id="icon_color" name="icon_color" class="form-input" value="{{ old('icon_color') }}" placeholder="Ex: #E8772A">
                @error('icon_color') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" id="url" name="url" class="form-input" value="{{ old('url') }}" placeholder="https://...">
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
            <a href="{{ route('admin.toolkit-items.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
