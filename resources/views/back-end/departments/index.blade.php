@extends('back-end.layouts.admin')

@section('title', 'Sous-directions')
@section('breadcrumb', 'Sous-directions')

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
        <h1 class="content-title">Sous-directions</h1>
        <p class="content-subtitle">{{ $departments->total() }} sous-direction(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle sous-direction
    </button>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($departments->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Acronyme</th>
                    <th>Nom</th>
                    <th>Lien</th>
                    <th>Ordre</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                <tr>
                    <td><span class="table-title" style="font-weight: 600;">{{ $department->acronym }}</span></td>
                    <td style="font-size: 13px;">{{ Str::limit($department->name, 50) }}</td>
                    <td>
                        @if($department->link)
                            <a href="{{ $department->link }}" target="_blank" style="font-size: 12px; color: var(--admin-primary);">{{ Str::limit($department->link, 30) }}</a>
                        @else
                            <span style="font-size: 12px; color: var(--admin-text-light);">—</span>
                        @endif
                    </td>
                    <td style="font-size: 13px;">{{ $department->order }}</td>
                    <td>
                        @if($department->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-acronym="{{ $department->acronym }}"
                                data-name="{{ $department->name }}"
                                data-description="{{ $department->description }}"
                                data-icon="{{ $department->icon }}"
                                data-link="{{ $department->link }}"
                                data-order="{{ $department->order }}"
                                data-is_active="{{ $department->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $department->id }}"
                                data-acronym="{{ $department->acronym }}"
                                data-name="{{ $department->name }}"
                                data-description="{{ $department->description }}"
                                data-icon="{{ $department->icon }}"
                                data-link="{{ $department->link }}"
                                data-order="{{ $department->order }}"
                                data-is_active="{{ $department->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-department-{{ $department->id }}" action="{{ route('admin.departments.destroy', $department) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                            <button class="action-btn delete" data-delete-form="delete-department-{{ $department->id }}" data-delete-name="cette sous-direction" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($departments->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $departments->firstItem() }} à {{ $departments->lastItem() }} sur {{ $departments->total() }}
        </div>
        <div class="pagination-links">
            {{ $departments->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <h3>Aucune sous-direction</h3>
        <p>Commencez par ajouter votre première sous-direction.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter une sous-direction</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-md">
        <form method="POST" action="{{ route('admin.departments.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #6366f1, #4f46e5)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div>
                    <h3>Nouvelle direction</h3>
                    <p>Ajoutez une direction ou sous-direction</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="create-acronym">Acronyme <span class="required">*</span></label>
                                <input type="text" id="create-acronym" name="acronym" class="form-input" value="{{ old('_modal') == 'create' ? old('acronym') : '' }}" required placeholder="Ex: DAOSAR" maxlength="20">
                                @if(old('_modal') == 'create') @error('acronym') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-name">Nom complet <span class="required">*</span></label>
                                <input type="text" id="create-name" name="name" class="form-input" value="{{ old('_modal') == 'create' ? old('name') : '' }}" required placeholder="Nom complet de la sous-direction">
                                @if(old('_modal') == 'create') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-description" name="description" class="form-textarea wysiwyg" rows="4" placeholder="Description des missions de la sous-direction...">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-icon">Icone <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-icon" name="icon" class="form-input" value="{{ old('_modal') == 'create' ? old('icon') : '' }}" placeholder="Ex: fa-building ou classe CSS">
                                <span class="form-help">Classe CSS d'icone (FontAwesome, etc.)</span>
                                @if(old('_modal') == 'create') @error('icon') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-link">Lien <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-link" name="link" class="form-input" value="{{ old('_modal') == 'create' ? old('link') : '' }}" placeholder="URL ou chemin vers la page">
                                @if(old('_modal') == 'create') @error('link') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="create-order">Ordre</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : 0 }}" min="0" placeholder="0">
                            </div>
                            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                                <label>
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1" {{ old('_modal') == 'create' ? (old('is_active') ? 'checked' : '') : 'checked' }} style="margin-right: 6px;">
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/departments') }}">
    <div class="admin-modal modal-fullpage modal-md">
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #6366f1, #4f46e5)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div>
                    <h3>Modifier la direction</h3>
                    <p>Modifiez les informations de cette direction</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS</div>
                            <div class="form-group">
                                <label for="edit-acronym">Acronyme <span class="required">*</span></label>
                                <input type="text" id="edit-acronym" name="acronym" class="form-input" value="{{ old('_modal') == 'edit' ? old('acronym') : '' }}" required maxlength="20">
                                @if(old('_modal') == 'edit') @error('acronym') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-name">Nom complet <span class="required">*</span></label>
                                <input type="text" id="edit-name" name="name" class="form-input" value="{{ old('_modal') == 'edit' ? old('name') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-description" name="description" class="form-textarea wysiwyg" rows="4">{{ old('_modal') == 'edit' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-icon">Icone <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-icon" name="icon" class="form-input" value="{{ old('_modal') == 'edit' ? old('icon') : '' }}" placeholder="Ex: fa-building ou classe CSS">
                                <span class="form-help">Classe CSS d'icone (FontAwesome, etc.)</span>
                                @if(old('_modal') == 'edit') @error('icon') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-link">Lien <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-link" name="link" class="form-input" value="{{ old('_modal') == 'edit' ? old('link') : '' }}" placeholder="URL ou chemin vers la page">
                                @if(old('_modal') == 'edit') @error('link') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="edit-order">Ordre</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
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
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:40px 32px;background:linear-gradient(135deg,#1e293b,#334155);color:white;text-align:center;">'
            +   '<div style="font-size:32px;font-weight:800;background:rgba(232,119,42,0.2);color:#E8772A;width:80px;height:80px;border-radius:16px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">' + (d.acronym || '?') + '</div>'
            +   '<h2 style="margin:0 0 6px;font-size:22px;font-weight:700;">' + (d.name || '') + '</h2>'
            +   (d.acronym ? '<p style="opacity:0.7;font-size:14px;margin:0;">' + d.acronym + '</p>' : '')
            + '</div>'
            + (d.description ? '<div class="art-show__content" style="padding:24px 32px;">' + d.description + '</div>' : '')
            + (d.link ? '<div style="padding:0 32px 24px;"><div style="display:flex;align-items:center;gap:8px;"><svg viewBox="0 0 24 24" width="16" height="16" stroke="var(--admin-primary)" fill="none" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><a href="' + d.link + '" target="_blank" style="color:var(--admin-primary)">' + d.link + '</a></div></div>' : '')
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
