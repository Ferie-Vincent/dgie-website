@extends('back-end.layouts.admin')

@section('title', 'Paramètres')
@section('breadcrumb', 'Paramètres')

@section('content')
<div class="content-header">
    <div>
        <h1 class="content-title">Configuration du Site</h1>
        <p class="content-subtitle">Gérez le pied de page, les réseaux sociaux et les informations de contact.</p>
    </div>
</div>

{{-- Footer Management --}}
<div class="ftr-section-title">
    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 15h18"/></svg>
    Personnalisation du Pied de Page
</div>

<div class="ftr-columns-grid ftr-columns-grid--4">
    {{-- Column 1: À Propos --}}
    <div class="ftr-column-card">
        <div class="ftr-column-header">
            <span class="ftr-column-number">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            </span>
            <h3>À Propos</h3>
        </div>
        <div class="ftr-column-body">
            <div class="form-group">
                <label class="ftr-label">Titre / Nom</label>
                <input type="text" id="footer_col1_title" class="form-input" value="{{ $footerSettings['footer_col1_title'] ?? '' }}" oninput="updateFooterPreview()">
            </div>
            <div class="form-group">
                <label class="ftr-label">Description</label>
                <textarea id="footer_col1_description" class="form-textarea" rows="3" oninput="updateFooterPreview()">{{ $footerSettings['footer_col1_description'] ?? '' }}</textarea>
            </div>
            <div class="form-group" style="margin-top: 8px;">
                <label class="ftr-label">Réseaux Sociaux</label>
                <div class="ftr-social-inputs">
                    <div class="ftr-social-row">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#1877F2" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        <input type="text" id="social_facebook" class="form-input" value="{{ $socialSettings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/..." oninput="updateFooterPreview()">
                    </div>
                    <div class="ftr-social-row">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#333" stroke-width="2"><path d="M4 4l11.733 16h4.267l-11.733 -16zM4 20l6.768 -6.768m2.46 -2.46L20 4"/></svg>
                        <input type="text" id="social_twitter" class="form-input" value="{{ $socialSettings['social_twitter'] ?? '' }}" placeholder="https://x.com/..." oninput="updateFooterPreview()">
                    </div>
                    <div class="ftr-social-row">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#0077b5" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                        <input type="text" id="social_linkedin" class="form-input" value="{{ $socialSettings['social_linkedin'] ?? '' }}" placeholder="https://linkedin.com/..." oninput="updateFooterPreview()">
                    </div>
                    <div class="ftr-social-row">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#FF0000" stroke-width="2"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                        <input type="text" id="social_youtube" class="form-input" value="{{ $socialSettings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/..." oninput="updateFooterPreview()">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Column 2: Liens Rapides --}}
    <div class="ftr-column-card">
        <div class="ftr-column-header">
            <span class="ftr-column-number">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
            </span>
            <h3>Liens Rapides</h3>
        </div>
        <div class="ftr-column-body">
            <div class="form-group">
                <label class="ftr-label">Titre de la section</label>
                <input type="text" id="footer_col2_title" class="form-input" value="{{ $footerSettings['footer_col2_title'] ?? 'LIENS RAPIDES' }}" oninput="updateFooterPreview()">
            </div>
            <div class="form-group">
                <label class="ftr-label">Liens internes du site</label>
                <div id="quick-links-list" class="ftr-links-list"></div>
                <button type="button" onclick="openAddLinkModal('quick')" class="ftr-add-link-btn">
                    <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Ajouter un lien
                </button>
            </div>
        </div>
    </div>

    {{-- Column 3: Liens Utiles --}}
    <div class="ftr-column-card">
        <div class="ftr-column-header">
            <span class="ftr-column-number">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </span>
            <h3>Liens Utiles</h3>
        </div>
        <div class="ftr-column-body">
            <div class="form-group">
                <label class="ftr-label">Titre de la section</label>
                <input type="text" id="footer_col3_title" class="form-input" value="{{ $footerSettings['footer_col3_title'] ?? 'LIENS UTILES' }}" oninput="updateFooterPreview()">
            </div>
            <div class="form-group">
                <label class="ftr-label">Liens institutionnels externes</label>
                <div id="footer-links-list" class="ftr-links-list"></div>
                <button type="button" onclick="openAddLinkModal('footer')" class="ftr-add-link-btn">
                    <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Ajouter un lien
                </button>
            </div>
        </div>
    </div>

    {{-- Column 4: Contact --}}
    <div class="ftr-column-card">
        <div class="ftr-column-header">
            <span class="ftr-column-number">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.81.36 1.6.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c1.21.34 2 .57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </span>
            <h3>Contact</h3>
        </div>
        <div class="ftr-column-body">
            <div class="form-group">
                <label class="ftr-label">Titre de la section</label>
                <input type="text" id="footer_col4_title" class="form-input" value="{{ $footerSettings['footer_col4_title'] ?? 'CONTACT' }}" oninput="updateFooterPreview()">
            </div>
            <div class="ftr-contact-fields">
                <div class="form-group">
                    <label class="ftr-contact-label">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        Adresse
                    </label>
                    <input type="text" id="footer_address" class="form-input" value="{{ $footerSettings['footer_address'] ?? '' }}" oninput="updateFooterPreview()">
                </div>
                <div class="form-group">
                    <label class="ftr-contact-label">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Téléphone
                    </label>
                    <input type="text" id="footer_phone" class="form-input" value="{{ $footerSettings['footer_phone'] ?? '' }}" oninput="updateFooterPreview()">
                </div>
                <div class="form-group">
                    <label class="ftr-contact-label">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        Email
                    </label>
                    <input type="text" id="footer_email" class="form-input" value="{{ $footerSettings['footer_email'] ?? '' }}" oninput="updateFooterPreview()">
                </div>
                <div class="form-group">
                    <label class="ftr-contact-label">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Horaires
                    </label>
                    <input type="text" id="footer_hours" class="form-input" value="{{ $footerSettings['footer_hours'] ?? '' }}" oninput="updateFooterPreview()">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Copyright --}}
