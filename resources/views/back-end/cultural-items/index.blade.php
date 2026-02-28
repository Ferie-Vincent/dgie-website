@extends('back-end.layouts.admin')

@section('title', 'Contenus culturels')
@section('breadcrumb', 'Contenus culturels')

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
        <h1 class="content-title">Contenus culturels</h1>
        <p class="content-subtitle">{{ $items->total() }} contenu(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau contenu
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher par titre..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="type" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="musique" {{ request('type') == 'musique' ? 'selected' : '' }}>Musique</option>
                <option value="livre" {{ request('type') == 'livre' ? 'selected' : '' }}>Livre</option>
                <option value="film" {{ request('type') == 'film' ? 'selected' : '' }}>Film</option>
                <option value="gastronomie" {{ request('type') == 'gastronomie' ? 'selected' : '' }}>Gastronomie</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($items->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Ordre</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="table-image" alt="">
                        @else
                            <span style="color: var(--admin-text-light);">&mdash;</span>
                        @endif
                    </td>
                    <td><span class="table-title">{{ Str::limit($item->title, 50) }}</span></td>
                    <td>
                        <span class="badge-status badge-publie">{{ ucfirst($item->type) }}</span>
                    </td>
                    <td style="font-size: 13px;">{{ $item->order }}</td>
                    <td>
                        @if($item->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-title="{{ $item->title }}"
                                data-type="{{ $item->type }}"
                                data-description="{{ $item->description }}"
                                data-order="{{ $item->order }}"
                                data-is_active="{{ $item->is_active ? '1' : '0' }}"
                                data-image="{{ $item->image ? asset('storage/' . $item->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $item->id }}"
                                data-type="{{ $item->type }}"
                                data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}"
                                data-order="{{ $item->order }}"
                                data-is_active="{{ $item->is_active ? '1' : '0' }}"
                                data-image-url="{{ $item->image ? asset('storage/' . $item->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-cultural-{{ $item->id }}" action="{{ route('admin.cultural-items.destroy', $item) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-cultural-{{ $item->id }}" data-delete-name="ce contenu culturel" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $items->firstItem() }} à {{ $items->lastItem() }} sur {{ $items->total() }}
        </div>
        <div class="pagination-links">
            {{ $items->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
        <h3>Aucun contenu culturel</h3>
        <p>Ajoutez votre premier contenu culturel.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter un contenu</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.cultural-items.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #ec4899, #f43f5e)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                </div>
                <div>
                    <h3>Nouvel element culturel</h3>
                    <p>Ajoutez un element culturel ivoirien</p>
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
                                <label for="create-type">Type <span class="required">*</span></label>
                                <select id="create-type" name="type" class="form-select" required>
                                    <option value="">Selectionner un type</option>
                                    <option value="musique" {{ old('_modal') == 'create' && old('type') == 'musique' ? 'selected' : '' }}>Musique</option>
                                    <option value="livre" {{ old('_modal') == 'create' && old('type') == 'livre' ? 'selected' : '' }}>Livre</option>
                                    <option value="film" {{ old('_modal') == 'create' && old('type') == 'film' ? 'selected' : '' }}>Film</option>
                                    <option value="gastronomie" {{ old('_modal') == 'create' && old('type') == 'gastronomie' ? 'selected' : '' }}>Gastronomie</option>
                                </select>
                                @if(old('_modal') == 'create') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-title">Titre <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Titre du contenu">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-description" name="description" class="form-textarea" rows="4" placeholder="Description du contenu culturel...">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
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
                            <input type="file" id="create-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')">
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/cultural-items') }}">
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
                    <h3>Modifier l'element</h3>
                    <p>Modifiez cet element culturel</p>
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
                                <label for="edit-type">Type <span class="required">*</span></label>
                                <select id="edit-type" name="type" class="form-select" required>
                                    <option value="">Selectionner un type</option>
                                    <option value="musique" {{ old('_modal') == 'edit' && old('type') == 'musique' ? 'selected' : '' }}>Musique</option>
                                    <option value="livre" {{ old('_modal') == 'edit' && old('type') == 'livre' ? 'selected' : '' }}>Livre</option>
                                    <option value="film" {{ old('_modal') == 'edit' && old('type') == 'film' ? 'selected' : '' }}>Film</option>
                                    <option value="gastronomie" {{ old('_modal') == 'edit' && old('type') == 'gastronomie' ? 'selected' : '' }}>Gastronomie</option>
                                </select>
                                @if(old('_modal') == 'edit') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-title">Titre <span class="required">*</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-description" name="description" class="form-textarea" rows="4">{{ old('_modal') == 'edit' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
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

            document.getElementById('edit-type').value = btn.dataset.type || '';
            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-description').value = btn.dataset.description || '';
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

    // View modal handler — rich preview
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var typeLabels = { musique: 'Musique', livre: 'Livre', film: 'Film', gastronomie: 'Gastronomie' };
        var typeIcons = { musique: '🎵', livre: '📚', film: '🎬', gastronomie: '🍽️' };
        var heroStyle = d.image ? ' style="background-image:url(\'' + d.image + '\')"' : '';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__hero"' + heroStyle + '>'
            +   '<div class="art-show__hero-overlay">'
            +     '<span class="art-show__category">' + (typeLabels[d.type] || d.type) + '</span>'
            +     '<h1 class="art-show__title">' + (d.title || '') + '</h1>'
            +   '</div>'
            + '</div>'
            + (d.description ? '<div class="art-show__content" style="padding:24px 32px;">' + d.description + '</div>' : '')
            + '<div class="art-show__tags"><span class="art-show__tags-label">Type :</span><span class="art-show__tag">' + (typeLabels[d.type] || d.type) + '</span></div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
