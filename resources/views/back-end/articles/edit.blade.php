@extends('back-end.layouts.admin')

@section('title', 'Modifier l\'article')
@section('breadcrumb', 'Articles / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier l'article</h1>
        <p class="content-subtitle">{{ $article->title }}</p>
    </div>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $article->title) }}" required>
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Catégorie <span class="required">*</span></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Statut <span class="required">*</span></label>
                <select id="status" name="status" class="form-select" required>
                    <option value="brouillon" {{ old('status', $article->status) == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publie" {{ old('status', $article->status) == 'publie' ? 'selected' : '' }}>Publié</option>
                    <option value="archive" {{ old('status', $article->status) == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>

            <div class="form-group">
                <label for="section">Section <span class="required">*</span></label>
                <select id="section" name="section" class="form-select" required>
                    <option value="general" {{ old('section', $article->section) == 'general' ? 'selected' : '' }}>Général (Accueil / Actualités)</option>
                    <option value="diaspora" {{ old('section', $article->section) == 'diaspora' ? 'selected' : '' }}>Diaspora (Coin des Diasporas)</option>
                </select>
                <span class="form-help">Détermine où l'article apparaîtra sur le site.</span>
            </div>

            <div class="form-group full-width">
                <label for="excerpt">Résumé</label>
                <textarea id="excerpt" name="excerpt" class="form-textarea" rows="3">{{ old('excerpt', $article->excerpt) }}</textarea>
                @error('excerpt') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="content">Contenu <span class="required">*</span></label>
                <textarea id="content" name="content" class="form-textarea" rows="12" required>{{ old('content', $article->content) }}</textarea>
                @error('content') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="image">Image de couverture</label>
                @if($article->image)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Image actuelle">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                <span class="form-help">Laisser vide pour conserver l'image actuelle.</span>
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="read_time">Temps de lecture (min)</label>
                <input type="number" id="read_time" name="read_time" class="form-input" value="{{ old('read_time', $article->read_time) }}" min="1">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Mettre à jour
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
