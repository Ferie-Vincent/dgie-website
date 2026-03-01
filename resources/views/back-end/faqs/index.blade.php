@extends('back-end.layouts.admin')

@section('title', 'FAQ')
@section('breadcrumb', 'FAQ')

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
        <h1 class="content-title">FAQ</h1>
        <p class="content-subtitle">{{ $faqs->total() }} question(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle FAQ
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher une question..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="type" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="App\Models\Dossier" {{ request('type') == 'App\Models\Dossier' ? 'selected' : '' }}>Dossier</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($faqs->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Reponse</th>
                    <th>Associe a</th>
                    <th>Ordre</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $faq)
                <tr>
                    <td>
                        <div class="table-title">{{ Str::limit($faq->question, 60) }}</div>
                    </td>
                    <td>
                        <span style="font-size: 12px;">{{ Str::limit($faq->answer, 40) }}</span>
                    </td>
                    <td>
                        <span style="font-size: 12px;">
                            @if($faq->faqable)
                                {{ class_basename($faq->faqable_type) }} : {{ Str::limit($faq->faqable->title, 30) }}
                            @else
                                <span style="color: var(--admin-text-light);">—</span>
                            @endif
                        </span>
                    </td>
                    <td>
                        <span style="font-size: 12px;">{{ $faq->order }}</span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-question="{{ $faq->question }}"
                                data-answer="{{ $faq->answer }}"
                                data-faqable_label="{{ $faq->faqable ? class_basename($faq->faqable_type) . ' : ' . $faq->faqable->title : '' }}"
                                data-order="{{ $faq->order }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $faq->id }}"
                                data-faqable_type="{{ $faq->faqable_type }}"
                                data-faqable_id="{{ $faq->faqable_id }}"
                                data-question="{{ $faq->question }}"
                                data-answer="{{ $faq->answer }}"
                                data-order="{{ $faq->order }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-faq-{{ $faq->id }}" action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-faq-{{ $faq->id }}" data-delete-name="cette FAQ" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($faqs->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $faqs->firstItem() }} à {{ $faqs->lastItem() }} sur {{ $faqs->total() }}
        </div>
        <div class="pagination-links">
            {{ $faqs->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <h3>Aucune FAQ</h3>
        <p>Commencez par creer votre premiere question/reponse.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Creer une FAQ</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-md">
        <form method="POST" action="{{ route('admin.faqs.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #f97316)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <div>
                    <h3>Nouvelle FAQ</h3>
                    <p>Ajoutez une question frequemment posee</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> QUESTION / REPONSE</div>
                            <div class="form-group">
                                <label for="create-question">Question <span class="required">*</span></label>
                                <textarea id="create-question" name="question" class="form-textarea" rows="3" required maxlength="500" placeholder="Saisissez la question">{{ old('_modal') == 'create' ? old('question') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('question') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-answer">Reponse <span class="required">*</span></label>
                                <textarea id="create-answer" name="answer" class="form-textarea wysiwyg" rows="6" required placeholder="Saisissez la reponse">{{ old('_modal') == 'create' ? old('answer') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('answer') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> RATTACHEMENT</div>
                            <div class="form-group">
                                <label for="create-faqable_type">Type de parent <span class="required">*</span></label>
                                <select id="create-faqable_type" name="faqable_type" class="form-select">
                                    <option value="">-- Selectionner --</option>
                                    <option value="App\Models\Dossier" {{ old('_modal') == 'create' && old('faqable_type') == 'App\Models\Dossier' ? 'selected' : '' }}>Dossier</option>
                                </select>
                                @if(old('_modal') == 'create') @error('faqable_type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>

                            <div class="form-group" id="create-dossiers-group" style="display:none;">
                                <label for="create-faqable_id_dossier">Dossier <span class="required">*</span></label>
                                <select id="create-faqable_id_dossier" name="" class="form-select">
                                    <option value="">-- Selectionner un dossier --</option>
                                    @foreach($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}" {{ old('_modal') == 'create' && old('faqable_id') == $dossier->id && old('faqable_type') == 'App\Models\Dossier' ? 'selected' : '' }}>{{ $dossier->title }}</option>
                                    @endforeach
                                </select>
                                @if(old('_modal') == 'create') @error('faqable_id') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>

                            <div class="form-group">
                                <label for="create-order">Ordre</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : 0 }}" min="0" placeholder="0">
                                @if(old('_modal') == 'create') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave">Sauvegarde automatique activee</div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Creer la FAQ</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/faqs') }}">
    <div class="admin-modal modal-fullpage modal-md">
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #f97316)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                </div>
                <div>
                    <h3>Modifier la FAQ</h3>
                    <p>Modifiez cette question-reponse</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> QUESTION / REPONSE</div>
                            <div class="form-group">
                                <label for="edit-question">Question <span class="required">*</span></label>
                                <textarea id="edit-question" name="question" class="form-textarea" rows="3" required maxlength="500">{{ old('_modal') == 'edit' ? old('question') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('question') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-answer">Reponse <span class="required">*</span></label>
                                <textarea id="edit-answer" name="answer" class="form-textarea wysiwyg" rows="6" required>{{ old('_modal') == 'edit' ? old('answer') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('answer') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> RATTACHEMENT</div>
                            <div class="form-group">
                                <label for="edit-faqable_type">Type de parent <span class="required">*</span></label>
                                <select id="edit-faqable_type" name="faqable_type" class="form-select">
                                    <option value="">-- Selectionner --</option>
                                    <option value="App\Models\Dossier" {{ old('_modal') == 'edit' && old('faqable_type') == 'App\Models\Dossier' ? 'selected' : '' }}>Dossier</option>
                                </select>
                                @if(old('_modal') == 'edit') @error('faqable_type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>

                            <div class="form-group" id="edit-dossiers-group" style="display:none;">
                                <label for="edit-faqable_id_dossier">Dossier <span class="required">*</span></label>
                                <select id="edit-faqable_id_dossier" name="" class="form-select">
                                    <option value="">-- Selectionner un dossier --</option>
                                    @foreach($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}" {{ old('_modal') == 'edit' && old('faqable_id') == $dossier->id ? 'selected' : '' }}>{{ $dossier->title }}</option>
                                    @endforeach
                                </select>
                                @if(old('_modal') == 'edit') @error('faqable_id') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>

                            <div class="form-group">
                                <label for="edit-order">Ordre</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                                @if(old('_modal') == 'edit') @error('order') <span class="form-error">{{ $message }}</span> @enderror @endif
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
    // ========== Faqable type toggle for BOTH modals ==========
    function toggleFaqableSelects(prefix) {
        var typeSelect = document.getElementById(prefix + '-faqable_type');
        var dossiersGroup = document.getElementById(prefix + '-dossiers-group');
        var dossierSelect = document.getElementById(prefix + '-faqable_id_dossier');

        if (!typeSelect) return;

        var val = typeSelect.value;

        if (val === 'App\\Models\\Dossier') {
            dossiersGroup.style.display = '';
            dossierSelect.name = 'faqable_id';
        } else {
            dossiersGroup.style.display = 'none';
            dossierSelect.name = '';
        }
    }

    // Attach change listeners for both modals
    var createTypeSelect = document.getElementById('create-faqable_type');
    var editTypeSelect = document.getElementById('edit-faqable_type');

    if (createTypeSelect) {
        createTypeSelect.addEventListener('change', function() {
            toggleFaqableSelects('create');
        });
    }

    if (editTypeSelect) {
        editTypeSelect.addEventListener('change', function() {
            toggleFaqableSelects('edit');
        });
    }

    // Initialize create modal toggle on page load (for old() values)
    toggleFaqableSelects('create');
    toggleFaqableSelects('edit');

    // ========== Set _edit_id and populate edit modal fields ==========
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-edit-btn]');
        if (!btn) return;

        var editIdField = document.querySelector('#editModal input[name="_edit_id"]');
        if (editIdField) editIdField.value = btn.dataset.id;

        // Populate faqable_type and trigger toggle
        var faqableType = btn.dataset.faqable_type;
        var faqableId = btn.dataset.faqable_id;

        var editTypeEl = document.getElementById('edit-faqable_type');
        if (editTypeEl) {
            editTypeEl.value = faqableType;
            toggleFaqableSelects('edit');

            // Now select the correct faqable_id
            if (faqableType === 'App\\Models\\Dossier') {
                document.getElementById('edit-faqable_id_dossier').value = faqableId;
            }
        }

        // Populate question and answer (textareas need special handling)
        document.getElementById('edit-question').value = btn.dataset.question;
        document.getElementById('edit-answer').value = btn.dataset.answer;
        document.getElementById('edit-order').value = btn.dataset.order;
    });

    // View detail modal — rich preview
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="art-show__preview-label">FAQ</span>'
            +     (d.faqable_label ? '<span class="art-show__preview-label">' + d.faqable_label + '</span>' : '')
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div style="padding:32px;border-bottom:1px solid #e2e8f0;">'
            +   '<h3 style="font-size:20px;font-weight:700;color:var(--admin-text);margin:0;line-height:1.4;">' + (d.question || '') + '</h3>'
            + '</div>'
            + '<div class="art-show__content" style="padding:24px 32px;">' + (d.answer || '—') + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
