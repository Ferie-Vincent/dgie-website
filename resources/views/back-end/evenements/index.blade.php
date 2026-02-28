@extends('back-end.layouts.admin')

@section('title', 'Evenements')
@section('breadcrumb', 'Evenements')

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
        <h1 class="content-title">Evenements</h1>
        <p class="content-subtitle">{{ $evenements->total() }} evenement(s)</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvel evenement
    </button>
</div>

{{-- ========================================= --}}
{{-- SECTION 1 : Prochain Grand Rendez-vous    --}}
{{-- ========================================= --}}
<div class="evt-section-header">
    <div class="evt-section-bar"></div>
    <h2 class="evt-section-title">Prochain Grand Rendez-vous</h2>
    <span class="evt-section-badge">Bloc hero frontoffice</span>
</div>

@if($nextEvent)
<div class="evt-hero">
    <div class="evt-hero__image" style="background-image:url('{{ $nextEvent->image ? asset('storage/'.$nextEvent->image) : '' }}')">
        <div class="evt-hero__overlay">
            <span class="evt-hero__type-badge evt-hero__type-badge--{{ $nextEvent->section }}">
                {{ $nextEvent->section === 'diaspora' ? 'Diaspora' : 'General DGIE' }}
            </span>
            <h3 class="evt-hero__title">{{ $nextEvent->title }}</h3>
            <div class="evt-hero__info">
                <span class="evt-hero__info-item">
                    <svg viewBox="0 0 24 24" width="14" height="14"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    {{ $nextEvent->location ?? 'Non precise' }}
                </span>
                <span class="evt-hero__info-item">
                    <svg viewBox="0 0 24 24" width="14" height="14"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $nextEvent->event_date->locale('fr')->isoFormat('D MMMM YYYY') }}
                </span>
            </div>
        </div>
    </div>
    <div class="evt-hero__countdown-col">
        <p class="evt-hero__countdown-label">Debut de l'evenement dans</p>
        <div class="evt-countdown" data-event-date="{{ $nextEvent->event_date->toIso8601String() }}">
            <div class="evt-countdown__box">
                <div class="evt-countdown__value countdown-days">00</div>
                <div class="evt-countdown__unit">Jours</div>
            </div>
            <div class="evt-countdown__box">
                <div class="evt-countdown__value countdown-hours">00</div>
                <div class="evt-countdown__unit">Heures</div>
            </div>
            <div class="evt-countdown__box">
                <div class="evt-countdown__value countdown-minutes">00</div>
                <div class="evt-countdown__unit">Min</div>
            </div>
            <div class="evt-countdown__box">
                <div class="evt-countdown__value countdown-seconds">00</div>
                <div class="evt-countdown__unit">Sec</div>
            </div>
        </div>
        <p class="evt-hero__description">{{ Str::limit($nextEvent->description, 200) }}</p>
        <div class="evt-hero__actions">
            <button class="btn btn-sm btn-outline" data-edit-btn
                data-id="{{ $nextEvent->id }}"
                data-title="{{ $nextEvent->title }}"
                data-description="{{ $nextEvent->description }}"
                data-location="{{ $nextEvent->location }}"
                data-event_date="{{ $nextEvent->event_date->format('Y-m-d\TH:i') }}"
                data-end_date="{{ $nextEvent->end_date ? $nextEvent->end_date->format('Y-m-d\TH:i') : '' }}"
                data-is_featured="{{ $nextEvent->is_featured ? '1' : '0' }}"
                data-status="{{ $nextEvent->status }}"
                data-section="{{ $nextEvent->section }}"
                data-image-url="{{ $nextEvent->image ? asset('storage/'.$nextEvent->image) : '' }}">
                <svg viewBox="0 0 24 24" width="14" height="14"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Modifier le contenu
            </button>
        </div>
    </div>
</div>
@else
<div class="evt-hero-empty">
    <svg viewBox="0 0 24 24" width="48" height="48"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    <p>Aucun evenement a venir pour le moment</p>
    <button class="btn btn-primary btn-sm" data-open-create>Creer un evenement</button>
</div>
@endif

