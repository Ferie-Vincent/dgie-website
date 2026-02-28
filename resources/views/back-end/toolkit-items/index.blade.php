@extends('back-end.layouts.admin')

@section('title', 'Boîte à outils')
@section('breadcrumb', 'Boîte à outils')

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
        <h1 class="content-title">Boîte à outils</h1>
        <p class="content-subtitle">{{ $items->total() }} outil(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvel outil
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
</div>

{{-- Table --}}
<div class="admin-card">
    @if($items->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Ordre</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td><span class="table-title">{{ $item->title }}</span></td>
                    <td style="font-size: 12px; color: var(--admin-text-light);">{{ Str::limit($item->description, 50) }}</td>
                    <td style="font-size: 12px;">
                        @if($item->url)
                            <a href="{{ $item->url }}" target="_blank" style="color: var(--admin-primary);">{{ Str::limit($item->url, 30) }}</a>
                        @else
                            <span style="color: var(--admin-text-light);">&mdash;</span>
                        @endif
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
                                data-description="{{ $item->description }}"
                                data-icon_color="{{ $item->icon_color }}"
                                data-url="{{ $item->url }}"
                                data-order="{{ $item->order }}"
                                data-is_active="{{ $item->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-description="{{ $item->description }}"
                                data-icon_color="{{ $item->icon_color }}"
                                data-url="{{ $item->url }}"
                                data-order="{{ $item->order }}"
                                data-is_active="{{ $item->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-toolkit-{{ $item->id }}" action="{{ route('admin.toolkit-items.destroy', $item) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-toolkit-{{ $item->id }}" data-delete-name="cet outil" title="Supprimer" aria-label="Supprimer">
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
        <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        <h3>Aucun outil</h3>
        <p>Ajoutez votre premier outil pour la boîte à outils.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter un outil</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" action="{{ route('admin.toolkit-items.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #f97316)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <div>
                    <h3>Nouvel outil</h3>
                    <p>Ajoutez un outil pour la diaspora</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="create-title">Titre <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Titre de l'outil">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-description" name="description" class="form-textarea" rows="4" placeholder="Description de l'outil...">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-icon_color">Couleur de l'icone <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-icon_color" name="icon_color" class="form-input" value="{{ old('_modal') == 'create' ? old('icon_color') : '' }}" placeholder="Ex: #E8772A">
                                @if(old('_modal') == 'create') @error('icon_color') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-url">URL <span class="label-hint">Optionnel</span></label>
                                <input type="url" id="create-url" name="url" class="form-input" value="{{ old('_modal') == 'create' ? old('url') : '' }}" placeholder="https://...">
                                @if(old('_modal') == 'create') @error('url') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="create-order">Ordre d'affichage</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order') : '0' }}" min="0">
                                @if(old('_modal') == 'create') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                                <label>
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" id="create-is_active" name="is_active" value="1" {{ old('_modal') == 'create' ? (old('is_active') ? 'checked' : '') : 'checked' }} style="margin-right: 6px;">
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/toolkit-items') }}">
    <div class="admin-modal modal-fullpage modal-sm">
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #f97316)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                </div>
                <div>
                    <h3>Modifier l'outil</h3>
                    <p>Modifiez les informations de cet outil</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> INFORMATIONS</div>
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
                            <div class="form-group">
                                <label for="edit-icon_color">Couleur de l'icone <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-icon_color" name="icon_color" class="form-input" value="{{ old('_modal') == 'edit' ? old('icon_color') : '' }}" placeholder="Ex: #E8772A">
                                @if(old('_modal') == 'edit') @error('icon_color') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-url">URL <span class="label-hint">Optionnel</span></label>
                                <input type="url" id="edit-url" name="url" class="form-input" value="{{ old('_modal') == 'edit' ? old('url') : '' }}" placeholder="https://...">
                                @if(old('_modal') == 'edit') @error('url') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="edit-order">Ordre d'affichage</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                                @if(old('_modal') == 'edit') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                                <label>
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" id="edit-is_active" name="is_active" value="1" {{ old('_modal') == 'edit' ? (old('is_active') ? 'checked' : '') : '' }} style="margin-right: 6px;">
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
    // View modal handler — rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        const d = btn.dataset;
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:40px 32px;background:linear-gradient(135deg,#059669,#047857);color:white;text-align:center;">'
            +   '<svg viewBox="0 0 24 24" width="56" height="56" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>'
            +   '<h2 style="margin:20px 0 6px;font-size:22px;font-weight:700;">' + (d.title || '') + '</h2>'
            + '</div>'
            + (d.description ? '<div class="art-show__content" style="padding:24px 32px;">' + d.description + '</div>' : '')
            + (d.url && d.url !== '#' ? '<div style="padding:0 32px 24px;"><div style="display:flex;align-items:center;gap:8px;"><svg viewBox="0 0 24 24" width="16" height="16" stroke="var(--admin-primary)" fill="none" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><a href="' + d.url + '" target="_blank" style="color:var(--admin-primary);word-break:break-all;">' + d.url + '</a></div></div>' : '')
            + '</div>';
        showViewModal(null, null, html, true);
    });

    // Set _edit_id hidden field when opening edit modal
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-edit-btn]');
        if (btn) {
            const editIdField = document.querySelector('#editModal input[name="_edit_id"]');
            if (editIdField) editIdField.value = btn.dataset.id;
        }
    });
</script>
@endsection
