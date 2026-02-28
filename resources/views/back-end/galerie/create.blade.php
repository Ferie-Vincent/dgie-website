@extends('back-end.layouts.admin')

@section('title', 'Nouvel album')
@section('breadcrumb', 'Galerie / Créer')

@section('content')
<div class="content-header">
    <div><h1 class="content-title">Nouvel album</h1></div>
    <a href="{{ route('admin.galerie.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.galerie.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="type">Type <span class="required">*</span></label>
                <select id="type" name="type" class="form-select">
                    <option value="photo" {{ old('type') == 'photo' ? 'selected' : '' }}>Photo</option>
                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Vidéo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="brouillon">Brouillon</option>
                    <option value="publie">Publié</option>
                    <option value="archive">Archivé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cover_image">Image de couverture</label>
                <input type="file" id="cover_image" name="cover_image" class="form-input" accept="image/*">
                @error('cover_image') <span class="form-error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.galerie.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
