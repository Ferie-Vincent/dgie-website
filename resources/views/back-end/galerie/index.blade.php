@extends('back-end.layouts.admin')

@section('title', 'Galerie & Médias')
@section('breadcrumb', 'Galerie & Médias')

@section('head')
@if($errors->any())
<meta name="reopen-modal" content="{{ old('_modal', 'create') }}">
@if(old('_edit_id'))
<meta name="edit-id" content="{{ old('_edit_id') }}">
@endif
@endif
@endsection

@section('content')
{{-- Page header --}}
<div class="galerie-header">
    <div class="galerie-header-top">
        <div>
            <div class="galerie-header-label">Médiathèque</div>
            <h1 class="galerie-header-title">Albums, photos & vidéos</h1>
            <p class="galerie-header-desc">Gérez les visuels et médias du site public de la DGIE.</p>
        </div>
        <button class="btn btn-primary" data-open-create>
            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Nouvel album
        </button>
    </div>
</div>

{{-- ========== ALBUMS PHOTO SECTION ========== --}}
<div class="galerie-section">
    <div class="galerie-section-header">
        <div>
            <h2 class="galerie-section-title">Albums de médias</h2>
            <p class="galerie-section-desc">Gérez les albums visuels pour le site web.</p>
        </div>
    </div>

    @if($albums->count() > 0)
    <div class="albums-grid">
        @foreach($albums as $album)
        <div class="album-card">
            <div class="album-card-cover">
                @if($album->cover_image)
                    <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}">
                @else
                    <div class="album-placeholder-icon">
                        <svg viewBox="0 0 24 24" width="40" height="40" stroke="currentColor" fill="none" stroke-width="1.2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                @endif
            </div>
            <div class="album-card-body">
                <div class="album-card-title">{{ $album->title }}</div>
                <div class="album-card-meta">
                    <span>{{ $album->items_count ?? 0 }} photo(s)</span>
                    <span>{{ $album->created_at->format('d M Y') }}</span>
                </div>
            </div>
            <div class="album-card-footer">
                <span class="badge-status badge-{{ $album->status }}">
                    <span class="dot"></span>{{ ucfirst($album->status) }}
                </span>
                <div class="album-card-actions">
                    <button class="action-btn view" title="Voir" aria-label="Voir"
                        data-view-album
                        data-id="{{ $album->id }}"
                        data-title="{{ $album->title }}"
                        data-description="{{ $album->description }}"
                        data-status="{{ $album->status }}"
                        data-items-count="{{ $album->items_count ?? 0 }}"
                        data-image-url="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : '' }}"
                        data-date="{{ $album->created_at->format('d/m/Y') }}"
                        data-photos='@json($album->items->map(fn($item) => asset("storage/" . $item->file_path)))'>
                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                    <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                        data-edit-btn
                        data-id="{{ $album->id }}"
                        data-title="{{ $album->title }}"
                        data-type="photo"
                        data-description="{{ $album->description }}"
                        data-status="{{ $album->status }}"
                        data-image-url="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : '' }}">
                        <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </button>
                    <form id="delete-album-{{ $album->id }}" action="{{ route('admin.galerie.destroy', $album) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                    <button class="action-btn delete" data-delete-form="delete-album-{{ $album->id }}" data-delete-name="l'album « {{ $album->title }} »" title="Supprimer" aria-label="Supprimer">
                        <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="galerie-empty">
        <div class="galerie-empty-icon">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
        <h3>Aucun album pour le moment</h3>
        <p>Créez votre premier album pour commencer à organiser vos photos</p>
        <button class="btn btn-primary btn-sm" data-open-create>
            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Créer un album
        </button>
    </div>
    @endif
</div>

