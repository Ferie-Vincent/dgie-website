@extends('back-end.layouts.admin')

@section('title', 'Pays')
@section('breadcrumb', 'Pays')

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
        <h1 class="content-title">Pays</h1>
        <p class="content-subtitle">{{ $countries->total() }} pays au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau pays
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un pays..." value="{{ request('search') }}">
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($countries->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Drapeau</th>
                    <th>Nom</th>
                    <th>Population</th>
                    <th>Ordre</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <td style="font-size: 24px;">{{ $country->flag_emoji ?? '—' }}</td>
                    <td><span class="table-title">{{ $country->name }}</span></td>
                    <td style="font-size: 12px; color: var(--admin-text-light);">{{ $country->population_label ?? '—' }}</td>
                    <td style="font-size: 13px;">{{ $country->order }}</td>
                    <td>
                        @if($country->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-name="{{ $country->name }}"
                                data-flag_emoji="{{ $country->flag_emoji }}"
                                data-population_label="{{ $country->population_label }}"
                                data-order="{{ $country->order }}"
                                data-is_active="{{ $country->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $country->id }}"
                                data-name="{{ $country->name }}"
                                data-flag_emoji="{{ $country->flag_emoji }}"
                                data-population_label="{{ $country->population_label }}"
                                data-order="{{ $country->order }}"
                                data-is_active="{{ $country->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-country-{{ $country->id }}" action="{{ route('admin.countries.destroy', $country) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-country-{{ $country->id }}" data-delete-name="ce pays" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($countries->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $countries->firstItem() }} à {{ $countries->lastItem() }} sur {{ $countries->total() }}
        </div>
        <div class="pagination-links">
            {{ $countries->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        <h3>Aucun pays</h3>
        <p>Commencez par ajouter un pays.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter un pays</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" action="{{ route('admin.countries.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <div>
                    <h3>Nouveau pays</h3>
                    <p>Ajoutez un pays de la diaspora</p>
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
                                <label for="create-name">Nom <span class="required">*</span></label>
                                <input type="text" id="create-name" name="name" class="form-input" value="{{ old('_modal') == 'create' ? old('name') : '' }}" required placeholder="Nom du pays">
                                @if(old('_modal') == 'create') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-flag_emoji">Drapeau (emoji) <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-flag_emoji" name="flag_emoji" class="form-input" value="{{ old('_modal') == 'create' ? old('flag_emoji') : '' }}" placeholder="Ex: &#x1F1E8;&#x1F1EE;" maxlength="10">
                                @if(old('_modal') == 'create') @error('flag_emoji') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-population_label">Population <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-population_label" name="population_label" class="form-input" value="{{ old('_modal') == 'create' ? old('population_label') : '' }}" placeholder="Ex: ~120 000 Ivoiriens">
                                @if(old('_modal') == 'create') @error('population_label') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="create-order">Ordre d'affichage <span class="label-hint">Optionnel</span></label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order') : '0' }}" min="0">
                                @if(old('_modal') == 'create') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-checkbox-row">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" id="create-is_active" name="is_active" value="1" {{ old('_modal') == 'create' ? (old('is_active') ? 'checked' : '') : 'checked' }}>
                                <label for="create-is_active">Actif</label>
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/countries') }}">
    <div class="admin-modal modal-fullpage modal-sm">
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #6366f1, #8b5cf6)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <div>
                    <h3>Modifier le pays</h3>
                    <p>Modifiez les informations de ce pays</p>
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
                                <label for="edit-name">Nom <span class="required">*</span></label>
                                <input type="text" id="edit-name" name="name" class="form-input" value="{{ old('_modal') == 'edit' ? old('name') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('name') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-flag_emoji">Drapeau (emoji) <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-flag_emoji" name="flag_emoji" class="form-input" value="{{ old('_modal') == 'edit' ? old('flag_emoji') : '' }}" maxlength="10">
                                @if(old('_modal') == 'edit') @error('flag_emoji') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-population_label">Population <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-population_label" name="population_label" class="form-input" value="{{ old('_modal') == 'edit' ? old('population_label') : '' }}">
                                @if(old('_modal') == 'edit') @error('population_label') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="edit-order">Ordre d'affichage <span class="label-hint">Optionnel</span></label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                                @if(old('_modal') == 'edit') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-checkbox-row">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" id="edit-is_active" name="is_active" value="1" {{ old('_modal') == 'edit' ? (old('is_active') ? 'checked' : '') : '' }}>
                                <label for="edit-is_active">Actif</label>
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
            + '<div style="display:flex;flex-direction:column;align-items:center;padding:48px 32px;background:linear-gradient(135deg,#1D8C4F,#166534);color:white;text-align:center;">'
            +   (d.flag_emoji ? '<span style="font-size:72px;line-height:1;">' + d.flag_emoji + '</span>' : '')
            +   '<h2 style="margin:20px 0 6px;font-size:24px;font-weight:700;">' + (d.name || '') + '</h2>'
            +   (d.population_label ? '<p style="opacity:0.8;font-size:15px;margin:0;">' + d.population_label + ' Ivoiriens</p>' : '')
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