{{-- ========================================= --}}
{{-- SECTION 2 : Evenements recents (Realises) --}}
{{-- ========================================= --}}
@if($pastEvents->count() > 0)
<div class="evt-section-header" style="margin-top:32px;">
    <div class="evt-section-bar"></div>
    <h2 class="evt-section-title">Evenements recents (Realises)</h2>
    <span class="evt-section-hint">
        <svg viewBox="0 0 24 24" width="14" height="14"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        Bloc affiche dans l'onglet Realises sur le frontoffice
    </span>
</div>

<div class="evt-past-list">
    @foreach($pastEvents as $pastEvt)
    <article class="evt-past-card">
        <div class="evt-past-card__image" style="background-image:url('{{ $pastEvt->image ? asset('storage/'.$pastEvt->image) : '' }}')"></div>
        <div class="evt-past-card__body">
            <div class="evt-past-card__badges">
                <span class="evt-type-badge evt-type-badge--{{ $pastEvt->section }}">{{ $pastEvt->section === 'diaspora' ? 'Diaspora' : 'General' }}</span>
                <span class="evt-done-badge">
                    <svg viewBox="0 0 24 24" width="12" height="12"><polyline points="20 6 9 17 4 12"/></svg>
                    Termine
                </span>
                <span class="evt-past-card__date">{{ $pastEvt->event_date->locale('fr')->isoFormat('MMMM YYYY') }}</span>
            </div>
            <h3 class="evt-past-card__title">{{ $pastEvt->title }}</h3>
            <p class="evt-past-card__desc">{{ Str::limit($pastEvt->description, 150) }}</p>
        </div>
        <div class="evt-past-card__actions">
            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                data-edit-btn
                data-id="{{ $pastEvt->id }}"
                data-title="{{ $pastEvt->title }}"
                data-description="{{ $pastEvt->description }}"
                data-location="{{ $pastEvt->location }}"
                data-event_date="{{ $pastEvt->event_date->format('Y-m-d\TH:i') }}"
                data-end_date="{{ $pastEvt->end_date ? $pastEvt->end_date->format('Y-m-d\TH:i') : '' }}"
                data-is_featured="{{ $pastEvt->is_featured ? '1' : '0' }}"
                data-status="{{ $pastEvt->status }}"
                data-section="{{ $pastEvt->section }}"
                data-image-url="{{ $pastEvt->image ? asset('storage/'.$pastEvt->image) : '' }}">
                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </button>
            <form id="delete-past-{{ $pastEvt->id }}" action="{{ route('admin.evenements.destroy', $pastEvt) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
            <button class="action-btn delete" data-delete-form="delete-past-{{ $pastEvt->id }}" title="Supprimer" aria-label="Supprimer">
                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            </button>
        </div>
    </article>
    @endforeach
</div>
@endif

{{-- ========================================= --}}
{{-- SECTION 3 : Tous les evenements (tableau)  --}}
{{-- ========================================= --}}
<div class="evt-section-header" style="margin-top:32px;">
    <div class="evt-section-bar" style="background:var(--blue);"></div>
    <h2 class="evt-section-title">Tous les evenements</h2>
</div>

