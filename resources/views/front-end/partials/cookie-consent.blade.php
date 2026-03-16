{{-- Bandeau de consentement cookies --}}
<div class="cc-banner" id="cookieBanner" style="display:none">
  <div class="cc-banner__inner">
    <div class="cc-banner__icon">
      <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" width="56" height="56">
        <rect x="4" y="8" width="40" height="32" rx="6" fill="#e8f5ee" stroke="#1D8C4F" stroke-width="2.5"/>
        <path d="M24 14v8l5.5 3" stroke="#1D8C4F" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <path d="M14 28h6M28 28h6" stroke="#1D8C4F" stroke-width="2" stroke-linecap="round"/>
        <circle cx="24" cy="22" r="11" stroke="#1D8C4F" stroke-width="2.5" fill="none"/>
        <path d="M17 36h14" stroke="#1D8C4F" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </div>
    <div class="cc-banner__text">
      <p>Nous utilisons des cookies pour améliorer votre expérience sur ce site.<br>
      Pour un aperçu complet des cookies utilisés, consultez vos <a href="#" class="cc-banner__link" id="ccCustomizeLink">paramètres personnels</a>.</p>
      <p>Consultez notre <a href="{{ route('politique-confidentialite') }}" class="cc-banner__link">Politique de confidentialité</a>.</p>
    </div>
    <div class="cc-banner__actions">
      <button type="button" class="cc-btn cc-btn--accept" id="ccAcceptAll">Tout accepter</button>
      <button type="button" class="cc-btn cc-btn--decline" id="ccDecline">Refuser</button>
      <button type="button" class="cc-btn cc-btn--customize" id="ccCustomize">Personnaliser</button>
    </div>
  </div>
</div>

{{-- Panneau de personnalisation --}}
<div class="cc-panel-overlay" id="ccPanelOverlay" style="display:none"></div>
<div class="cc-panel" id="ccPanel" style="display:none">
  <div class="cc-panel__header">
    <h3 class="cc-panel__title">Paramètres des cookies</h3>
    <button type="button" class="cc-panel__close" id="ccPanelClose">&times;</button>
  </div>
  <div class="cc-panel__body">
    <div class="cc-panel__category">
      <div class="cc-panel__cat-header">
        <div>
          <strong>Cookies essentiels</strong>
          <p class="cc-panel__cat-desc">Nécessaires au fonctionnement du site. Ils ne peuvent pas être désactivés.</p>
        </div>
        <span class="cc-toggle cc-toggle--locked">
          <input type="checkbox" checked disabled>
          <span class="cc-toggle__slider"></span>
        </span>
      </div>
    </div>
    <div class="cc-panel__category">
      <div class="cc-panel__cat-header">
        <div>
          <strong>Cookies analytiques</strong>
          <p class="cc-panel__cat-desc">Nous aident à comprendre comment les visiteurs utilisent le site (Google Analytics).</p>
        </div>
        <label class="cc-toggle">
          <input type="checkbox" id="ccAnalytics">
          <span class="cc-toggle__slider"></span>
        </label>
      </div>
    </div>
  </div>
  <div class="cc-panel__footer">
    <button type="button" class="cc-btn cc-btn--accept" id="ccSavePrefs">Enregistrer mes préférences</button>
  </div>
</div>

<script>
(function() {
  var COOKIE_KEY = 'dgie_cookie_consent';
  var banner = document.getElementById('cookieBanner');
  var panel = document.getElementById('ccPanel');
  var overlay = document.getElementById('ccPanelOverlay');

  function getConsent() {
    return localStorage.getItem(COOKIE_KEY);
  }

  function setConsent() {
    localStorage.setItem(COOKIE_KEY, JSON.stringify({ accepted: true, date: new Date().toISOString() }));
    banner.style.display = 'none';
    closePanel();
  }

  function openPanel() {
    panel.style.display = 'flex';
    overlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closePanel() {
    panel.style.display = 'none';
    overlay.style.display = 'none';
    document.body.style.overflow = '';
  }

  // Show banner only if user hasn't responded yet
  if (!getConsent()) {
    banner.style.display = 'block';
  }

  // Buttons
  document.getElementById('ccAcceptAll').addEventListener('click', setConsent);
  document.getElementById('ccDecline').addEventListener('click', setConsent);
  document.getElementById('ccCustomize').addEventListener('click', openPanel);
  document.getElementById('ccCustomizeLink').addEventListener('click', function(e) { e.preventDefault(); openPanel(); });
  document.getElementById('ccPanelClose').addEventListener('click', closePanel);
  overlay.addEventListener('click', closePanel);
  document.getElementById('ccSavePrefs').addEventListener('click', setConsent);
})();
</script>
