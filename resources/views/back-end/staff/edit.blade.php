@extends('back-end.layouts.admin')

@section('title', 'Modifier le membre')
@section('breadcrumb', 'Personnel / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier le membre</h1>
        <p class="content-subtitle">{{ $staff->name }}</p>
    </div>
    <a href="{{ route('admin.staff.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.staff.update', $staff) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $staff->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $staff->title) }}">
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="role">Fonction</label>
                <input type="text" id="role" name="role" class="form-input" value="{{ old('role', $staff->role) }}">
                @error('role') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="type">Type <span class="required">*</span></label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Sélectionner un type</option>
                    <option value="ministre" {{ old('type', $staff->type) == 'ministre' ? 'selected' : '' }}>Ministre</option>
                    <option value="dg" {{ old('type', $staff->type) == 'dg' ? 'selected' : '' }}>Directeur Général</option>
                    <option value="directeur" {{ old('type', $staff->type) == 'directeur' ? 'selected' : '' }}>Directeur</option>
                    <option value="autre" {{ old('type', $staff->type) == 'autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="quote">Citation</label>
                <textarea id="quote" name="quote" class="form-textarea" rows="3">{{ old('quote', $staff->quote) }}</textarea>
                @error('quote') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="bio">Biographie</label>
                <textarea id="bio" name="bio" class="form-textarea wysiwyg" rows="6">{{ old('bio', $staff->bio) }}</textarea>
                @error('bio') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="photo">Photo (accueil / sidebar)</label>
                @if($staff->photo)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $staff->photo) }}" alt="">
                    </div>
                @endif
                <input type="file" id="photo" name="photo" class="form-input" accept="image/*">
                <span class="form-help">Photo affichée sur la page d'accueil. Laisser vide pour conserver.</span>
                @error('photo') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="photo_page">Photo (page La DGIE)</label>
                @if($staff->photo_page)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $staff->photo_page) }}" alt="">
                    </div>
                @endif
                <input type="file" id="photo_page" name="photo_page" class="form-input" accept="image/*">
                <span class="form-help">Photo affichée sur la page "Mot du DG". Laisser vide pour conserver.</span>
                @error('photo_page') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $staff->order) }}" min="0">
            </div>

            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $staff->is_active) ? 'checked' : '' }} style="margin-right: 6px;">
                    Actif
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Mettre à jour
            </button>
            <a href="{{ route('admin.staff.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