{{-- ========== BIBLIOTHEQUE VIDEOS SECTION ========== --}}
<div class="galerie-section">
    <div class="galerie-section-header">
        <div>
            <h2 class="galerie-section-title">Bibliothèque vidéos</h2>
            <p class="galerie-section-desc">Vidéos intégrées dans les sections du site public.</p>
        </div>
        <button class="btn btn-primary btn-sm" id="addVideoBtn">
            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
            Ajouter une vidéo
        </button>
    </div>

    @if($videos->count() > 0)
    <table class="galerie-video-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Mise à jour</th>
                <th style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
            <tr>
                <td>
                    <div class="video-title-cell">
                        <strong>{{ $video->title }}</strong>
                        <small>YouTube</small>
                    </div>
                </td>
                <td style="font-size: 13px; color: var(--text-400);">{{ $video->updated_at->format('d M Y') }}</td>
                <td>
                    <div class="table-actions" style="justify-content: flex-end;">
                        <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                            data-edit-video-btn
                            data-id="{{ $video->id }}"
                            data-title="{{ $video->title }}"
                            data-status="{{ $video->status }}"
                            data-video-url="{{ $video->items->first()?->file_path ?? '' }}">
                            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <form id="delete-video-{{ $video->id }}" action="{{ route('admin.galerie.destroy', $video) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                        <button class="action-btn delete" data-delete-form="delete-video-{{ $video->id }}" data-delete-name="cette vidéo" title="Supprimer" aria-label="Supprimer">
                            <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="galerie-empty" style="padding: 40px 24px;">
        <div class="galerie-empty-icon">
            <svg viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
        </div>
        <h3>Aucune vidéo pour le moment</h3>
        <p>Ajoutez des liens YouTube pour enrichir votre médiathèque</p>
    </div>
    @endif
</div>

