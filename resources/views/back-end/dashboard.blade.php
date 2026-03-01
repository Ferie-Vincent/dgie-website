@extends('back-end.layouts.admin')

@section('title', 'Tableau de bord')
@section('breadcrumb', 'Tableau de bord')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Tableau de bord</h1>
        <p class="content-subtitle">Bienvenue, {{ auth()->user()->name }}</p>
    </div>
</div>

{{-- Stats principales --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon orange">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['articles'] }}</div>
        <div class="stat-label">Articles</div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['dossiers'] }}</div>
        <div class="stat-label">Dossiers</div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['evenements'] }}</div>
        <div class="stat-label">Événements</div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon bordeaux">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>
        <div class="stat-value">{{ $stats['utilisateurs'] }}</div>
        <div class="stat-label">Utilisateurs</div>
    </div>
</div>

{{-- Bannière Héro --}}
<div class="admin-card" style="margin-bottom: 16px;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
        <div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <svg viewBox="0 0 24 24" width="18" height="18" stroke="var(--blue, #3b82f6)" fill="none" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                {{-- <h2 style="font-size: 15px; font-weight: 600; color: var(--text-900); margin: 0;">Bannière Héro</h2> --}}
            </div>
            <p style="font-size: 12px; color: var(--text-400); margin: 4px 0 0 28px;">Image principale plein écran</p>
        </div>
        <button type="button" class="btn btn-outline btn-sm" onclick="openHeroBannerModal()" style="display: flex; align-items: center; gap: 6px;">
            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
            Remplacer l'image
        </button>
    </div>
    <div class="hero-banner-preview">
        @if($heroBanner && $heroBanner->image)
            <img src="{{ asset('storage/' . $heroBanner->image) }}" alt="Bannière actuelle" id="heroBannerImg" class="hero-banner-preview__img">
        @else
            <div class="hero-banner-preview__empty" id="heroBannerEmpty">
                <svg viewBox="0 0 24 24" width="40" height="40" stroke="#94a3b8" fill="none" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span>Aucune bannière configurée</span>
                <span style="font-size: 10px; color: var(--text-300);">Dimensions recommandées : 2400 x 800px</span>
            </div>
        @endif
        <div class="hero-banner-preview__overlay"></div>
        <div class="hero-banner-preview__badges">
            @if($heroBanner && $heroBanner->is_active)
            <span class="hero-banner-preview__badge hero-banner-preview__badge--active">Actif</span>
            @endif
            <span class="hero-banner-preview__badge hero-banner-preview__badge--dim">2400 × 800px</span>
        </div>
    </div>
</div>

{{-- Modal Bannière Héro --}}
<div class="admin-modal-overlay" id="heroOverlay">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" id="heroForm" action="{{ $heroBanner ? route('admin.banners.update', $heroBanner) : route('admin.banners.store') }}" enctype="multipart/form-data">
            @csrf
            @if($heroBanner) @method('PUT') @endif
            <input type="hidden" name="position" value="top">
            <input type="hidden" name="is_active" value="1">
            <input type="hidden" name="_redirect" value="dashboard">
            <div class="modal-fp-header">
                <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" fill="none" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <h3>Remplacer la bannière</h3>
                <button type="button" class="modal-fp-close" onclick="closeHeroModal()">
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div id="heroPreviewBlock" style="display: {{ ($heroBanner && $heroBanner->image) ? 'block' : 'none' }}; margin-bottom: 20px; border-radius: 10px; overflow: hidden; border: 1px solid var(--border-light, #e2e8f0);">
                    <img id="heroPreviewImg" src="{{ ($heroBanner && $heroBanner->image) ? asset('storage/' . $heroBanner->image) : '' }}" alt="Aperçu" style="width: 100%; height: 120px; object-fit: cover;">
                </div>

                <div class="modal-fp-section">
                    <div class="modal-fp-section-title">Image de la bannière</div>
                    <label for="heroImageInput" class="fp-dropzone">
                        <svg viewBox="0 0 24 24" width="28" height="28" stroke="#94a3b8" fill="none" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span style="color: var(--text-400); font-size: 13px;">Glissez une image ou cliquez</span>
                        <span style="color: var(--orange); font-size: 11px;">Dimensions recommandées : 2400 × 800px</span>
                    </label>
                    <input type="file" id="heroImageInput" name="image" accept="image/*" style="display:none;" onchange="previewHeroImage(this)">
                </div>

                <div class="modal-fp-section">
                    <div class="modal-fp-section-title">Lien (optionnel)</div>
                    <div class="form-group">
                        <label for="hero_url">URL de redirection</label>
                        <input type="url" id="hero_url" name="url" class="form-input" placeholder="https://..." value="{{ $heroBanner->url ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <button type="button" class="btn btn-outline" onclick="closeHeroModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

