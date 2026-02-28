@extends('front-end.layouts.app')

@section('title', $evenement->title . ' — Événement DGIE')

@section('meta')
  <meta name="description" content="{{ Str::limit(strip_tags($evenement->description), 160) }}">
  <meta property="og:title" content="{{ $evenement->title }} — DGIE">
  <meta property="og:description" content="{{ Str::limit(strip_tags($evenement->description), 160) }}">
  <meta property="og:type" content="article">
  <meta property="og:url" content="{{ route('event.show', $evenement->slug) }}">
  <meta property="og:image" content="{{ $evenement->image ? asset('storage/' . $evenement->image) : asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="canonical" href="{{ route('event.show', $evenement->slug) }}">
@endsection

@section('content')
  <!-- HERO ÉVÉNEMENT -->
  <section class="section" style="padding-bottom: 0;">
    <div class="container">
      <div class="event-hero" style="background-image: linear-gradient(135deg, rgba(15,23,42,0.85), rgba(29,140,79,0.75)), url('{{ $evenement->image ? asset('storage/' . $evenement->image) : asset('assets/images/hero-bg.jpg') }}');">

      <div class="breadcrumb breadcrumb--light" style="margin-bottom: 20px;">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Événement</span>
      </div>

      <div class="event-hero__badge">
        @if($evenement->event_date->isFuture())
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Événement à venir
        @else
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
          Événement passé
        @endif
      </div>

      <h1 class="event-hero__title">{{ $evenement->title }}</h1>

      <div class="event-hero__meta">
        <div class="event-hero__meta-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          {{ $evenement->event_date->isoFormat('dddd D MMMM YYYY') }}
          @if($evenement->end_date)
            — {{ $evenement->end_date->isoFormat('D MMMM YYYY') }}
          @endif
        </div>
        @if($evenement->location)
        <div class="event-hero__meta-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          {{ $evenement->location }}
        </div>
        @endif
        @if($evenement->section === 'diaspora')
        <div class="event-hero__meta-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          Événement diaspora
        </div>
        @endif
      </div>

      @if($evenement->event_date->isFuture())
      <div class="event-hero__countdown" id="eventDetailCountdown" data-date="{{ $evenement->event_date->toIso8601String() }}">
        <div class="event-hero__countdown-unit">
          <span class="event-hero__countdown-number" id="detailDays">--</span>
          <span class="event-hero__countdown-label">Jours</span>
        </div>
        <div class="event-hero__countdown-unit">
          <span class="event-hero__countdown-number" id="detailHours">--</span>
          <span class="event-hero__countdown-label">Heures</span>
        </div>
        <div class="event-hero__countdown-unit">
          <span class="event-hero__countdown-number" id="detailMins">--</span>
          <span class="event-hero__countdown-label">Min</span>
        </div>
        <div class="event-hero__countdown-unit">
          <span class="event-hero__countdown-number" id="detailSecs">--</span>
          <span class="event-hero__countdown-label">Sec</span>
        </div>
      </div>
      @endif
      </div>
    </div>
  </section>

  <!-- CONTENU ÉVÉNEMENT -->
  <section class="section">
    <div class="container">
      <div class="event-layout">

        <!-- Contenu principal -->
        <main class="event-content" id="main-content">

          @if($evenement->image)
          <figure class="event-content__figure">
            <img src="{{ asset('storage/' . $evenement->image) }}" alt="{{ $evenement->title }}" class="event-content__img">
          </figure>
          @endif

          <div class="event-content__body">
            {!! $evenement->description !!}
          </div>

          <!-- Informations pratiques -->
          <div class="event-info-card">
            <h3 class="event-info-card__title">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
              Informations pratiques
            </h3>
            <div class="event-info-card__grid">
              <div class="event-info-card__item">
                <span class="event-info-card__label">Date</span>
                <span class="event-info-card__value">
                  {{ $evenement->event_date->isoFormat('D MMMM YYYY [à] HH[h]mm') }}
                  @if($evenement->end_date)
                    <br>au {{ $evenement->end_date->isoFormat('D MMMM YYYY [à] HH[h]mm') }}
                  @endif
                </span>
              </div>
              @if($evenement->location)
              <div class="event-info-card__item">
                <span class="event-info-card__label">Lieu</span>
                <span class="event-info-card__value">{{ $evenement->location }}</span>
              </div>
              @endif
              <div class="event-info-card__item">
                <span class="event-info-card__label">Section</span>
                <span class="event-info-card__value">{{ $evenement->section === 'diaspora' ? 'Diaspora' : 'Général' }}</span>
              </div>
            </div>
          </div>

          <!-- Partage -->
          <div class="event-share">
            <span class="event-share__label">Partager cet événement :</span>
            <div class="event-share__links">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('event.show', $evenement->slug)) }}" target="_blank" rel="noopener" class="article-share__btn article-share__btn--facebook" aria-label="Partager sur Facebook">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('event.show', $evenement->slug)) }}&text={{ urlencode($evenement->title) }}" target="_blank" rel="noopener" class="article-share__btn article-share__btn--twitter" aria-label="Partager sur X">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
              </a>
              <a href="https://wa.me/?text={{ urlencode($evenement->title . ' — ' . route('event.show', $evenement->slug)) }}" target="_blank" rel="noopener" class="article-share__btn article-share__btn--whatsapp" aria-label="Partager sur WhatsApp">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              </a>
            </div>
          </div>
        </main>

        <!-- Sidebar -->
        <aside class="event-sidebar">
          @if($upcomingEvents->count() > 0)
          <div class="event-sidebar__block">
            <h3 class="event-sidebar__title">Autres événements à venir</h3>
            @foreach($upcomingEvents as $evt)
            <a href="{{ route('event.show', $evt->slug) }}" class="event-sidebar__card">
              <div class="event-sidebar__card-date">
                <span class="event-sidebar__card-day">{{ $evt->event_date->format('d') }}</span>
                <span class="event-sidebar__card-month">{{ $evt->event_date->translatedFormat('M') }}</span>
              </div>
              <div class="event-sidebar__card-body">
                <span class="event-sidebar__card-title">{{ Str::limit($evt->title, 55) }}</span>
                <span class="event-sidebar__card-location">{{ $evt->location ?? 'Abidjan' }}</span>
              </div>
            </a>
            @endforeach
          </div>
          @endif
        </aside>

      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
  // Countdown pour la page événement
  (function() {
    const el = document.getElementById('eventDetailCountdown');
    if (!el) return;
    const target = new Date(el.dataset.date).getTime();
    function update() {
      const diff = target - Date.now();
      if (diff <= 0) {
        el.innerHTML = '<p style="color:#fff;font-weight:600;">L\'événement a commencé !</p>';
        return;
      }
      const d = Math.floor(diff / 86400000);
      const h = Math.floor((diff % 86400000) / 3600000);
      const m = Math.floor((diff % 3600000) / 60000);
      const s = Math.floor((diff % 60000) / 1000);
      document.getElementById('detailDays').textContent = String(d).padStart(2, '0');
      document.getElementById('detailHours').textContent = String(h).padStart(2, '0');
      document.getElementById('detailMins').textContent = String(m).padStart(2, '0');
      document.getElementById('detailSecs').textContent = String(s).padStart(2, '0');
    }
    update();
    setInterval(update, 1000);
  })();
</script>
@endpush