{{-- ========== CREATE ALBUM MODAL ========== --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage modal-md">
        <form method="POST" action="{{ route('admin.galerie.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <input type="hidden" name="type" value="photo" id="create-type-hidden">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #8b5cf6, #6366f1)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                <div>
                    <h3>Gestion de l'album photo</h3>
                    <p>Créez et organisez un nouvel album photo</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        {{-- INFORMATIONS --}}
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS DE L'ALBUM</div>
                            <div class="form-group">
                                <label for="create-title">Titre de l'album <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Ex. Cérémonie de remise de prix">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label for="create-status">Statut</label>
                                    <select id="create-status" name="status" class="form-select">
                                        <option value="publie" {{ old('_modal') == 'create' && old('status') == 'publie' ? 'selected' : '' }}>Publié</option>
                                        <option value="brouillon" {{ old('_modal') == 'create' && old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                        <option value="archive" {{ old('_modal') == 'create' && old('status') == 'archive' ? 'selected' : '' }}>Archivé</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- MÉDIAS --}}
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> MÉDIAS DE L'ALBUM</div>
                            <div class="fp-photos-grid">
                                <div>
                                    <label style="font-size: 13px; font-weight: 500; color: var(--text); margin-bottom: 8px; display: block;">Uploads multiples (photos & vidéos)</label>
                                    <div class="fp-dropzone" id="create-dropzone">
                                        <div class="fp-dropzone-icon">
                                            <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                        </div>
                                        <div class="fp-dropzone-text">Glissez vos fichiers ici</div>
                                        <div class="fp-dropzone-text">ou <span class="link">sélectionnez des fichiers</span></div>
                                        <div class="fp-dropzone-hint">JPG, PNG, MP4, MOV, WebM — max 50 Mo par vidéo, 10 Mo par photo</div>
                                    </div>
                                    <input type="file" id="create-photos" name="photos[]" accept="image/*,video/mp4,video/quicktime,video/webm" multiple style="display:none">
                                    <div class="fp-photos-preview" id="create-photos-preview"></div>
                                </div>
                                <div>
                                    <label style="font-size: 13px; font-weight: 500; color: var(--text); margin-bottom: 8px; display: block;">Image de couverture</label>
                                    <label for="create-cover_image" class="fp-image-upload">
                                        <div class="fp-image-placeholder" id="create-image-placeholder">
                                            <span>Aucune image sélectionnée</span>
                                            <small>Format 16:9 recommandé</small>
                                        </div>
                                    </label>
                                    <input type="file" id="create-cover_image" name="cover_image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')">
                                    <span class="form-help">Format recommandé : 16:9 — 1600 x 900 px</span>
                                </div>
                            </div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> DESCRIPTION DE L'ALBUM</div>
                            <div class="form-group">
                                <textarea name="description" class="form-textarea" rows="4" placeholder="Décrivez brièvement le contexte de l'événement, les moments forts, les personnalités présentes...">{{ old('_modal') == 'create' ? old('description') : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave">
                    <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Toutes les photos seront optimisées automatiquement
                </div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer l'album</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ========== EDIT ALBUM MODAL ========== --}}
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/galerie') }}">
    <div class="admin-modal modal-fullpage modal-md">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_edit_id" value="{{ old('_edit_id') }}">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #f59e0b, #ef4444)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </div>
                <div>
                    <h3>Modifier l'album</h3>
                    <p>Modifiez les informations de cet album</p>
                </div>
                <button type="button" class="modal-fp-close" data-close-modal>
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div class="modal-fp-grid single-col">
                    <div class="modal-fp-main">
                        {{-- INFORMATIONS --}}
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> INFORMATIONS DE L'ALBUM</div>
                            <div class="form-group">
                                <label for="edit-title">Titre de l'album <span class="required">*</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-grid-2">
                                <div class="form-group">
                                    <label for="edit-status">Statut</label>
                                    <select id="edit-status" name="status" class="form-select">
                                        <option value="publie">Publié</option>
                                        <option value="brouillon">Brouillon</option>
                                        <option value="archive">Archivé</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- MÉDIAS --}}
                        <div class="modal-fp-section" id="edit-photos-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> MÉDIAS DE L'ALBUM</div>
                            <div class="fp-photos-grid">
                                <div>
                                    <label style="font-size: 13px; font-weight: 500; color: var(--text); margin-bottom: 8px; display: block;">Ajouter des médias</label>
                                    <div class="fp-dropzone" id="edit-dropzone">
                                        <div class="fp-dropzone-icon">
                                            <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                        </div>
                                        <div class="fp-dropzone-text">Glissez vos fichiers ici</div>
                                        <div class="fp-dropzone-text">ou <span class="link">sélectionnez des fichiers</span></div>
                                        <div class="fp-dropzone-hint">JPG, PNG, MP4, MOV, WebM — max 50 Mo par vidéo, 10 Mo par photo</div>
                                    </div>
                                    <input type="file" id="edit-photos" name="photos[]" accept="image/*,video/mp4,video/quicktime,video/webm" multiple style="display:none">
                                    <div class="fp-photos-preview" id="edit-photos-preview"></div>
                                </div>
                                <div>
                                    <label style="font-size: 13px; font-weight: 500; color: var(--text); margin-bottom: 8px; display: block;">Image de couverture</label>
                                    <label for="edit-cover_image" class="fp-image-upload">
                                        <div id="edit-image-placeholder">
                                            <div class="fp-image-placeholder">
                                                <span>Aucune image sélectionnée</span>
                                                <small>Format 16:9 recommandé</small>
                                            </div>
                                        </div>
                                    </label>
                                    <input type="file" id="edit-cover_image" name="cover_image" accept="image/*" style="display:none" onchange="previewImage(this, 'edit-image-placeholder')">
                                    <span class="form-help">Laisser vide pour conserver l'image actuelle.</span>
                                </div>
                            </div>
                        </div>

                        {{-- VIDEO URL (shown only for video type) --}}
                        <div class="modal-fp-section" id="edit-video-section" style="display: none;">
                            <div class="modal-fp-section-title"><span class="dot green"></span> LIEN VIDÉO</div>
                            <div class="form-group">
                                <label for="edit-video_url">URL YouTube <span class="required">*</span></label>
                                <input type="url" id="edit-video_url" name="video_url" class="form-input" placeholder="https://www.youtube.com/watch?v=...">
                            </div>
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> DESCRIPTION DE L'ALBUM</div>
                            <div class="form-group">
                                <textarea id="edit-description" name="description" class="form-textarea" rows="4" placeholder="Décrivez brièvement le contexte...">{{ old('_modal') == 'edit' ? old('description') : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave">
                    <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Toutes les photos seront optimisées automatiquement
                </div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ========== ADD VIDEO MODAL ========== --}}
<div class="admin-modal-overlay" id="videoModal">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" action="{{ route('admin.galerie.store') }}">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <input type="hidden" name="type" value="video">
            <input type="hidden" name="status" value="publie">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #ef4444, #ec4899)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                </div>
                <div>
                    <h3>Ajouter une vidéo</h3>
                    <p>Ajoutez un lien YouTube à la médiathèque</p>
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
                                <label>Titre de la vidéo <span class="required">*</span></label>
                                <input type="text" name="title" class="form-input" required placeholder="Ex. La DGIE célèbre ses 10 ans">
                            </div>
                            <div class="form-group">
                                <label>URL YouTube <span class="required">*</span></label>
                                <input type="url" name="video_url" class="form-input" required placeholder="https://www.youtube.com/watch?v=...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave"></div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // ========== Dropzone functionality ==========
    function setupDropzone(dropzoneId, fileInputId, previewId) {
        var dropzone = document.getElementById(dropzoneId);
        var fileInput = document.getElementById(fileInputId);
        var preview = document.getElementById(previewId);

        if (!dropzone || !fileInput) return;

        dropzone.addEventListener('click', function() { fileInput.click(); });

        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', function() {
            dropzone.classList.remove('dragover');
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            fileInput.files = e.dataTransfer.files;
            showPhotosPreviews(fileInput.files, preview);
        });

        fileInput.addEventListener('change', function() {
            showPhotosPreviews(this.files, preview);
        });
    }

    function showPhotosPreviews(files, container) {
        container.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var thumb = document.createElement('div');
            thumb.className = 'fp-thumb';

            if (file.type.startsWith('image/')) {
                var img = document.createElement('img');
                var reader = new FileReader();
                reader.onload = (function(img) {
                    return function(e) { img.src = e.target.result; };
                })(img);
                reader.readAsDataURL(file);
                thumb.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                thumb.innerHTML = '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;background:#1e293b;border-radius:8px;color:#fff;padding:8px;text-align:center;">'
                    + '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="5 3 19 12 5 21 5 3"/></svg>'
                    + '<small style="margin-top:4px;font-size:10px;opacity:.7;">' + file.name.substring(0, 15) + '</small></div>';
            } else {
                continue;
            }

            container.appendChild(thumb);
        }
    }

    setupDropzone('create-dropzone', 'create-photos', 'create-photos-preview');
    setupDropzone('edit-dropzone', 'edit-photos', 'edit-photos-preview');

    // ========== Open video modal ==========
    document.getElementById('addVideoBtn').addEventListener('click', function() {
        openModal('videoModal');
    });

    // ========== Edit album (photo) ==========
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-edit-btn]');
        if (!btn) return;
        e.preventDefault();

        var editIdField = document.querySelector('#editModal input[name="_edit_id"]');
        if (editIdField) editIdField.value = btn.dataset.id;

        document.getElementById('edit-title').value = btn.dataset.title || '';
        document.getElementById('edit-status').value = btn.dataset.status || 'brouillon';
        document.getElementById('edit-description').value = btn.dataset.description || '';

        // Show/hide sections based on type
        var isVideo = btn.dataset.type === 'video';
        document.getElementById('edit-photos-section').style.display = isVideo ? 'none' : '';
        document.getElementById('edit-video-section').style.display = isVideo ? '' : 'none';

        if (isVideo && btn.dataset.videoUrl) {
            document.getElementById('edit-video_url').value = btn.dataset.videoUrl;
        }

        // Image preview
        var placeholder = document.getElementById('edit-image-placeholder');
        if (btn.dataset.imageUrl) {
            placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
        } else {
            placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image sélectionnée</span><small>Format 16:9 recommandé</small></div>';
        }

        // Clear photos preview
        document.getElementById('edit-photos-preview').innerHTML = '';

        // Set form action
        var editForm = document.getElementById('editForm');
        var baseUrl = document.getElementById('editModal').dataset.routeBase;
        if (editForm && baseUrl && btn.dataset.id) {
            editForm.action = baseUrl + '/' + btn.dataset.id;
        }

        openModal('editModal');
    });

    // ========== Edit video ==========
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-edit-video-btn]');
        if (!btn) return;
        e.preventDefault();

        var editIdField = document.querySelector('#editModal input[name="_edit_id"]');
        if (editIdField) editIdField.value = btn.dataset.id;

        document.getElementById('edit-title').value = btn.dataset.title || '';
        document.getElementById('edit-status').value = btn.dataset.status || 'publie';
        document.getElementById('edit-description').value = '';

        // Show video section, hide photos section
        document.getElementById('edit-photos-section').style.display = 'none';
        document.getElementById('edit-video-section').style.display = '';
        document.getElementById('edit-video_url').value = btn.dataset.videoUrl || '';

        // Clear image placeholder
        var placeholder = document.getElementById('edit-image-placeholder');
        placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image sélectionnée</span><small>Format 16:9 recommandé</small></div>';

        // Set form action
        var editForm = document.getElementById('editForm');
        var baseUrl = document.getElementById('editModal').dataset.routeBase;
        if (editForm && baseUrl && btn.dataset.id) {
            editForm.action = baseUrl + '/' + btn.dataset.id;
        }

        openModal('editModal');
    });

    // ========== View album detail — rich preview ==========
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-view-album]');
        if (!btn) return;
        var d = btn.dataset;

        // Parse photos JSON
        var photos = [];
        try { photos = JSON.parse(d.photos || '[]'); } catch(err) {}

        var heroStyle = d.imageUrl ? ' style="background-image:url(\'' + d.imageUrl + '\')"' : '';
        var statusClass = d.status || 'brouillon';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + statusClass + '"><span class="dot"></span>' + (d.status ? d.status.charAt(0).toUpperCase() + d.status.slice(1) : '') + '</span>'
            +     '<span class="art-show__preview-label">' + (d.itemsCount || 0) + ' photo(s)</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__hero"' + heroStyle + '>'
            +   '<div class="art-show__hero-overlay">'
            +     '<span class="art-show__category">Album</span>'
            +     '<h1 class="art-show__title">' + (d.title || '') + '</h1>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__meta">'
            +   '<div class="art-show__meta-item"><svg viewBox="0 0 24 24" width="16" height="16"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg> ' + (d.itemsCount || 0) + ' photo(s)</div>'
            +   '<div class="art-show__meta-sep"></div>'
            +   '<div class="art-show__meta-item"><svg viewBox="0 0 24 24" width="16" height="16"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> ' + (d.date || '') + '</div>'
            + '</div>'
            + (d.description ? '<div class="art-show__excerpt">' + d.description + '</div>' : '');

        // Photo gallery grid
        if (photos.length > 0) {
            html += '<div style="padding:16px 32px 32px;">'
                + '<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;">';
            for (var i = 0; i < photos.length; i++) {
                html += '<div style="aspect-ratio:1;border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;">'
                    + '<img src="' + photos[i] + '" alt="" style="width:100%;height:100%;object-fit:cover;cursor:pointer;" onclick="window.open(this.src,\'_blank\')">'
                    + '</div>';
            }
            html += '</div></div>';
        }

        html += '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
