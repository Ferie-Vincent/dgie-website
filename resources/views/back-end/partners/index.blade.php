@extends('back-end.layouts.admin')

@section('title', 'Partenaires')
@section('breadcrumb', 'Partenaires')

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
        <h1 class="content-title">Partenaires</h1>
        <p class="content-subtitle">{{ $partners->total() }} partenaire(s)</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau partenaire
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un partenaire..." value="{{ request('search') }}">
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($partners->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nom</th>
                    <th>Abréviation</th>
                    <th>URL</th>
                    <th>Ordre</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partners as $partner)
                <tr>
                    <td>
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" class="table-image" alt="">
                        @else
                            <div class="table-image" style="display:flex; align-items:center; justify-content:center;">
                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="#94a3b8" fill="none" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                    </td>
                    <td><span class="table-title">{{ $partner->name }}</span></td>
                    <td style="font-size: 12px;">{{ $partner->abbreviation ?? '—' }}</td>
                    <td style="font-size: 12px;">
                        @if($partner->url)
                            <a href="{{ $partner->url }}" target="_blank" style="color: var(--admin-primary);">{{ Str::limit($partner->url, 30) }}</a>
                        @else
                            —
                        @endif
                    </td>
                    <td style="font-size: 13px;">{{ $partner->order }}</td>
                    <td>
                        @if($partner->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-name="{{ $partner->name }}"
                                data-abbreviation="{{ $partner->abbreviation }}"
                                data-url="{{ $partner->url }}"
                                data-order="{{ $partner->order }}"
                                data-is_active="{{ $partner->is_active ? '1' : '0' }}"
                                data-image-url="{{ $partner->logo ? asset('storage/' . $partner->logo) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $partner->id }}"
                                data-name="{{ $partner->name }}"
                                data-abbreviation="{{ $partner->abbreviation }}"
                                data-url="{{ $partner->url }}"
                                data-order="{{ $partner->order }}"
                                data-is_active="{{ $partner->is_active ? '1' : '0' }}"
                                data-image-url="{{ $partner->logo ? asset('storage/' . $partner->logo) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-partner-{{ $partner->id }}" action="{{ route('admin.partners.destroy', $partner) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-partner-{{ $partner->id }}" data-delete-name="ce partenaire" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($partners->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $partners->firstItem() }} à {{ $partners->lastItem() }} sur {{ $partners->total() }}
        </div>
        <div class="pagination-links">
            {{ $partners->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <h3>Aucun partenaire</h3>
        <p>Ajoutez les partenaires de la DGIE.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter un partenaire</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <h3>Nouveau partenaire</h3>
                    <p>Ajoutez un partenaire institutionnel</p>
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
                                <input type="text" id="create-name" name="name" class="form-input" value="{{ old('_modal') == 'create' ? old('name') : '' }}" required placeholder="Nom du partenaire">
                                @if(old('_modal') == 'create') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-abbreviation">Abbreviation <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-abbreviation" name="abbreviation" class="form-input" value="{{ old('_modal') == 'create' ? old('abbreviation') : '' }}" placeholder="Ex: OIM, OFII">
                                @if(old('_modal') == 'create') @error('abbreviation') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-url">URL du site web <span class="label-hint">Optionnel</span></label>
                                <input type="url" id="create-url" name="url" class="form-input" value="{{ old('_modal') == 'create' ? old('url') : '' }}" placeholder="https://exemple.com">
                                @if(old('_modal') == 'create') @error('url') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> LOGO</div>
                            <label for="create-logo" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-image-placeholder">
                                    <span>Aucun logo selectionne</span>
                                    <small>Format carre recommande</small>
                                </div>
                            </label>
                            <input type="file" id="create-logo" name="logo" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')">
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('logo') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="create-order">Ordre d'affichage</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : 0 }}" min="0">
                            </div>
                            <div class="form-group">
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/partners') }}">
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
                    <h3>Modifier le partenaire</h3>
                    <p>Modifiez les informations de ce partenaire</p>
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
                                <label for="edit-abbreviation">Abbreviation <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-abbreviation" name="abbreviation" class="form-input" value="{{ old('_modal') == 'edit' ? old('abbreviation') : '' }}">
                                @if(old('_modal') == 'edit') @error('abbreviation') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-url">URL du site web <span class="label-hint">Optionnel</span></label>
                                <input type="url" id="edit-url" name="url" class="form-input" value="{{ old('_modal') == 'edit' ? old('url') : '' }}">
                                @if(old('_modal') == 'edit') @error('url') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> LOGO</div>
                            <label for="edit-logo" class="fp-image-upload">
                                <div id="edit-image-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucun logo selectionne</span>
                                        <small>Format carre recommande</small>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-logo" name="logo" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-image-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver le logo actuel.</span>
                            @if(old('_modal') == 'edit') @error('logo') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="edit-order">Ordre d'affichage</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                            </div>
                            <div class="form-group">
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

            document.getElementById('edit-name').value = btn.dataset.name || '';
            document.getElementById('edit-abbreviation').value = btn.dataset.abbreviation || '';
            document.getElementById('edit-url').value = btn.dataset.url || '';
            document.getElementById('edit-order').value = btn.dataset.order || '';
            document.getElementById('edit-is_active').checked = btn.dataset.is_active === '1';

            // Image preview in fullpage modal
            var placeholder = document.getElementById('edit-image-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucun logo selectionne</span><small>Format carre recommande</small></div>';
            }
        }
    });

    // View detail modal — rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        const d = btn.dataset;
        var logoHtml = d.imageUrl
            ? '<img src="' + d.imageUrl + '" alt="" style="max-width:160px;max-height:100px;object-fit:contain;">'
            : '<div style="width:100px;height:100px;border-radius:12px;background:var(--admin-bg-alt);display:flex;align-items:center;justify-content:center;font-size:36px;font-weight:700;color:var(--admin-primary);">' + (d.abbreviation || d.name ? (d.abbreviation || d.name).charAt(0).toUpperCase() : 'P') + '</div>';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:40px 32px;background:white;border-bottom:1px solid #e2e8f0;text-align:center;">'
            +   logoHtml
            +   '<h2 style="margin:20px 0 4px;font-size:22px;font-weight:700;color:var(--admin-text);">' + (d.name || '') + '</h2>'
            +   (d.abbreviation ? '<p style="color:var(--admin-text-light);font-size:14px;margin:0;">' + d.abbreviation + '</p>' : '')
            + '</div>'
            + '<div style="padding:24px 32px;">'
            +   (d.url ? '<div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;"><svg viewBox="0 0 24 24" width="16" height="16" stroke="var(--admin-primary)" fill="none" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><a href="' + d.url + '" target="_blank" style="color:var(--admin-primary);word-break:break-all;">' + d.url + '</a></div>' : '')
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
