@extends('front-end.layouts.app')

@section('title', $opportunite->title . ' — Opportunités — DGIE')

@section('meta')
  <meta name="description" content="{{ Str::limit(strip_tags($opportunite->description), 160) }}">
  <meta property="og:title" content="{{ $opportunite->title }}">
  <meta property="og:description" content="{{ Str::limit(strip_tags($opportunite->description), 160) }}">
  <meta property="og:type" content="article">
  <meta property="og:image" content="{{ $opportunite->image ? asset('storage/' . $opportunite->image) : asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="{{ route('opportunite.show', $opportunite->slug) }}">
  <link rel="canonical" href="{{ route('opportunite.show', $opportunite->slug) }}">
@endsection

@section('content')
  <!-- HERO -->
  <section class="oppo-detail-hero" id="main-content">
    <div class="oppo-detail-hero__overlay" style="background-image: url('{{ $opportunite->image ? asset('storage/' . $opportunite->image) : asset('assets/images/hero-bg.jpg') }}');"></div>
    <div class="container">
      <div class="breadcrumb breadcrumb--light">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <a href="{{ route('opportunites') }}">Opportunités</a>
        <span class="breadcrumb__sep">/</span>
        <span>{{ Str::limit($opportunite->title, 50) }}</span>
      </div>
      <span class="oppo-card__type oppo-card__type--{{ $opportunite->type }}" style="display:inline-block; margin-bottom:12px;">{{ $opportunite->type_label }}</span>
      <h1 class="oppo-detail-hero__title">{{ $opportunite->title }}</h1>
      <div class="oppo-detail-hero__meta">
        @if($opportunite->organisme)
        <span class="oppo-detail-hero__info">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          {{ $opportunite->organisme }}
        </span>
        @endif
        @if($opportunite->location)
        <span class="oppo-detail-hero__info">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          {{ $opportunite->location }}
        </span>
        @endif
        @if($opportunite->date_limite)
        <span class="oppo-detail-hero__info {{ $opportunite->is_expired ? 'oppo-detail-hero__info--expired' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          {{ $opportunite->is_expired ? 'Date limite expirée' : 'Date limite : ' . $opportunite->date_limite->isoFormat('D MMMM YYYY') }}
        </span>
        @endif
      </div>
    </div>
  </section>

  <!-- CONTENU -->
  <section class="section">
    <div class="container">
      <div class="oppo-detail-layout">

        <!-- Colonne principale -->
        <div class="oppo-detail-content">
          <!-- Description -->
          <div class="oppo-detail-content__lead">
            {{ $opportunite->description }}
          </div>

          <!-- Contenu riche -->
          @if($opportunite->content)
          <div class="oppo-detail-content__body">
            {!! $opportunite->content !!}
          </div>
          @endif

          <!-- Lien externe -->
          @if($opportunite->url)
          <div class="oppo-detail-content__cta">
            <a href="{{ $opportunite->url }}" class="btn btn--primary" target="_blank" rel="noopener">
              Consulter le site officiel
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:6px;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
          </div>
          @endif

          <!-- Partage -->
          <div class="oppo-detail-share">
            <span class="oppo-detail-share__label">Partager :</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('opportunite.show', $opportunite->slug)) }}" target="_blank" rel="noopener" class="oppo-detail-share__btn" title="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('opportunite.show', $opportunite->slug)) }}&text={{ urlencode($opportunite->title) }}" target="_blank" rel="noopener" class="oppo-detail-share__btn" title="X (Twitter)">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('opportunite.show', $opportunite->slug)) }}" target="_blank" rel="noopener" class="oppo-detail-share__btn" title="LinkedIn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            <a href="https://wa.me/?text={{ urlencode($opportunite->title . ' — ' . route('opportunite.show', $opportunite->slug)) }}" target="_blank" rel="noopener" class="oppo-detail-share__btn" title="WhatsApp">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </a>
          </div>
        </div>

        <!-- Sidebar -->
        <aside class="oppo-detail-sidebar">
          <!-- Carte infos pratiques -->
          <div class="oppo-detail-info-card">
            <h3 class="oppo-detail-info-card__title">Informations pratiques</h3>
            <dl class="oppo-detail-info-card__list">
              <div class="oppo-detail-info-card__item">
                <dt>Type</dt>
                <dd><span class="oppo-card__type oppo-card__type--{{ $opportunite->type }}">{{ $opportunite->type_label }}</span></dd>
              </div>
              @if($opportunite->organisme)
              <div class="oppo-detail-info-card__item">
                <dt>Organisme</dt>
                <dd>{{ $opportunite->organisme }}</dd>
              </div>
              @endif
              @if($opportunite->location)
              <div class="oppo-detail-info-card__item">
                <dt>Lieu</dt>
                <dd>{{ $opportunite->location }}</dd>
              </div>
              @endif
              @if($opportunite->date_limite)
              <div class="oppo-detail-info-card__item">
                <dt>Date limite</dt>
                <dd class="{{ $opportunite->is_expired ? 'oppo-detail-info-card__expired' : '' }}">
                  {{ $opportunite->is_expired ? 'Expirée' : $opportunite->date_limite->isoFormat('D MMMM YYYY') }}
                </dd>
              </div>
              @endif
              @if($opportunite->url)
              <div class="oppo-detail-info-card__item">
                <dt>Site web</dt>
                <dd><a href="{{ $opportunite->url }}" target="_blank" rel="noopener">{{ parse_url($opportunite->url, PHP_URL_HOST) }}</a></dd>
              </div>
              @endif
            </dl>
          </div>

          <!-- Opportunités similaires -->
          @if($related->count() > 0)
          <div class="oppo-detail-related">
            <h3 class="oppo-detail-related__title">Opportunités similaires</h3>
            @foreach($related as $rel)
            <a href="{{ str_contains(strtolower($rel->organisme ?? ''), 'dgie') ? route('opportunite.show', $rel->slug) : ($rel->url ?: route('opportunite.show', $rel->slug)) }}" class="oppo-detail-related__card" @if($rel->url && !str_contains(strtolower($rel->organisme ?? ''), 'dgie')) target="_blank" rel="noopener" @endif>
              <span class="oppo-card__type oppo-card__type--{{ $rel->type }}" style="font-size:.65rem; padding: 2px 8px;">{{ $rel->type_label }}</span>
              <h4>{{ Str::limit($rel->title, 65) }}</h4>
              @if($rel->date_limite)
              <span class="oppo-detail-related__deadline {{ $rel->is_expired ? 'oppo-card__deadline--expired' : '' }}">
                {{ $rel->is_expired ? 'Expiré' : $rel->date_limite->isoFormat('D MMM YYYY') }}
              </span>
              @endif
            </a>
            @endforeach
          </div>
          @endif
        </aside>

      </div>
    </div>
  </section>

  <!-- CTA retour -->
  <section class="section section--alt">
    <div class="container" style="text-align:center;">
      <a href="{{ route('opportunites') }}" class="btn btn--outline" style="margin-right:12px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Toutes les opportunités
      </a>
      <a href="{{ route('contact') }}" class="btn btn--primary">Contactez la DGIE</a>
    </div>
  </section>
@endsection
