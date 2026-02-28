@extends('back-end.layouts.admin')

@section('title', 'Catégories')
@section('breadcrumb', 'Catégories')

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
        <h1 class="content-title">Catégories</h1>
        <p class="content-subtitle">{{ $categories->count() }} catégorie(s)</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle catégorie
    </button>
</div>

<div class="admin-card">
    @if($categories->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Couleur</th>
                    <th>Articles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td><span class="table-title">{{ $category->name }}</span></td>
                    <td style="font-size: 12px; color: var(--text-400);">{{ $category->slug }}</td>
                    <td>
                        @if($category->color)
                            <span style="display:inline-block; padding: 2px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; background: var(--bg);">{{ $category->color }}</span>
                        @else
                            <span style="color: var(--text-400);">—</span>
                        @endif
                    </td>
                    <td><span style="font-size: 13px; font-weight: 600;">{{ $category->articles_count }}</span></td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-name="{{ $category->name }}"
                                data-color="{{ $category->color }}"
                                data-articles_count="{{ $category->articles_count }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $category->id }}"
                                data-name="{{ $category->name }}"
                                data-color="{{ $category->color }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-cat-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-cat-{{ $category->id }}" data-delete-name="cette catégorie" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
        <h3>Aucune catégorie</h3>
        <p>Créez votre première catégorie pour organiser vos articles.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Créer une catégorie</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #10b981, #059669)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                </div>
                <div>
                    <h3>Nouvelle categorie</h3>
                    <p>Ajoutez une categorie d'articles</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="create-name">Nom <span class="required">*</span></label>
                                <input type="text" id="create-name" name="name" class="form-input" value="{{ old('_modal') == 'create' ? old('name') : '' }}" required placeholder="Nom de la catégorie">
                                @if(old('_modal') == 'create') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-color">Classe CSS couleur <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-color" name="color" class="form-input" value="{{ old('_modal') == 'create' ? old('color') : '' }}" placeholder="Ex: tag--green, tag--orange">
                                <span class="form-help">Classe CSS utilisée pour le badge de la catégorie sur le site.</span>
                                @if(old('_modal') == 'create') @error('color') <span class="form-error">{{ $message }}</span> @enderror @endif
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/categories') }}">
    <div class="admin-modal modal-fullpage modal-sm">
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #10b981, #059669)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                </div>
                <div>
                    <h3>Modifier la categorie</h3>
                    <p>Modifiez les informations de cette categorie</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="edit-name">Nom <span class="required">*</span></label>
                                <input type="text" id="edit-name" name="name" class="form-input" value="{{ old('_modal') == 'edit' ? old('name') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-color">Classe CSS couleur <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-color" name="color" class="form-input" value="{{ old('_modal') == 'edit' ? old('color') : '' }}">
                                <span class="form-help">Classe CSS utilisée pour le badge de la catégorie sur le site.</span>
                                @if(old('_modal') == 'edit') @error('color') <span class="form-error">{{ $message }}</span> @enderror @endif
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
    // Set _edit_id hidden field when opening edit modal
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-edit-btn]');
        if (btn) {
            const editIdField = document.querySelector('#editModal input[name="_edit_id"]');
            if (editIdField) editIdField.value = btn.dataset.id;
        }
    });

    // View detail modal — rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="art-show__preview-label">Catégorie</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:40px 32px;background:linear-gradient(135deg,#E8772A,#c25e15);color:white;text-align:center;">'
            +   '<svg viewBox="0 0 24 24" width="56" height="56" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>'
            +   '<h2 style="margin:20px 0 6px;font-size:24px;font-weight:700;">' + (d.name || '') + '</h2>'
            +   '<p style="opacity:0.9;font-size:16px;margin:0;">' + (d.articles_count || 0) + ' article(s)</p>'
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
