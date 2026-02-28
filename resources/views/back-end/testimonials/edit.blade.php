@extends('back-end.layouts.admin')

@section('title', 'Modifier le témoignage')
@section('breadcrumb', 'Témoignages / Modifier')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Modifier le témoignage</h1>
        <p class="content-subtitle">{{ $testimonial->name }}</p>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $testimonial->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="type">Type <span class="required">*</span></label>
                <select id="type" name="type" class="form-select" required>
                    <option value="general" {{ old('type', $testimonial->type) == 'general' ? 'selected' : '' }}>Général</option>
                    <option value="retour" {{ old('type', $testimonial->type) == 'retour' ? 'selected' : '' }}>Retour</option>
                    <option value="success_story" {{ old('type', $testimonial->type) == 'success_story' ? 'selected' : '' }}>Success story</option>
                </select>
                @error('type') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="context">Contexte</label>
                <input type="text" id="context" name="context" class="form-input" value="{{ old('context', $testimonial->context) }}" placeholder="Ex: Ivoirienne de retour de France">
                @error('context') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="route">Parcours</label>
                <input type="text" id="route" name="route" class="form-input" value="{{ old('route', $testimonial->route) }}" placeholder="Ex: France - Abidjan">
                @error('route') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="return_year">Année de retour</label>
                <input type="text" id="return_year" name="return_year" class="form-input" value="{{ old('return_year', $testimonial->return_year) }}" placeholder="Ex: 2023">
                @error('return_year') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="page_slug">Page (slug)</label>
                <input type="text" id="page_slug" name="page_slug" class="form-input" value="{{ old('page_slug', $testimonial->page_slug) }}" placeholder="Ex: retour-reintegration">
                @error('page_slug') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="dossier_id">Dossier</label>
                <select id="dossier_id" name="dossier_id" class="form-select">
                    <option value="">Aucun dossier</option>
                    @foreach($dossiers as $dossier)
                        <option value="{{ $dossier->id }}" {{ old('dossier_id', $testimonial->dossier_id) == $dossier->id ? 'selected' : '' }}>{{ $dossier->title }}</option>
                    @endforeach
                </select>
                @error('dossier_id') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="order">Ordre</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $testimonial->order) }}" min="0">
                @error('order') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label for="quote">Citation <span class="required">*</span></label>
                <textarea id="quote" name="quote" class="form-textarea" rows="5" required>{{ old('quote', $testimonial->quote) }}</textarea>
                @error('quote') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="avatar">Photo</label>
                @if($testimonial->avatar)
                    <div class="file-upload-preview" style="margin-bottom: 8px;">
                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="Photo actuelle">
                    </div>
                @endif
                <input type="file" id="avatar" name="avatar" class="form-input" accept="image/*">
                <span class="form-help">Laisser vide pour conserver la photo actuelle.</span>
                @error('avatar') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-checkbox-label">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                    <span>Actif</span>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Mettre à jour
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
