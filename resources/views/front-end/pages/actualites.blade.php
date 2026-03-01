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

      <!-- Filtres -->
      <div class="filters">
        <a href="{{ route('actualites') }}" class="filter-btn {{ !request('categorie') ? 'active' : '' }}">Tous <span class="filter-btn__count">{{ $articles->total() }}</span></a>
        @foreach($categories as $category)
        <a href="{{ route('actualites', ['categorie' => $category->slug]) }}" class="filter-btn {{ request('categorie') == $category->slug ? 'active' : '' }}">{{ $category->name }} <span class="filter-btn__count">{{ $category->articles_count }}</span></a>
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
