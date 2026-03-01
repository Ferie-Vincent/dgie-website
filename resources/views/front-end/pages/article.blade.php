@extends('front-end.layouts.app')

@section('title', $article->title . ' — DGIE')

@section('meta')
  <meta name="description" content="{{ Str::limit($article->excerpt ?? strip_tags($article->content), 160) }}">
  <meta property="og:title" content="{{ $article->title }} — DGIE">
  <meta property="og:description" content="{{ Str::limit($article->excerpt ?? strip_tags($article->content), 160) }}">
  <meta property="og:type" content="article">
  <meta property="og:url" content="{{ route('article.show', $article->slug) }}">
  <meta property="og:image" content="{{ $article->image ? asset('storage/' . $article->image) : asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta property="article:published_time" content="{{ $article->published_at?->toIso8601String() }}">
  <meta property="article:author" content="{{ $article->author?->name ?? 'DGIE' }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $article->title }} — DGIE">
  <meta name="twitter:description" content="{{ Str::limit($article->excerpt ?? strip_tags($article->content), 160) }}">
  <meta name="twitter:image" content="{{ $article->image ? asset('storage/' . $article->image) : asset('assets/images/logo-dgie.png') }}">
  <link rel="canonical" href="{{ route('article.show', $article->slug) }}">
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ $article->title }}",
    "description": "{{ Str::limit($article->excerpt ?? strip_tags($article->content), 160) }}",
    "image": "{{ $article->image ? asset('storage/' . $article->image) : asset('assets/images/logo-dgie.png') }}",
    "datePublished": "{{ $article->published_at?->toIso8601String() }}",
    "author": {
      "@type": "Organization",
      "name": "{{ $article->author?->name ?? 'DGIE' }}"
    },
    "publisher": {
      "@type": "GovernmentOrganization",
      "name": "Direction Générale des Ivoiriens de l'Extérieur",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ asset('assets/images/logo-dgie.png') }}"
      }
    }
  }
  </script>
@endsection