<div class="ftr-column-card" style="margin-bottom: 28px;">
    <div class="ftr-column-header">
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M15 9.354a4 4 0 1 0 0 5.292"/></svg>
        <h3>Barre de Copyright</h3>
    </div>
    <div class="ftr-column-body">
        <div class="form-group">
            <label class="ftr-label">Texte de copyright</label>
            <input type="text" id="footer_copyright" class="form-input" value="{{ $footerSettings['footer_copyright'] ?? '' }}" oninput="updateFooterPreview()">
        </div>
    </div>
</div>

{{-- Statistiques Diaspora --}}
@php $statsSettings = \App\Models\Setting::getGroup('stats'); @endphp
<div class="ftr-section-title" style="margin-top: 28px;">
    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
    Statistiques Diaspora (Le Coin des Diasporas)
</div>
<div class="ftr-columns-grid ftr-columns-grid--4" style="grid-template-columns: repeat(3, 1fr);">
    <div class="ftr-column-card">
        <div class="ftr-column-header"><h3>Ivoiriens à l'étranger</h3></div>
        <div class="ftr-column-body">
            <div class="form-group">
                <label class="ftr-label">Valeur affichée</label>
                <input type="text" id="stat_diaspo_ivoiriens" class="form-input" value="{{ $statsSettings['stat_diaspo_ivoiriens'] ?? '1,24M' }}">
            </div>
            <div class="form-group">
                <label class="ftr-label">Libellé</label>
                <input type="text" id="stat_diaspo_ivoiriens_label" class="form-input" value="{{ $statsSettings['stat_diaspo_ivoiriens_label'] ?? 'Ivoiriens à l\'étranger' }}">
            </div>
        </div>
    </div>
    <div class="ftr-column-card">
        <div class="ftr-column-header"><h3>Associations</h3></div>
        <div class="ftr-column-body">
            <div class="form-group">
                <label class="ftr-label">Valeur affichée</label>
                <input type="text" id="stat_diaspo_associations" class="form-input" value="{{ $statsSettings['stat_diaspo_associations'] ?? '150+' }}">
            </div>
            <div class="form-group">
                <label class="ftr-label">Libellé</label>
                <input type="text" id="stat_diaspo_associations_label" class="form-input" value="{{ $statsSettings['stat_diaspo_associations_label'] ?? 'Associations recensées' }}">
            </div>
        </div>
    </div>
    <div class="ftr-column-card">
        <div class="ftr-column-header"><h3>Événements</h3></div>
        <div class="ftr-column-body">
            <div class="form-group">
                <label class="ftr-label">Valeur affichée</label>
                <input type="text" id="stat_diaspo_evenements" class="form-input" value="{{ $statsSettings['stat_diaspo_evenements'] ?? '40+' }}">
            </div>
            <div class="form-group">
                <label class="ftr-label">Libellé</label>
                <input type="text" id="stat_diaspo_evenements_label" class="form-input" value="{{ $statsSettings['stat_diaspo_evenements_label'] ?? 'Événements par an' }}">
            </div>
        </div>
    </div>
