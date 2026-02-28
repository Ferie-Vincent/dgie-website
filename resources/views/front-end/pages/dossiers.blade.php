@extends('front-end.layouts.app')

@section('title', 'Dossiers — DGIE')

@section('meta')
  <meta name="description" content="Consultez les dossiers thématiques de la DGIE : retour volontaire, mobilisation des compétences, investissement diaspora, accompagnement social et partenariats.">
  <meta property="og:title" content="Dossiers thématiques — DGIE">
  <meta property="og:description" content="Les dossiers thématiques de la Direction Générale des Ivoiriens de l'Extérieur.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/dossiers.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Dossiers thématiques — DGIE">
  <meta name="twitter:description" content="Les dossiers thématiques de la Direction Générale des Ivoiriens de l'Extérieur.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ route('dossiers') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Dossiers</span>
      </div>
      <h1 class="page-hero__title">Dossiers de la DGIE</h1>
      <p class="page-hero__subtitle">Retrouvez nos dossiers thématiques sur les actions et programmes de la DGIE</p>
    </div>
  </section>

  <!-- DOSSIERS -->
  <section class="content" style="padding: 48px 0 64px;">
    <div class="container">

      <div class="dossier-grid">

        @forelse($dossiers as $dossier)
        <article class="dossier-card">
          <div class="dossier-card__img">
            <div class="dossier-card__img-inner" style="background-image: url('{{ $dossier->image ? asset('storage/' . $dossier->image) : 'https://images.unsplash.com/photo-1596496181871-9681eacf9764?w=600&h=350&fit=crop' }}');"></div>
          </div>
          <div class="dossier-card__body">
            <span class="dossier-card__tag">{{ strtoupper($dossier->department ?? 'DGIE') }}</span>
            <h3 class="dossier-card__title">{{ $dossier->title }}</h3>
            <p class="dossier-card__excerpt">{{ $dossier->description }}</p>
            <div class="dossier-card__meta">
              <span class="dossier-card__count">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                {{ $dossier->articles_count }} article{{ $dossier->articles_count > 1 ? 's' : '' }}
              </span>
              <a href="{{ route('dossier.show', $dossier->slug) }}" class="dossier-card__link">Consulter
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
              </a>
            </div>
          </div>
        </article>
        @empty
        <p>Aucun dossier disponible pour le moment.</p>
        @endforelse

      </div>

    </div>
  </section>
@endsection
