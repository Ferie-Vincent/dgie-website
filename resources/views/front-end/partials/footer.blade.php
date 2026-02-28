<!-- FOOTER -->
<footer class="footer">
  <div class="footer__armoirie"></div>
  <div class="container">
    @php
      use App\Models\Setting;
      $footerSettings = Setting::getGroup('footer');
      $socialSettings = Setting::getGroup('social');

      $col1Title = $footerSettings['footer_col1_title'] ?? 'Direction Générale des Ivoiriens de l\'Extérieur';
      $col1Desc = $footerSettings['footer_col1_description'] ?? 'La DGIE est une structure de l\'État ivoirien chargée de la relation avec les Ivoiriens établis à l\'étranger et de l\'accompagnement des migrants de retour.';
      $col2Title = $footerSettings['footer_col2_title'] ?? 'Liens rapides';
      $col3Title = $footerSettings['footer_col3_title'] ?? 'Liens utiles';
      $col4Title = $footerSettings['footer_col4_title'] ?? 'Contact';
      $footerAddress = $footerSettings['footer_address'] ?? ($contactInfo->address ?? 'Abidjan, Côte d\'Ivoire');
      $footerPhone = $footerSettings['footer_phone'] ?? ($contactInfo->phone_1 ?? '+225 XX XX XX XX XX');
      $footerEmail = $footerSettings['footer_email'] ?? ($contactInfo->email ?? 'contact@dgie.gouv.ci');
      $footerHours = $footerSettings['footer_hours'] ?? 'Lundi – Vendredi : 8h00 – 16h30';
      $footerCopyright = $footerSettings['footer_copyright'] ?? ('© ' . date('Y') . ' DGIE — République de Côte d\'Ivoire. Tous droits réservés.');

      $quickLinks = json_decode($footerSettings['footer_quick_links'] ?? '', true);
      $usefulLinks = json_decode($footerSettings['footer_links'] ?? '', true);
    @endphp

    <div class="footer__grid">
      <!-- Colonne 1 : Présentation + réseaux sociaux -->
      <div>
        <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE" class="footer__logo" loading="lazy">
        <div class="footer__title">{{ $col1Title }}</div>
        <p>{{ $col1Desc }}</p>
        <div class="footer__social">
          @if(!empty($socialSettings['social_facebook']))<a href="{{ $socialSettings['social_facebook'] }}" target="_blank" rel="noopener" class="footer__social-link footer__social-link--facebook" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>@endif
          @if(!empty($socialSettings['social_twitter']))<a href="{{ $socialSettings['social_twitter'] }}" target="_blank" rel="noopener" class="footer__social-link footer__social-link--twitter" aria-label="X"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>@endif
          @if(!empty($socialSettings['social_linkedin']))<a href="{{ $socialSettings['social_linkedin'] }}" target="_blank" rel="noopener" class="footer__social-link footer__social-link--linkedin" aria-label="LinkedIn"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>@endif
          @if(!empty($socialSettings['social_youtube']))<a href="{{ $socialSettings['social_youtube'] }}" target="_blank" rel="noopener" class="footer__social-link footer__social-link--youtube" aria-label="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>@endif
        </div>
      </div>

      <!-- Colonne 2 : Liens rapides -->
      <div>
        <div class="footer__title">{{ $col2Title }}</div>
        <div class="footer__links">
          @if(!empty($quickLinks))
            @foreach($quickLinks as $link)
              <a href="{{ $link['url'] ?? '#' }}" @if(str_starts_with($link['url'] ?? '', 'http')) target="_blank" rel="noopener" @endif>{{ $link['label'] ?? $link['name'] ?? '' }}</a>
            @endforeach
          @else
            <a href="{{ route('nos-services') }}">Nos services</a>
            <a href="{{ route('actualites') }}">Actualités</a>
            <a href="{{ route('coin-des-diaspos') }}">Le Coin des Diasporas</a>
            <a href="{{ route('la-dgie') }}">La DGIE</a>
            <a href="{{ route('contact') }}">FAQ</a>
          @endif
        </div>
      </div>

      <!-- Colonne 3 : Liens utiles -->
      <div>
        <div class="footer__title">{{ $col3Title }}</div>
        <div class="footer__links">
          @if(!empty($usefulLinks))
            @foreach($usefulLinks as $link)
              <a href="{{ $link['url'] ?? '#' }}" target="_blank" rel="noopener">{{ $link['label'] ?? $link['name'] ?? '' }}</a>
            @endforeach
          @else
            <a href="https://www.presidence.ci" target="_blank" rel="noopener">Présidence de la République</a>
            <a href="https://www.primature.ci" target="_blank" rel="noopener">Primature</a>
            <a href="https://www.diplomatie.gouv.ci" target="_blank" rel="noopener">Min. des Affaires Étrangères</a>
            <a href="https://www.integration-africaine.gouv.ci" target="_blank" rel="noopener">Min. de l'Intégration Africaine</a>
            <a href="https://www.gouv.ci" target="_blank" rel="noopener">Portail du Gouvernement</a>
          @endif
        </div>
      </div>

      <!-- Colonne 4 : Contact -->
      <div>
        <div class="footer__title">{{ $col4Title }}</div>
        <p>{{ $footerAddress }}</p>
        <p>Téléphone : {{ $footerPhone }}</p>
        <p>E-mail : {{ $footerEmail }}</p>
        <p>{{ $footerHours }}</p>
      </div>
    </div>

    <div class="footer__bottom">
      <span>{{ $footerCopyright }}</span>
      <div class="footer__bottom-links">
        <a href="{{ route('mentions-legales') }}">Mentions légales</a>
        <a href="{{ route('politique-confidentialite') }}">Politique de confidentialité</a>
        <a href="/sitemap.xml">Plan du site</a>
      </div>
    </div>
  </div>
</footer>