</div>

{{-- Live Footer Preview --}}
<div class="ftr-preview-wrapper">
    <div class="ftr-preview-toolbar">
        <span class="ftr-preview-label">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            Aperçu en temps réel
        </span>
        <div class="ftr-preview-dots">
            <span class="dot-red"></span>
            <span class="dot-yellow"></span>
            <span class="dot-green"></span>
        </div>
    </div>
    <footer class="ftr-preview-footer">
        <div class="ftr-preview-grid ftr-preview-grid--4">
            {{-- Col 1: Logo + Description + Socials --}}
            <div class="ftr-preview-col ftr-preview-col--about">
                <div class="ftr-preview-logo-block">
                    <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE" class="ftr-preview-logo-img">
                    <div class="ftr-preview-logo-text">
                        <strong>DGIE</strong>
                        <span>Direction Générale des<br>Ivoiriens de l'Extérieur</span>
                    </div>
                </div>
                <h3 id="preview-col1-title" class="ftr-preview-title--about">{{ $footerSettings['footer_col1_title'] ?? '' }}</h3>
                <p id="preview-col1-description">{{ $footerSettings['footer_col1_description'] ?? '' }}</p>
                <div id="preview-social-links" class="ftr-preview-socials"></div>
            </div>

            {{-- Col 2: Liens Rapides --}}
            <div class="ftr-preview-col">
                <h3 id="preview-col2-title">{{ $footerSettings['footer_col2_title'] ?? 'LIENS RAPIDES' }}</h3>
                <ul id="preview-quick-links" class="ftr-preview-links"></ul>
            </div>

            {{-- Col 3: Liens Utiles --}}
            <div class="ftr-preview-col">
                <h3 id="preview-col3-title">{{ $footerSettings['footer_col3_title'] ?? 'LIENS UTILES' }}</h3>
                <ul id="preview-footer-links" class="ftr-preview-links"></ul>
            </div>

            {{-- Col 4: Contact --}}
            <div class="ftr-preview-col">
                <h3 id="preview-col4-title">{{ $footerSettings['footer_col4_title'] ?? 'CONTACT' }}</h3>
                <ul class="ftr-preview-contact">
                    <li id="preview-address">{{ $footerSettings['footer_address'] ?? '' }}</li>
                    <li id="preview-phone"></li>
                    <li id="preview-email"></li>
                    <li id="preview-hours">{{ $footerSettings['footer_hours'] ?? '' }}</li>
                </ul>
            </div>
        </div>

        {{-- Armoirie watermark --}}
        <div class="ftr-preview-armoirie">
            <img src="{{ asset('assets/images/armoirie-ci.png') }}" alt="">
        </div>

        {{-- Copyright bar --}}
        <div class="ftr-preview-copyright-bar">
            <span id="preview-copyright">{{ $footerSettings['footer_copyright'] ?? '' }}</span>
            <div class="ftr-preview-copyright-links">
                <a href="#">Mentions légales</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">Plan du site</a>
            </div>
        </div>
    </footer>
</div>

{{-- Save Button --}}
<div class="ftr-save-btn-wrapper">
    <button type="button" onclick="saveSettings()" class="btn btn-primary">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Enregistrer les modifications
    </button>
</div>

{{-- Add Link Modal --}}
<div class="admin-modal-overlay" id="addLinkModal">
    <div class="admin-modal" style="max-width: 400px;">
        <div class="modal-fp-header" style="padding: 14px 20px;">
            <div><h3 id="addLinkModalTitle">Ajouter un lien</h3></div>
            <button type="button" class="modal-fp-close" onclick="closeAddLinkModal()">
                <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div style="padding: 20px;">
            <div class="form-group">
                <label class="ftr-label">Nom du lien</label>
                <input type="text" id="link-name-input" class="form-input" placeholder="Ex : Présidence de la République">
            </div>
            <div class="form-group">
                <label class="ftr-label">URL de destination</label>
                <input type="text" id="link-url-input" class="form-input" placeholder="https://...">
            </div>
        </div>
        <div class="usr-modal-footer">
            <button type="button" class="btn btn-outline" onclick="closeAddLinkModal()">Annuler</button>
            <button type="button" class="btn btn-primary" onclick="addLink()">Ajouter</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let quickLinks = [];
