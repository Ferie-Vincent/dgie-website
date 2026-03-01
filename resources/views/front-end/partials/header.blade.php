<!-- HEADER -->
<header class="header" id="header">
  <div class="container">
    <a href="{{ route('home') }}" class="header__logo">
      <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
    </a>
    <nav class="nav" id="nav">
      <a href="{{ route('home') }}" class="nav__link {{ request()->routeIs('home') ? 'nav__link--active' : '' }}">Accueil</a>
      <a href="{{ route('la-dgie') }}" class="nav__link {{ request()->routeIs('la-dgie') ? 'nav__link--active' : '' }}">La DGIE</a>
      <a href="{{ route('actualites') }}" class="nav__link {{ request()->routeIs('actualites', 'article.show') ? 'nav__link--active' : '' }}">Actualités</a>
      <a href="{{ route('nos-services') }}" class="nav__link {{ request()->routeIs('nos-services') ? 'nav__link--active' : '' }}">Nos services</a>
      <a href="{{ route('coin-des-diaspos') }}" class="nav__link {{ request()->routeIs('coin-des-diaspos') ? 'nav__link--active' : '' }}">Le Coin des Diasporas</a>
      <a href="{{ route('dossiers') }}" class="nav__link {{ request()->routeIs('dossiers', 'dossier.show') ? 'nav__link--active' : '' }}">Dossiers</a>
      <a href="{{ route('galerie') }}" class="nav__link {{ request()->routeIs('galerie') ? 'nav__link--active' : '' }}">Galerie</a>
      <a href="{{ route('mediatheque') }}" class="nav__link {{ request()->routeIs('mediatheque') ? 'nav__link--active' : '' }}">Médiathèque</a>
      <a href="{{ route('contact') }}" class="nav__link {{ request()->routeIs('contact') ? 'nav__link--active' : '' }}">Contact</a>
    </nav>
    <div class="header__search">
      <button class="header__search-toggle" id="searchToggle" aria-label="Rechercher">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      </button>
      <form class="header__search-box" id="searchBox" action="{{ route('search') }}" method="GET">
        <input type="text" name="q" placeholder="Rechercher..." class="header__search-input" id="searchInput">
        <button type="submit" class="header__search-submit" aria-label="Lancer la recherche">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        </button>
      </form>
    </div>
    <button class="nav__toggle" id="navToggle" aria-label="Menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>
