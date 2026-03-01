@extends('front-end.layouts.app')

@section('title', 'Médiathèque — DGIE')

@section('meta')
  <meta name="description" content="Retrouvez toutes les vidéos de la Direction Générale des Ivoiriens de l'Extérieur : événements, conférences, interviews et actualités de la diaspora ivoirienne.">
  <meta property="og:title" content="Médiathèque — DGIE">
  <meta property="og:description" content="Les vidéos des activités et événements de la DGIE.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="{{ route('mediatheque') }}">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Médiathèque — DGIE">
  <meta name="twitter:description" content="Les vidéos des activités et événements de la DGIE.">
  <meta name="twitter:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <link rel="canonical" href="{{ route('mediatheque') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Médiathèque</span>
      </div>
      <h1 class="page-hero__title">Médiathèque</h1>
      <p class="page-hero__subtitle">Retrouvez toutes les vidéos des activités de la DGIE</p>
    </div>
  </section>

  <!-- VIDÉOS -->
  <section class="content" style="padding: 48px 0 64px;">
    <div class="container">

      @if($videos->count() > 0)
      <p class="mediatheque-page__count">{{ $videos->count() }} vidéo{{ $videos->count() > 1 ? 's' : '' }} disponible{{ $videos->count() > 1 ? 's' : '' }}</p>

      <div class="mediatheque-page__grid">
        @foreach($videos as $video)
        <a href="#" class="video-card" data-embed="{{ $video->embed_url }}" data-title="{{ $video->title }}">
          <div class="video-card__thumb">
            <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" alt="{{ $video->title }}" loading="lazy">
            <div class="video-card__play">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
            </div>
            <div class="video-card__overlay">
              <h3 class="video-card__title">{{ $video->title }}</h3>
              <span class="video-card__date">{{ $video->date->translatedFormat('d F Y') }}</span>
            </div>
          </div>
        </a>
        @endforeach
      </div>

      @else
      <div class="empty-section">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--slate-300)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
        </svg>
        <h3>Aucune vidéo pour le moment</h3>
        <p>Les vidéos des activités de la DGIE seront bientôt disponibles.</p>
      </div>
      @endif

    </div>
  </section>

  <!-- VIDEO PLAYER MODAL -->
  <div class="video-modal" id="videoModal">
    <div class="video-modal__backdrop"></div>
    <div class="video-modal__container">
      <button class="video-modal__close" aria-label="Fermer">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
      <div class="video-modal__player">
        <iframe id="videoFrame" src="" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
      <h3 class="video-modal__title" id="videoTitle"></h3>
    </div>
  </div>
@endsection

@push('scripts')
<script>
(function() {
  var modal = document.getElementById('videoModal');
  var frame = document.getElementById('videoFrame');
  var title = document.getElementById('videoTitle');
  if (!modal) return;

  // Open modal on card click
  document.querySelectorAll('.video-card').forEach(function(card) {
    card.addEventListener('click', function(e) {
      e.preventDefault();
      frame.src = this.dataset.embed + '?autoplay=1';
      frame.title = this.dataset.title;
      title.textContent = this.dataset.title;
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });

  // Close modal
  function closeModal() {
    modal.classList.remove('active');
    frame.src = '';
    document.body.style.overflow = '';
  }

  modal.querySelector('.video-modal__close').addEventListener('click', closeModal);
  modal.querySelector('.video-modal__backdrop').addEventListener('click', closeModal);
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
  });
})();
</script>
@endpush