let footerLinks = [];
let currentLinkTarget = 'footer';

// ========== LINKS MANAGEMENT ==========
function renderLinksList(type) {
    const links = type === 'quick' ? quickLinks : footerLinks;
    const container = document.getElementById(type === 'quick' ? 'quick-links-list' : 'footer-links-list');
    container.innerHTML = '';
    links.forEach((link, i) => {
        const div = document.createElement('div');
        div.className = 'ftr-link-row';
        div.innerHTML = `
            <div class="ftr-link-inputs">
                <input type="text" class="form-input" value="${link.name}" oninput="${type === 'quick' ? 'quickLinks' : 'footerLinks'}[${i}].name=this.value;updateFooterPreview()" placeholder="Nom">
                <input type="text" class="form-input" value="${link.url}" oninput="${type === 'quick' ? 'quickLinks' : 'footerLinks'}[${i}].url=this.value;updateFooterPreview()" placeholder="URL">
            </div>
            <button type="button" class="ftr-link-remove" onclick="removeLink('${type}', ${i})" title="Supprimer">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18"/><path d="m6 6 12 12"/></svg>
            </button>`;
        container.appendChild(div);
    });
    updateFooterPreview();
}

function removeLink(type, i) {
    if (type === 'quick') { quickLinks.splice(i, 1); renderLinksList('quick'); }
    else { footerLinks.splice(i, 1); renderLinksList('footer'); }
}

function openAddLinkModal(type) {
    currentLinkTarget = type;
    document.getElementById('link-name-input').value = '';
    document.getElementById('link-url-input').value = '';
    document.getElementById('addLinkModalTitle').textContent = type === 'quick' ? 'Ajouter un lien rapide' : 'Ajouter un lien utile';
    document.getElementById('addLinkModal').classList.add('active');
}
function closeAddLinkModal() { document.getElementById('addLinkModal').classList.remove('active'); }

function addLink() {
    const name = document.getElementById('link-name-input').value.trim();
    const url = document.getElementById('link-url-input').value.trim();
    if (!name || !url) { showToast('warning', 'Veuillez remplir les deux champs.'); return; }
    if (currentLinkTarget === 'quick') { quickLinks.push({ name, url }); renderLinksList('quick'); }
    else { footerLinks.push({ name, url }); renderLinksList('footer'); }
    closeAddLinkModal();
}

// ========== LIVE PREVIEW ==========
function updateFooterPreview() {
    // Col 1 - About
    document.getElementById('preview-col1-title').textContent = document.getElementById('footer_col1_title').value;
    document.getElementById('preview-col1-description').textContent = document.getElementById('footer_col1_description').value;

    // Social icons
    const socials = document.getElementById('preview-social-links');
    socials.innerHTML = '';
    const icons = [
        { id: 'social_facebook', svg: '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>' },
        { id: 'social_twitter', svg: '<svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>' },
        { id: 'social_linkedin', svg: '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>' },
        { id: 'social_youtube', svg: '<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>' }
    ];
    icons.forEach(s => {
        const val = document.getElementById(s.id).value;
        if (val) {
            socials.innerHTML += `<a href="#" class="ftr-social-icon">${s.svg}</a>`;
        }
    });

    // Col 2 - Quick Links
    document.getElementById('preview-col2-title').textContent = document.getElementById('footer_col2_title').value || 'LIENS RAPIDES';
    const qlUl = document.getElementById('preview-quick-links');
    qlUl.innerHTML = '';
    quickLinks.forEach(l => { qlUl.innerHTML += `<li><a href="#">${l.name}</a></li>`; });

    // Col 3 - Footer Links
    document.getElementById('preview-col3-title').textContent = document.getElementById('footer_col3_title').value || 'LIENS UTILES';
    const flUl = document.getElementById('preview-footer-links');
    flUl.innerHTML = '';
    footerLinks.forEach(l => { flUl.innerHTML += `<li><a href="#">${l.name}</a></li>`; });

    // Col 4 - Contact
    document.getElementById('preview-col4-title').textContent = document.getElementById('footer_col4_title').value || 'CONTACT';
    document.getElementById('preview-address').textContent = document.getElementById('footer_address').value;
    const phone = document.getElementById('footer_phone').value;
    document.getElementById('preview-phone').textContent = phone ? 'Téléphone : ' + phone : '';
    const email = document.getElementById('footer_email').value;
    document.getElementById('preview-email').textContent = email ? 'E-mail : ' + email : '';
    document.getElementById('preview-hours').textContent = document.getElementById('footer_hours').value;

    // Copyright
    document.getElementById('preview-copyright').textContent = document.getElementById('footer_copyright').value;
}

