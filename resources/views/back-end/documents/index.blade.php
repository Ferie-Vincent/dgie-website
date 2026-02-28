@extends('back-end.layouts.admin')

@section('title', 'Documents')
@section('breadcrumb', 'Documents')

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
        <h1 class="content-title">Documents</h1>
        <p class="content-subtitle">{{ $documents->total() }} document(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau document
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un document..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="type" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="juridique" {{ request('type') == 'juridique' ? 'selected' : '' }}>Juridique</option>
                <option value="rapport" {{ request('type') == 'rapport' ? 'selected' : '' }}>Rapport</option>
                <option value="organigramme" {{ request('type') == 'organigramme' ? 'selected' : '' }}>Organigramme</option>
                <option value="autre" {{ request('type') == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($documents->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Taille</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                <tr>
                    <td><span class="table-title">{{ Str::limit($document->title, 50) }}</span></td>
                    <td>
                        <span class="badge-status badge-{{ $document->type === 'juridique' ? 'publie' : ($document->type === 'rapport' ? 'brouillon' : 'archive') }}">
                            <span class="dot"></span>
                            {{ ucfirst($document->type) }}
                        </span>
                    </td>
                    <td style="font-size: 12px; white-space: nowrap;">{{ $document->file_size ?? '—' }}</td>
                    <td>
                        @if($document->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-title="{{ $document->title }}"
                                data-type="{{ $document->type }}"
                                data-description="{{ $document->description }}"
                                data-order="{{ $document->order }}"
                                data-is_active="{{ $document->is_active ? '1' : '0' }}"
                                data-file_info="{{ $document->file_path ? basename($document->file_path) . ' (' . $document->file_size . ')' : '' }}"
                                data-file_size="{{ $document->file_size }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $document->id }}"
                                data-title="{{ $document->title }}"
                                data-type="{{ $document->type }}"
                                data-description="{{ $document->description }}"
                                data-order="{{ $document->order }}"
                                data-is_active="{{ $document->is_active ? '1' : '0' }}"
                                data-file-info="{{ $document->file_path ? basename($document->file_path) . ' (' . $document->file_size . ')' : '' }}"
                                data-file-url="{{ $document->file_path ? asset('storage/' . $document->file_path) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-document-{{ $document->id }}" action="{{ route('admin.documents.destroy', $document) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                            <button class="action-btn delete" data-delete-form="delete-document-{{ $document->id }}" data-delete-name="ce document" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($documents->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $documents->firstItem() }} à {{ $documents->lastItem() }} sur {{ $documents->total() }}
        </div>
        <div class="pagination-links">
            {{ $documents->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        <h3>Aucun document</h3>
        <p>Commencez par ajouter votre premier document.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter un document</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                </div>
                <div>
                    <h3>Nouveau document</h3>
                    <p>Ajoutez un document officiel</p>
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
                                <label for="create-title">Titre <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Titre du document">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-description" name="description" class="form-textarea" rows="4" placeholder="Description du document (facultatif)">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> FICHIER</div>
                            <label for="create-file" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-file-placeholder">
                                    <span>Aucun fichier selectionne</span>
                                    <small>PDF, DOC, XLS acceptes</small>
                                </div>
                            </label>
                            <input type="file" id="create-file" name="file" style="display:none" required onchange="previewImage(this, 'create-file-placeholder')">
                            <span class="form-help">Tous types de fichiers acceptes. Max 10 Mo.</span>
                            @if(old('_modal') == 'create') @error('file') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> METADONNEES</div>
                            <div class="form-group">
                                <label for="create-type">Type <span class="required">*</span></label>
                                <select id="create-type" name="type" class="form-select" required>
                                    <option value="">Selectionner un type</option>
                                    <option value="juridique" {{ old('_modal') == 'create' && old('type') == 'juridique' ? 'selected' : '' }}>Juridique</option>
                                    <option value="rapport" {{ old('_modal') == 'create' && old('type') == 'rapport' ? 'selected' : '' }}>Rapport</option>
                                    <option value="organigramme" {{ old('_modal') == 'create' && old('type') == 'organigramme' ? 'selected' : '' }}>Organigramme</option>
                                    <option value="autre" {{ old('_modal') == 'create' && old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @if(old('_modal') == 'create') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-order">Ordre</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : '0' }}" min="0" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="create-is_active">Statut</label>
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
                    <button type="submit" class="btn btn-primary">Creer le document</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/documents') }}">
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
                    <h3>Modifier le document</h3>
                    <p>Modifiez les informations de ce document</p>
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
                            <div class="modal-fp-section-title"><span class="dot orange"></span> FICHIER</div>
                            <label for="edit-file" class="fp-image-upload">
                                <div id="edit-file-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucun fichier selectionne</span>
                                        <small>PDF, DOC, XLS acceptes</small>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-file" name="file" style="display:none" onchange="previewImage(this, 'edit-file-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver le fichier actuel. Max 10 Mo.</span>
                            @if(old('_modal') == 'edit') @error('file') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> METADONNEES</div>
                            <div class="form-group">
                                <label for="edit-type">Type <span class="required">*</span></label>
                                <select id="edit-type" name="type" class="form-select" required>
                                    <option value="">Selectionner un type</option>
                                    <option value="juridique" {{ old('_modal') == 'edit' && old('type') == 'juridique' ? 'selected' : '' }}>Juridique</option>
                                    <option value="rapport" {{ old('_modal') == 'edit' && old('type') == 'rapport' ? 'selected' : '' }}>Rapport</option>
                                    <option value="organigramme" {{ old('_modal') == 'edit' && old('type') == 'organigramme' ? 'selected' : '' }}>Organigramme</option>
                                    <option value="autre" {{ old('_modal') == 'edit' && old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @if(old('_modal') == 'edit') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-order">Ordre</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                            </div>
                            <div class="form-group">
                                <label for="edit-is_active">Statut</label>
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

            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-type').value = btn.dataset.type || '';
            document.getElementById('edit-description').value = btn.dataset.description || '';
            document.getElementById('edit-order').value = btn.dataset.order || '0';

            // Checkbox
            var isActiveCheck = document.querySelector('#editModal input[type="checkbox"][name="is_active"]');
            if (isActiveCheck) isActiveCheck.checked = btn.dataset.is_active === '1';

            // File preview in fullpage modal
            var placeholder = document.getElementById('edit-file-placeholder');
            if (btn.dataset.fileInfo) {
                placeholder.innerHTML = '<div class="fp-image-preview" style="padding: 16px; text-align: center;"><svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom:8px;opacity:0.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg><br><span style="font-size:13px;color:var(--admin-text-light)">' + btn.dataset.fileInfo + '</span></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucun fichier selectionne</span><small>PDF, DOC, XLS acceptes</small></div>';
            }
        }
    });

    // View detail modal — rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var typeIcon = { formulaire: '📋', guide: '📖', rapport: '📊', note: '📝' };
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +     (d.type ? '<span class="art-show__preview-label">' + d.type.charAt(0).toUpperCase() + d.type.slice(1) + '</span>' : '')
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:40px 32px;background:linear-gradient(135deg,#3b82f6,#6366f1);color:white;text-align:center;">'
            +   '<svg viewBox="0 0 24 24" width="64" height="64" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:0.9;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>'
            +   '<h2 style="margin:16px 0 6px;font-size:22px;font-weight:700;">' + (d.title || '') + '</h2>'
            +   (d.file_info ? '<p style="opacity:0.8;font-size:14px;margin:0;">' + d.file_info + '</p>' : '')
            + '</div>'
            + (d.description ? '<div class="art-show__content" style="padding:24px 32px;">' + d.description + '</div>' : '')
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
