@extends('back-end.layouts.admin')

@section('title', 'Dossiers')
@section('breadcrumb', 'Dossiers')

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
        <h1 class="content-title">Dossiers</h1>
        <p class="content-subtitle">{{ $dossiers->total() }} dossier(s)</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau dossier
    </button>
</div>

<div class="admin-card">
    @if($dossiers->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Sous-direction</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dossiers as $dossier)
                <tr>
                    <td>
                        <div class="table-title">{{ Str::limit($dossier->title, 50) }}</div>
                        <div class="table-excerpt">{{ Str::limit($dossier->description, 60) }}</div>
                    </td>
                    <td>
                        @if($dossier->department)
                            <span style="font-size: 12px; font-weight: 600;">{{ $dossier->department }}</span>
                        @else
                            <span style="color: var(--admin-text-muted); font-size: 12px;">—</span>
                        @endif
                    </td>
                    <td style="font-size: 13px;">{{ $dossier->order }}</td>
                    <td>
                        <span class="badge-status badge-{{ $dossier->status }}">
                            <span class="dot"></span>{{ ucfirst($dossier->status) }}
                        </span>
                    </td>
                    <td style="font-size: 12px; color: var(--admin-text-light);">{{ $dossier->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-id="{{ $dossier->id }}"
                                data-title="{{ $dossier->title }}"
                                data-description="{{ $dossier->description }}"
                                data-content="{{ $dossier->content }}"
                                data-department="{{ $dossier->department }}"
                                data-order="{{ $dossier->order }}"
                                data-status="{{ $dossier->status }}"
                                data-image-url="{{ $dossier->image ? asset('storage/'.$dossier->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $dossier->id }}"
                                data-title="{{ $dossier->title }}"
                                data-description="{{ $dossier->description }}"
                                data-content="{{ $dossier->content }}"
                                data-department="{{ $dossier->department }}"
                                data-order="{{ $dossier->order }}"
                                data-status="{{ $dossier->status }}"
                                data-image-url="{{ $dossier->image ? asset('storage/'.$dossier->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-dossier-{{ $dossier->id }}" action="{{ route('admin.dossiers.destroy', $dossier) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                            <button class="action-btn delete" data-delete-form="delete-dossier-{{ $dossier->id }}" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($dossiers->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">Affichage de {{ $dossiers->firstItem() }} à {{ $dossiers->lastItem() }} sur {{ $dossiers->total() }}</div>
        <div class="pagination-links">{{ $dossiers->links() }}</div>
    </div>
    @endif
    @else
    <div class="empty-state">
        <h3>Aucun dossier</h3>
        <p>Creez votre premier dossier thematique.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Creer un dossier</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.dossiers.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #3b82f6, #6366f1)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                </div>
                <div>
                    <h3>Nouveau dossier</h3>
                    <p>Creez un nouveau dossier thematique</p>
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
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS PRINCIPALES</div>
                            <div class="form-group">
                                <label for="create-title">Titre <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Titre du dossier">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description courte <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-description" name="description" class="form-textarea" rows="3" placeholder="Description courte du dossier">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> CONTENU DETAILLE</div>
                            <div class="form-group">
                                <label for="create-content">Contenu <span class="required">*</span></label>
                                <textarea id="create-content" name="content" class="form-textarea wysiwyg" rows="16" required placeholder="Contenu complet du dossier">{{ old('_modal') == 'create' ? old('content') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE DE COUVERTURE</div>
                            <label for="create-image" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-image-placeholder">
                                    <span>Aucune image selectionnee</span>
                                    <small>Format 16:9 recommande</small>
                                </div>
                            </label>
                            <input type="file" id="create-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')">
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> METADONNEES</div>
                            <div class="form-group">
                                <label for="create-department">Sous-direction <span class="label-hint">Optionnel</span></label>
                                <select id="create-department" name="department" class="form-select">
                                    <option value="">Aucune</option>
                                    <option value="DAOSAR" {{ old('_modal') == 'create' && old('department') == 'DAOSAR' ? 'selected' : '' }}>DAOSAR</option>
                                    <option value="DMCRIE" {{ old('_modal') == 'create' && old('department') == 'DMCRIE' ? 'selected' : '' }}>DMCRIE</option>
                                    <option value="DAS" {{ old('_modal') == 'create' && old('department') == 'DAS' ? 'selected' : '' }}>DAS</option>
                                    <option value="DGIE" {{ old('_modal') == 'create' && old('department') == 'DGIE' ? 'selected' : '' }}>DGIE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="create-status">Statut</label>
                                <select id="create-status" name="status" class="form-select">
                                    <option value="brouillon" {{ old('_modal') == 'create' && old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="publie" {{ old('_modal') == 'create' && old('status') == 'publie' ? 'selected' : '' }}>Publie</option>
                                    <option value="archive" {{ old('_modal') == 'create' && old('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="create-order">Ordre d'affichage</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : 0 }}" min="0">
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/dossiers') }}">
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
                    <h3>Modifier le dossier</h3>
                    <p>Modifiez les informations de ce dossier</p>
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
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS PRINCIPALES</div>
                            <div class="form-group">
                                <label for="edit-title">Titre <span class="required">*</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Description courte <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-description" name="description" class="form-textarea" rows="3">{{ old('_modal') == 'edit' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> CONTENU DETAILLE</div>
                            <div class="form-group">
                                <label for="edit-content">Contenu <span class="required">*</span></label>
                                <textarea id="edit-content" name="content" class="form-textarea wysiwyg" rows="16" required>{{ old('_modal') == 'edit' ? old('content') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE DE COUVERTURE</div>
                            <label for="edit-image" class="fp-image-upload">
                                <div id="edit-image-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune image selectionnee</span>
                                        <small>Format 16:9 recommande</small>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-image-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver l'image actuelle.</span>
                            @if(old('_modal') == 'edit') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> METADONNEES</div>
                            <div class="form-group">
                                <label for="edit-department">Sous-direction <span class="label-hint">Optionnel</span></label>
                                <select id="edit-department" name="department" class="form-select">
                                    <option value="">Aucune</option>
                                    <option value="DAOSAR" {{ old('_modal') == 'edit' && old('department') == 'DAOSAR' ? 'selected' : '' }}>DAOSAR</option>
                                    <option value="DMCRIE" {{ old('_modal') == 'edit' && old('department') == 'DMCRIE' ? 'selected' : '' }}>DMCRIE</option>
                                    <option value="DAS" {{ old('_modal') == 'edit' && old('department') == 'DAS' ? 'selected' : '' }}>DAS</option>
                                    <option value="DGIE" {{ old('_modal') == 'edit' && old('department') == 'DGIE' ? 'selected' : '' }}>DGIE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-status">Statut</label>
                                <select id="edit-status" name="status" class="form-select">
                                    <option value="brouillon" {{ old('_modal') == 'edit' && old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="publie" {{ old('_modal') == 'edit' && old('status') == 'publie' ? 'selected' : '' }}>Publie</option>
                                    <option value="archive" {{ old('_modal') == 'edit' && old('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-order">Ordre d'affichage</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave">Sauvegarde automatique activee</div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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

            // Populate fields
            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-description').value = btn.dataset.description || '';
            document.getElementById('edit-content').value = btn.dataset.content || '';
            document.getElementById('edit-department').value = btn.dataset.department || '';
            document.getElementById('edit-order').value = btn.dataset.order || '';
            document.getElementById('edit-status').value = btn.dataset.status || 'brouillon';

            // Image preview in fullpage modal
            var placeholder = document.getElementById('edit-image-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image selectionnee</span><small>Format 16:9 recommande</small></div>';
            }
        }
    });

    // View detail modal — BNC-style rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var statusClass = d.status || 'brouillon';
        var heroStyle = d.imageUrl ? ' style="background-image:url(\'' + d.imageUrl + '\')"' : '';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + statusClass + '"><span class="dot"></span>' + (d.status ? d.status.charAt(0).toUpperCase() + d.status.slice(1) : '') + '</span>'
            +     (d.department ? '<span class="art-show__preview-label">' + d.department + '</span>' : '')
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__hero"' + heroStyle + '>'
            +   '<div class="art-show__hero-overlay">'
            +     '<span class="art-show__category">Dossier</span>'
            +     '<h1 class="art-show__title">' + (d.title || '') + '</h1>'
            +   '</div>'
            + '</div>'
            + (d.description ? '<div class="art-show__excerpt">' + d.description + '</div>' : '')
            + (d.content ? '<div class="art-show__content" style="padding:24px 32px;">' + d.content + '</div>' : '')
            + '<div class="art-show__tags"><span class="art-show__tags-label">Sous-direction :</span>'
            +   (d.department ? '<span class="art-show__tag">' + d.department + '</span>' : '<span class="art-show__tag">Non spécifiée</span>')
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