@section('content')
  <!-- ARTICLE -->
  <section class="section article-page">
    <div class="container">
      <div class="article-layout">

        <!-- Partage social (gauche) -->
        <aside class="article-share">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('article.show', $article->slug)) }}" target="_blank" rel="noopener" class="article-share__btn article-share__btn--facebook" aria-label="Partager sur Facebook">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('article.show', $article->slug)) }}&text={{ urlencode($article->title) }}" target="_blank" rel="noopener" class="article-share__btn article-share__btn--twitter" aria-label="Partager sur X">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('article.show', $article->slug)) }}&title={{ urlencode($article->title) }}" target="_blank" rel="noopener" class="article-share__btn article-share__btn--linkedin" aria-label="Partager sur LinkedIn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="https://wa.me/?text={{ urlencode($article->title . ' — ' . route('article.show', $article->slug)) }}" target="_blank" rel="noopener" class="article-share__btn article-share__btn--whatsapp" aria-label="Partager sur WhatsApp">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          </a>
        </aside>

        <!-- Contenu principal -->
        <main class="article-content" id="main-content">
          <!-- Breadcrumb -->
          <div class="breadcrumb" style="margin-bottom: 20px;">
            <a href="{{ route('home') }}">Accueil</a>
            <span class="breadcrumb__sep">/</span>
            <a href="{{ route('actualites') }}">Actualités</a>
            <span class="breadcrumb__sep">/</span>
            <span>{{ Str::limit($article->title, 40) }}</span>
          </div>

          <!-- Meta -->
          <div class="article-content__meta">
            @if($article->category)
            <span class="news-card-img__cat">{{ $article->category->name }}</span>
            <span class="news-card-img__dot">&bull;</span>
            @endif
            <span class="news-card-img__date">{{ $article->published_at ? $article->published_at->isoFormat('D MMMM YYYY') : $article->created_at->isoFormat('D MMMM YYYY') }}</span>
            @if($article->read_time)
            <span class="news-card-img__dot">&bull;</span>
            <span class="news-card-img__date">{{ $article->read_time }} min de lecture</span>
            @endif
          </div>

          <!-- Titre -->
          <h1 class="article-content__title">{{ $article->title }}</h1>

          <!-- Chapô -->
          @if($article->excerpt)
          <p class="article-content__lead">{{ $article->excerpt }}</p>
          @endif

          <!-- Image principale -->
          @if($article->image)
          <figure class="article-content__figure">
            <div class="article-content__img" style="background-image: url('{{ asset('storage/' . $article->image) }}'); background-size: cover; background-position: center; height: 420px; border-radius: 12px;"></div>
          </figure>
          @endif

          <!-- Corps de l'article -->
          <div class="article-content__body">
            {!! $article->content !!}
          </div>

          <!-- Galerie photos -->
          @if($article->images->count())
          <div class="article-gallery">
            <h3 class="article-gallery__title">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
              Galerie photos
            </h3>
            <div class="article-gallery__grid">
              @foreach($article->images as $index => $img)
              <figure class="article-gallery__item" data-lightbox="{{ $index }}">
                <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->caption ?? $article->title }}" loading="lazy">
                @if($img->caption)
                <figcaption>{{ $img->caption }}</figcaption>
                @endif
              </figure>
              @endforeach
            </div>
          </div>

          <!-- Lightbox -->
          <div class="article-lightbox" id="articleLightbox">
            <button class="article-lightbox__close" aria-label="Fermer">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
            <button class="article-lightbox__nav article-lightbox__prev" aria-label="Image precedente">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <img class="article-lightbox__img" src="" alt="">
            <button class="article-lightbox__nav article-lightbox__next" aria-label="Image suivante">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
          @endif

          <!-- Auteur -->
          <div class="article-author">
            <div class="article-author__avatar">
              @if($article->author && $article->author->avatar)
              <img src="{{ asset('storage/avatars/' . $article->author->avatar) }}" alt="{{ $article->author->name }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
              @else
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              @endif
            </div>
            <div>
              <div class="article-author__label">Auteur</div>
              <div class="article-author__name">{{ $article->author?->name ?? 'DGIE — Direction de la Communication' }}</div>
            </div>
          </div>

          <!-- Navigation articles -->
          <div class="article-nav">
            @if($previousArticle)
            <a href="{{ route('article.show', $previousArticle->slug) }}" class="article-nav__link article-nav__link--prev">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
              <div>
                <span class="article-nav__label">Article précédent</span>
                <span class="article-nav__title">{{ Str::limit($previousArticle->title, 60) }}</span>
              </div>
            </a>
            @endif
            @if($nextArticle)
            <a href="{{ route('article.show', $nextArticle->slug) }}" class="article-nav__link article-nav__link--next">
              <div>
                <span class="article-nav__label">Article suivant</span>
                <span class="article-nav__title">{{ Str::limit($nextArticle->title, 60) }}</span>
              </div>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
            </a>
            @endif
          </div>

          <!-- Zone de commentaires -->
          <div class="comments-section">
            <h2 class="comments-section__title">
              Commentaires
              <span class="comments-section__count">{{ $article->comments->count() }}</span>
            </h2>

            @if(session('comment_success'))
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; color: #166534; font-size: .9rem;">
              {{ session('comment_success') }}
            </div>
            @endif

            <!-- Formulaire -->
            <form class="comment-form" action="{{ route('comment.submit') }}" method="POST">
              @csrf
              <input type="hidden" name="article_id" value="{{ $article->id }}">
              <div class="comment-form__row">
                <div class="comment-form__field">
                  <label for="commentName">Nom complet</label>
                  <input type="text" id="commentName" name="name" placeholder="Votre nom" required value="{{ old('name') }}">
                  @error('name') <span style="color:#e53e3e;font-size:.8rem;">{{ $message }}</span> @enderror
                </div>
                <div class="comment-form__field">
                  <label for="commentEmail">Adresse e-mail</label>
                  <input type="email" id="commentEmail" name="email" placeholder="votre@email.com" required value="{{ old('email') }}">
                  @error('email') <span style="color:#e53e3e;font-size:.8rem;">{{ $message }}</span> @enderror
                </div>
              </div>
              <div class="comment-form__field">
                <label for="commentText">Votre commentaire</label>
                <textarea id="commentText" name="content" rows="4" placeholder="Partagez votre avis sur cet article..." required>{{ old('content') }}</textarea>
                @error('content') <span style="color:#e53e3e;font-size:.8rem;">{{ $message }}</span> @enderror
              </div>
              <button type="submit" class="btn btn--primary comment-form__submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4 20-7z"/></svg>
                Publier le commentaire
              </button>
            </form>

            <!-- Liste des commentaires -->
            <div class="comments-list">
              @forelse($article->comments as $comment)
              <div class="comment">
                <div class="comment__avatar">{{ strtoupper(substr($comment->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $comment->name)[1] ?? '', 0, 1)) }}</div>
                <div class="comment__body">
                  <div class="comment__header">
                    <span class="comment__author">{{ $comment->name }}</span>
                    <span class="comment__date">{{ $comment->created_at->isoFormat('D MMMM YYYY') }}</span>
                  </div>
                  <p class="comment__text">{{ $comment->content }}</p>

                  @foreach($comment->replies as $reply)
                  <div class="comment comment--reply">
                    <div class="comment__avatar {{ $reply->is_admin ? 'comment__avatar--admin' : '' }}">{{ $reply->is_admin ? 'DGIE' : strtoupper(substr($reply->name, 0, 2)) }}</div>
                    <div class="comment__body">
                      <div class="comment__header">
                        <span class="comment__author">{{ $reply->name }} @if($reply->is_admin) <span class="comment__badge">Admin</span> @endif</span>
                        <span class="comment__date">{{ $reply->created_at->isoFormat('D MMMM YYYY') }}</span>
                      </div>
                      <p class="comment__text">{{ $reply->content }}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              @empty
              <p style="color: var(--slate-500); text-align: center; padding: 24px 0;">Soyez le premier à commenter cet article.</p>
              @endforelse
            </div>
          </div>

        </main>

        <!-- Sidebar -->
        <aside class="article-sidebar">
          <!-- À la une -->
          <div class="article-sidebar__block">
            <h3 class="article-sidebar__title">À la une</h3>
            @forelse($relatedArticles as $related)
            <a href="{{ route('article.show', $related->slug) }}" class="sidebar-article">
              <div class="sidebar-article__img" style="background-image: url('{{ $related->image ? asset('storage/' . $related->image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=200&h=150&fit=crop' }}'); background-size: cover; background-position: center;"></div>
              <div class="sidebar-article__body">
                @if($related->category)
                <span class="sidebar-article__cat">{{ $related->category->name }}</span>
                @endif
                <span class="sidebar-article__heading">{{ Str::limit($related->title, 70) }}</span>
              </div>
            </a>
            @empty
            <p style="color:var(--slate-500);font-size:.9rem;">Aucun article similaire.</p>
            @endforelse
          </div>

          <!-- Newsletter -->
          <div class="article-sidebar__newsletter-v2">
            <div class="article-sidebar__newsletter-v2-header">
              <div class="article-sidebar__newsletter-v2-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              </div>
              <div>
                <h3 class="article-sidebar__newsletter-v2-title">Restez informé</h3>
                <p class="article-sidebar__newsletter-v2-desc">Recevez nos actualités par e-mail</p>
              </div>
            </div>
            <form class="article-sidebar__newsletter-v2-form" action="{{ route('newsletter.subscribe') }}" method="POST">
              @csrf
              <label for="sidebarNewsletterEmail" class="sr-only">Votre adresse e-mail</label>
              <input type="email" name="email" id="sidebarNewsletterEmail" placeholder="Votre adresse e-mail" required>
              <button type="submit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              </button>
            </form>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
