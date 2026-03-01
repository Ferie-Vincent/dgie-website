@extends('front-end.layouts.app')

@section('title', 'Actualités DGIE — Informations diaspora ivoirienne')

@section('meta')
  <meta name="description" content="Suivez les dernières actualités de la DGIE : événements, communiqués, programmes et opportunités pour les Ivoiriens de l'extérieur.">
  <meta property="og:title" content="Actualités — DGIE">
  <meta property="og:description" content="Suivez les dernières actualités de la DGIE : événements, communiqués, programmes et opportunités.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="{{ route('actualites') }}">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Actualités — DGIE">
  <meta name="twitter:description" content="Suivez les dernières actualités de la DGIE : événements, communiqués, programmes et opportunités.">
  <meta name="twitter:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <link rel="canonical" href="{{ route('actualites') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Actualités</span>
      </div>
      <h1 class="page-hero__title">{{ $sectionLabel ? $sectionLabel . ' — Actualités' : 'Actualités de la DGIE' }}</h1>
      <p class="page-hero__subtitle">
        @if($sectionLabel)
          Articles de la rubrique « {{ $sectionLabel }} ».
          <a href="{{ route('actualites') }}" style="color: #fff; text-decoration: underline;">Voir toutes les actualités</a>
        @else
          Communiqués, événements, programmes et témoignages : restez informé des actions de la Direction Générale des Ivoiriens de l'Extérieur.
        @endif
      </p>
    </div>
  </section>

  <!-- ACTUALITÉS -->
  <section class="section">
    <div class="container">

      <!-- Recherche multicritère -->
      <form action="{{ route('actualites') }}" method="GET" class="search-zone">
        @if(request('section'))
          <input type="hidden" name="section" value="{{ request('section') }}">
        @endif
        <div class="search-zone__row">
          <div class="search-zone__field search-zone__field--keyword">
            <label for="search-q" class="search-zone__label">Rechercher</label>
            <div class="search-zone__input-wrap">
              <svg class="search-zone__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
              <input type="text" id="search-q" name="q" value="{{ request('q') }}" placeholder="Titre, mot-clé…" class="search-zone__input">
            </div>
          </div>
          <div class="search-zone__field">
            <label for="search-date-from" class="search-zone__label">Du</label>
            <input type="date" id="search-date-from" name="date_from" value="{{ request('date_from') }}" class="search-zone__input">
          </div>
          <div class="search-zone__field">
            <label for="search-date-to" class="search-zone__label">Au</label>
            <input type="date" id="search-date-to" name="date_to" value="{{ request('date_to') }}" class="search-zone__input">
          </div>
          <div class="search-zone__actions">
            <button type="submit" class="btn btn--primary btn--sm">Rechercher</button>
            @if(request('q') || request('date_from') || request('date_to'))
              <a href="{{ route('actualites', request('section') ? ['section' => request('section')] : []) }}" class="search-zone__reset">Effacer</a>
            @endif
          </div>
        </div>
        @if(request('q') || request('date_from') || request('date_to'))
        <p class="search-zone__result-count">{{ $articles->total() }} résultat{{ $articles->total() > 1 ? 's' : '' }} trouvé{{ $articles->total() > 1 ? 's' : '' }}
          @if(request('q')) pour « {{ request('q') }} »@endif
        </p>
        @endif
      </form>

      <!-- Filtres -->
      <div class="filters">
        <a href="{{ route('actualites', array_filter(['q' => request('q'), 'date_from' => request('date_from'), 'date_to' => request('date_to')])) }}" class="filter-btn {{ !request('categorie') ? 'active' : '' }}">Tous <span class="filter-btn__count">{{ $articles->total() }}</span></a>
        @foreach($categories as $category)
        <a href="{{ route('actualites', array_filter(['categorie' => $category->slug, 'q' => request('q'), 'date_from' => request('date_from'), 'date_to' => request('date_to')])) }}" class="filter-btn {{ request('categorie') == $category->slug ? 'active' : '' }}">{{ $category->name }} <span class="filter-btn__count">{{ $category->articles_count }}</span></a>
        @endforeach
      </div>

      <!-- Grille des actualités -->
      <div class="news-grid-4">
        @forelse($articles as $article)
        <article class="news-card-img" data-category="{{ $article->category?->slug }}">
          <a href="{{ route('article.show', $article->slug) }}">
            <div class="news-card-img__visual" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop' }}'); background-size: cover; background-position: center;"></div>
            <div class="news-card-img__body">
              <div class="news-card-img__meta">
                @if($article->category)
                <span class="news-card-img__cat">{{ $article->category->name }}</span>
                <span class="news-card-img__dot">&bull;</span>
                @endif
                <span class="news-card-img__date">{{ $article->published_at ? $article->published_at->isoFormat('D MMM YYYY') : $article->created_at->isoFormat('D MMM YYYY') }}</span>
              </div>
              <h3 class="news-card-img__title">{{ $article->title }}</h3>
              <p class="news-card-img__excerpt">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 160) }}</p>
            </div>
          </a>
        </article>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 48px 0; color: var(--slate-500);">
          <p>Aucun article publié pour le moment.</p>
        </div>
        @endforelse
      </div>

      <!-- Pagination -->
      @if($articles->hasPages())
      <div style="margin-top: 40px;">
        {{ $articles->appends(request()->query())->links('vendor.pagination.front') }}
      </div>
      @endif

    </div>
  </section>

  <!-- CTA -->
  <section class="section section--alt">
    <div class="container" style="text-align:center;">
      <h2>Restez informé des actions de la DGIE</h2>
      <p style="max-width:560px; margin:12px auto 24px;">Pour toute question relative aux actualités ou pour obtenir des informations complémentaires, contactez directement la Direction Générale des Ivoiriens de l'Extérieur.</p>
      <a href="{{ route('contact') }}" class="btn btn--primary">Contactez la DGIE</a>
    </div>
  </section>
@endsection