{{-- Organigramme Officiel --}}
<div class="admin-card" style="margin-bottom: 16px;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <svg viewBox="0 0 24 24" width="20" height="20" stroke="var(--orange)" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <h2 style="font-size: 15px; font-weight: 600; color: var(--text-900); margin: 0;">Organigramme Officiel</h2>
        </div>
        <a href="{{ route('admin.staff.index') }}" style="font-size: 12px; color: var(--orange); text-decoration: none; font-weight: 500;">Gérer le personnel &rarr;</a>
    </div>

    @if($portraits->count() > 0)
    <div class="organigramme-grid">
        @foreach($portraits as $portrait)
        <div class="organigramme-card" data-portrait-id="{{ $portrait->id }}">
            <div class="organigramme-card__img">
                @if($portrait->photo)
                    <img src="{{ asset('storage/' . $portrait->photo) }}" alt="{{ $portrait->name }}">
                @else
                    <div class="organigramme-card__placeholder">
                        <svg viewBox="0 0 24 24" width="40" height="40" stroke="#cbd5e1" fill="none" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                @endif
                <div class="organigramme-card__overlay"></div>
                <button class="organigramme-card__edit" onclick="openPortraitModal({{ $portrait->id }}, '{{ addslashes($portrait->name) }}', '{{ addslashes($portrait->title) }}', '{{ $portrait->photo ? asset('storage/' . $portrait->photo) : '' }}', '{{ $portrait->type }}')">
                    <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
            <div class="organigramme-card__info">
                <span class="organigramme-card__badge">{{ $portrait->type === 'ministre' ? 'MINISTRE' : 'DIRECTEUR GÉNÉRAL' }}</span>
                <h3 class="organigramme-card__name">{{ $portrait->name }}</h3>
                <p class="organigramme-card__title">{{ $portrait->title }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state" style="padding: 32px;">
        <svg viewBox="0 0 24 24" width="40" height="40" stroke="#cbd5e1" fill="none" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        <h3>Aucun portrait officiel</h3>
        <p>Ajoutez les portraits du Ministre, Ministre délégué et Directeur Général.</p>
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm">Ajouter un portrait</a>
    </div>
    @endif
</div>

{{-- Espaces Publicitaires --}}
<div class="admin-card" style="margin-bottom: 16px;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <svg viewBox="0 0 24 24" width="18" height="18" stroke="var(--orange)" fill="none" stroke-width="2"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
            <h2 style="font-size: 15px; font-weight: 600; color: var(--text-900); margin: 0;">Espaces Publicitaires</h2>
        </div>
        <span style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--text-400);">Gestion des bannières</span>
    </div>
    <div class="ad-banners-grid">
        @for($i = 0; $i < 3; $i++)
            @php $ad = $adBanners[$i] ?? null; @endphp
            <div class="ad-banner-slot group">
                @if($ad && $ad->image)
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->title }}" class="ad-banner-slot__img">
                    <div class="ad-banner-slot__overlay">
                        <button type="button" class="ad-banner-slot__btn" onclick="openAdModal({{ $ad->id }}, '{{ $ad->url }}', '{{ asset('storage/' . $ad->image) }}')">
                            <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            Remplacer
                        </button>
                    </div>
                @elseif($ad)
                    <div class="ad-banner-slot__empty">
                        <svg viewBox="0 0 24 24" width="28" height="28" stroke="#94a3b8" fill="none" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span>Aucune image</span>
                    </div>
                    <div class="ad-banner-slot__overlay">
                        <button type="button" class="ad-banner-slot__btn" onclick="openAdModal({{ $ad->id }}, '{{ $ad->url }}', '')">
                            <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" fill="none" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            Remplacer
                        </button>
                    </div>
                @else
                    <div class="ad-banner-slot__empty" style="cursor: pointer;" onclick="createAdModal()">
                        <svg viewBox="0 0 24 24" width="28" height="28" stroke="#94a3b8" fill="none" stroke-width="1.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <span>Ajouter une pub</span>
                    </div>
                @endif
                <span class="ad-banner-slot__badge">Position #{{ $i + 1 }}</span>
            </div>
        @endfor
    </div>
</div>

