@extends('back-end.layouts.admin')

@section('title', 'Sondages')
@section('breadcrumb', 'Sondages')

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
        <h1 class="content-title">Sondages</h1>
        <p class="content-subtitle">{{ $polls->total() }} sondage(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouveau sondage
    </button>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($polls->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Nb options</th>
                    <th>Total votes</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($polls as $poll)
                <tr>
                    <td><span class="table-title">{{ Str::limit($poll->question, 60) }}</span></td>
                    <td style="font-size: 13px;">{{ $poll->options_count }}</td>
                    <td style="font-size: 13px;">{{ $poll->total_votes ?? 0 }}</td>
                    <td>
                        @if($poll->is_active)
                            <span class="badge-status badge-publie"><span class="dot"></span>Actif</span>
                        @else
                            <span class="badge-status badge-archive"><span class="dot"></span>Inactif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-question="{{ $poll->question }}"
                                data-options="{{ json_encode($poll->options->pluck('label')->toArray()) }}"
                                data-is_active="{{ $poll->is_active ? '1' : '0' }}"
                                data-total_votes="{{ $poll->total_votes ?? 0 }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $poll->id }}"
                                data-question="{{ $poll->question }}"
                                data-is_active="{{ $poll->is_active ? '1' : '0' }}"
                                data-options="{{ json_encode($poll->options->pluck('label')->toArray()) }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-poll-{{ $poll->id }}" action="{{ route('admin.polls.destroy', $poll) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                            <button class="action-btn delete" data-delete-form="delete-poll-{{ $poll->id }}" data-delete-name="ce sondage" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($polls->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $polls->firstItem() }} à {{ $polls->lastItem() }} sur {{ $polls->total() }}
        </div>
        <div class="pagination-links">
            {{ $polls->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
        <h3>Aucun sondage</h3>
        <p>Commencez par creer votre premier sondage.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Creer un sondage</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-md">
        <form method="POST" action="{{ route('admin.polls.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #8b5cf6, #6366f1)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
                <div>
                    <h3>Nouveau sondage</h3>
                    <p>Creez un nouveau sondage interactif</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> QUESTION</div>
                            <div class="form-group">
                                <label for="create-question">Question <span class="required">*</span></label>
                                <input type="text" id="create-question" name="question" class="form-input" value="{{ old('_modal') == 'create' ? old('question') : '' }}" required placeholder="Votre question de sondage">
                                @if(old('_modal') == 'create') @error('question') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> OPTIONS DE REPONSE</div>
                            <div style="display: flex; justify-content: flex-end; margin-bottom: 12px;">
                                <button type="button" id="createAddOptionBtn" class="btn btn-outline" style="font-size: 13px; padding: 6px 12px;">
                                    <svg viewBox="0 0 24 24" style="width: 14px; height: 14px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    Ajouter une option
                                </button>
                            </div>
                            @if(old('_modal') == 'create')
                                @error('options') <span class="form-error" style="display:block; margin-bottom: 12px;">{{ $message }}</span> @enderror
                                @error('options.*') <span class="form-error" style="display:block; margin-bottom: 12px;">{{ $message }}</span> @enderror
                            @endif

                            <div id="createOptionsContainer">
                                @if(old('_modal') == 'create' && old('options'))
                                    @foreach(old('options') as $i => $opt)
                                    <div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                                        <input type="text" name="options[]" class="form-input" value="{{ $opt }}" required placeholder="Option..." style="flex: 1;">
                                        <button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">
                                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                                        <input type="text" name="options[]" class="form-input" required placeholder="Option..." style="flex: 1;">
                                        <button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">
                                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                    <div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                                        <input type="text" name="options[]" class="form-input" required placeholder="Option..." style="flex: 1;">
                                        <button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">
                                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                                <label>
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/polls') }}">
    <div class="admin-modal modal-fullpage modal-md">
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #8b5cf6, #6366f1)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
                <div>
                    <h3>Modifier le sondage</h3>
                    <p>Modifiez ce sondage</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> QUESTION</div>
                            <div class="form-group">
                                <label for="edit-question">Question <span class="required">*</span></label>
                                <input type="text" id="edit-question" name="question" class="form-input" value="{{ old('_modal') == 'edit' ? old('question') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('question') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> OPTIONS DE REPONSE</div>
                            <div style="display: flex; justify-content: flex-end; margin-bottom: 12px;">
                                <button type="button" id="editAddOptionBtn" class="btn btn-outline" style="font-size: 13px; padding: 6px 12px;">
                                    <svg viewBox="0 0 24 24" style="width: 14px; height: 14px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                    Ajouter une option
                                </button>
                            </div>
                            @if(old('_modal') == 'edit')
                                @error('options') <span class="form-error" style="display:block; margin-bottom: 12px;">{{ $message }}</span> @enderror
                                @error('options.*') <span class="form-error" style="display:block; margin-bottom: 12px;">{{ $message }}</span> @enderror
                            @endif

                            <div id="editOptionsContainer">
                                @if(old('_modal') == 'edit' && old('options'))
                                    @foreach(old('options') as $i => $opt)
                                    <div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">
                                        <input type="text" name="options[]" class="form-input" value="{{ $opt }}" required placeholder="Option..." style="flex: 1;">
                                        <button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">
                                            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        </button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMETRES</div>
                            <div class="form-group" style="display:flex; align-items:end; padding-bottom: 4px;">
                                <label>
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
    // ========== Option row HTML helper ==========
    function createOptionRowHtml(value) {
        return '<div class="option-row" style="display: flex; gap: 8px; align-items: center; margin-bottom: 8px;">' +
            '<input type="text" name="options[]" class="form-input" required placeholder="Option..." style="flex: 1;" value="' + (value || '').replace(/"/g, '&quot;') + '">' +
            '<button type="button" class="action-btn delete remove-option-btn" title="Retirer" aria-label="Retirer" style="flex-shrink: 0;">' +
            '<svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>' +
            '</div>';
    }

    function updateRemoveButtons(container) {
        var rows = container.querySelectorAll('.option-row');
        rows.forEach(function(row) {
            var btn = row.querySelector('.remove-option-btn');
            if (btn) {
                btn.style.visibility = rows.length <= 2 ? 'hidden' : 'visible';
            }
        });
    }

    // ========== Create modal options ==========
    (function() {
        var container = document.getElementById('createOptionsContainer');
        var addBtn = document.getElementById('createAddOptionBtn');

        addBtn.addEventListener('click', function() {
            container.insertAdjacentHTML('beforeend', createOptionRowHtml(''));
            updateRemoveButtons(container);
        });

        container.addEventListener('click', function(e) {
            var btn = e.target.closest('.remove-option-btn');
            if (btn) {
                var rows = container.querySelectorAll('.option-row');
                if (rows.length > 2) {
                    btn.closest('.option-row').remove();
                    updateRemoveButtons(container);
                }
            }
        });

        updateRemoveButtons(container);
    })();

    // ========== Edit modal options ==========
    (function() {
        var container = document.getElementById('editOptionsContainer');
        var addBtn = document.getElementById('editAddOptionBtn');

        addBtn.addEventListener('click', function() {
            container.insertAdjacentHTML('beforeend', createOptionRowHtml(''));
            updateRemoveButtons(container);
        });

        container.addEventListener('click', function(e) {
            var btn = e.target.closest('.remove-option-btn');
            if (btn) {
                var rows = container.querySelectorAll('.option-row');
                if (rows.length > 2) {
                    btn.closest('.option-row').remove();
                    updateRemoveButtons(container);
                }
            }
        });

        updateRemoveButtons(container);
    })();

    // ========== Populate edit modal on edit button click ==========
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-edit-btn]');
        if (!btn) return;

        // Set _edit_id hidden field
        var editIdField = document.querySelector('#editModal input[name="_edit_id"]');
        if (editIdField) editIdField.value = btn.dataset.id;

        // Populate is_active checkbox
        var isActiveCheckbox = document.getElementById('edit-is_active');
        if (isActiveCheckbox) {
            isActiveCheckbox.checked = btn.dataset.is_active === '1';
        }

        // Populate options from data-options JSON
        var container = document.getElementById('editOptionsContainer');
        container.innerHTML = '';

        try {
            var options = JSON.parse(btn.dataset.options);
            if (options && options.length > 0) {
                options.forEach(function(label) {
                    container.insertAdjacentHTML('beforeend', createOptionRowHtml(label));
                });
            } else {
                // Fallback: at least 2 empty options
                container.insertAdjacentHTML('beforeend', createOptionRowHtml(''));
                container.insertAdjacentHTML('beforeend', createOptionRowHtml(''));
            }
        } catch(err) {
            container.insertAdjacentHTML('beforeend', createOptionRowHtml(''));
            container.insertAdjacentHTML('beforeend', createOptionRowHtml(''));
        }

        updateRemoveButtons(container);
    });

    // View modal handler — rich preview
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var optionsHtml = '';
        try {
            var options = JSON.parse(d.options);
            if (options && options.length > 0) {
                options.forEach(function(opt) {
                    optionsHtml += '<div style="padding:12px 16px;background:var(--admin-bg-alt);border-radius:8px;margin-bottom:8px;font-size:14px;border:1px solid #e2e8f0;">' + opt + '</div>';
                });
            }
        } catch(err) {}
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +     '<span class="art-show__preview-label">' + (d.total_votes || 0) + ' vote(s)</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="padding:32px;border-bottom:1px solid #e2e8f0;">'
            +   '<h3 style="font-size:20px;font-weight:700;color:var(--admin-text);margin:0;line-height:1.4;">' + (d.question || '') + '</h3>'
            + '</div>'
            + '<div style="padding:24px 32px;">'
            +   '<div style="font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--admin-primary);margin-bottom:12px;">Options de réponse</div>'
            +   optionsHtml
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
