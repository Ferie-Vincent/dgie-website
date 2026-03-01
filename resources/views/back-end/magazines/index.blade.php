@extends('back-end.layouts.admin')

@section('title', 'Magazines')
@section('breadcrumb', 'Magazines')

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
        <h1 class="content-title">Magazines</h1>
        <p class="content-subtitle">{{ $magazines->total() }} magazine(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau magazine
    </button>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($magazines->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Couverture</th>
                    <th>Titre</th>
                    <th>Date de parution</th>
                    <th>PDF</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($magazines as $mag)
                <tr>
                    <td>
                        @if($mag->cover_image)
                            <img src="{{ asset('storage/' . $mag->cover_image) }}" class="table-image" alt="">
                        @else
                            <div class="table-image" style="display:flex; align-items:center; justify-content:center;">
                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="#94a3b8" fill="none" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            </div>
                        @endif
                    </td>
                    <td><span class="table-title">{{ $mag->title }}</span></td>
                    <td>{{ $mag->published_at ? $mag->published_at->isoFormat('MMM YYYY') : '—' }}</td>
                    <td>
                        @if($mag->pdf_file)
                            <a href="{{ asset('storage/' . $mag->pdf_file) }}" target="_blank" style="color: var(--admin-primary); font-size: 13px;">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                Voir le PDF
                            </a>
                        @else
                            <span style="color: var(--admin-text-light);">&mdash;</span>
                        @endif
                    </td>
                    <td>
                        @if($mag->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $mag->id }}"
                                data-title="{{ $mag->title }}"
                                data-published_at="{{ $mag->published_at ? $mag->published_at->format('Y-m-d') : '' }}"
                                data-description="{{ $mag->description }}"
                                data-order="{{ $mag->order }}"
                                data-is_active="{{ $mag->is_active ? '1' : '0' }}"
                                data-image-url="{{ $mag->cover_image ? asset('storage/' . $mag->cover_image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-magazine-{{ $mag->id }}" action="{{ route('admin.magazines.destroy', $mag) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-magazine-{{ $mag->id }}" data-delete-name="ce magazine" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($magazines->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $magazines->firstItem() }} à {{ $magazines->lastItem() }} sur {{ $magazines->total() }}
        </div>
        <div class="pagination-links">
            {{ $magazines->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        <h3>Aucun magazine</h3>
        <p>Ajoutez votre premier magazine / publication.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter un magazine</button>
    </div>
    @endif
</div>

{{-- Create Modal --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.magazines.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #1D8C4F, #059669)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                <div>
                    <h3>Nouveau magazine</h3>
                    <p>Ajoutez une publication avec couverture et PDF</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="create-title">Titre <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" placeholder="Titre du magazine" required>
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-published_at">Date de parution</label>
                                <input type="date" id="create-published_at" name="published_at" class="form-input" value="{{ old('_modal') == 'create' ? old('published_at') : '' }}">
                                @if(old('_modal') == 'create') @error('published_at') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description</label>
                                <textarea id="create-description" name="description" class="form-input" rows="4" maxlength="1000" placeholder="Bref descriptif du contenu du magazine...">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot bordeaux"></span> FICHIER PDF</div>
                            <div class="form-group">
                                <label for="create-pdf_file">Fichier PDF <span class="required">*</span></label>
                                <input type="file" id="create-pdf_file" name="pdf_file" class="form-input" accept=".pdf" required>
                                <span class="form-help">Format : PDF — Taille max : 20 Mo</span>
                                @if(old('_modal') == 'create') @error('pdf_file') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE DE COUVERTURE</div>
                            <label for="create-cover_image" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-image-placeholder">
                                    <span>Aucune image selectionnee</span>
                                </div>
                            </label>
                            <input type="file" id="create-cover_image" name="cover_image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')" required>
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 5 Mo</span>
                            @if(old('_modal') == 'create') @error('cover_image') <span class="form-error">{{ $message }}</span> @enderror @endif
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
                <div class="modal-fp-autosave"></div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Creer</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/magazines') }}">
    <div class="admin-modal modal-fullpage">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #059669, #f59e0b)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <div>
                    <h3>Modifier le magazine</h3>
                    <p>Modifiez cette publication</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="edit-title">Titre <span class="required">*</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-published_at">Date de parution</label>
                                <input type="date" id="edit-published_at" name="published_at" class="form-input" value="{{ old('_modal') == 'edit' ? old('published_at') : '' }}">
                                @if(old('_modal') == 'edit') @error('published_at') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Description</label>
                                <textarea id="edit-description" name="description" class="form-input" rows="4" maxlength="1000">{{ old('_modal') == 'edit' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot bordeaux"></span> FICHIER PDF</div>
                            <div class="form-group">
                                <label for="edit-pdf_file">Fichier PDF</label>
                                <input type="file" id="edit-pdf_file" name="pdf_file" class="form-input" accept=".pdf">
                                <span class="form-help">Laisser vide pour conserver le PDF actuel.</span>
                                @if(old('_modal') == 'edit') @error('pdf_file') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE DE COUVERTURE</div>
                            <label for="edit-cover_image" class="fp-image-upload">
                                <div id="edit-image-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune image selectionnee</span>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-cover_image" name="cover_image" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-image-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver l'image actuelle.</span>
                            @if(old('_modal') == 'edit') @error('cover_image') <span class="form-error">{{ $message }}</span> @enderror @endif
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
                <div class="modal-fp-autosave"></div>
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
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-edit-btn]');
        if (btn) {
            const editIdField = document.querySelector('#editModal input[name="_edit_id"]');
            if (editIdField) editIdField.value = btn.dataset.id;

            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-published_at').value = btn.dataset.published_at || '';
            document.getElementById('edit-description').value = btn.dataset.description || '';
            document.getElementById('edit-order').value = btn.dataset.order || '0';

            var isActiveCheckbox = document.getElementById('edit-is_active');
            if (isActiveCheckbox) isActiveCheckbox.checked = btn.dataset.is_active === '1';

            var placeholder = document.getElementById('edit-image-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image selectionnee</span></div>';
            }
        }
    });
</script>
@endsection
