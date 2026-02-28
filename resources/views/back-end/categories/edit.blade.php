@extends('back-end.layouts.admin')

@section('title', 'Modifier la catégorie')
@section('breadcrumb', 'Catégories / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier la catégorie</h1>
        <p class="content-subtitle">{{ $category->name }}</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.categories.update', $category) }}">
    @csrf @method('PUT')
    <div class="admin-card">
        <div class="form-group">
            <label for="name">Nom <span class="required">*</span></label>
            <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $category->name) }}" required>
            @error('name') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="color">Classe CSS couleur</label>
            <input type="text" id="color" name="color" class="form-input" value="{{ old('color', $category->color) }}">
            @error('color') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
