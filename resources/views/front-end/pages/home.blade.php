@extends('front-end.layouts.app')

@section('title', 'DGIE — Direction Générale des Ivoiriens de l\'Extérieur')

@section('meta')
  <meta name="description" content="La DGIE accompagne la diaspora ivoirienne : retour, réintégration, investissement et mobilisation des compétences. Découvrez nos services.">
  <meta property="og:title" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur | Côte d'Ivoire">
  <meta property="og:description" content="La DGIE accompagne la diaspora ivoirienne : retour, réintégration, investissement et mobilisation des compétences. Découvrez nos services.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.dgie.gouv.ci/">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:description" content="La DGIE accompagne la diaspora ivoirienne : retour, réintégration, investissement et mobilisation des compétences.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ route('home') }}">
@endsection

@section('head')
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "GovernmentOrganization",
    "name": "Direction Générale des Ivoiriens de l'Extérieur",
    "alternateName": "DGIE",
    "url": "https://www.dgie.gouv.ci",
    "logo": "https://www.dgie.gouv.ci/assets/images/logo-dgie.png",
    "description": "La DGIE est une structure du Ministère des Affaires Étrangères de Côte d'Ivoire chargée de la relation avec les Ivoiriens établis à l'étranger.",
    "address": {
      "@@type": "PostalAddress",
      "addressLocality": "Abidjan",
      "addressCountry": "CI"
    },
    "contactPoint": {
      "@@type": "ContactPoint",
      "email": "{{ $contactInfo->email ?? 'contact@dgie.gouv.ci' }}",
      "contactType": "customer service",
      "availableLanguage": "French"
    },
    "parentOrganization": {
      "@@type": "GovernmentOrganization",
      "name": "Ministère des Affaires Étrangères, de l'Intégration Africaine et de la Diaspora"
    }
  }
  </script>
@endsection

@section('modals')
  <!-- MODAL ÉVÉNEMENT -->
  @if($modalEvent)
  <div class="welcome-modal" id="welcomeModal" role="dialog" aria-modal="true" aria-label="Événement à venir">
    <div class="welcome-modal__backdrop" id="welcomeModalBackdrop"></div>
    <div class="welcome-modal__dialog">
      <button class="welcome-modal__close" id="welcomeModalClose" aria-label="Fermer">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        Fermer
      </button>
      <a href="{{ route('actualites') }}" class="welcome-modal__poster">
        @if($modalEvent->image)
        <img src="{{ asset('storage/' . $modalEvent->image) }}" alt="{{ $modalEvent->title }}" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'welcome-modal__fallback\'><img src=\'{{ asset("assets/images/logo-dgie.png") }}\' alt=\'DGIE\' class=\'welcome-modal__fallback-logo\'><h2>{{ $modalEvent->title }}</h2><p>{{ $modalEvent->location ?? "Abidjan" }} — {{ $modalEvent->event_date->isoFormat("D MMMM YYYY") }}</p><span class=\'welcome-modal__fallback-cta\'>Découvrir l\'événement</span></div>';">
        @else
        <div class="welcome-modal__fallback">
          <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE" class="welcome-modal__fallback-logo">
          <h2>{{ $modalEvent->title }}</h2>
          <p>{{ $modalEvent->location ?? 'Abidjan' }} — {{ $modalEvent->event_date->isoFormat('D MMMM YYYY') }}</p>
          <span class="welcome-modal__fallback-cta">Découvrir l'événement</span>
        </div>
        @endif
      </a>
    </div>
  </div>
  @else
  <div class="welcome-modal" id="welcomeModal" role="dialog" aria-modal="true" aria-label="Événement à venir">
    <div class="welcome-modal__backdrop" id="welcomeModalBackdrop"></div>
    <div class="welcome-modal__dialog">
      <button class="welcome-modal__close" id="welcomeModalClose" aria-label="Fermer">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        Fermer
      </button>
      <a href="{{ route('actualites') }}" class="welcome-modal__poster">
        <img src="{{ asset('assets/images/modal-event.jpg') }}" alt="Événement DGIE" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'welcome-modal__fallback\'><img src=\'{{ asset("assets/images/logo-dgie.png") }}\' alt=\'DGIE\' class=\'welcome-modal__fallback-logo\'><h2>Direction Générale des Ivoiriens de l\'Extérieur</h2><span class=\'welcome-modal__fallback-cta\'>Découvrir</span></div>';">
      </a>
    </div>
  </div>
  @endif
