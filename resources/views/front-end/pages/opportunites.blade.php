@extends('front-end.layouts.app')

@section('title', 'Opportunités — DGIE')

@section('meta')
  <meta name="description" content="Découvrez les opportunités pour la diaspora ivoirienne : emploi, investissement, formation, bourses et appels à projets proposés par la DGIE.">
  <meta property="og:title" content="Opportunités — DGIE">
  <meta property="og:description" content="Emplois, bourses, formations, investissements et appels à projets pour la diaspora ivoirienne.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="{{ route('opportunites') }}">
  <link rel="canonical" href="{{ route('opportunites') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Opportunités</span>
      </div>
      <h1 class="page-hero__title">Opportunités</h1>
      <p class="page-hero__subtitle">Emplois, bourses, formations, investissements et appels à projets pour la diaspora ivoirienne.</p>
    </div>
  </section>

  <!-- CONTENU -->
  <section class="section">
    <div class="container">

      <!-- Recherche -->
      <form action="{{ route('opportunites') }}" method="GET" class="search-zone" style="margin-bottom: 24px;">
        @if(request('type'))
          <input type="hidden" name="type" value="{{ request('type') }}">
        @endif
        <div class="search-zone__row">
          <div class="search-zone__field search-zone__field--keyword">
            <label for="search-q" class="search-zone__label">Rechercher</label>
            <div class="search-zone__input-wrap">
              <svg class="search-zone__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
              <input type="text" id="search-q" name="q" value="{{ request('q') }}" placeholder="Titre, organisme, mot-clé…" class="search-zone__input">
            </div>
          </div>
          <div class="search-zone__actions">
            <button type="submit" class="btn btn--primary btn--sm">Rechercher</button>
            @if(request('q'))
              <a href="{{ route('opportunites', request('type') ? ['type' => request('type')] : []) }}" class="search-zone__reset">Effacer</a>
            @endif
          </div>
        </div>
        @if(request('q'))
        <p class="search-zone__result-count">{{ $opportunites->total() }} résultat{{ $opportunites->total() > 1 ? 's' : '' }} trouvé{{ $opportunites->total() > 1 ? 's' : '' }} pour « {{ request('q') }} »</p>
        @endif
      </form>

      <!-- Filtres par type -->
      <div class="filters">
        <a href="{{ route('opportunites', array_filter(['q' => request('q')])) }}" class="filter-btn {{ !request('type') ? 'active' : '' }}">Tous <span class="filter-btn__count">{{ $total }}</span></a>
        @foreach($types as $key => $label)
        <a href="{{ route('opportunites', array_filter(['type' => $key, 'q' => request('q')])) }}" class="filter-btn {{ request('type') == $key ? 'active' : '' }}">{{ $label }} <span class="filter-btn__count">{{ $typeCounts[$key] ?? 0 }}</span></a>
        @endforeach
      </div>

      @if($featured->count() > 0 && !request('type') && !request('q'))
      <!-- Opportunités en vedette -->
      <div class="oppo-featured-grid">
        @foreach($featured as $item)
        <article class="oppo-featured-card">
          <div class="oppo-featured-card__image" style="background-image: url('{{ $item->image ? asset('storage/' . $item->image) : asset('assets/images/hero-bg.jpg') }}');">
            <span class="oppo-card__type oppo-card__type--{{ $item->type }}">{{ $item->type_label }}</span>
          </div>
          <div class="oppo-featured-card__body">
            <h3 class="oppo-featured-card__title">{{ $item->title }}</h3>
            <p class="oppo-featured-card__desc">{{ Str::limit(strip_tags($item->description), 120) }}</p>
            @if($item->date_limite)
            <span class="oppo-card__deadline {{ $item->is_expired ? 'oppo-card__deadline--expired' : '' }}">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              {{ $item->is_expired ? 'Expiré' : 'Date limite : ' . $item->date_limite->isoFormat('D MMM YYYY') }}
            </span>
            @endif
            @if($item->url)
            <a href="{{ $item->url }}" class="oppo-card__link" target="_blank" rel="noopener">
              En savoir plus
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
            @endif
          </div>
        </article>
        @endforeach
      </div>

      <hr style="border: none; border-top: 1px solid var(--slate-200); margin: 32px 0;">
      @endif

      <!-- Grille des opportunités -->
      <div class="oppo-grid">
        @forelse($opportunites as $item)
        <article class="oppo-card">
          @if($item->image)
          <div class="oppo-card__image" style="background-image: url('{{ asset('storage/' . $item->image) }}');"></div>
          @endif
          <div class="oppo-card__body">
            <div class="oppo-card__meta">
              <span class="oppo-card__type oppo-card__type--{{ $item->type }}">{{ $item->type_label }}</span>
              @if($item->date_limite)
              <span class="oppo-card__deadline {{ $item->is_expired ? 'oppo-card__deadline--expired' : '' }}">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                {{ $item->is_expired ? 'Expiré' : $item->date_limite->isoFormat('D MMM YYYY') }}
              </span>
              @endif
            </div>
            <h3 class="oppo-card__title">{{ $item->title }}</h3>
            <p class="oppo-card__desc">{{ Str::limit(strip_tags($item->description), 160) }}</p>
            <div class="oppo-card__footer">
              @if($item->organisme)
              <span class="oppo-card__org">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                {{ $item->organisme }}
              </span>
              @endif
              @if($item->location)
              <span class="oppo-card__location">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ $item->location }}
              </span>
              @endif
            </div>
            @if($item->url)
            <a href="{{ $item->url }}" class="oppo-card__link" target="_blank" rel="noopener">
              En savoir plus
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
            @endif
          </div>
        </article>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 48px 0; color: var(--slate-500);">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 16px; opacity: 0.4;"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          <p style="font-size: 1.1rem; font-weight: 600;">Aucune opportunité disponible pour le moment</p>
          <p style="margin-top: 4px;">De nouvelles opportunités seront bientôt publiées. Revenez régulièrement !</p>
        </div>
        @endforelse
      </div>

      <!-- Pagination -->
      @if($opportunites->hasPages())
      <div style="margin-top: 40px;">
        {{ $opportunites->appends(request()->query())->links('vendor.pagination.front') }}
      </div>
      @endif

    </div>
  </section>

  <!-- CTA -->
  <section class="section section--alt">
    <div class="container" style="text-align:center;">
      <h2>Vous avez une opportunité à partager ?</h2>
      <p style="max-width:560px; margin:12px auto 24px;">Vous êtes un organisme, une entreprise ou une institution et vous souhaitez proposer une opportunité à la diaspora ivoirienne ? Contactez la DGIE.</p>
      <a href="{{ route('contact') }}" class="btn btn--primary">Contactez la DGIE</a>
    </div>
  </section>
@endsection
