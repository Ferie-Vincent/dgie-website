@extends('back-end.layouts.admin')

@section('title', 'Modifier le partenaire')
@section('breadcrumb', 'Partenaires / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier le partenaire</h1>
        <p class="content-subtitle">{{ $partner->name }}</p>
    </div>
    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $partner->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="abbreviation">Abréviation</label>
                <input type="text" id="abbreviation" name="abbreviation" class="form-input" value="{{ old('abbreviation', $partner->abbreviation) }}">
                @error('abbreviation') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                @if($partner->logo)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="">
                    </div>
                @endif
                <input type="file" id="logo" name="logo" class="form-input" accept="image/*">
                <span class="form-help">Laisser vide pour conserver le logo actuel.</span>
                @error('logo') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="url">URL du site web</label>
                <input type="url" id="url" name="url" class="form-input" value="{{ old('url', $partner->url) }}">
                @error('url') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $partner->order) }}" min="0">
            </div>

            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $partner->is_active) ? 'checked' : '' }} style="margin-right: 6px;">
                    Actif
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Mettre à jour
            </button>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
