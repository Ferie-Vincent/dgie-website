@extends('back-end.layouts.admin')

@section('title', 'Modifier le flash info')
@section('breadcrumb', 'Flash Infos / Modifier')

@section('content')
<div class="content-header">
    <div><h1 class="content-title">Modifier le flash info</h1></div>
    <a href="{{ route('admin.flash-infos.index') }}" class="btn btn-outline">
        <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Retour
    </a>
</div>

<form method="POST" action="{{ route('admin.flash-infos.update', $flash_info) }}">
    @csrf @method('PUT')
    <div class="admin-card">
        <div class="form-group">
            <label for="content">Contenu <span class="required">*</span></label>
            <textarea id="content" name="content" class="form-textarea" rows="3" required maxlength="500">{{ old('content', $flash_info->content) }}</textarea>
            @error('content') <span class="form-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $flash_info->order) }}" min="0">
            </div>
            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $flash_info->is_active) ? 'checked' : '' }} style="margin-right: 6px;">
                    Actif
                </label>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.flash-infos.index') }}" class="btn btn-outline">Annuler</a>
        </div>
    </div>
</form>
@endsection
