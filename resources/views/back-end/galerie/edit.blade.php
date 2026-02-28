@extends('back-end.layouts.admin')

@section('title', 'Modifier l\'album')
@section('breadcrumb', 'Galerie / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier l'album</h1>
        <p class="content-subtitle">{{ $galerie->title }}</p>
    </div>
    <a href="{{ route('admin.galerie.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.galerie.update', $galerie) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $galerie->title) }}" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-select">
                    <option value="photo" {{ old('type', $galerie->type) == 'photo' ? 'selected' : '' }}>Photo</option>
                    <option value="video" {{ old('type', $galerie->type) == 'video' ? 'selected' : '' }}>Vidéo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-select">
                    <option value="brouillon" {{ old('status', $galerie->status) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publie" {{ old('status', $galerie->status) == 'publie' ? 'selected' : '' }}>Publié</option>
                    <option value="archive" {{ old('status', $galerie->status) == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cover_image">Image de couverture</label>
                @if($galerie->cover_image)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $galerie->cover_image) }}" alt="">
                    </div>
                @endif
                <input type="file" id="cover_image" name="cover_image" class="form-input" accept="image/*">
                <span class="form-help">Laisser vide pour conserver l'image actuelle.</span>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.galerie.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>

{{-- Album items --}}
@if($galerie->items->count() > 0)
<div class="admin-card" style="margin-top: 24px;">
    <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 16px;">Éléments de l'album ({{ $galerie->items->count() }})</h2>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Fichier</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Ordre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($galerie->items as $item)
                <tr>
                    <td style="font-size: 12px;">{{ basename($item->file_path) }}</td>
                    <td>{{ $item->title ?? '—' }}</td>
                    <td style="font-size: 12px; text-transform: capitalize;">{{ $item->type }}</td>
                    <td>{{ $item->order }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