@endsection

@section('content')
  <div class="container" style="padding-top: 28px;">

    <!-- FEATURED HERO — Articles à la une -->
    @if($featuredArticles->count())
    <section class="featured-hero animate-on-scroll">
      <div class="featured-hero__grid">
        <!-- Article principal -->
        @php $mainArticle = $featuredArticles->first(); @endphp
        <a href="{{ route('article.show', $mainArticle->slug) }}" class="featured-card">
          <div class="featured-card__bg" style="background-image: url('{{ $mainArticle->image ? asset('storage/' . $mainArticle->image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=900&h=600&fit=crop' }}'); background-size: cover; background-position: center;"></div>
          <div class="featured-card__overlay"></div>
          <div class="featured-card__content">
            @if($mainArticle->category)
            <span class="featured-card__category {{ $mainArticle->category->color ?? 'cat-orange' }}">{{ $mainArticle->category->name }}</span>
            @endif
            <h1 class="featured-card__title">{{ $mainArticle->title }}</h1>
            <div class="featured-card__meta">
              <span>{{ $mainArticle->author->name ?? 'DGIE' }}</span>
              <span>{{ $mainArticle->published_at->isoFormat('D MMMM YYYY') }}</span>
              @if($mainArticle->read_time)
              <span>{{ $mainArticle->read_time }} min de lecture</span>
              @endif
            </div>
          </div>
        </a>
        <!-- Colonne droite : articles secondaires -->
        @if($featuredArticles->count() > 1)
        <div class="featured-side">
          @foreach($featuredArticles->skip(1)->take(2) as $sideArticle)
          <a href="{{ route('article.show', $sideArticle->slug) }}" class="featured-card featured-card--small">
            <div class="featured-card__bg" style="background-image: url('{{ $sideArticle->image ? asset('storage/' . $sideArticle->image) : 'https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?w=600&h=400&fit=crop' }}'); background-size: cover; background-position: center;"></div>
            <div class="featured-card__overlay"></div>
            <div class="featured-card__content">
              @if($sideArticle->category)
              <span class="featured-card__category {{ $sideArticle->category->color ?? 'cat-green' }}">{{ $sideArticle->category->name }}</span>
              @endif
              <h3 class="featured-card__title">{{ $sideArticle->title }}</h3>
              <div class="featured-card__meta">
                <span>{{ $sideArticle->author->name ?? 'DGIE' }}</span>
                <span>{{ $sideArticle->published_at->isoFormat('D MMMM YYYY') }}</span>
              </div>
            </div>
          </a>
          @endforeach
        </div>
        @endif
      </div>
    </section>
    @endif

    <!-- ORIENTATION — Bande d'accès rapide -->
    <div class="orientation-strip animate-on-scroll">
      <span class="orientation-strip__label">Vous êtes :</span>
      <div class="orientation-strip__links">
        <a href="{{ route('nos-services') }}#investir" class="orientation-strip__link orientation-strip__link--orange">Membre de la diaspora</a>
        <a href="{{ route('nos-services') }}#retour" class="orientation-strip__link orientation-strip__link--green">De retour en Côte d'Ivoire</a>
        <a href="{{ route('la-dgie') }}" class="orientation-strip__link orientation-strip__link--dark">En quête d'information</a>
      </div>
    </div>

    <!-- LAYOUT : Articles + Sidebar -->
    <div class="main-layout">

      <!-- COLONNE PRINCIPALE -->
      <main id="main-content">

        <!-- Dernières publications -->
        <div class="section-title">
          <h2>Dernières publications</h2>
          <span class="section-title__line"></span>
          <a href="{{ route('actualites') }}" class="section-title__link">Tout voir</a>
        </div>

        <div class="articles-grid">
          @php $articleStyles = ['', 'article-card--orange', 'article-card--slate', 'article-card--bordeaux']; @endphp
          @forelse($latestArticles as $index => $article)
          <article class="article-card {{ $articleStyles[$index] ?? '' }}">
            <div class="article-card__img">
              <div class="article-card__img-inner" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&h=400&fit=crop' }}'); background-size: cover; background-position: center;"></div>
            </div>
            <div class="article-card__overlay">
              @if($article->category)
              <span class="article-card__category {{ $article->category->color ?? 'cat-orange' }}">{{ $article->category->name }}</span>
              @endif
              <h3 class="article-card__title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></h3>
              <p class="article-card__excerpt">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 150) }}</p>
              <div class="article-card__meta"><span>{{ $article->author->name ?? 'DGIE' }}</span><span>{{ $article->published_at->isoFormat('D MMMM YYYY') }}</span></div>
            </div>
          </article>
          @empty
          <p>Aucun article publié pour le moment.</p>
          @endforelse
        </div>

        <!-- AD BANNER 1 -->
        @if($adBanners->count() > 0)
        <div class="ad-banner">
          <a href="{{ $adBanners->first()->url ?? route('actualites') }}">
            <img src="{{ $adBanners->first()->image ? asset('storage/' . $adBanners->first()->image) : asset('assets/images/ad-banner-1.jpg') }}" alt="{{ $adBanners->first()->alt_text ?? 'Publicité institutionnelle — DGIE' }}" loading="lazy">
          </a>
        </div>
        @else
        <div class="ad-banner">
          <a href="{{ route('actualites') }}">
            <img src="{{ asset('assets/images/ad-banner-1.jpg') }}" alt="Publicité institutionnelle — DGIE" loading="lazy">
          </a>
        </div>
        @endif

        <!-- Retour et Réintégration -->
        <div class="section-title">
          <h2>Retour et Réintégration</h2>
          <span class="section-title__line"></span>
          <a href="{{ route('actualites', ['section' => 'retour']) }}" class="section-title__link">Voir plus</a>
        </div>

        <div class="articles-grid" style="margin-bottom: 40px;">
          @php $returnStyles = ['', 'article-card--orange']; @endphp
          @forelse($returnArticles as $index => $article)
          <article class="article-card {{ $returnStyles[$index] ?? '' }}">
            <div class="article-card__img">
              <div class="article-card__img-inner" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1596496181871-9681eacf9764?w=600&h=400&fit=crop' }}'); background-size: cover; background-position: center;"></div>
            </div>
            <div class="article-card__overlay">
              @if($article->category)
              <span class="article-card__category {{ $article->category->color ?? 'cat-green' }}">{{ $article->category->name }}</span>
              @endif
              <h3 class="article-card__title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></h3>
              <p class="article-card__excerpt">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 150) }}</p>
              <div class="article-card__meta"><span>{{ $article->author->name ?? 'DGIE' }}</span><span>{{ $article->published_at->isoFormat('D MMMM YYYY') }}</span></div>
            </div>
          </article>
          @empty
          <p>Aucun article dans cette rubrique pour le moment.</p>
          @endforelse
        </div>

        <!-- AD BANNER 2 -->
        @if($adBanners->count() > 1)
        <div class="ad-banner">
          <a href="{{ $adBanners->get(1)->url ?? route('nos-services') }}">
            <img src="{{ $adBanners->get(1)->image ? asset('storage/' . $adBanners->get(1)->image) : asset('assets/images/ad-banner-2.jpg') }}" alt="{{ $adBanners->get(1)->alt_text ?? 'Publicité institutionnelle — DGIE' }}" loading="lazy">
          </a>
        </div>
        @else
        <div class="ad-banner">
          <a href="{{ route('nos-services') }}#investir">
            <img src="{{ asset('assets/images/ad-banner-2.jpg') }}" alt="Publicité institutionnelle — DGIE" loading="lazy">
          </a>
        </div>
        @endif

        <!-- Investir et Contribuer -->
        <div class="section-title">
          <h2>Investir et Contribuer</h2>
          <span class="section-title__line"></span>
          <a href="{{ route('actualites', ['section' => 'investir']) }}" class="section-title__link">Voir plus</a>
        </div>

        <div class="articles-grid">
          @php $investStyles = ['article-card--slate', 'article-card--orange']; @endphp
          @forelse($investArticles as $index => $article)
          <article class="article-card {{ $investStyles[$index] ?? '' }}">
            <div class="article-card__img">
              <div class="article-card__img-inner" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&h=400&fit=crop' }}'); background-size: cover; background-position: center;"></div>
            </div>
            <div class="article-card__overlay">
              @if($article->category)
              <span class="article-card__category {{ $article->category->color ?? 'cat-blue' }}">{{ $article->category->name }}</span>
              @endif
              <h3 class="article-card__title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></h3>
              <p class="article-card__excerpt">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 150) }}</p>
              <div class="article-card__meta"><span>{{ $article->author->name ?? 'DGIE' }}</span><span>{{ $article->published_at->isoFormat('D MMMM YYYY') }}</span></div>
            </div>
          </article>
          @empty
          <p>Aucun article dans cette rubrique pour le moment.</p>
          @endforelse
        </div>

        <!-- AD BANNER 3 -->
        @if($adBanners->count() > 2)
        <div class="ad-banner">
          <a href="{{ $adBanners->get(2)->url ?? '#' }}">
            <img src="{{ $adBanners->get(2)->image ? asset('storage/' . $adBanners->get(2)->image) : asset('assets/images/ad-banner-3.jpg') }}" alt="{{ $adBanners->get(2)->alt_text ?? 'Publicité institutionnelle — DGIE' }}" loading="lazy">
          </a>
        </div>
        @else
        <div class="ad-banner">
          <a href="https://www.gouv.ci">
            <img src="{{ asset('assets/images/ad-banner-3.jpg') }}" alt="Le gouvernement à votre écoute — Côte d'Ivoire" loading="lazy">
          </a>
        </div>
        @endif

        <!-- Actions Sociales -->
        <div class="section-title">
          <h2>Actions Sociales</h2>
          <span class="section-title__line"></span>
          <a href="{{ route('actualites', ['section' => 'action-sociale']) }}" class="section-title__link">Voir plus</a>
        </div>

        <div class="articles-grid">
          @php $socialeStyles = ['article-card--bordeaux', 'article-card--slate']; @endphp
          @forelse($actionSocialeArticles as $index => $article)
          <article class="article-card {{ $socialeStyles[$index] ?? '' }}">
            <div class="article-card__img">
              <div class="article-card__img-inner" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?w=600&h=400&fit=crop' }}'); background-size: cover; background-position: center;"></div>
            </div>
            <div class="article-card__overlay">
              @if($article->category)
              <span class="article-card__category {{ $article->category->color ?? 'cat-blue' }}">{{ $article->category->name }}</span>
              @endif
              <h3 class="article-card__title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></h3>
              <p class="article-card__excerpt">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 150) }}</p>
              <div class="article-card__meta"><span>{{ $article->author->name ?? 'DGIE' }}</span><span>{{ $article->published_at->isoFormat('D MMMM YYYY') }}</span></div>
            </div>
          </article>
          @empty
          <p>Aucun article dans cette rubrique pour le moment.</p>
          @endforelse
        </div>

        <!-- Galerie -->
        <div class="section-title">
          <h2>Galerie</h2>
          <span class="section-title__line"></span>
          <a href="{{ route('galerie') }}" class="section-title__link">Voir tous les albums</a>
        </div>

        <div class="gallery-grid gallery-grid--home">
          @forelse($galleryAlbums as $album)
          <a href="{{ route('galerie') }}" class="gallery-album" data-gallery-type="{{ $album->type }}">
            @php
              if ($album->cover_image) {
                  $albumImg = asset('storage/' . $album->cover_image);
              } elseif ($album->type === 'video' && $album->items->first()?->file_path && str_contains($album->items->first()->file_path, 'youtube.com')) {
                  preg_match('/[?&]v=([^&]+)/', $album->items->first()->file_path, $m);
                  $albumImg = $m ? 'https://img.youtube.com/vi/' . $m[1] . '/hqdefault.jpg' : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop';
              } elseif ($album->items->first()?->file_path) {
                  $albumImg = asset('storage/' . $album->items->first()->file_path);
              } else {
                  $albumImg = 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop';
              }
            @endphp
            <div class="gallery-album__img" style="background-image: url('{{ $albumImg }}');"></div>
            <div class="gallery-album__overlay">
              <div class="gallery-album__icon">
                @if($album->type === 'video')
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                @else
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                @endif
              </div>
              <div class="gallery-album__title">{{ $album->title }}</div>
              <div class="gallery-album__count">{{ $album->items->count() }} {{ $album->type === 'video' ? 'vidéo' : 'photo' }}{{ $album->items->count() > 1 ? 's' : '' }}</div>
            </div>
          </a>
          @empty
          <p>Aucun album disponible pour le moment.</p>
          @endforelse
        </div>

        <!-- Médiathèque -->
        @if(isset($videos) && $videos->count() > 0)
        <div class="section-title section-title--orange" style="margin-top: 48px;">
          <h2>Médiathèque</h2>
          <span class="section-title__line"></span>
          <a href="{{ route('mediatheque') }}" class="section-title__link">Voir tout →</a>
        </div>

        <div class="mediatheque-section">
          @php $featured = $videos->first(); @endphp
          <div class="mediatheque-featured">
            <iframe src="{{ $featured->embed_url }}" title="{{ $featured->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
          </div>

          @if($videos->count() > 1)
          <div class="mediatheque-grid" id="mediaGrid">
            @foreach($videos->skip(1) as $video)
            <div class="mediatheque-card">
              <div class="mediatheque-card__thumb">
                <iframe src="{{ $video->embed_url }}" title="{{ $video->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              </div>
            </div>
            @endforeach
          </div>
          @endif
        </div>
        @endif

      </main>

      <!-- SIDEBAR -->
      <aside class="sidebar">

        <!-- Widget DGIE -->
        <div class="sidebar-dgie-widget">
          <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="Logo DGIE — Direction Générale des Ivoiriens de l'Extérieur" class="sidebar-dgie-widget__logo">
          <p class="sidebar-dgie-widget__desc">La DGIE connecte la diaspora ivoirienne au développement national, en facilitant l'intégration à l'étranger, le retour au pays et l'investissement des compétences et ressources.</p>
        </div>

        <!-- Portraits officiels -->
        @php $officialStyles = ['', 'official-card--orange', 'official-card--slate']; @endphp
        @forelse($officials as $index => $staff)
        <div class="official-card {{ $officialStyles[$index] ?? 'official-card--slate' }}">
          <div class="official-card__img">
            <img src="{{ $staff->photo ? asset('storage/' . $staff->photo) : asset('assets/images/logo-dgie.png') }}" alt="{{ $staff->name }}" loading="lazy">
          </div>
          <div class="official-card__overlay">
            <p class="official-card__role-label">{{ $staff->title }}</p>
            <h3 class="official-card__name">{{ $staff->name }}</h3>
          </div>
        </div>
        @empty
        <div class="official-card">
          <div class="official-card__img">
            <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE" loading="lazy">
          </div>
          <div class="official-card__overlay">
            <p class="official-card__role-label">Direction Générale des Ivoiriens de l'Extérieur</p>
            <h3 class="official-card__name">DGIE</h3>
          </div>
        </div>
        @endforelse

        <!-- Événement à venir — Compte à rebours -->
        @if($nextEvent)
        <div class="event-countdown" id="eventCountdown">
          <div class="event-countdown__badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Prochain événement
          </div>
          <div class="event-countdown__title">{{ $nextEvent->title }}</div>
          <div class="event-countdown__date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            {{ $nextEvent->event_date->isoFormat('D MMMM YYYY') }} — {{ $nextEvent->location ?? 'Abidjan, Côte d\'Ivoire' }}
          </div>
          <div class="event-countdown__timer">
            <div class="event-countdown__unit">
              <span class="event-countdown__number" id="countdownDays">--</span>
              <span class="event-countdown__label">Jours</span>
            </div>
            <div class="event-countdown__unit">
              <span class="event-countdown__number" id="countdownHours">--</span>
              <span class="event-countdown__label">Heures</span>
            </div>
            <div class="event-countdown__unit">
              <span class="event-countdown__number" id="countdownMins">--</span>
              <span class="event-countdown__label">Min</span>
            </div>
            <div class="event-countdown__unit">
              <span class="event-countdown__number" id="countdownSecs">--</span>
              <span class="event-countdown__label">Sec</span>
            </div>
          </div>
          <a href="{{ route('event.show', $nextEvent->slug) }}" class="event-countdown__cta">
            En savoir plus
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
        </div>
        @endif

        <!-- Chaîne WhatsApp QR -->
        <div class="sidebar-whatsapp">
          <a href="https://whatsapp.com/channel/0029VajlgosEgGfHcqyRBQ17" target="_blank" rel="noopener">
            <img src="{{ asset('assets/images/whatsapp-qr.png') }}" alt="Scannez le QR code pour rejoindre la chaîne WhatsApp DGIE" class="sidebar-whatsapp__img">
          </a>
        </div>

        <!-- Rubriques -->
        <div class="sidebar-widget">
          <div class="sidebar-widget__title">Rubriques</div>
          <div class="sidebar-widget__list">
            @forelse($categories as $cat)
            <a href="{{ route('actualites', ['categorie' => $cat->slug]) }}">{{ $cat->name }} <span class="count">{{ $cat->articles_count }}</span></a>
            @empty
            <a href="{{ route('actualites') }}">Toutes les actualités</a>
            @endforelse
          </div>
        </div>

        <!-- Réseaux sociaux -->
        @php
          $sidebarSocials = [
              'facebook' => \App\Models\Setting::where('key', 'social_facebook')->value('value'),
              'twitter' => \App\Models\Setting::where('key', 'social_twitter')->value('value'),
              'linkedin' => \App\Models\Setting::where('key', 'social_linkedin')->value('value'),
              'youtube' => \App\Models\Setting::where('key', 'social_youtube')->value('value'),
          ];
        @endphp
        <div class="sidebar-social">
          <div class="sidebar-social__title">Suivez-nous</div>
          <div class="sidebar-social__grid">
            @if($sidebarSocials['facebook'])
            <a href="{{ $sidebarSocials['facebook'] }}" target="_blank" rel="noopener" class="sidebar-social__link sidebar-social__link--facebook">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
              <span>Facebook</span>
            </a>
            @endif
            @if($sidebarSocials['twitter'])
            <a href="{{ $sidebarSocials['twitter'] }}" target="_blank" rel="noopener" class="sidebar-social__link sidebar-social__link--x">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
              <span>X (Twitter)</span>
            </a>
            @endif
            @if($sidebarSocials['linkedin'])
            <a href="{{ $sidebarSocials['linkedin'] }}" target="_blank" rel="noopener" class="sidebar-social__link sidebar-social__link--linkedin">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
              <span>LinkedIn</span>
            </a>
            @endif
            @if($sidebarSocials['youtube'])
            <a href="{{ $sidebarSocials['youtube'] }}" target="_blank" rel="noopener" class="sidebar-social__link sidebar-social__link--youtube">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              <span>YouTube</span>
            </a>
            @endif
          </div>
        </div>

        <!-- Calendrier des activités -->
        <div class="sidebar-calendar" id="sidebarCalendar">
          <div class="sidebar-calendar__title">Calendrier des activités</div>
          <div class="sidebar-calendar__header">
            <button class="sidebar-calendar__nav" id="calPrev" aria-label="Mois précédent">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <span class="sidebar-calendar__month" id="calMonth"></span>
            <button class="sidebar-calendar__nav" id="calNext" aria-label="Mois suivant">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
          </div>
          <div class="sidebar-calendar__weekdays">
            <span>Lun</span><span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
          </div>
          <div class="sidebar-calendar__grid" id="calGrid"></div>
          <div class="sidebar-calendar__event" id="calEvent"></div>
        </div>

        <!-- Magazine / Publication -->
        @if($latestMagazine)
        <div class="sidebar-magazine">
          <div class="sidebar-magazine__badge">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            Vient de paraitre
          </div>
          <div class="sidebar-magazine__cover">
            <img src="{{ asset('storage/' . $latestMagazine->cover_image) }}" alt="{{ $latestMagazine->title }}">
          </div>
          <h3 class="sidebar-magazine__title">{{ $latestMagazine->title }}</h3>
          @if($latestMagazine->published_at)
          <div class="sidebar-magazine__date">{{ $latestMagazine->published_at->translatedFormat('M Y') }}</div>
          @endif
          @if($latestMagazine->description)
          <p class="sidebar-magazine__desc">{{ $latestMagazine->description }}</p>
          @endif
          @if($latestMagazine->pdf_file)
          <a href="{{ asset('storage/' . $latestMagazine->pdf_file) }}" target="_blank" class="sidebar-magazine__btn" download>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Telecharger le PDF
          </a>
          @endif
        </div>
        @endif

      </aside>

    </div>
  </div>

  <!-- STATS COUNTER -->
  <section class="stats-counter">
    <div class="container">
      <h2 class="stats-counter__title">La DGIE en chiffres</h2>
      <div class="stats-counter__grid">
        <div class="stats-counter__item">
          <div class="stats-counter__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <span class="stats-counter__number" data-count="1240000" data-suffix="+">0</span>
          <span class="stats-counter__label">Ivoiriens de l'extérieur</span>
        </div>
        <div class="stats-counter__item">
          <div class="stats-counter__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <span class="stats-counter__number" data-count="2300" data-suffix="+">0</span>
          <span class="stats-counter__label">Migrants accompagnés</span>
        </div>
        <div class="stats-counter__item">
          <div class="stats-counter__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
          </div>
          <span class="stats-counter__number" data-count="85" data-suffix="%">0</span>
          <span class="stats-counter__label">Taux de réinsertion</span>
        </div>
        <div class="stats-counter__item">
          <div class="stats-counter__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <span class="stats-counter__number" data-count="32">0</span>
          <span class="stats-counter__label">Pays couverts</span>
        </div>
      </div>
    </div>
  </section>

  <!-- PARTENAIRES -->
  <section class="partners">
    <div class="container">
      <h2 class="section-title" style="text-align:center;justify-content:center;">Nos Partenaires<span class="section-title__line"></span></h2>
      <div class="partners__grid">
        @forelse($homePartners as $partner)
        <a href="{{ $partner->url ?? '#' }}" target="_blank" rel="noopener" class="partners__card" title="{{ $partner->name }}">
          @if($partner->logo)
          <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="partners__card-logo">
          @else
          <div class="partners__card-placeholder">
            <span class="partners__icon">{{ $partner->abbreviation ?? Str::upper(Str::substr($partner->name, 0, 3)) }}</span>
            <span class="partners__name">{{ $partner->name }}</span>
          </div>
          @endif
        </a>
        @empty
        <p>Partenaires à venir.</p>
        @endforelse
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<!-- Calendar events data (dynamic from DB) -->
<script>
  window.calendarEvents = @json($calendarEventsFormatted);
</script>

<!-- Countdown timer -->
@if($nextEvent)
<script>
(function() {
  var eventDate = new Date('{{ $nextEvent->event_date->toIso8601String() }}').getTime();
  var daysEl = document.getElementById('countdownDays');
  var hoursEl = document.getElementById('countdownHours');
  var minsEl = document.getElementById('countdownMins');
  var secsEl = document.getElementById('countdownSecs');

  if (!daysEl) return;

  function pad(n) { return n < 10 ? '0' + n : n; }

  function update() {
    var now = Date.now();
    var diff = eventDate - now;

    if (diff <= 0) {
      daysEl.textContent = '00';
      hoursEl.textContent = '00';
      minsEl.textContent = '00';
      secsEl.textContent = '00';
      return;
    }

    var d = Math.floor(diff / 86400000);
    var h = Math.floor((diff % 86400000) / 3600000);
    var m = Math.floor((diff % 3600000) / 60000);
    var s = Math.floor((diff % 60000) / 1000);

    daysEl.textContent = pad(d);
    hoursEl.textContent = pad(h);
    minsEl.textContent = pad(m);
    secsEl.textContent = pad(s);
  }

  update();
  setInterval(update, 1000);
})();
</script>
@endif
@endpush
