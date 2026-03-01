@extends('back-end.layouts.admin')

@section('title', 'Flash Infos')
@section('breadcrumb', 'Flash Infos')

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
        <h1 class="content-title">Flash Infos</h1>
        <p class="content-subtitle">Messages défilants du bandeau</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau flash info
    </button>
</div>

<div class="admin-card">
    @if($flashInfos->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Contenu</th>
                    <th>Ordre</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flashInfos as $flash)
                <tr>
                    <td><span class="table-title">{{ Str::limit($flash->content, 70) }}</span></td>
                    <td style="font-size: 13px;">{{ $flash->order }}</td>
                    <td>
                        @if($flash->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-content="{{ $flash->content }}"
                                data-order="{{ $flash->order }}"
                                data-is_active="{{ $flash->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $flash->id }}"
                                data-content="{{ $flash->content }}"
                                data-order="{{ $flash->order }}"
                                data-is_active="{{ $flash->is_active ? '1' : '0' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-flash-{{ $flash->id }}" action="{{ route('admin.flash-infos.destroy', $flash) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-flash-{{ $flash->id }}" data-delete-name="ce flash info" title="Supprimer" aria-label="Supprimer">
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
        <svg viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        <h3>Aucun flash info</h3>
        <p>Ajoutez des messages pour le bandeau défilant.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Créer un flash info</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" action="{{ route('admin.flash-infos.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #ef4444)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div>
                    <h3>Nouveau flash info</h3>
                    <p>Ajoutez un message defilant</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> CONTENU</div>
                            <div class="form-group">
                                <label for="create-content">Contenu <span class="required">*</span></label>
                                <textarea id="create-content" name="content" class="form-textarea" rows="3" required maxlength="500" placeholder="Message du flash info..." oninput="updateCounter(this, 'create-counter')">{{ old('_modal') == 'create' ? old('content') : '' }}</textarea>
                                <span class="form-hint" id="create-counter"><span>0</span>/500 caractères</span>
                                @if(old('_modal') == 'create') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> PARAMETRES</div>
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/flash-infos') }}">
    <div class="admin-modal modal-fullpage modal-sm">
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #ef4444)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div>
                    <h3>Modifier le flash info</h3>
                    <p>Modifiez ce message defilant</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> CONTENU</div>
                            <div class="form-group">
                                <label for="edit-content">Contenu <span class="required">*</span></label>
                                <textarea id="edit-content" name="content" class="form-textarea" rows="3" required maxlength="500" oninput="updateCounter(this, 'edit-counter')">{{ old('_modal') == 'edit' ? old('content') : '' }}</textarea>
                                <span class="form-hint" id="edit-counter"><span>0</span>/500 caractères</span>
                                @if(old('_modal') == 'edit') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> PARAMETRES</div>
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
    // Compteur de caractères
    function updateCounter(textarea, counterId) {
        const counter = document.getElementById(counterId);
        if (!counter) return;
        const span = counter.querySelector('span');
        const len = textarea.value.length;
        span.textContent = len;
        counter.style.color = len > 450 ? (len >= 500 ? '#ef4444' : '#f59e0b') : '';
    }

    // Init counters on page load
    document.addEventListener('DOMContentLoaded', function() {
        const createTA = document.getElementById('create-content');
        if (createTA && createTA.value) updateCounter(createTA, 'create-counter');
    });

    // Set _edit_id hidden field when opening edit modal + update counter
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-edit-btn]');
        if (btn) {
            const editIdField = document.querySelector('#editModal input[name="_edit_id"]');
            if (editIdField) editIdField.value = btn.dataset.id;
            // Update edit counter after content is populated
            setTimeout(function() {
                const editTA = document.getElementById('edit-content');
                if (editTA) updateCounter(editTA, 'edit-counter');
            }, 50);
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
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="display:flex;align-items:center;gap:16px;padding:32px;background:linear-gradient(135deg,#f59e0b,#d97706);color:white;">'
            +   '<svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>'
            +   '<div style="font-size:18px;font-weight:600;line-height:1.5;">' + (d.content || '') + '</div>'
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
