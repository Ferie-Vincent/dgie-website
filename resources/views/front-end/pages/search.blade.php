@extends('front-end.layouts.app')

@section('title', $query ? 'Recherche : ' . $query . ' — DGIE' : 'Recherche — DGIE')

@section('meta')
  <meta name="robots" content="noindex">
@endsection

@section('content')
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Recherche</span>
      </div>
      <h1 class="page-hero__title">Recherche</h1>
      @if($query)
      <p class="page-hero__subtitle">Résultats pour « {{ $query }} »</p>
      @endif
    </div>
  </section>

  <section class="search-section">
    <div class="container">

      <!-- Barre de recherche -->
      <form action="{{ route('search') }}" method="GET" class="search-form">
        <input type="text" name="q" value="{{ $query }}" placeholder="Rechercher un article, un dossier, un événement..." class="search-form__input">
        <button type="submit" class="search-form__btn">Rechercher</button>
      </form>

      @if(!$query)
        <p class="search-empty">Saisissez un terme pour lancer la recherche.</p>
      @elseif($articles->isEmpty() && $dossiers->isEmpty() && $evenements->isEmpty())
        <div class="search-no-results">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
          <p class="search-no-results__title">Aucun résultat trouvé pour « {{ $query }} »</p>
          <p>Essayez avec d'autres termes ou parcourez nos rubriques.</p>
        </div>
      @else

        @php $totalResults = $articles->count() + $dossiers->count() + $evenements->count(); @endphp
        <p class="search-count">{{ $totalResults }} résultat{{ $totalResults > 1 ? 's' : '' }} trouvé{{ $totalResults > 1 ? 's' : '' }}</p>

        {{-- Articles --}}
        @if($articles->count())
        <h2 class="search-results__heading">Articles ({{ $articles->count() }})</h2>
        <div class="article-grid" style="margin-bottom: 3rem;">
          @foreach($articles as $article)
          <article class="article-card">
            <a href="{{ route('article.show', $article->slug) }}" class="article-card__img-link">
              <div class="article-card__img" style="background-image: url('{{ $article->image ? asset('storage/' . $article->image) : '' }}');"></div>
            </a>
            <div class="article-card__body">
              @if($article->category)
              <span class="article-card__category">{{ $article->category->name }}</span>
              @endif
              <h3 class="article-card__title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></h3>
              <p class="article-card__excerpt">{{ Str::limit($article->excerpt, 120) }}</p>
            </div>
          </article>
          @endforeach
        </div>
        @endif

        {{-- Dossiers --}}
        @if($dossiers->count())
        <h2 class="search-results__heading search-results__heading--green">Dossiers ({{ $dossiers->count() }})</h2>
        <div class="search-results__grid">
          @foreach($dossiers as $dossier)
          <a href="{{ route('dossier.show', $dossier->slug) }}" class="search-dossier-card">
            <h3 class="search-dossier-card__title">{{ $dossier->title }}</h3>
            <p class="search-dossier-card__desc">{{ Str::limit($dossier->description, 150) }}</p>
          </a>
          @endforeach
        </div>
        @endif

        {{-- Événements --}}
        @if($evenements->count())
        <h2 class="search-results__heading search-results__heading--bordeaux">Événements ({{ $evenements->count() }})</h2>
        <div class="search-results__grid">
          @foreach($evenements as $evt)
          <div class="search-event-card">
            <span class="search-event-card__date">{{ $evt->event_date?->translatedFormat('d F Y') }}</span>
            <h3 class="search-event-card__title">{{ $evt->title }}</h3>
            @if($evt->location)<p class="search-event-card__location">{{ $evt->location }}</p>@endif
          </div>
          @endforeach
        </div>
        @endif

      @endif
    </div>
  </section>
@endsection
