@extends('back-end.layouts.admin')

@section('title', 'Articles')
@section('breadcrumb', 'Articles')

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
        <h1 class="content-title">Articles</h1>
        <p class="content-subtitle">{{ $articles->total() }} article(s) au total</p>
    </div>
    <button class="btn btn-primary" data-open-create>
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvel article
    </button>
</div>

{{-- Toolbar --}}
<div class="toolbar">
    <div class="toolbar-search">
        <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un article..." value="{{ request('search') }}">
        </form>
    </div>
    <div class="toolbar-filter">
        <form method="GET" style="display:flex; gap:8px;">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <select name="category" onchange="this.form.submit()">
                <option value="">Toutes les categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="status" onchange="this.form.submit()">
                <option value="">Tous les statuts</option>
                <option value="brouillon" {{ request('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                <option value="publie" {{ request('status') == 'publie' ? 'selected' : '' }}>Publié</option>
                <option value="archive" {{ request('status') == 'archive' ? 'selected' : '' }}>Archivé</option>
            </select>
            <select name="section" onchange="this.form.submit()">
                <option value="">Toutes les sections</option>
                <option value="retour" {{ request('section') == 'retour' ? 'selected' : '' }}>Retour et Réintégration</option>
                <option value="investir" {{ request('section') == 'investir' ? 'selected' : '' }}>Investir et Contribuer</option>
                <option value="action-sociale" {{ request('section') == 'action-sociale' ? 'selected' : '' }}>Actions Sociales</option>
            </select>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="admin-card">
    @if($articles->count() > 0)
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Categorie</th>
                    <th>Auteur</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>
                        <div class="table-title">{{ Str::limit($article->title, 50) }}</div>
                        <div class="table-excerpt">{{ Str::limit($article->excerpt, 60) }}</div>
                    </td>
                    <td>
                        <span style="font-size: 12px;">{{ $article->category->name ?? '—' }}</span>
                    </td>
                    <td>
                        <span style="font-size: 12px;">{{ $article->author->name ?? '—' }}</span>
                    </td>
                    <td>
                        <span class="badge-status badge-{{ $article->status }}">
                            <span class="dot"></span>
                            {{ ucfirst($article->status) }}
                        </span>
                    </td>
                    <td style="font-size: 12px; color: var(--admin-text-light); white-space: nowrap;">
                        {{ $article->created_at->format('d/m/Y') }}
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="action-btn view" title="Voir" aria-label="Voir"
                                data-view-btn
                                data-title="{{ $article->title }}"
                                data-category="{{ $article->category->name ?? '' }}"
                                data-author="{{ $article->author->name ?? 'Auteur' }}"
                                data-author-role="{{ ucfirst($article->author->role ?? 'redacteur') }}"
                                data-author-initials="{{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}{{ strtoupper(substr(explode(' ', $article->author->name ?? 'A')[1] ?? '', 0, 1)) }}"
                                data-status="{{ $article->status }}"
                                data-excerpt="{{ $article->excerpt }}"
                                data-content="{{ $article->content }}"
                                data-read_time="{{ $article->read_time ?? 1 }}"
                                data-section="{{ $article->section }}"
                                data-image="{{ $article->image ? asset('storage/'.$article->image) : '' }}"
                                data-date="{{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}"
                                data-comments="{{ $article->comments_count ?? 0 }}"
                                data-edit-url="{{ route('admin.articles.edit', $article) }}">
                                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                            <button class="action-btn edit" title="Modifier" aria-label="Modifier"
                                data-edit-btn
                                data-id="{{ $article->id }}"
                                data-title="{{ $article->title }}"
                                data-category_id="{{ $article->category_id }}"
                                data-dossier_id="{{ $article->dossier_id }}"
                                data-status="{{ $article->status }}"
                                data-excerpt="{{ $article->excerpt }}"
                                data-content="{{ $article->content }}"
                                data-section="{{ $article->section }}"
                                data-read_time="{{ $article->read_time }}"
                                data-published_at="{{ $article->published_at ? $article->published_at->format('Y-m-d') : '' }}"
                                data-image-url="{{ $article->image ? asset('storage/'.$article->image) : '' }}"
                                data-images='@json($article->images->map(fn($img) => ["id" => $img->id, "url" => asset("storage/".$img->image_path)]))'>
                                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </button>
                            <form id="delete-article-{{ $article->id }}" action="{{ route('admin.articles.destroy', $article) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button class="action-btn delete" data-delete-form="delete-article-{{ $article->id }}" title="Supprimer" aria-label="Supprimer">
                                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
    <div class="admin-pagination">
        <div class="pagination-info">
            Affichage de {{ $articles->firstItem() }} à {{ $articles->lastItem() }} sur {{ $articles->total() }}
        </div>
        <div class="pagination-links">
            {{ $articles->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        <h3>Aucun article</h3>
        <p>Commencez par créer votre premier article.</p>
        <button class="btn btn-primary btn-sm" data-open-create>Créer un article</button>
    </div>
    @endif
</div>

{{-- Create Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="createModal">
    <div class="admin-modal modal-fullpage">
        <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_modal" value="create">
            <div class="modal-fp-header">
                <div class="modal-fp-icon" style="background: linear-gradient(135deg, #3b82f6, #6366f1)">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                </div>
                <div>
                    <h3>Nouvel article</h3>
                    <p>Créez un nouvel article pour le site</p>
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
                                <label for="create-title">Titre principal <span class="required">*</span></label>
                                <input type="text" id="create-title" name="title" class="form-input" value="{{ old('_modal') == 'create' ? old('title') : '' }}" required placeholder="Titre de l'article">
                                @if(old('_modal') == 'create') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label>Resume (chapeau) <span class="label-hint">Optionnel</span></label>
                                <textarea id="create-excerpt" name="excerpt" class="form-textarea" rows="3" maxlength="500" placeholder="Bref resume de l'article pour les listes et les aperçus...">{{ old('_modal') == 'create' ? old('excerpt') : '' }}</textarea>
                                <span class="form-help">Ce resume apparaitra dans les listes d'articles et les aperçus.</span>
                                @if(old('_modal') == 'create') @error('excerpt') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> CONTENU DETAILLE</div>
                            <div class="form-group">
                                <label for="create-content">Contenu de l'article <span class="required">*</span></label>
                                <textarea id="create-content" name="content" class="form-textarea wysiwyg" rows="16" required placeholder="Saisissez le contenu detaille de votre article...">{{ old('_modal') == 'create' ? old('content') : '' }}</textarea>
                                @if(old('_modal') == 'create') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE DE COUVERTURE</div>
                            <label for="create-image" class="fp-image-upload">
                                <div class="fp-image-placeholder" id="create-image-placeholder">
                                    <span>Aucune image selectionnee</span>
                                    <small>Format 16:9 recommande</small>
                                </div>
                            </label>
                            <input type="file" id="create-image" name="image" accept="image/*" style="display:none" onchange="previewImage(this, 'create-image-placeholder')">
                            <div class="form-group" style="margin-top: 12px;">
                                <label>Legende / Credit photo <span class="label-hint">Optionnel</span></label>
                                <input type="text" name="image_caption" class="form-input" placeholder="Photo officielle © DGIE" value="{{ old('_modal') == 'create' ? old('image_caption') : '' }}">
                            </div>
                            <span class="form-help">Formats : JPG, PNG, WebP — Taille max : 2 Mo</span>
                            @if(old('_modal') == 'create') @error('image') <span class="form-error">{{ $message }}</span> @enderror @endif
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGES SUPPLEMENTAIRES</div>
                            <div class="fp-dropzone" id="create-article-dropzone">
                                <div class="fp-dropzone-icon">
                                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                                <div class="fp-dropzone-text">Glissez vos images ici</div>
                                <div class="fp-dropzone-text">ou <span class="link">selectionnez des fichiers</span></div>
                                <div class="fp-dropzone-hint">JPG, PNG, WebP — max 5 Mo par image — 10 images max</div>
                            </div>
                            <input type="file" id="create-article-photos" name="additional_images[]" accept="image/*" multiple style="display:none">
                            <div class="fp-photos-preview" id="create-article-photos-preview"></div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> METADONNEES</div>
                            <div class="form-group">
                                <label for="create-status">Statut de publication</label>
                                <select id="create-status" name="status" class="form-select" required>
                                    <option value="brouillon" {{ old('_modal') == 'create' && old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="publie" {{ old('_modal') == 'create' && old('status') == 'publie' ? 'selected' : '' }}>Publie</option>
                                    <option value="archive" {{ old('_modal') == 'create' && old('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="create-category_id">Categorie <span class="required">*</span></label>
                                <select id="create-category_id" name="category_id" class="form-select" required>
                                    <option value="">Selectionner une categorie</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('_modal') == 'create' && old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if(old('_modal') == 'create') @error('category_id') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="create-dossier_id">Dossier <span class="label-hint">Optionnel</span></label>
                                <select id="create-dossier_id" name="dossier_id" class="form-select">
                                    <option value="">Aucun dossier</option>
                                    @foreach($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}" {{ old('_modal') == 'create' && old('dossier_id') == $dossier->id ? 'selected' : '' }}>{{ $dossier->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="create-section">Section <span class="label-required">*</span></label>
                                <select id="create-section" name="section" class="form-select" required>
                                    <option value="">Selectionner une section</option>
                                    <option value="retour" {{ old('_modal') == 'create' && old('section') == 'retour' ? 'selected' : '' }}>Retour et Reintegration</option>
                                    <option value="investir" {{ old('_modal') == 'create' && old('section') == 'investir' ? 'selected' : '' }}>Investir et Contribuer</option>
                                    <option value="action-sociale" {{ old('_modal') == 'create' && old('section') == 'action-sociale' ? 'selected' : '' }}>Actions Sociales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="create-published_at">Date de publication <span class="label-hint">Optionnel</span></label>
                                <input type="date" id="create-published_at" name="published_at" class="form-input" value="{{ old('_modal') == 'create' ? old('published_at') : date('Y-m-d') }}">
                                <span class="form-help">Si non renseignee, la date actuelle sera utilisee lors de la publication.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <div class="modal-fp-autosave">Sauvegarde automatique activee</div>
                <div class="modal-fp-actions">
                    <button type="button" class="btn btn-outline" data-close-modal>Annuler</button>
                    <button type="submit" class="btn btn-primary">Publier l'article</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal (Fullpage) --}}
<div class="admin-modal-overlay" id="editModal" data-route-base="{{ url('admin/articles') }}">
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
                    <h3>Modifier l'article</h3>
                    <p>Modifiez les informations de cet article</p>
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
                                <label for="edit-title">Titre principal <span class="required">*</span></label>
                                <input type="text" id="edit-title" name="title" class="form-input" value="{{ old('_modal') == 'edit' ? old('title') : '' }}" required>
                                @if(old('_modal') == 'edit') @error('title') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label>Resume (chapeau) <span class="label-hint">Optionnel</span></label>
                                <textarea id="edit-excerpt" name="excerpt" class="form-textarea" rows="3" maxlength="500" placeholder="Bref resume de l'article...">{{ old('_modal') == 'edit' ? old('excerpt') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('excerpt') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot blue"></span> CONTENU DETAILLE</div>
                            <div class="form-group">
                                <label for="edit-content">Contenu de l'article <span class="required">*</span></label>
                                <textarea id="edit-content" name="content" class="form-textarea wysiwyg" rows="16" required>{{ old('_modal') == 'edit' ? old('content') : '' }}</textarea>
                                @if(old('_modal') == 'edit') @error('content') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar column --}}
                    <div class="modal-fp-sidebar">
                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGE DE COUVERTURE</div>
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
                            <div class="modal-fp-section-title"><span class="dot orange"></span> IMAGES SUPPLEMENTAIRES</div>
                            <div class="article-existing-images" id="edit-existing-images"></div>
                            <div class="fp-dropzone" id="edit-article-dropzone">
                                <div class="fp-dropzone-icon">
                                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                                <div class="fp-dropzone-text">Ajouter des images</div>
                                <div class="fp-dropzone-text">ou <span class="link">selectionnez des fichiers</span></div>
                                <div class="fp-dropzone-hint">JPG, PNG, WebP — max 5 Mo par image</div>
                            </div>
                            <input type="file" id="edit-article-photos" name="additional_images[]" accept="image/*" multiple style="display:none">
                            <div class="fp-photos-preview" id="edit-article-photos-preview"></div>
                        </div>

                        <div class="modal-fp-section">
                            <div class="modal-fp-section-title"><span class="dot green"></span> METADONNEES</div>
                            <div class="form-group">
                                <label for="edit-status">Statut de publication</label>
                                <select id="edit-status" name="status" class="form-select" required>
                                    <option value="brouillon" {{ old('_modal') == 'edit' && old('status') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="publie" {{ old('_modal') == 'edit' && old('status') == 'publie' ? 'selected' : '' }}>Publie</option>
                                    <option value="archive" {{ old('_modal') == 'edit' && old('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-category_id">Categorie <span class="required">*</span></label>
                                <select id="edit-category_id" name="category_id" class="form-select" required>
                                    <option value="">Selectionner une categorie</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('_modal') == 'edit' && old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if(old('_modal') == 'edit') @error('category_id') <span class="form-error">{{ $message }}</span> @enderror @endif
                            </div>
                            <div class="form-group">
                                <label for="edit-dossier_id">Dossier <span class="label-hint">Optionnel</span></label>
                                <select id="edit-dossier_id" name="dossier_id" class="form-select">
                                    <option value="">Aucun dossier</option>
                                    @foreach($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}" {{ old('_modal') == 'edit' && old('dossier_id') == $dossier->id ? 'selected' : '' }}>{{ $dossier->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-section">Section <span class="label-required">*</span></label>
                                <select id="edit-section" name="section" class="form-select" required>
                                    <option value="">Selectionner une section</option>
                                    <option value="retour" {{ old('_modal') == 'edit' && old('section') == 'retour' ? 'selected' : '' }}>Retour et Reintegration</option>
                                    <option value="investir" {{ old('_modal') == 'edit' && old('section') == 'investir' ? 'selected' : '' }}>Investir et Contribuer</option>
                                    <option value="action-sociale" {{ old('_modal') == 'edit' && old('section') == 'action-sociale' ? 'selected' : '' }}>Actions Sociales</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-published_at">Date de publication <span class="label-hint">Optionnel</span></label>
                                <input type="date" id="edit-published_at" name="published_at" class="form-input" value="{{ old('_modal') == 'edit' ? old('published_at') : '' }}">
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
    // Dropzone setup for additional images
    function setupArticleDropzone(dropzoneId, fileInputId, previewId) {
        var dropzone = document.getElementById(dropzoneId);
        var fileInput = document.getElementById(fileInputId);
        var preview = document.getElementById(previewId);
        if (!dropzone || !fileInput) return;

        dropzone.addEventListener('click', function() { fileInput.click(); });
        dropzone.addEventListener('dragover', function(e) { e.preventDefault(); dropzone.classList.add('dragover'); });
        dropzone.addEventListener('dragleave', function() { dropzone.classList.remove('dragover'); });
        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            fileInput.files = e.dataTransfer.files;
            showArticlePhotoPreviews(fileInput.files, preview);
        });
        fileInput.addEventListener('change', function() { showArticlePhotoPreviews(this.files, preview); });
    }

    function showArticlePhotoPreviews(files, container) {
        container.innerHTML = '';
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.startsWith('image/')) continue;
            var thumb = document.createElement('div');
            thumb.className = 'fp-thumb';
            var img = document.createElement('img');
            var reader = new FileReader();
            reader.onload = (function(img) { return function(e) { img.src = e.target.result; }; })(img);
            reader.readAsDataURL(file);
            thumb.appendChild(img);
            container.appendChild(thumb);
        }
    }

    setupArticleDropzone('create-article-dropzone', 'create-article-photos', 'create-article-photos-preview');
    setupArticleDropzone('edit-article-dropzone', 'edit-article-photos', 'edit-article-photos-preview');

    // Set _edit_id hidden field and populate edit form when opening edit modal
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-edit-btn]');
        if (btn) {
            const editIdField = document.querySelector('#editModal input[name="_edit_id"]');
            if (editIdField) editIdField.value = btn.dataset.id;

            document.getElementById('edit-title').value = btn.dataset.title || '';
            document.getElementById('edit-category_id').value = btn.dataset.category_id || '';
            document.getElementById('edit-dossier_id').value = btn.dataset.dossier_id || '';
            document.getElementById('edit-status').value = btn.dataset.status || 'brouillon';
            document.getElementById('edit-section').value = btn.dataset.section || 'retour';
            document.getElementById('edit-published_at').value = btn.dataset.published_at || '';
            document.getElementById('edit-excerpt').value = btn.dataset.excerpt || '';
            document.getElementById('edit-content').value = btn.dataset.content || '';

            // Image preview in fullpage modal
            var placeholder = document.getElementById('edit-image-placeholder');
            if (btn.dataset.imageUrl) {
                placeholder.innerHTML = '<div class="fp-image-preview"><img src="' + btn.dataset.imageUrl + '" alt=""></div>';
            } else {
                placeholder.innerHTML = '<div class="fp-image-placeholder"><span>Aucune image selectionnee</span><small>Format 16:9 recommande</small></div>';
            }

            // Existing additional images
            var container = document.getElementById('edit-existing-images');
            container.innerHTML = '';
            var images = [];
            try { images = JSON.parse(btn.dataset.images || '[]'); } catch(e) {}
            images.forEach(function(img) {
                var div = document.createElement('div');
                div.className = 'article-existing-img';
                div.innerHTML = '<img src="' + img.url + '" alt="">'
                    + '<button type="button" class="article-existing-img__delete" data-image-id="' + img.id + '" title="Supprimer">'
                    + '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>'
                    + '</button>';
                container.appendChild(div);
            });

            // Clear new image previews
            document.getElementById('edit-article-photos-preview').innerHTML = '';
        }
    });

    // AJAX delete for existing additional images
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.article-existing-img__delete');
        if (!btn) return;
        if (!confirm('Supprimer cette image ?')) return;
        var imageId = btn.dataset.imageId;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('/admin/article-images/' + imageId, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
        }).then(function(res) {
            if (res.ok) btn.closest('.article-existing-img').remove();
        });
    });

    // View detail modal — BNC-style rich preview
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-view-btn]');
        if (!btn) return;
        var d = btn.dataset;
        var statusMap = { 'publié': 'publie', 'brouillon': 'brouillon', 'archivé': 'archive', 'publie': 'publie' };
        var statusClass = statusMap[d.status] || 'brouillon';

        var heroStyle = d.image ? ' style="background-image:url(\'' + d.image + '\')"' : '';
        var html = '<div class="art-show" style="max-width:100%;margin:0;border-radius:0;box-shadow:none;">'
            + '<div class="art-show__topbar">'
            +   '<div class="art-show__topbar-left">'
            +     '<span class="badge-status badge-' + statusClass + '"><span class="dot"></span>' + (d.status ? d.status.charAt(0).toUpperCase() + d.status.slice(1) : '') + '</span>'
            +     '<span class="art-show__preview-label">Apercu en direct &bull; Vue publique</span>'
            +   '</div>'
            +   '<div class="art-show__topbar-right">'
            +     '<a href="' + d.editUrl + '" class="btn btn-primary btn-sm">Modifier</a>'
            +     '<button type="button" class="btn btn-outline btn-sm" data-close-modal><svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" fill="none" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__hero"' + heroStyle + '>'
            +   '<div class="art-show__hero-overlay">'
            +     (d.category ? '<span class="art-show__category">' + d.category + '</span>' : '')
            +     '<h1 class="art-show__title">' + (d.title || '') + '</h1>'
            +   '</div>'
            + '</div>'
            + '<div class="art-show__meta">'
            +   '<div class="art-show__author">'
            +     '<div class="art-show__avatar">' + (d.authorInitials || 'A') + '</div>'
            +     '<div><div class="art-show__author-name">' + (d.author || '') + '</div>'
            +     '<div class="art-show__author-role">' + (d.authorRole || '') + '</div></div>'
            +   '</div>'
            +   '<div class="art-show__meta-sep"></div>'
            +   '<div class="art-show__meta-item"><svg viewBox="0 0 24 24" width="16" height="16"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg> ' + (d.date || '') + '</div>'
            +   '<div class="art-show__meta-sep"></div>'
            +   '<div class="art-show__meta-item"><svg viewBox="0 0 24 24" width="16" height="16"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> ' + (d.read_time || 1) + ' min de lecture</div>'
            + '</div>'
            + (d.excerpt ? '<div class="art-show__excerpt">' + d.excerpt + '</div>' : '')
            + '<div class="art-show__content">' + (d.content || '') + '</div>'
            + '<div class="art-show__tags"><span class="art-show__tags-label">Mots-cles :</span>'
            +   (d.category ? '<span class="art-show__tag">' + d.category + '</span>' : '')
            +   '<span class="art-show__tag">' + ({retour:'Retour et Réintégration',investir:'Investir et Contribuer','action-sociale':'Actions Sociales'}[d.section] || d.section) + '</span>'
            + '</div>'
            + '<div class="art-show__footer">'
            +   '<div class="art-show__stats"><span class="art-show__stat"><svg viewBox="0 0 24 24" width="16" height="16"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg> ' + (d.comments || 0) + ' commentaire(s)</span></div>'
            +   '<div class="art-show__actions"><a href="' + d.editUrl + '" class="btn btn-primary btn-sm">Modifier l\'article</a></div>'
            + '</div>'
            + '</div>';
        showViewModal(null, null, html, true);
    });
</script>
@endsection