<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="status" onchange="this.form.submit()">
                <option value="">Tous les statuts</option>
                <option value="brouillon" {{ request('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                <option value="publie" {{ request('status') == 'publie' ? 'selected' : '' }}>Publie</option>
                <option value="archive" {{ request('status') == 'archive' ? 'selected' : '' }}>Archive</option>
            </select>
            <select name="section" onchange="this.form.submit()">
                <option value="">Toutes les sections</option>
                <option value="general" {{ request('section') == 'general' ? 'selected' : '' }}>General</option>
                <option value="diaspora" {{ request('section') == 'diaspora' ? 'selected' : '' }}>Diaspora</option>
            </select>
        </form>
    </div>
</div>

<div class="admin-card">
    @if($evenements->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Evenement</th>
                    <th>Section</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Vedette</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evenements as $event)
                <tr>
                    <td><span class="table-title">{{ Str::limit($event->title, 40) }}</span></td>
                    <td>
                        <span class="evt-type-badge evt-type-badge--{{ $event->section ?? 'general' }}">
                            {{ ($event->section ?? 'general') === 'diaspora' ? 'Diaspora' : 'General' }}
                        </span>
                    </td>
                    <td style="font-size: 12px; white-space: nowrap;">{{ $event->event_date->format('d/m/Y H:i') }}</td>
                    <td style="font-size: 12px; color: var(--text-400);">{{ Str::limit($event->location ?? '—', 25) }}</td>
                    <td>
                        @if($event->is_featured)
                            <span style="color: var(--orange); font-size: 12px; font-weight: 600;">Oui</span>
                        @else
                            <span style="color: var(--text-400); font-size: 12px;">Non</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge-status badge-{{ $event->status }}">
                            <span class="dot"></span>{{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-id="{{ $event->id }}"
                                data-title="{{ $event->title }}"
                                data-description="{{ $event->description }}"
                                data-location="{{ $event->location }}"
                                data-event_date="{{ $event->event_date ? $event->event_date->format('d/m/Y H:i') : '' }}"
                                data-end_date="{{ $event->end_date ? $event->end_date->format('d/m/Y H:i') : '' }}"
                                data-is_featured="{{ $event->is_featured ? '1' : '0' }}"
                                data-status="{{ $event->status }}"
                                data-section="{{ $event->section ?? 'general' }}"
                                data-image-url="{{ $event->image ? asset('storage/'.$event->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $event->id }}"
                                data-title="{{ $event->title }}"
                                data-description="{{ $event->description }}"
                                data-location="{{ $event->location }}"
                                data-event_date="{{ $event->event_date ? $event->event_date->format('Y-m-d\TH:i') : '' }}"
                                data-end_date="{{ $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '' }}"
                                data-is_featured="{{ $event->is_featured ? '1' : '0' }}"
                                data-status="{{ $event->status }}"
                                data-section="{{ $event->section ?? 'general' }}"
                                data-image-url="{{ $event->image ? asset('storage/'.$event->image) : '' }}">
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-event-{{ $event->id }}" action="{{ route('admin.evenements.destroy', $event) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                            <button class="action-btn delete" data-delete-form="delete-event-{{ $event->id }}" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($evenements->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">Affichage de {{ $evenements->firstItem() }} à {{ $evenements->lastItem() }} sur {{ $evenements->total() }}</div>
        <div class="pagination-links">{{ $evenements->links() }}</div>
    </div>
    @endif
    @else
    <div class="empty-state">
        <h3>Aucun evenement</h3>
        <p>Planifiez votre premier evenement.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Creer un evenement</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.evenements.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #10b981, #059669)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div>
                    <h3>Nouvel evenement</h3>
                    <p>Planifiez un nouvel evenement</p>
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
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS PRINCIPALES</div>
                            <div class="form-group">
                                <label for="create-title">Titre <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Titre de l'evenement">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-section">Type d'evenement <span class="required">*</span></label>
                                <select id="create-section" name="section" class="form-select" required>
                                    <option value="general" {{ old('_modal') == 'create' && old('section') == 'general' ? 'selected' : (old('_modal') != 'create' ? 'selected' : '') }}>General (DGIE)</option>
                                    <option value="diaspora" {{ old('_modal') == 'create' && old('section') == 'diaspora' ? 'selected' : '' }}>Diaspora</option>
                                </select>
                                <span class="form-help">General = evenements DGIE officiels. Diaspora = evenements Coin des Diasporas.</span>
                            </div>
                            <div class="form-group">
                                <label for="create-location">Lieu <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="create-location" name="location" class="form-input" value="{{ old('_modal') == 'create' ? old('location') : '' }}" placeholder="Ex: Abidjan, Plateau">
                            </div>
                            <div class="form-group">
                                <label for="create-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-description" name="description" class="form-textarea wysiwyg" rows="6" placeholder="Description de l'evenement">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> DATES ET HORAIRES</div>
                            <div class="form-group">
                                <label for="create-event_date">Date et heure de debut <span class="required">*</span></label>
                                <input type="datetime-local" id="create-event_date" name="event_date" class="form-input" value="{{ old('_modal') == 'create' ? old('event_date') : '' }}" required>
                                @if(old('_modal') == 'create') @error('event_date') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-end_date">Date et heure de fin <span class="label-hint">Optionnel</span></label>
                                <input type="datetime-local" id="create-end_date" name="end_date" class="form-input" value="{{ old('_modal') == 'create' ? old('end_date') : '' }}">
                                @if(old('_modal') == 'create') @error('end_date') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> IMAGE DE COUVERTURE</div>
                            <label for="create-image" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-image-placeholder">
                                    <span>Aucune image selectionnee</span>
                                    <small>Format 16:9 recommande</small>
                                </div>
                            </label>
                            <input type="file" id="create-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')">
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot bordeaux"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="create-status">Statut</label>
                                <select id="create-status" name="status" class="form-select">
                                    <option value="brouillon" {{ old('_modal') == 'create' && old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="publie" {{ old('_modal') == 'create' && old('status') == 'publie' ? 'selected' : '' }}>Publie</option>
                                    <option value="archive" {{ old('_modal') == 'create' && old('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="is_featured" value="1" {{ old('_modal') == 'create' && old('is_featured') ? 'checked' : '' }} style="margin-right: 6px;">
                                    Mettre en vedette (modale accueil)
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
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/evenements') }}">
    <div class="admin-modal modal-fullpage">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #ef4444)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div>
                    <h3>Modifier l'evenement</h3>
                    <p>Modifiez les informations de cet evenement</p>
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
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS PRINCIPALES</div>
                            <div class="form-group">
                                <label for="edit-title">Titre <span class="required">*</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-section">Type d'evenement <span class="required">*</span></label>
                                <select id="edit-section" name="section" class="form-select" required>
                                    <option value="general" {{ old('_modal') == 'edit' && old('section') == 'general' ? 'selected' : '' }}>General (DGIE)</option>
                                    <option value="diaspora" {{ old('_modal') == 'edit' && old('section') == 'diaspora' ? 'selected' : '' }}>Diaspora</option>
                                </select>
                                <span class="form-help">General = evenements DGIE officiels. Diaspora = evenements Coin des Diasporas.</span>
                            </div>
                            <div class="form-group">
                                <label for="edit-location">Lieu <span class="label-hint">Optionnel</span></label>
                                <input type="text" id="edit-location" name="location" class="form-input" value="{{ old('_modal') == 'edit' ? old('location') : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-description">Description <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-description" name="description" class="form-textarea wysiwyg" rows="6">{{ old('_modal') == 'edit' ? old('description') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('description') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> DATES ET HORAIRES</div>
                            <div class="form-group">
                                <label for="edit-event_date">Date et heure de debut <span class="required">*</span></label>
                                <input type="datetime-local" id="edit-event_date" name="event_date" class="form-input" value="{{ old('_modal') == 'edit' ? old('event_date') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('event_date') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-end_date">Date et heure de fin <span class="label-hint">Optionnel</span></label>
                                <input type="datetime-local" id="edit-end_date" name="end_date" class="form-input" value="{{ old('_modal') == 'edit' ? old('end_date') : '' }}">
                                @if(old('_modal') == 'edit') @error('end_date') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> IMAGE DE COUVERTURE</div>
                            <label for="edit-image" class="fp-image-upload">
                                <div id="edit-image-placeholder">
                                    <div class="fp-image-placeholder">
                                        <span>Aucune image selectionnee</span>
                                        <small>Format 16:9 recommande</small>
                                    </div>
                                </div>
                            </label>
                            <input type="file" id="edit-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-image-placeholder')">
                            <span class="form-help" style="margin-top: 8px;">Laisser vide pour conserver l'image actuelle.</span>
                            @if(old('_modal') == 'edit') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot bordeaux"></span> PARAMETRES</div>
                            <div class="form-group">
                                <label for="edit-status">Statut</label>
                                <select id="edit-status" name="status" class="form-select">
                                    <option value="brouillon" {{ old('_modal') == 'edit' && old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="publie" {{ old('_modal') == 'edit' && old('status') == 'publie' ? 'selected' : '' }}>Publie</option>
                                    <option value="archive" {{ old('_modal') == 'edit' && old('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="edit-is_featured" name="is_featured" value="1" {{ old('_modal') == 'edit' && old('is_featured') ? 'checked' : '' }} style="margin-right: 6px;">
                                    Mettre en vedette
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

            // Populate fields
            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-description').value = btn.dataset.description || '';
            document.getElementById('edit-location').value = btn.dataset.location || '';
            document.getElementById('edit-event_date').value = btn.dataset.event_date || '';
            document.getElementById('edit-end_date').value = btn.dataset.end_date || '';
            document.getElementById('edit-status').value = btn.dataset.status || 'brouillon';
            document.getElementById('edit-section').value = btn.dataset.section || 'general';
            document.getElementById('edit-is_featured').checked = btn.dataset.is_featured === '1';

            // Image preview in fullpage modal
            var placeholder = document.getElementById('edit-image-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image selectionnee</span><small>Format 16:9 recommande</small></div>';
            }

            // Open the edit modal
            var modal = document.getElementById('editModal');
            if (modal) modal.classList.add('active');
        }
    });

    // View detail modal — BNC-style rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var statusClass = d.status || 'brouillon';
        var sectionLabel = (d.section === 'diaspora') ? 'Diaspora' : 'General DGIE';
        var sectionClass = (d.section === 'diaspora') ? 'diaspora' : 'general';
        var heroStyle = d.imageUrl ? ' style="background-image:url(\'' + d.imageUrl + '\')"' : '';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + statusClass + '"><span class="dot"></span>' + (d.status ? d.status.charAt(0).toUpperCase() + d.status.slice(1) : '') + '</span>'
            +     '<span class="evt-type-badge evt-type-badge--' + sectionClass + '">' + sectionLabel + '</span>'
            +     (d.is_featured === '1' ? '<span class="badge-status badge-publie"><span class="dot"></span>En vedette</span>' : '')
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__hero"' + heroStyle + '>'
            +   '<div class="art-show__hero-overlay">'
            +     '<span class="art-show__category">' + sectionLabel + '</span>'
            +     '<h1 class="art-show__title">' + (d.title || '') + '</h1>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__meta">'
            +   '<div class="art-show__meta-item"><svg viewBox="0 0 24 24" width="16" height="16"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> ' + (d.location || 'Non precise') + '</div>'
            +   '<div class="art-show__meta-sep"></div>'
            +   '<div class="art-show__meta-item"><svg viewBox="0 0 24 24" width="16" height="16"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> ' + (d.event_date || '—') + '</div>'
            +   (d.end_date ? '<div class="art-show__meta-sep"></div><div class="art-show__meta-item"><svg viewBox="0 0 24 24" width="16" height="16"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Fin : ' + d.end_date + '</div>' : '')
            + '</div>'
            + (d.description ? '<div class="art-show__content" style="padding:24px 32px;">' + d.description + '</div>' : '')
            + '</div>';
        showViewModal(null, null, html, true);
    });

    // ========== Countdown Timer ==========
    (function() {
        var el = document.querySelector('.evt-countdown');
        if (!el) return;
        var targetDate = new Date(el.dataset.eventDate).getTime();

        function tick() {
            var now = Date.now();
            var diff = targetDate - now;
            if (diff <= 0) {
                document.querySelector('.countdown-days').textContent = '0';
                document.querySelector('.countdown-hours').textContent = '0';
                document.querySelector('.countdown-minutes').textContent = '0';
                document.querySelector('.countdown-seconds').textContent = '0';
                return;
            }
            var d = Math.floor(diff / 86400000);
            var h = Math.floor((diff % 86400000) / 3600000);
            var m = Math.floor((diff % 3600000) / 60000);
            var s = Math.floor((diff % 60000) / 1000);
            document.querySelector('.countdown-days').textContent = d;
            document.querySelector('.countdown-hours').textContent = h;
            document.querySelector('.countdown-minutes').textContent = m;
            document.querySelector('.countdown-seconds').textContent = s;
        }

        tick();
        setInterval(tick, 1000);
    })();
</script>
@endsection
