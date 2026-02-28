@extends('back-end.layouts.admin')

@section('title', 'Témoignages')
@section('breadcrumb', 'Témoignages')

@section('head')
@if($errors->any())
<meta name="reopen-modal" content="{{ old('_modal', 'create') }}">
@if(old('_edit_id'))
<meta name="edit-id" content="{{ old('_edit_id') }}">
@endif
@endif
@endsection

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Témoignages</h1>
        <p class="content-subtitle">{{ $testimonials->total() }} témoignage(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau témoignage
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un témoignage..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="type" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>Général</option>
                <option value="retour" {{ request('type') == 'retour' ? 'selected' : '' }}>Retour</option>
                <option value="success_story" {{ request('type') == 'success_story' ? 'selected' : '' }}>Success story</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($testimonials->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Citation</th>
                    <th>Type</th>
                    <th>Page / Dossier</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                <tr>
                    <td>
                        <div class="table-title">{{ $testimonial->name }}</div>
                        <div class="table-excerpt">{{ $testimonial->context ?? '—' }}</div>
                    </td>
                    <td>
                        <span style="font-size: 12px;">{{ Str::limit($testimonial->quote, 50) }}</span>
                    </td>
                    <td>
                        <span style="font-size: 12px;">
                            @if($testimonial->type === 'general') Général
                            @elseif($testimonial->type === 'retour') Retour
                            @else Success story
                            @endif
                        </span>
                    </td>
                    <td>
                        <span style="font-size: 12px;">
                            @if($testimonial->dossier)
                                {{ Str::limit($testimonial->dossier->title, 30) }}
                            @elseif($testimonial->page_slug)
                                {{ $testimonial->page_slug }}
                            @else
                                —
                            @endif
                        </span>
                    </td>
                    <td>
                        <span class="badge-status badge-{{ $testimonial->is_active ? 'publie' : 'brouillon' }}">
                            <span class="dot"></span>
                            {{ $testimonial->is_active ? 'Oui' : 'Non' }}
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-name="{{ $testimonial->name }}"
                                data-context="{{ $testimonial->context }}"
                                data-type="{{ $testimonial->type }}"
                                data-quote="{{ $testimonial->quote }}"
                                data-dossier="{{ $testimonial->dossier ? $testimonial->dossier->title : '' }}"
                                data-is_active="{{ $testimonial->is_active ? '1' : '0' }}"
                                data-avatar="{{ $testimonial->avatar ? asset('storage/' . $testimonial->avatar) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $testimonial->id }}"
                                data-name="{{ $testimonial->name }}"
                                data-context="{{ $testimonial->context }}"
                                data-route="{{ $testimonial->route }}"
                                data-return_year="{{ $testimonial->return_year }}"
                                data-page_slug="{{ $testimonial->page_slug }}"
                                data-dossier_id="{{ $testimonial->dossier_id }}"
                                data-type="{{ $testimonial->type }}"
                                data-order="{{ $testimonial->order }}"
                                data-quote="{{ $testimonial->quote }}"
                                data-is_active="{{ $testimonial->is_active ? '1' : '0' }}"
                                data-avatar="{{ $testimonial->avatar ? asset('storage/' . $testimonial->avatar) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-testimonial-{{ $testimonial->id }}" action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-testimonial-{{ $testimonial->id }}" data-delete-name="ce témoignage" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($testimonials->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $testimonials->firstItem() }} à {{ $testimonials->lastItem() }} sur {{ $testimonials->total() }}
        </div>
        <div class="pagination-links">
            {{ $testimonials->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <h3>Aucun témoignage</h3>
        <p>Commencez par créer votre premier témoignage.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Créer un témoignage</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #10b981, #059669)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                </div>
                <div>
                    <h3>Nouveau temoignage</h3>
                    <p>Ajoutez un temoignage de la diaspora</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid">
                    {{-- Main column --}}
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> TEMOIGNAGE</div>
                            <div class="form-group">
                                <label for="create-name">Nom <span class="required">*</span></label>
                                <input type="text" id="create-name" name="name" class="form-input" value="{{ old('_modal') == 'create' ? old('name') : '' }}" required placeholder="Nom de la personne">
                                @if(old('_modal') == 'create') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-type">Type <span class="required">*</span></label>
                                <select id="create-type" name="type" class="form-select" required>
                                    <option value="general" {{ old('_modal') == 'create' && old('type') == 'general' ? 'selected' : (old('_modal') != 'create' ? 'selected' : '') }}>General</option>
                                    <option value="retour" {{ old('_modal') == 'create' && old('type') == 'retour' ? 'selected' : '' }}>Retour</option>
                                    <option value="investissement" {{ old('_modal') == 'create' && old('type') == 'investissement' ? 'selected' : '' }}>Investissement</option>
                                    <option value="competence" {{ old('_modal') == 'create' && old('type') == 'competence' ? 'selected' : '' }}>Competence</option>
                                </select>
                                @if(old('_modal') == 'create') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-quote">Citation <span class="required">*</span></label>
                                <textarea id="create-quote" name="quote" class="form-textarea wysiwyg" rows="4" required placeholder="Le temoignage de la personne">{{ old('_modal') == 'create' ? old('quote') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('quote') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-context">Contexte <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-context" name="context" class="form-input" value="{{ old('_modal') == 'create' ? old('context') : '' }}" placeholder="Ex: Ivoirienne de retour de France">
                                @if(old('_modal') == 'create') @error('context') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARCOURS</div>
                            <div class="form-group">
                                <label for="create-route">Parcours <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-route" name="route" class="form-input" value="{{ old('_modal') == 'create' ? old('route') : '' }}" placeholder="Ex: France - Abidjan">
                                @if(old('_modal') == 'create') @error('route') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-return_year">Annee de retour <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-return_year" name="return_year" class="form-input" value="{{ old('_modal') == 'create' ? old('return_year') : '' }}" placeholder="Ex: 2023">
                                @if(old('_modal') == 'create') @error('return_year') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PHOTO</div>
                            <label for="create-avatar" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-avatar-placeholder">
                                    <span>Aucune photo selectionnee</span>
                                </div>
                            </label>
                            <input type="file" id="create-avatar" name="avatar" accept="image/*" style="display:none" onchange="previewImage(this, 'create-avatar-placeholder')">
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('avatar') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot slate"></span> PUBLICATION</div>
                            <div class="form-group">
                                <label for="create-page_slug">Page (slug) <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-page_slug" name="page_slug" class="form-input" value="{{ old('_modal') == 'create' ? old('page_slug') : '' }}" placeholder="Ex: retour-reintegration">
                                @if(old('_modal') == 'create') @error('page_slug') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-dossier_id">Dossier <span class="label-hint">Optionnel</span></label>
                                <select id="create-dossier_id" name="dossier_id" class="form-select">
                                    <option value="">Aucun dossier</option>
                                    @foreach($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}" {{ old('_modal') == 'create' && old('dossier_id') == $dossier->id ? 'selected' : '' }}>{{ $dossier->title }}</option>
                                    @endforeach
                                </select>
                                @if(old('_modal') == 'create') @error('dossier_id') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-order">Ordre</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : '0' }}" min="0" placeholder="0">
                                @if(old('_modal') == 'create') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label>Visibilite</label>
                                <label class="toggle-label">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" {{ old('_modal') == 'create' ? (old('is_active') ? 'checked' : '') : 'checked' }}>
                                    Actif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave">Sauvegarde automatique activee</div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Creer</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/testimonials') }}">
    <div class="admin-modal modal-fullpage">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #ef4444)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </div>
                <div>
                    <h3>Modifier le temoignage</h3>
                    <p>Modifiez ce temoignage</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid">
                    {{-- Main column --}}
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> TEMOIGNAGE</div>
                            <div class="form-group">
                                <label for="edit-name">Nom <span class="required">*</span></label>
                                <input type="text" id="edit-name" name="name" class="form-input" value="{{ old('_modal') == 'edit' ? old('name') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-type">Type <span class="required">*</span></label>
                                <select id="edit-type" name="type" class="form-select" required>
                                    <option value="general" {{ old('_modal') == 'edit' && old('type') == 'general' ? 'selected' : '' }}>General</option>
                                    <option value="retour" {{ old('_modal') == 'edit' && old('type') == 'retour' ? 'selected' : '' }}>Retour</option>
                                    <option value="investissement" {{ old('_modal') == 'edit' && old('type') == 'investissement' ? 'selected' : '' }}>Investissement</option>
                                    <option value="competence" {{ old('_modal') == 'edit' && old('type') == 'competence' ? 'selected' : '' }}>Competence</option>
                                </select>
                                @if(old('_modal') == 'edit') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-quote">Citation <span class="required">*</span></label>
                                <textarea id="edit-quote" name="quote" class="form-textarea wysiwyg" rows="4" required>{{ old('_modal') == 'edit' ? old('quote') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('quote') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-context">Contexte <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-context" name="context" class="form-input" value="{{ old('_modal') == 'edit' ? old('context') : '' }}" placeholder="Ex: Ivoirienne de retour de France">
                                @if(old('_modal') == 'edit') @error('context') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARCOURS</div>
                            <div class="form-group">
                                <label for="edit-route">Parcours <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-route" name="route" class="form-input" value="{{ old('_modal') == 'edit' ? old('route') : '' }}" placeholder="Ex: France - Abidjan">
                                @if(old('_modal') == 'edit') @error('route') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-return_year">Annee de retour <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-return_year" name="return_year" class="form-input" value="{{ old('_modal') == 'edit' ? old('return_year') : '' }}" placeholder="Ex: 2023">
                                @if(old('_modal') == 'edit') @error('return_year') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PHOTO</div>
                            <label for="edit-avatar" class="fp-image-upload">
                                <div id="edit-avatar-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune photo selectionnee</span>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-avatar" name="avatar" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-avatar-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver la photo actuelle.</span>
                            @if(old('_modal') == 'edit') @error('avatar') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot slate"></span> PUBLICATION</div>
                            <div class="form-group">
                                <label for="edit-page_slug">Page (slug) <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-page_slug" name="page_slug" class="form-input" value="{{ old('_modal') == 'edit' ? old('page_slug') : '' }}" placeholder="Ex: retour-reintegration">
                                @if(old('_modal') == 'edit') @error('page_slug') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-dossier_id">Dossier <span class="label-hint">Optionnel</span></label>
                                <select id="edit-dossier_id" name="dossier_id" class="form-select">
                                    <option value="">Aucun dossier</option>
                                    @foreach($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}" {{ old('_modal') == 'edit' && old('dossier_id') == $dossier->id ? 'selected' : '' }}>{{ $dossier->title }}</option>
                                    @endforeach
                                </select>
                                @if(old('_modal') == 'edit') @error('dossier_id') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-order">Ordre</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                                @if(old('_modal') == 'edit') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label>Visibilite</label>
                                <label class="toggle-label">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" id="edit-is_active" name="is_active" value="1" {{ old('_modal') == 'edit' ? (old('is_active') ? 'checked' : '') : '' }}>
                                    Actif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave">Sauvegarde automatique activee</div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Set _edit_id hidden field and populate edit form when opening edit modal
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-edit-btn]');
        if (btn) {
            const editIdField = document.querySelector('#editModal input[name="_edit_id"]');
            if (editIdField) editIdField.value = btn.dataset.id;

            document.getElementById('edit-name').value = btn.dataset.name || '';
            document.getElementById('edit-type').value = btn.dataset.type || 'general';
            document.getElementById('edit-quote').value = btn.dataset.quote || '';
            document.getElementById('edit-context').value = btn.dataset.context || '';
            document.getElementById('edit-route').value = btn.dataset.route || '';
            document.getElementById('edit-return_year').value = btn.dataset.return_year || '';
            document.getElementById('edit-page_slug').value = btn.dataset.page_slug || '';
            document.getElementById('edit-dossier_id').value = btn.dataset.dossier_id || '';
            document.getElementById('edit-order').value = btn.dataset.order || '0';

            var isActiveCheckbox = document.getElementById('edit-is_active');
            if (isActiveCheckbox) isActiveCheckbox.checked = btn.dataset.is_active === '1';

            // Image preview in fullpage modal
            var placeholder = document.getElementById('edit-avatar-placeholder');
            if (btn.dataset.avatar) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.avatar + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune photo selectionnee</span></div>';
            }
        }
    });

    // View modal handler — rich preview
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var typeLabels = { general: 'Général', retour: 'Retour', investissement: 'Investissement', competence: 'Compétence', success_story: 'Success story' };
        var avatarHtml = d.avatar
            ? '<img src="' + d.avatar + '" alt="" style="width:80px;height:80px;border-radius:50%;object-fit:cover;">'
            : '<div class="art-show__avatar" style="width:80px;height:80px;font-size:28px;">' + (d.name ? d.name.charAt(0).toUpperCase() : 'T') + '</div>';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +     '<span class="art-show__preview-label">' + (typeLabels[d.type] || d.type) + '</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:40px 32px 24px;background:linear-gradient(135deg,#1e293b,#334155);color:white;text-align:center;">'
            +   avatarHtml
            +   '<h2 style="margin:16px 0 4px;font-size:22px;font-weight:700;">' + (d.name || '') + '</h2>'
            +   (d.context ? '<p style="opacity:0.7;font-size:14px;margin:0;">' + d.context + '</p>' : '')
            + '</div>'
            + '<div style="padding:32px;font-size:18px;line-height:1.7;font-style:italic;color:var(--admin-text);border-left:4px solid var(--admin-primary);margin:24px 32px;padding:16px 24px;background:rgba(232,119,42,0.05);border-radius:0 8px 8px 0;">'
            +   '« ' + (d.quote || '') + ' »'
            + '</div>'
            + (d.dossier ? '<div class="art-show__tags" style="padding:0 32px 24px;"><span class="art-show__tags-label">Dossier :</span><span class="art-show__tag">' + d.dossier + '</span></div>' : '')
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