(function() {
  var lightbox = document.getElementById('articleLightbox');
  if (!lightbox) return;
  var items = document.querySelectorAll('.article-gallery__item');
  var lbImg = lightbox.querySelector('.article-lightbox__img');
  var current = 0;
  var images = [];
  items.forEach(function(item) {
    images.push(item.querySelector('img').src);
  });

  function openLightbox(index) {
    current = index;
    lbImg.src = images[current];
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
  function closeLightbox() {
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
  }
  function navigate(dir) {
    current = (current + dir + images.length) % images.length;
    lbImg.src = images[current];
  }

  items.forEach(function(item, i) {
    item.addEventListener('click', function() { openLightbox(i); });
  });
  lightbox.querySelector('.article-lightbox__close').addEventListener('click', closeLightbox);
  lightbox.querySelector('.article-lightbox__prev').addEventListener('click', function() { navigate(-1); });
  lightbox.querySelector('.article-lightbox__next').addEventListener('click', function() { navigate(1); });
  lightbox.addEventListener('click', function(e) { if (e.target === lightbox) closeLightbox(); });
  document.addEventListener('keydown', function(e) {
    if (!lightbox.classList.contains('active')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') navigate(-1);
    if (e.key === 'ArrowRight') navigate(1);
  });
})();
</script>
@endpush