{{-- Modal édition/création pub --}}
<div class="admin-modal-overlay" id="adOverlay">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" id="adForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="adMethodField" name="_method" value="PUT">
            <input type="hidden" name="position" value="pub">
            <input type="hidden" name="is_active" value="1">
            <input type="hidden" name="_redirect" value="dashboard">
            <div class="modal-fp-header">
                <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" fill="none" stroke-width="2"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
                <h3 id="adModalTitle">Modifier la publicité</h3>
                <button type="button" class="modal-fp-close" onclick="closeAdModal()">
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                <div id="adPreviewBlock" style="display: none; margin-bottom: 20px; border-radius: 10px; overflow: hidden; border: 1px solid var(--border-light, #e2e8f0);">
                    <img id="adPreviewImg" src="" alt="Aperçu" style="width: 100%; height: 100px; object-fit: cover;">
                </div>

                <div class="modal-fp-section">
                    <div class="modal-fp-section-title">Bannière publicitaire</div>
                    <label for="adImageInput" class="fp-dropzone">
                        <svg viewBox="0 0 24 24" width="28" height="28" stroke="#94a3b8" fill="none" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span style="color: var(--text-400); font-size: 13px;">Glissez une image ou cliquez</span>
                        <span style="color: var(--orange); font-size: 11px;">Dimensions recommandées : 728 x 90 ou 300 x 250</span>
                    </label>
                    <input type="file" id="adImageInput" name="image" accept="image/*" style="display:none;" onchange="previewAdImage(this)">
                </div>

                <div class="modal-fp-section">
                    <div class="modal-fp-section-title">Lien de destination</div>
                    <div class="form-group">
                        <label for="ad_url">URL</label>
                        <input type="url" id="ad_url" name="url" class="form-input" placeholder="https://...">
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <button type="button" class="btn btn-outline" onclick="closeAdModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal édition portrait --}}
<div class="admin-modal-overlay" id="portraitOverlay">
    <div class="admin-modal modal-fullpage modal-sm">
        <form method="POST" id="portraitForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="portrait_type" name="type" value="">
            <input type="hidden" name="is_active" value="1">
            <input type="hidden" name="_redirect" value="dashboard">
            <div class="modal-fp-header">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <h3 id="portraitModalTitle">Modifier les infos</h3>
                <button type="button" class="modal-fp-close" onclick="closePortraitModal()">
                    <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <div class="modal-fp-body">
                {{-- Aperçu actuel --}}
                <div id="portraitPreviewBlock" style="display: flex; align-items: center; gap: 14px; padding: 14px; background: var(--bg-50, #f8fafc); border-radius: 10px; margin-bottom: 20px;">
                    <img id="portraitPreviewImg" src="" alt="" style="width: 56px; height: 56px; border-radius: 10px; object-fit: cover;">
                    <div>
                        <div style="font-size: 13px; font-weight: 600; color: var(--text-900);">Aperçu actuel</div>
                        <div style="font-size: 11px; color: var(--text-400);">Ce portrait sera affiché en page d'accueil</div>
                    </div>
                </div>

                <div class="modal-fp-section">
                    <div class="modal-fp-section-title">Photo</div>
                    <label for="portraitPhotoInput" class="fp-dropzone" id="portraitDropzone">
                        <svg viewBox="0 0 24 24" width="32" height="32" stroke="#94a3b8" fill="none" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span style="color: var(--text-400); font-size: 13px;">Glissez une photo ou cliquez</span>
                        <span style="color: var(--orange); font-size: 11px;">Format portrait 4:5 recommandé</span>
                    </label>
                    <input type="file" id="portraitPhotoInput" name="photo" accept="image/*" style="display:none;" onchange="previewPortraitPhoto(this)">
                </div>

                <div class="modal-fp-section">
                    <div class="modal-fp-section-title">Informations</div>
                    <div class="form-group">
                        <label for="portrait_name">Nom complet</label>
                        <input type="text" id="portrait_name" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="portrait_title">Titre (optionnel)</label>
                        <input type="text" id="portrait_title" name="title" class="form-input" placeholder="Ex: Ministre d'État...">
                    </div>
                </div>
            </div>
            <div class="modal-fp-footer">
                <button type="button" class="btn btn-outline" onclick="closePortraitModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

