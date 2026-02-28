@extends('front-end.layouts.app')

@section('title', 'Galerie Photos & Vidéos — DGIE')

@section('meta')
  <meta name="description" content="Découvrez en images les activités, événements et programmes de la Direction Générale des Ivoiriens de l'Extérieur.">
  <meta property="og:title" content="Galerie Photos & Vidéos — DGIE">
  <meta property="og:description" content="Les albums photos et vidéos des activités de la DGIE.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="{{ route('galerie') }}">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Galerie Photos & Vidéos — DGIE">
  <meta name="twitter:description" content="Les albums photos et vidéos des activités de la DGIE.">
  <meta name="twitter:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <link rel="canonical" href="{{ route('galerie') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Galerie</span>
      </div>
      <h1 class="page-hero__title">Galerie Photos & Vidéos</h1>
      <p class="page-hero__subtitle">Revivez en images les temps forts des activités de la DGIE</p>
    </div>
  </section>

  <!-- FILTRES + GALERIE -->
  <section class="content" style="padding: 48px 0 64px;">
    <div class="container">

      <!-- Filtres -->
      <div class="filters" style="margin-bottom: 32px;">
        <a href="{{ route('galerie') }}" class="filter-btn {{ !request('type') ? 'filter-btn--active' : '' }}" data-gallery-filter="all">Tous <span class="filter-btn__count">{{ $totalCount }}</span></a>
        <a href="{{ route('galerie', ['type' => 'photo']) }}" class="filter-btn {{ request('type') == 'photo' ? 'filter-btn--active' : '' }}" data-gallery-filter="photo">Photos <span class="filter-btn__count">{{ $photoCount }}</span></a>
        <a href="{{ route('galerie', ['type' => 'video']) }}" class="filter-btn {{ request('type') == 'video' ? 'filter-btn--active' : '' }}" data-gallery-filter="video">Vidéos <span class="filter-btn__count">{{ $videoCount }}</span></a>
      </div>

      <!-- Grille albums -->
      <div class="gallery-grid">
        @forelse($albums as $album)
        <a href="#" class="gallery-album {{ $album->type === 'video' ? 'gallery-album--video' : '' }}" data-gallery-type="{{ $album->type }}" data-album-index="{{ $loop->index }}">
          <div class="gallery-album__img" style="background-image: url('{{ $album->cover_image ? asset('storage/' . $album->cover_image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop' }}');"></div>
          <div class="gallery-album__overlay">
            <div class="gallery-album__icon">
              @if($album->type === 'video')
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
              @else
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
              @endif
            </div>
            <div class="gallery-album__title">{{ $album->title }}</div>
            <div class="gallery-album__count">{{ $album->items_count ?? $album->items->count() }} {{ $album->type === 'video' ? 'vidéos' : 'photos' }}</div>
          </div>
        </a>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 48px 0; color: var(--slate-500);">
          <p>Aucun album publié pour le moment.</p>
        </div>
        @endforelse
      </div>

    </div>
  </section>

  <!-- ALBUM MODAL -->
  <div class="album-modal" id="albumModal">
    <div class="album-modal__container">
      <div class="album-modal__header">
        <div>
          <span class="album-modal__title" id="albumModalTitle"></span>
          <span class="album-modal__count" id="albumModalCount"></span>
        </div>
        <button class="album-modal__close" id="albumModalClose" aria-label="Fermer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="album-modal__grid" id="albumModalGrid"></div>
    </div>
  </div>

  <!-- LIGHTBOX -->
  <div class="lightbox" id="lightbox">
    <button class="lightbox__close" id="lightboxClose" aria-label="Fermer">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <button class="lightbox__nav lightbox__nav--prev" id="lightboxPrev" aria-label="Précédent">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <img class="lightbox__img" id="lightboxImg" src="" alt="Image de la galerie">
    <button class="lightbox__nav lightbox__nav--next" id="lightboxNext" aria-label="Suivant">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
    <div class="lightbox__caption" id="lightboxCaption"></div>
  </div>
@endsection

@push('scripts')
  <script>
  (function() {
    /* ---- Données des albums (dynamiques) ---- */
    var albumsData = @json($albumsJson);

    /* ---- Album Modal ---- */
    var modal = document.getElementById('albumModal');
    var modalTitle = document.getElementById('albumModalTitle');
    var modalCount = document.getElementById('albumModalCount');
    var modalGrid = document.getElementById('albumModalGrid');
    var modalClose = document.getElementById('albumModalClose');
    var albumEls = document.querySelectorAll('.gallery-album');

    albumEls.forEach(function(album) {
      album.addEventListener('click', function(e) {
        e.preventDefault();
        var index = parseInt(album.getAttribute('data-album-index'));
        openAlbum(index);
      });
    });

    function openAlbum(index) {
      var data = albumsData[index];
      if (!data) return;

      var label = data.type === 'video' ? ' vidéos' : ' photos';
      modalTitle.textContent = data.title;
      modalCount.textContent = data.photos.length + label;
      modalGrid.innerHTML = '';

      data.photos.forEach(function(photo, i) {
        var div = document.createElement('div');
        div.className = 'album-modal__photo';
        div.innerHTML = '<img src="' + photo.src + '" alt="' + photo.caption + '" loading="lazy">';
        div.addEventListener('click', function() {
          openLightbox(data.photos, i);
        });
        modalGrid.appendChild(div);
      });

      modal.classList.add('album-modal--open');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      modal.classList.remove('album-modal--open');
      document.body.style.overflow = '';
    }

    modalClose.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
      if (e.target === modal) closeModal();
    });

    /* ---- Lightbox ---- */
    var lightbox = document.getElementById('lightbox');
    var lightboxImg = document.getElementById('lightboxImg');
    var lightboxCaption = document.getElementById('lightboxCaption');
    var lightboxClose = document.getElementById('lightboxClose');
    var lightboxPrev = document.getElementById('lightboxPrev');
    var lightboxNext = document.getElementById('lightboxNext');
    var currentPhotos = [];
    var currentIndex = 0;

    function openLightbox(photos, index) {
      currentPhotos = photos;
      currentIndex = index;
      showPhoto();
      lightbox.classList.add('lightbox--open');
    }

    function showPhoto() {
      var photo = currentPhotos[currentIndex];
      lightboxImg.src = photo.src;
      lightboxImg.alt = photo.caption;
      lightboxCaption.textContent = (currentIndex + 1) + ' / ' + currentPhotos.length + '  —  ' + photo.caption;
    }

    function closeLightbox() {
      lightbox.classList.remove('lightbox--open');
      lightboxImg.src = '';
    }

    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function(e) {
      if (e.target === lightbox) closeLightbox();
    });

    lightboxPrev.addEventListener('click', function(e) {
      e.stopPropagation();
      currentIndex = (currentIndex - 1 + currentPhotos.length) % currentPhotos.length;
      showPhoto();
    });

    lightboxNext.addEventListener('click', function(e) {
      e.stopPropagation();
      currentIndex = (currentIndex + 1) % currentPhotos.length;
      showPhoto();
    });

    /* ---- Clavier ---- */
    document.addEventListener('keydown', function(e) {
      if (lightbox.classList.contains('lightbox--open')) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') { currentIndex = (currentIndex - 1 + currentPhotos.length) % currentPhotos.length; showPhoto(); }
        if (e.key === 'ArrowRight') { currentIndex = (currentIndex + 1) % currentPhotos.length; showPhoto(); }
      } else if (modal.classList.contains('album-modal--open')) {
        if (e.key === 'Escape') closeModal();
      }
    });
  })();
  </script>
@endpush
