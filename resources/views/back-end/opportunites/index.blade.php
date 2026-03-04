@extends('back-end.layouts.admin')

@section('title', 'Opportunités')
@section('breadcrumb', 'Opportunités')

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
        <h1 class="content-title">Opportunités</h1>
        <p class="content-subtitle">{{ $opportunites->total() }} opportunité(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle opportunité
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
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="type" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                <option value="emploi" {{ request('type') == 'emploi' ? 'selected' : '' }}>Emploi</option>
                <option value="investissement" {{ request('type') == 'investissement' ? 'selected' : '' }}>Investissement</option>
                <option value="formation" {{ request('type') == 'formation' ? 'selected' : '' }}>Formation</option>
                <option value="bourse" {{ request('type') == 'bourse' ? 'selected' : '' }}>Bourse</option>
                <option value="appel_a_projets" {{ request('type') == 'appel_a_projets' ? 'selected' : '' }}>Appel à projets</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($opportunites->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Organisme</th>
                    <th>Date limite</th>
                    <th>Vedette</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($opportunites as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="table-image" alt="">
                        @else
                            <span style="color: var(--admin-text-light);">&mdash;</span>
                        @endif
                    </td>
                    <td><span class="table-title">{{ Str::limit($item->title, 50) }}</span></td>
                    <td>
                        <span class="badge-oppo badge-oppo--{{ $item->type }}">{{ $item->type_label }}</span>
                    </td>
                    <td style="font-size: 13px;">{{ $item->organisme ?: '—' }}</td>
                    <td style="font-size: 13px;">
                        @if($item->date_limite)
                            <span style="{{ $item->is_expired ? 'color: var(--danger); font-weight: 600;' : '' }}">
                                {{ $item->date_limite->format('d/m/Y') }}
                            </span>
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        @if($item->is_featured)
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="#f59e0b" stroke="#f59e0b" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        @else
                            <span style="color: var(--admin-text-light);">&mdash;</span>
                        @endif
                    </td>
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
                                data-type="{{ $item->type }}"
                                data-type-label="{{ $item->type_label }}"
                                data-description="{{ $item->description }}"
                                data-organisme="{{ $item->organisme }}"
                                data-location="{{ $item->location }}"
                                data-url="{{ $item->url }}"
                                data-date_limite="{{ $item->date_limite ? $item->date_limite->format('d/m/Y') : '' }}"
                                data-is_active="{{ $item->is_active ? '1' : '0' }}"
                                data-is_featured="{{ $item->is_featured ? '1' : '0' }}"
                                data-image="{{ $item->image ? asset('storage/' . $item->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}"
                                data-type="{{ $item->type }}"
                                data-description="{{ $item->description }}"
                                data-content="{{ $item->content }}"
                                data-organisme="{{ $item->organisme }}"
                                data-location="{{ $item->location }}"
                                data-url="{{ $item->url }}"
                                data-date_limite="{{ $item->date_limite ? $item->date_limite->format('Y-m-d') : '' }}"
                                data-is_featured="{{ $item->is_featured ? '1' : '0' }}"
                                data-is_active="{{ $item->is_active ? '1' : '0' }}"
                                data-order="{{ $item->order }}"
                                data-image-url="{{ $item->image ? asset('storage/' . $item->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-oppo-{{ $item->id }}" action="{{ route('admin.opportunites.destroy', $item) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-oppo-{{ $item->id }}" data-delete-name="cette opportunité" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($opportunites->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $opportunites->firstItem() }} à {{ $opportunites->lastItem() }} sur {{ $opportunites->total() }}
        </div>
        <div class="pagination-links">
            {{ $opportunites->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
        <h3>Aucune opportunité</h3>
        <p>Ajoutez votre première opportunité pour la diaspora.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Ajouter une opportunité</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.opportunites.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
                <div>
                    <h3>Nouvelle opportunité</h3>
                    <p>Ajoutez une opportunité pour la diaspora</p>
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
                                <label for="create-title">Titre <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Titre de l'opportunité">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-type">Type <span class="required">*</span></label>
                                <select id="create-type" name="type" class="form-select" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="emploi" {{ old('_modal') == 'create' && old('type') == 'emploi' ? 'selected' : '' }}>Emploi</option>
                                    <option value="investissement" {{ old('_modal') == 'create' && old('type') == 'investissement' ? 'selected' : '' }}>Investissement</option>
                                    <option value="formation" {{ old('_modal') == 'create' && old('type') == 'formation' ? 'selected' : '' }}>Formation</option>
                                    <option value="bourse" {{ old('_modal') == 'create' && old('type') == 'bourse' ? 'selected' : '' }}>Bourse</option>
                                    <option value="appel_a_projets" {{ old('_modal') == 'create' && old('type') == 'appel_a_projets' ? 'selected' : '' }}>Appel à projets</option>
                                </select>
                                @if(old('_modal') == 'create') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description <span class="required">*</span></label>
                                <textarea id="create-description" name="description" class="form-textarea" rows="4" required placeholder="Description courte de l'opportunité...">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-content">Contenu détaillé <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-content" name="content" class="form-textarea wysiwyg" rows="6">{{ old('_modal') == 'create' ? old('content') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE</div>
                            <label for="create-image" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-image-placeholder">
                                    <span>Aucune image sélectionnée</span>
                                </div>
                            </label>
                            <input type="file" id="create-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')">
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot purple"></span> DÉTAILS</div>
                            <div class="form-group">
                                <label for="create-organisme">Organisme <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-organisme" name="organisme" class="form-input" value="{{ old('_modal') == 'create' ? old('organisme') : '' }}" placeholder="Ex: Ministère de l'Emploi">
                            </div>
                            <div class="form-group">
                                <label for="create-location">Localisation <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-location" name="location" class="form-input" value="{{ old('_modal') == 'create' ? old('location') : '' }}" placeholder="Ex: Abidjan, Côte d'Ivoire">
                            </div>
                            <div class="form-group">
                                <label for="create-url">Lien externe <span class="label-hint">Optionnel</span></label>
                                <input type="url" id="create-url" name="url" class="form-input" value="{{ old('_modal') == 'create' ? old('url') : '' }}" placeholder="https://...">
                            </div>
                            <div class="form-group">
                                <label for="create-date_limite">Date limite <span class="label-hint">Optionnel</span></label>
                                <input type="date" id="create-date_limite" name="date_limite" class="form-input" value="{{ old('_modal') == 'create' ? old('date_limite') : '' }}">
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMÈTRES</div>
                            <div class="form-group">
                                <label for="create-order">Ordre d'affichage</label>
                                <input type="number" id="create-order" name="order" class="form-input" value="{{ old('_modal') == 'create' ? old('order', 0) : 0 }}" min="0">
                            </div>
                            <div class="form-group">
                                <label>Mettre en vedette</label>
                                <label class="toggle-label">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('_modal') == 'create' && old('is_featured') ? 'checked' : '' }}>
                                    Vedette
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Visibilité</label>
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
                <div class="modal-fp-autosave">Sauvegarde automatique activée</div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/opportunites') }}">
    <div class="admin-modal modal-fullpage">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #ef4444)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <div>
                    <h3>Modifier l'opportunité</h3>
                    <p>Modifiez les informations de cette opportunité</p>
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
                                <label for="edit-title">Titre <span class="required">*</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-type">Type <span class="required">*</span></label>
                                <select id="edit-type" name="type" class="form-select" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="emploi" {{ old('_modal') == 'edit' && old('type') == 'emploi' ? 'selected' : '' }}>Emploi</option>
                                    <option value="investissement" {{ old('_modal') == 'edit' && old('type') == 'investissement' ? 'selected' : '' }}>Investissement</option>
                                    <option value="formation" {{ old('_modal') == 'edit' && old('type') == 'formation' ? 'selected' : '' }}>Formation</option>
                                    <option value="bourse" {{ old('_modal') == 'edit' && old('type') == 'bourse' ? 'selected' : '' }}>Bourse</option>
                                    <option value="appel_a_projets" {{ old('_modal') == 'edit' && old('type') == 'appel_a_projets' ? 'selected' : '' }}>Appel à projets</option>
                                </select>
                                @if(old('_modal') == 'edit') @error('type') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Description <span class="required">*</span></label>
                                <textarea id="edit-description" name="description" class="form-textarea" rows="4" required>{{ old('_modal') == 'edit' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-content">Contenu détaillé <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-content" name="content" class="form-textarea wysiwyg" rows="6">{{ old('_modal') == 'edit' ? old('content') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE</div>
                            <label for="edit-image" class="fp-image-upload">
                                <div id="edit-image-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune image sélectionnée</span>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-image-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver l'image actuelle.</span>
                            @if(old('_modal') == 'edit') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot purple"></span> DÉTAILS</div>
                            <div class="form-group">
                                <label for="edit-organisme">Organisme</label>
                                <input type="text" id="edit-organisme" name="organisme" class="form-input" value="{{ old('_modal') == 'edit' ? old('organisme') : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-location">Localisation</label>
                                <input type="text" id="edit-location" name="location" class="form-input" value="{{ old('_modal') == 'edit' ? old('location') : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-url">Lien externe</label>
                                <input type="url" id="edit-url" name="url" class="form-input" value="{{ old('_modal') == 'edit' ? old('url') : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-date_limite">Date limite</label>
                                <input type="date" id="edit-date_limite" name="date_limite" class="form-input" value="{{ old('_modal') == 'edit' ? old('date_limite') : '' }}">
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> PARAMÈTRES</div>
                            <div class="form-group">
                                <label for="edit-order">Ordre d'affichage</label>
                                <input type="number" id="edit-order" name="order" class="form-input" value="{{ old('_modal') == 'edit' ? old('order') : '' }}" min="0">
                            </div>
                            <div class="form-group">
                                <label>Mettre en vedette</label>
                                <label class="toggle-label">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" id="edit-is_featured" name="is_featured" value="1" {{ old('_modal') == 'edit' && old('is_featured') ? 'checked' : '' }}>
                                    Vedette
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Visibilité</label>
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
                <div class="modal-fp-autosave">Sauvegarde automatique activée</div>
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
    // Edit button handler
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-edit-btn]');
        if (btn) {
            const editIdField = document.querySelector('#editModal input[name="_edit_id"]');
            if (editIdField) editIdField.value = btn.dataset.id;

            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-type').value = btn.dataset.type || '';
            document.getElementById('edit-description').value = btn.dataset.description || '';
            document.getElementById('edit-content').value = btn.dataset.content || '';
            document.getElementById('edit-organisme').value = btn.dataset.organisme || '';
            document.getElementById('edit-location').value = btn.dataset.location || '';
            document.getElementById('edit-url').value = btn.dataset.url || '';
            document.getElementById('edit-date_limite').value = btn.dataset.date_limite || '';
            document.getElementById('edit-order').value = btn.dataset.order || '0';

            var isFeatured = document.getElementById('edit-is_featured');
            if (isFeatured) isFeatured.checked = btn.dataset.is_featured === '1';

            var isActive = document.getElementById('edit-is_active');
            if (isActive) isActive.checked = btn.dataset.is_active === '1';

            // Image preview
            var placeholder = document.getElementById('edit-image-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image sélectionnée</span></div>';
            }
        }
    });

    // View modal handler
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var heroStyle = d.image ? ' style="background-image:url(\'' + d.image + '\')"' : '';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + (d.is_active === '1' ? 'publie' : 'brouillon') + '"><span class="dot"></span>' + (d.is_active === '1' ? 'Actif' : 'Inactif') + '</span>'
            +     (d.is_featured === '1' ? ' <span class="badge-status badge-publie"><span class="dot"></span>Vedette</span>' : '')
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__hero"' + heroStyle + '>'
            +   '<div class="art-show__hero-overlay">'
            +     '<span class="art-show__category">' + (d.typeLabel || d.type) + '</span>'
            +     '<h1 class="art-show__title">' + (d.title || '') + '</h1>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__content" style="padding:24px 32px;">'
            +   '<p>' + (d.description || '') + '</p>'
            + '</div>'
            + '<div class="art-show__tags">'
            +   (d.organisme ? '<span class="art-show__tags-label">Organisme :</span><span class="art-show__tag">' + d.organisme + '</span>' : '')
            +   (d.location ? '<span class="art-show__tags-label">Lieu :</span><span class="art-show__tag">' + d.location + '</span>' : '')
            +   (d.date_limite ? '<span class="art-show__tags-label">Date limite :</span><span class="art-show__tag">' + d.date_limite + '</span>' : '')
            +   (d.url ? '<span class="art-show__tags-label">Lien :</span><a href="' + d.url + '" target="_blank" class="art-show__tag" style="color:var(--orange);">' + d.url + '</a>' : '')
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