{{-- Alertes rapides --}}
@if($stats['comments_pending'] > 0 || $stats['messages_unread'] > 0)
<div style="display: flex; gap: 12px; margin-bottom: 16px;">
    @if($stats['comments_pending'] > 0)
    <a href="{{ route('admin.comments.index') }}" class="admin-card" style="padding: 12px 16px; display: flex; align-items: center; gap: 10px; text-decoration: none; flex: 1; border-left: 3px solid #f59e0b;">
        <div style="font-size: 20px; font-weight: 600; color: #f59e0b;">{{ $stats['comments_pending'] }}</div>
        <div style="font-size: 12px; color: var(--text-400);">commentaire(s) en attente de modération</div>
    </a>
    @endif
    @if($stats['messages_unread'] > 0)
    <a href="{{ route('admin.contact-messages.index') }}" class="admin-card" style="padding: 12px 16px; display: flex; align-items: center; gap: 10px; text-decoration: none; flex: 1; border-left: 3px solid #3b82f6;">
        <div style="font-size: 20px; font-weight: 600; color: #3b82f6;">{{ $stats['messages_unread'] }}</div>
        <div style="font-size: 12px; color: var(--text-400);">message(s) non lu(s)</div>
    </a>
    @endif
</div>
@endif

{{-- Two columns --}}
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">

    {{-- Recent articles --}}
    <div class="admin-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
            <h2 style="font-size: 13px; font-weight: 600; color: var(--text-900); letter-spacing: -0.01em;">Articles récents</h2>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline">Voir tout</a>
        </div>

        @if($recentArticles->count() > 0)
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentArticles as $article)
                    <tr>
                        <td><span class="table-title">{{ Str::limit($article->title, 30) }}</span></td>
                        <td style="font-size: 11px; color: var(--text-400);">{{ $article->category->name ?? '—' }}</td>
                        <td>
                            <span class="badge-status badge-{{ $article->status }}">
                                <span class="dot"></span>{{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td style="font-size: 11px; color: var(--text-400);">{{ $article->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            <h3>Aucun article</h3>
            <p>Commencez par créer votre premier article.</p>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">Créer un article</a>
        </div>
        @endif
    </div>

    {{-- Recent events --}}
    <div class="admin-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
            <h2 style="font-size: 13px; font-weight: 600; color: var(--text-900); letter-spacing: -0.01em;">Événements récents</h2>
            <a href="{{ route('admin.evenements.index') }}" class="btn btn-sm btn-outline">Voir tout</a>
        </div>

        @if($recentEvenements->count() > 0)
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentEvenements as $event)
                    <tr>
                        <td><span class="table-title">{{ Str::limit($event->title, 30) }}</span></td>
                        <td style="font-size: 11px; color: var(--text-400);">{{ $event->event_date->format('d/m/Y') }}</td>
                        <td style="font-size: 11px; color: var(--text-400);">{{ Str::limit($event->location ?? '—', 18) }}</td>
                        <td>
                            <span class="badge-status badge-{{ $event->status }}">
                                <span class="dot"></span>{{ ucfirst($event->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <h3>Aucun événement</h3>
            <p>Planifiez votre premier événement.</p>
            <a href="{{ route('admin.evenements.create') }}" class="btn btn-primary btn-sm">Créer un événement</a>
        </div>
        @endif
    </div>

</div>

{{-- Quick access cards --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 16px;">
    <a href="{{ route('admin.categories.index') }}" class="admin-card" style="padding: 14px; display: block; transition: all 0.2s; text-decoration: none;">
        <div style="font-size: 20px; font-weight: 600; color: var(--text-900); letter-spacing: -0.025em;">{{ $stats['categories'] }}</div>
        <div style="font-size: 11px; color: var(--text-400); margin-top: 2px;">Catégories</div>
    </a>
    <a href="{{ route('admin.flash-infos.index') }}" class="admin-card" style="padding: 14px; display: block; transition: all 0.2s; text-decoration: none;">
        <div style="font-size: 20px; font-weight: 600; color: var(--text-900); letter-spacing: -0.025em;">{{ $stats['flash_infos'] }}</div>
        <div style="font-size: 11px; color: var(--text-400); margin-top: 2px;">Flash Infos actifs</div>
    </a>
    <a href="{{ route('admin.newsletter.index') }}" class="admin-card" style="padding: 14px; display: block; transition: all 0.2s; text-decoration: none;">
        <div style="font-size: 20px; font-weight: 600; color: var(--text-900); letter-spacing: -0.025em;">{{ $stats['newsletter'] }}</div>
        <div style="font-size: 11px; color: var(--text-400); margin-top: 2px;">Abonnés newsletter</div>
    </a>
    <a href="{{ route('admin.galerie.index') }}" class="admin-card" style="padding: 14px; display: block; transition: all 0.2s; text-decoration: none;">
        <div style="font-size: 20px; font-weight: 600; color: var(--text-900); letter-spacing: -0.025em;">{{ $stats['albums'] }}</div>
        <div style="font-size: 11px; color: var(--text-400); margin-top: 2px;">Albums galerie</div>
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="admin-card" style="padding: 14px; display: block; transition: all 0.2s; text-decoration: none;">
        <div style="font-size: 20px; font-weight: 600; color: var(--text-900); letter-spacing: -0.025em;">{{ $stats['testimonials'] }}</div>
        <div style="font-size: 11px; color: var(--text-400); margin-top: 2px;">Témoignages</div>
    </a>
    <a href="{{ route('admin.partners.index') }}" class="admin-card" style="padding: 14px; display: block; transition: all 0.2s; text-decoration: none;">
        <div style="font-size: 20px; font-weight: 600; color: var(--text-900); letter-spacing: -0.025em;">{{ $stats['partners'] }}</div>
        <div style="font-size: 11px; color: var(--text-400); margin-top: 2px;">Partenaires</div>
    </a>
    <a href="{{ route('admin.faqs.index') }}" class="admin-card" style="padding: 14px; display: block; transition: all 0.2s; text-decoration: none;">
        <div style="font-size: 20px; font-weight: 600; color: var(--text-900); letter-spacing: -0.025em;">{{ $stats['faqs'] }}</div>
        <div style="font-size: 11px; color: var(--text-400); margin-top: 2px;">FAQ</div>
    </a>
</div>
@endsection

@section('scripts')
<script>
function openPortraitModal(id, name, title, photoUrl, type) {
    const overlay = document.getElementById('portraitOverlay');
    const form = document.getElementById('portraitForm');
    form.action = '/admin/staff/' + id;
    document.getElementById('portrait_name').value = name;
    document.getElementById('portrait_title').value = title;
    document.getElementById('portrait_type').value = type || 'ministre';
    document.getElementById('portraitModalTitle').textContent = 'Modifier les infos';

    const previewBlock = document.getElementById('portraitPreviewBlock');
    const previewImg = document.getElementById('portraitPreviewImg');
    if (photoUrl) {
        previewImg.src = photoUrl;
        previewBlock.style.display = 'flex';
    } else {
        previewBlock.style.display = 'none';
    }

    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePortraitModal() {
    document.getElementById('portraitOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

function previewPortraitPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewBlock = document.getElementById('portraitPreviewBlock');
            const previewImg = document.getElementById('portraitPreviewImg');
            previewImg.src = e.target.result;
            previewBlock.style.display = 'flex';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('portraitOverlay')?.addEventListener('click', function(e) {
    if (e.target === this) closePortraitModal();
});

// --- Espaces publicitaires ---
function openAdModal(id, url, imageUrl) {
    const overlay = document.getElementById('adOverlay');
    const form = document.getElementById('adForm');
    form.action = '/admin/visuels/' + id;
    document.getElementById('adMethodField').value = 'PUT';
    document.getElementById('adModalTitle').textContent = 'Modifier la publicité';
    document.getElementById('ad_url').value = url || '';

    const previewBlock = document.getElementById('adPreviewBlock');
    const previewImg = document.getElementById('adPreviewImg');
    if (imageUrl) {
        previewImg.src = imageUrl;
        previewBlock.style.display = 'block';
    } else {
        previewBlock.style.display = 'none';
    }

    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function createAdModal() {
    const overlay = document.getElementById('adOverlay');
    const form = document.getElementById('adForm');
    form.action = '/admin/visuels';
    document.getElementById('adMethodField').value = 'POST';
    document.getElementById('adModalTitle').textContent = 'Créer une publicité';
    document.getElementById('ad_url').value = '';
    document.getElementById('adPreviewBlock').style.display = 'none';
    document.getElementById('adImageInput').value = '';

    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeAdModal() {
    document.getElementById('adOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

function previewAdImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewBlock = document.getElementById('adPreviewBlock');
            const previewImg = document.getElementById('adPreviewImg');
            previewImg.src = e.target.result;
            previewBlock.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('adOverlay')?.addEventListener('click', function(e) {
    if (e.target === this) closeAdModal();
});

// --- Bannière Héro ---
function openHeroBannerModal() {
    document.getElementById('heroOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeHeroModal() {
    document.getElementById('heroOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

function previewHeroImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('heroPreviewImg').src = e.target.result;
            document.getElementById('heroPreviewBlock').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('heroOverlay')?.addEventListener('click', function(e) {
    if (e.target === this) closeHeroModal();
});
</script>
@endsection
