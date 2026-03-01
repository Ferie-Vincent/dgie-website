@extends('back-end.layouts.admin')

@section('title', 'Personnel')
@section('breadcrumb', 'Personnel')

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
        <h1 class="content-title">Personnel</h1>
        <p class="content-subtitle">{{ $staff->total() }} membre(s)</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau membre
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un membre..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="type" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="ministre" {{ request('type') == 'ministre' ? 'selected' : '' }}>Ministre</option>
                <option value="dg" {{ request('type') == 'dg' ? 'selected' : '' }}>Directeur Général</option>
                <option value="directeur" {{ request('type') == 'directeur' ? 'selected' : '' }}>Directeur</option>
                <option value="autre" {{ request('type') == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($staff->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Ordre</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $member)
                <tr>
                    <td>
                        @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" class="table-image" alt="">
                        @else
                            <div class="table-image" style="display:flex; align-items:center; justify-content:center;">
                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="#94a3b8" fill="none" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                    </td>
                    <td><span class="table-title">{{ $member->name }}</span></td>
                    <td style="font-size: 12px;">{{ $member->title ?? '—' }}</td>
                    <td style="font-size: 12px; text-transform: capitalize;">{{ $member->type }}</td>
                    <td style="font-size: 13px;">{{ $member->order }}</td>
                    <td>
                        @if($member->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-name="{{ $member->name }}"
                                data-title="{{ $member->title }}"
                                data-type="{{ $member->type }}"
                                data-bio="{{ $member->bio }}"
                                data-photo="{{ $member->photo ? asset('storage/' . $member->photo) : '' }}"
                                data-order="{{ $member->order }}"
                                data-is_active="{{ $member->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $member->id }}"
                                data-name="{{ $member->name }}"
                                data-title="{{ $member->title }}"
                                data-role="{{ $member->role }}"
                                data-type="{{ $member->type }}"
                                data-quote="{{ $member->quote }}"
                                data-bio="{{ $member->bio }}"
                                data-order="{{ $member->order }}"
                                data-is_active="{{ $member->is_active ? '1' : '0' }}"
                                data-image-url="{{ $member->photo ? asset('storage/' . $member->photo) : '' }}"
                                data-image-page-url="{{ $member->photo_page ? asset('storage/' . $member->photo_page) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-staff-{{ $member->id }}" action="{{ route('admin.staff.destroy', $member) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-staff-{{ $member->id }}" data-delete-name="ce membre" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($staff->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $staff->firstItem() }} à {{ $staff->lastItem() }} sur {{ $staff->total() }}
        </div>
        <div class="pagination-links">
            {{ $staff->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <h3>Aucun membre</h3>
        <p>Ajoutez les membres du personnel de la DGIE.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter un membre</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.staff.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div>
                    <h3>Nouveau membre</h3>
                    <p>Ajoutez un membre du personnel</p>
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
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="create-name">Nom <span class="required">*</span></label>
                                <input type="text" id="create-name" name="name" class="form-input" value="{{ old('_modal') == 'create' ? old('name') : '' }}" required placeholder="Nom complet">
                                @if(old('_modal') == 'create') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-title">Titre <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" placeholder="Ex: Directeur General">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-role">Fonction <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-role" name="role" class="form-input" value="{{ old('_modal') == 'create' ? old('role') : '' }}" placeholder="Ex: Directeur de la DAOSAR">
                                @if(old('_modal') == 'create') @error('role') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-type">Type <span class="required">*</span></label>
                                <select id="create-type" name="type" class="form-select" required>
                                    <option value="">Selectionner un type</option>
                                    <option value="ministre" {{ old('_modal') == 'create' && old('type') == 'ministre' ? 'selected' : '' }}>Ministre</option>
                                    <option value="dg" {{ old('_modal') == 'create' && old('type') == 'dg' ? 'selected' : '' }}>Directeur General</option>
                                    <option value="directeur" {{ old('_modal') == 'create' && old('type') == 'directeur' ? 'selected' : '' }}>Directeur</option>
                                    <option value="autre" {{ old('_modal') == 'create' && old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @if(old('_modal') == 'create') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-quote">Citation <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-quote" name="quote" class="form-textarea" rows="3" maxlength="1000" placeholder="Citation ou message du membre">{{ old('_modal') == 'create' ? old('quote') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('quote') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-bio">Biographie <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-bio" name="bio" class="form-textarea wysiwyg" rows="5" placeholder="Biographie du membre">{{ old('_modal') == 'create' ? old('bio') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('bio') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PHOTO (ACCUEIL)</div>
                            <label for="create-photo" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-photo-placeholder">
                                    <span>Aucune photo selectionnee</span>
                                    <small>Affichée sur la page d'accueil</small>
                                </div>
                            </label>
                            <input type="file" id="create-photo" name="photo" accept="image/*" style="display:none" onchange="previewImage(this, 'create-photo-placeholder')">
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('photo') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PHOTO (PAGE LA DGIE)</div>
                            <label for="create-photo-page" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-photo-page-placeholder">
                                    <span>Aucune photo selectionnee</span>
                                    <small>Affichée sur la page "Mot du DG"</small>
                                </div>
                            </label>
                            <input type="file" id="create-photo-page" name="photo_page" accept="image/*" style="display:none" onchange="previewImage(this, 'create-photo-page-placeholder')">
                            <span class="form-help">Optionnel — si vide, la photo accueil sera utilisée.</span>
                            @if(old('_modal') == 'create') @error('photo_page') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="create-order">Ordre d'affichage</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : '0' }}" min="0">
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/staff') }}">
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
                    <h3>Modifier le membre</h3>
                    <p>Modifiez les informations de ce membre</p>
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
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="edit-name">Nom <span class="required">*</span></label>
                                <input type="text" id="edit-name" name="name" class="form-input" value="{{ old('_modal') == 'edit' ? old('name') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-title">Titre <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}">
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-role">Fonction <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-role" name="role" class="form-input" value="{{ old('_modal') == 'edit' ? old('role') : '' }}">
                                @if(old('_modal') == 'edit') @error('role') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-type">Type <span class="required">*</span></label>
                                <select id="edit-type" name="type" class="form-select" required>
                                    <option value="">Selectionner un type</option>
                                    <option value="ministre" {{ old('_modal') == 'edit' && old('type') == 'ministre' ? 'selected' : '' }}>Ministre</option>
                                    <option value="dg" {{ old('_modal') == 'edit' && old('type') == 'dg' ? 'selected' : '' }}>Directeur General</option>
                                    <option value="directeur" {{ old('_modal') == 'edit' && old('type') == 'directeur' ? 'selected' : '' }}>Directeur</option>
                                    <option value="autre" {{ old('_modal') == 'edit' && old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @if(old('_modal') == 'edit') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-quote">Citation <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-quote" name="quote" class="form-textarea" rows="3" maxlength="1000">{{ old('_modal') == 'edit' ? old('quote') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('quote') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-bio">Biographie <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-bio" name="bio" class="form-textarea wysiwyg" rows="5">{{ old('_modal') == 'edit' ? old('bio') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('bio') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PHOTO (ACCUEIL)</div>
                            <label for="edit-photo" class="fp-image-upload">
                                <div id="edit-photo-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune photo selectionnee</span>
                                        <small>Affichée sur la page d'accueil</small>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-photo" name="photo" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-photo-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver la photo actuelle.</span>
                            @if(old('_modal') == 'edit') @error('photo') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PHOTO (PAGE LA DGIE)</div>
                            <label for="edit-photo-page" class="fp-image-upload">
                                <div id="edit-photo-page-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune photo selectionnee</span>
                                        <small>Affichée sur la page "Mot du DG"</small>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-photo-page" name="photo_page" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-photo-page-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver la photo actuelle.</span>
                            @if(old('_modal') == 'edit') @error('photo_page') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="edit-order">Ordre d'affichage</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                            </div>
                            <div class="form-group">
                                <label>Visibilite</label>
                                <label class="toggle-label">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" {{ old('_modal') == 'edit' && old('is_active') ? 'checked' : '' }}>
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
            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-role').value = btn.dataset.role || '';
            document.getElementById('edit-type').value = btn.dataset.type || '';
            document.getElementById('edit-quote').value = btn.dataset.quote || '';
            document.getElementById('edit-bio').value = btn.dataset.bio || '';
            document.getElementById('edit-order').value = btn.dataset.order || '0';

            var isActiveCheckbox = document.querySelector('#editModal input[name="is_active"][type="checkbox"]');
            if (isActiveCheckbox) isActiveCheckbox.checked = btn.dataset.is_active === '1';

            // Image preview in fullpage modal
            var placeholder = document.getElementById('edit-photo-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune photo selectionnee</span><small>Affichée sur la page d\'accueil</small></div>';
            }

            // Photo page preview
            var placeholderPage = document.getElementById('edit-photo-page-placeholder');
            if (btn.dataset.imagePageUrl) {
                placeholderPage.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imagePageUrl + '" alt=""></div>';
            } else {
                placeholderPage.innerHTML = '<div class="fp-image-placeholder"><span>Aucune photo selectionnee</span><small>Affichée sur la page "Mot du DG"</small></div>';
            }
        }
    });

    // View modal handler — rich preview
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var typeLabels = { ministre: 'Ministre', dg: 'Directeur Général', directeur: 'Directeur', autre: 'Autre' };
        var photoHtml = d.photo
            ? '<img src="' + d.photo + '" alt="" style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid rgba(255,255,255,0.3);">'
            : '<div class="art-show__avatar" style="width:120px;height:120px;font-size:40px;">' + (d.name ? d.name.charAt(0).toUpperCase() : 'P') + '</div>';
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
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:48px 32px 32px;background:linear-gradient(135deg,#1e293b,#0f172a);color:white;text-align:center;">'
            +   photoHtml
            +   '<h2 style="margin:20px 0 6px;font-size:24px;font-weight:700;">' + (d.name || '') + '</h2>'
            +   (d.title ? '<p style="opacity:0.8;font-size:15px;margin:0;max-width:500px;line-height:1.5;">' + d.title + '</p>' : '')
            + '</div>'
            + (d.bio ? '<div class="art-show__content" style="padding:24px 32px;">' + d.bio + '</div>' : '')
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
