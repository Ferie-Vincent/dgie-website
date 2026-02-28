@extends('back-end.layouts.admin')

@section('title', 'Nouveau pays')
@section('breadcrumb', 'Pays / Créer')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Nouveau pays</h1>
        <p class="content-subtitle">Ajoutez un nouveau pays</p>
    </div>
    <a href="{{ route('admin.countries.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.countries.store') }}">
    @csrf

    <div class="admin-card">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required placeholder="Nom du pays">
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="flag_emoji">Drapeau (emoji)</label>
                <input type="text" id="flag_emoji" name="flag_emoji" class="form-input" value="{{ old('flag_emoji') }}" placeholder="Ex: 🇨🇮" maxlength="10">
                @error('flag_emoji') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="population_label">Population</label>
                <input type="text" id="population_label" name="population_label" class="form-input" value="{{ old('population_label') }}" placeholder="Ex: ~120 000 Ivoiriens">
                @error('population_label') <span class="form-error">{{ $message }}</span> @enderror
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
            <a href="{{ route('admin.countries.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
