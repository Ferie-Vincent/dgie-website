@extends('back-end.layouts.admin')

@section('title', 'Bannières')
@section('breadcrumb', 'Bannières')

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
        <h1 class="content-title">Bannières</h1>
        <p class="content-subtitle">{{ $banners->total() }} bannière(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle bannière
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <select name="position" onchange="this.form.submit()">
                <option value="">Toutes les positions</option>
                <option value="top" {{ request('position') == 'top' ? 'selected' : '' }}>Top</option>
                <option value="sidebar" {{ request('position') == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                <option value="popup" {{ request('position') == 'popup' ? 'selected' : '' }}>Popup</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($banners->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Position</th>
                    <th>URL</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr>
                    <td>
                        @if($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" class="table-image" alt="">
                        @else
                            <div class="table-image" style="display:flex; align-items:center; justify-content:center;">
                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="#94a3b8" fill="none" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                    </td>
                    <td><span class="table-title">{{ $banner->title ?? '—' }}</span></td>
                    <td>
                        <span class="badge-status badge-publie">{{ ucfirst($banner->position) }}</span>
                    </td>
                    <td style="font-size: 12px;">
                        @if($banner->url)
                            <a href="{{ $banner->url }}" target="_blank" style="color: var(--admin-primary);">{{ Str::limit($banner->url, 30) }}</a>
                        @else
                            <span style="color: var(--admin-text-light);">&mdash;</span>
                        @endif
                    </td>
                    <td>
                        @if($banner->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-title="{{ $banner->title }}"
                                data-position="{{ $banner->position }}"
                                data-url="{{ $banner->url }}"
                                data-alt_text="{{ $banner->alt_text }}"
                                data-order="{{ $banner->order }}"
                                data-is_active="{{ $banner->is_active ? '1' : '0' }}"
                                data-image-url="{{ $banner->image ? asset('storage/' . $banner->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $banner->id }}"
                                data-title="{{ $banner->title }}"
                                data-position="{{ $banner->position }}"
                                data-url="{{ $banner->url }}"
                                data-alt_text="{{ $banner->alt_text }}"
                                data-order="{{ $banner->order }}"
                                data-is_active="{{ $banner->is_active ? '1' : '0' }}"
                                data-image-url="{{ $banner->image ? asset('storage/' . $banner->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-banner-{{ $banner->id }}" action="{{ route('admin.banners.destroy', $banner) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-banner-{{ $banner->id }}" data-delete-name="cette bannière" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($banners->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $banners->firstItem() }} à {{ $banners->lastItem() }} sur {{ $banners->total() }}
        </div>
        <div class="pagination-links">
            {{ $banners->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        <h3>Aucune bannière</h3>
        <p>Ajoutez votre première bannière publicitaire.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter une bannière</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #f97316)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <div>
                    <h3>Nouvelle banniere</h3>
                    <p>Ajoutez une banniere publicitaire</p>
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
                                <label for="create-title">Titre <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" placeholder="Titre de la banniere">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-alt_text">Texte alternatif <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-alt_text" name="alt_text" class="form-input" value="{{ old('_modal') == 'create' ? old('alt_text') : '' }}" placeholder="Description de l'image">
                                @if(old('_modal') == 'create') @error('alt_text') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-url">URL de destination <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-url" name="url" class="form-input" value="{{ old('_modal') == 'create' ? old('url') : '' }}" placeholder="https://...">
                                @if(old('_modal') == 'create') @error('url') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE</div>
                            <label for="create-image" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-image-placeholder">
                                    <span>Aucune image selectionnee</span>
                                </div>
                            </label>
                            <input type="file" id="create-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')" required>
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="create-position">Position <span class="required">*</span></label>
                                <select id="create-position" name="position" class="form-select" required>
                                    <option value="">Selectionner une position</option>
                                    <option value="top" {{ old('_modal') == 'create' && old('position') == 'top' ? 'selected' : '' }}>Top</option>
                                    <option value="sidebar" {{ old('_modal') == 'create' && old('position') == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                    <option value="popup" {{ old('_modal') == 'create' && old('position') == 'popup' ? 'selected' : '' }}>Popup</option>
                                </select>
                                @if(old('_modal') == 'create') @error('position') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-order">Ordre d'affichage</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : 0 }}" min="0">
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/banners') }}">
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
                    <h3>Modifier la banniere</h3>
                    <p>Modifiez cette banniere</p>
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
                                <label for="edit-title">Titre <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" placeholder="Titre de la banniere">
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-alt_text">Texte alternatif <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-alt_text" name="alt_text" class="form-input" value="{{ old('_modal') == 'edit' ? old('alt_text') : '' }}" placeholder="Description de l'image">
                                @if(old('_modal') == 'edit') @error('alt_text') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-url">URL de destination <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-url" name="url" class="form-input" value="{{ old('_modal') == 'edit' ? old('url') : '' }}" placeholder="https://...">
                                @if(old('_modal') == 'edit') @error('url') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE</div>
                            <label for="edit-image" class="fp-image-upload">
                                <div id="edit-image-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune image selectionnee</span>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-image-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver l'image actuelle.</span>
                            @if(old('_modal') == 'edit') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="edit-position">Position <span class="required">*</span></label>
                                <select id="edit-position" name="position" class="form-select" required>
                                    <option value="">Selectionner une position</option>
                                    <option value="top" {{ old('_modal') == 'edit' && old('position') == 'top' ? 'selected' : '' }}>Top</option>
                                    <option value="sidebar" {{ old('_modal') == 'edit' && old('position') == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                    <option value="popup" {{ old('_modal') == 'edit' && old('position') == 'popup' ? 'selected' : '' }}>Popup</option>
                                </select>
                                @if(old('_modal') == 'edit') @error('position') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-order">Ordre d'affichage</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
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

            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-alt_text').value = btn.dataset.alt_text || '';
            document.getElementById('edit-url').value = btn.dataset.url || '';
            document.getElementById('edit-position').value = btn.dataset.position || '';
            document.getElementById('edit-order').value = btn.dataset.order || '0';

            var isActiveCheckbox = document.getElementById('edit-is_active');
            if (isActiveCheckbox) isActiveCheckbox.checked = btn.dataset.is_active === '1';

            // Image preview in fullpage modal
            var placeholder = document.getElementById('edit-image-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image selectionnee</span></div>';
            }
        }
    });

    // View detail modal — rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        const d = btn.dataset;
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +     '<span class="art-show__preview-label">Position : ' + (d.position ? d.position.charAt(0).toUpperCase() + d.position.slice(1) : '—') + '</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + (d.imageUrl ? '<div style="padding:0;"><img src="' + d.imageUrl + '" alt="" style="width:100%;max-height:400px;object-fit:cover;display:block;"></div>' : '')
            + '<div style="padding:24px 32px;">'
            +   '<h3 style="font-size:18px;font-weight:700;margin:0 0 16px;">' + (d.title || 'Sans titre') + '</h3>'
            +   (d.alt_text ? '<p style="color:var(--admin-text-light);font-size:14px;margin:0 0 12px;">' + d.alt_text + '</p>' : '')
            +   (d.url ? '<div style="display:flex;align-items:center;gap:8px;"><svg viewBox="0 0 24 24" width="16" height="16" stroke="var(--admin-primary)" fill="none" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><a href="' + d.url + '" target="_blank" style="color:var(--admin-primary);word-break:break-all;">' + d.url + '</a></div>' : '')
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