// ========== SAVE ==========
function saveSettings() {
    const data = {
        footer_col1_title: document.getElementById('footer_col1_title').value,
        footer_col1_description: document.getElementById('footer_col1_description').value,
        footer_col2_title: document.getElementById('footer_col2_title').value,
        footer_quick_links: JSON.stringify(quickLinks),
        footer_col3_title: document.getElementById('footer_col3_title').value,
        footer_links: JSON.stringify(footerLinks),
        footer_col4_title: document.getElementById('footer_col4_title').value,
        footer_address: document.getElementById('footer_address').value,
        footer_phone: document.getElementById('footer_phone').value,
        footer_email: document.getElementById('footer_email').value,
        footer_hours: document.getElementById('footer_hours').value,
        footer_copyright: document.getElementById('footer_copyright').value,
        social_facebook: document.getElementById('social_facebook').value,
        social_twitter: document.getElementById('social_twitter').value,
        social_linkedin: document.getElementById('social_linkedin').value,
        social_youtube: document.getElementById('social_youtube').value,
        stat_diaspo_ivoiriens: document.getElementById('stat_diaspo_ivoiriens').value,
        stat_diaspo_ivoiriens_label: document.getElementById('stat_diaspo_ivoiriens_label').value,
        stat_diaspo_associations: document.getElementById('stat_diaspo_associations').value,
        stat_diaspo_associations_label: document.getElementById('stat_diaspo_associations_label').value,
        stat_diaspo_evenements: document.getElementById('stat_diaspo_evenements').value,
        stat_diaspo_evenements_label: document.getElementById('stat_diaspo_evenements_label').value,
    };

    fetch('{{ route("admin.settings.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(d => { showToast('success', d.message || 'Paramètres enregistrés avec succès.'); })
    .catch(() => { showToast('error', 'Erreur lors de la sauvegarde.'); });
}

// ========== INIT ==========
document.addEventListener('DOMContentLoaded', function() {
    // Quick links
    try {
        const savedQuick = @json($footerSettings['footer_quick_links'] ?? '[]');
        quickLinks = typeof savedQuick === 'string' ? JSON.parse(savedQuick) : (Array.isArray(savedQuick) ? savedQuick : []);
    } catch(e) { quickLinks = []; }
    if (!quickLinks.length) {
        quickLinks = [
            { name: 'Nos services', url: '/pages/nos-services.html' },
            { name: 'Actualités', url: '/pages/actualites.html' },
            { name: 'Le Coin des Diasporas', url: '/pages/coin-des-diaspos.html' },
            { name: 'La DGIE', url: '/pages/la-dgie.html' },
            { name: 'FAQ', url: '/pages/nos-services.html#faq' }
        ];
    }

    // Footer links (institutional)
    try {
        const savedFooter = @json($footerSettings['footer_links'] ?? '[]');
        footerLinks = typeof savedFooter === 'string' ? JSON.parse(savedFooter) : (Array.isArray(savedFooter) ? savedFooter : []);
    } catch(e) { footerLinks = []; }
    if (!footerLinks.length) {
        footerLinks = [
            { name: 'Présidence de la République', url: 'https://presidence.ci' },
            { name: 'Primature', url: 'https://primature.ci' },
            { name: 'Min. des Affaires Étrangères', url: '#' },
            { name: "Min. de l'Intégration Africaine", url: '#' },
            { name: 'Portail du Gouvernement', url: 'https://gouvernement.ci' }
        ];
    }

    renderLinksList('quick');
    renderLinksList('footer');
});
</script>
@endsection
