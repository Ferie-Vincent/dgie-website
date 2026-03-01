@extends('back-end.layouts.admin')

@section('title', 'Créer un article')
@section('breadcrumb', 'Articles / Créer')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Créer un article</h1>
        <p class="content-subtitle">Rédigez et publiez un nouvel article</p>
    </div>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group full-width">
                <label for="title">Titre <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required placeholder="Titre de l'article">
                @error('title') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Catégorie <span class="required">*</span></label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Statut <span class="required">*</span></label>
                <select id="status" name="status" class="form-select" required>
                    <option value="brouillon" {{ old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                    <option value="publie" {{ old('status') == 'publie' ? 'selected' : '' }}>Publié</option>
                    <option value="archive" {{ old('status') == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>

            <div class="form-group">
                <label for="section">Section <span class="required">*</span></label>
                <select id="section" name="section" class="form-select" required>
                    <option value="general" {{ old('section') == 'general' ? 'selected' : '' }}>Général (Accueil / Actualités)</option>
                    <option value="diaspora" {{ old('section') == 'diaspora' ? 'selected' : '' }}>Diaspora (Coin des Diasporas)</option>
                </select>
                <span class="form-help">Détermine où l'article apparaîtra sur le site.</span>
            </div>

            <div class="form-group full-width">
                <label for="excerpt">Résumé</label>
                <textarea id="excerpt" name="excerpt" class="form-textarea" rows="3" maxlength="500" placeholder="Court résumé de l'article (affiché dans les listes)">{{ old('excerpt') }}</textarea>
                @error('excerpt') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="content">Contenu <span class="required">*</span></label>
                <textarea id="content" name="content" class="form-textarea wysiwyg" rows="12" required placeholder="Contenu complet de l'article">{{ old('content') }}</textarea>
                @error('content') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="image">Image de couverture</label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*">
                <span class="form-help">Formats acceptés : JPG, PNG, WebP. Max 2 Mo.</span>
                @error('image') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="read_time">Temps de lecture (min)</label>
                <input type="number" id="read_time" name="read_time" class="form-input" value="{{ old('read_time') }}" min="1" placeholder="Ex: 5">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Enregistrer
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
