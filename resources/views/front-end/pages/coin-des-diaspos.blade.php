@extends('front-end.layouts.app')

@section('title', 'Le Coin des Diasporas — Communauté ivoirienne dans le monde | DGIE')

@section('meta')
  <meta name="description" content="Événements, portraits, annonces et ressources pour la diaspora ivoirienne. Retrouvez votre communauté dans le monde.">
  <meta property="og:title" content="Le Coin des Diasporas — DGIE">
  <meta property="og:description" content="Événements, portraits, annonces et ressources pour la diaspora ivoirienne dans le monde.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/coin-des-diaspos.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Le Coin des Diasporas — DGIE">
  <meta name="twitter:description" content="Événements, portraits, annonces et ressources pour la diaspora ivoirienne dans le monde.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ route('coin-des-diaspos') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero page-hero--diaspo" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Le Coin des Diasporas</span>
      </div>
      <h1 class="page-hero__title">Le Coin des Diasporas</h1>
      <p class="page-hero__subtitle">Votre espace, vos histoires, vos connexions. Événements, portraits et ressources pour la communauté ivoirienne dans le monde.</p>
    </div>
  </section>

  <!-- STATISTIQUES DIASPORA -->
  <section class="diaspo-stats">
    <div class="container">
      <div class="diaspo-stats__grid">
        <div class="diaspo-stats__item animate-on-scroll">
          <div class="diaspo-stats__icon diaspo-stats__icon--orange">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <div class="diaspo-stats__number" data-target="{{ $countries->count() ?: 32 }}">{{ $countries->count() ?: 32 }}</div>
          <div class="diaspo-stats__label">Pays de résidence</div>
        </div>
        <div class="diaspo-stats__item animate-on-scroll">
          <div class="diaspo-stats__icon diaspo-stats__icon--green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div class="diaspo-stats__number">{{ \App\Models\Setting::get('stat_diaspo_ivoiriens', '1,24M') }}</div>
          <div class="diaspo-stats__label">{{ \App\Models\Setting::get('stat_diaspo_ivoiriens_label', 'Ivoiriens à l\'étranger') }}</div>
        </div>
        <div class="diaspo-stats__item animate-on-scroll">
          <div class="diaspo-stats__icon diaspo-stats__icon--blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
          </div>
          <div class="diaspo-stats__number">{{ \App\Models\Setting::get('stat_diaspo_associations', '150+') }}</div>
          <div class="diaspo-stats__label">{{ \App\Models\Setting::get('stat_diaspo_associations_label', 'Associations recensées') }}</div>
        </div>
        <div class="diaspo-stats__item animate-on-scroll">
          <div class="diaspo-stats__icon diaspo-stats__icon--bordeaux">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          </div>
          <div class="diaspo-stats__number">{{ \App\Models\Setting::get('stat_diaspo_evenements', '40+') }}</div>
          <div class="diaspo-stats__label">{{ \App\Models\Setting::get('stat_diaspo_evenements_label', 'Événements par an') }}</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ÉVÉNEMENT À LA UNE — Hero + Countdown -->
  <section class="section">
    <div class="container">
      <div class="section-title">
        <h2>Prochain grand rendez-vous</h2>
        <span class="section-title__line"></span>
      </div>

      @if($nextDiaspoEvent)
      <div class="diaspo-event-hero">
        <div class="diaspo-event-hero__image" style="background-image: url('{{ $nextDiaspoEvent->image ? asset('storage/'.$nextDiaspoEvent->image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&h=500&fit=crop' }}');">
          <div class="diaspo-event-hero__overlay">
            <span class="diaspo-event-hero__badge diaspo-event-hero__badge--{{ $nextDiaspoEvent->section ?? 'general' }}">
              {{ ($nextDiaspoEvent->section ?? 'general') === 'diaspora' ? 'Diaspora' : 'Événement DGIE' }}
            </span>
            <h3 class="diaspo-event-hero__title">{{ $nextDiaspoEvent->title }}</h3>
            <div class="diaspo-event-hero__info">
              @if($nextDiaspoEvent->location)
              <span class="diaspo-event-hero__info-item">
                <svg width="15" height="15" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ $nextDiaspoEvent->location }}
              </span>
              @endif
              <span class="diaspo-event-hero__info-item">
                <svg width="15" height="15" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ $nextDiaspoEvent->event_date->locale('fr')->isoFormat('D MMMM YYYY') }}
                @if($nextDiaspoEvent->end_date)
                  — {{ $nextDiaspoEvent->end_date->locale('fr')->isoFormat('D MMMM YYYY') }}
                @endif
              </span>
            </div>
          </div>
        </div>
        <div class="diaspo-event-hero__countdown-col">
          <p class="diaspo-event-hero__countdown-label">Début de l'événement dans</p>
          <div class="diaspo-countdown" id="diaspoCountdown" data-event-date="{{ $nextDiaspoEvent->event_date->toIso8601String() }}">
            <div class="diaspo-countdown__box">
              <div class="diaspo-countdown__value" id="cd-days">00</div>
              <div class="diaspo-countdown__unit">Jours</div>
            </div>
            <div class="diaspo-countdown__box">
              <div class="diaspo-countdown__value" id="cd-hours">00</div>
              <div class="diaspo-countdown__unit">Heures</div>
            </div>
            <div class="diaspo-countdown__box">
              <div class="diaspo-countdown__value" id="cd-minutes">00</div>
              <div class="diaspo-countdown__unit">Min</div>
            </div>
            <div class="diaspo-countdown__box">
              <div class="diaspo-countdown__value" id="cd-seconds">00</div>
              <div class="diaspo-countdown__unit">Sec</div>
            </div>
          </div>
          @if($nextDiaspoEvent->description)
          <p class="diaspo-event-hero__desc">{{ Str::limit($nextDiaspoEvent->description, 220) }}</p>
          @endif
          <div class="diaspo-event-hero__cta">
            <a href="{{ route('actualites') }}" class="btn btn--outline">En savoir plus</a>
          </div>
        </div>
      </div>
      @else
      {{-- Fallback statique si aucun événement --}}
      <div class="diaspo-featured">
        <div class="diaspo-featured__img" style="background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&h=500&fit=crop');"></div>
        <div class="diaspo-featured__overlay"></div>
        <div class="diaspo-featured__content">
          <span class="diaspo-featured__badge">Événement</span>
          <h3 class="diaspo-featured__title">Aucun événement à venir pour le moment</h3>
          <p class="diaspo-featured__desc">Restez connectés, de nouveaux événements seront bientôt annoncés.</p>
        </div>
      </div>
      @endif
    </div>
  </section>

  {{-- Événements réalisés --}}
  @if($pastDiaspoEvents->count() > 0)
  <section class="section section--alt">
    <div class="container">
      <div class="section-title">
        <h2>Événements réalisés</h2>
        <span class="section-title__line"></span>
      </div>
      <div class="diaspo-past-events">
        @foreach($pastDiaspoEvents as $pastEvt)
        <article class="diaspo-past-card animate-on-scroll">
          <div class="diaspo-past-card__image" style="background-image: url('{{ $pastEvt->image ? asset('storage/'.$pastEvt->image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&h=300&fit=crop' }}');"></div>
          <div class="diaspo-past-card__body">
            <div class="diaspo-past-card__badges">
              <span class="diaspo-past-card__type{{ ($pastEvt->section ?? 'general') === 'diaspora' ? ' diaspo-past-card__type--diaspora' : '' }}">
                {{ ($pastEvt->section ?? 'general') === 'diaspora' ? 'Diaspora' : 'Général' }}
              </span>
              <span class="diaspo-past-card__done">
                <svg width="11" height="11" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                Terminé
              </span>
            </div>
            <h3 class="diaspo-past-card__title">{{ $pastEvt->title }}</h3>
            <span class="diaspo-past-card__date">{{ $pastEvt->event_date->locale('fr')->isoFormat('D MMMM YYYY') }}</span>
          </div>
        </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  {{-- Événements à venir --}}
  @if($upcomingDiaspoEvents->count() > 0)
  <section class="section">
    <div class="container">
      <div class="section-title">
        <h2>Prochains événements</h2>
        <span class="section-title__line"></span>
      </div>
      <div class="news-grid-4">
        @foreach($upcomingDiaspoEvents as $upEvt)
        <article class="news-card-img" data-category="evenement">
          <a href="{{ route('actualites') }}">
            <div class="news-card-img__visual" style="background-image: url('{{ $upEvt->image ? asset('storage/'.$upEvt->image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop' }}'); background-size: cover; background-position: center;"></div>
            <div class="news-card-img__body">
              <div class="news-card-img__meta">
                <span class="news-card-img__cat news-card-img__cat--green">Événement</span>
                <span class="news-card-img__dot">&bull;</span>
                <span class="news-card-img__date">{{ $upEvt->event_date->locale('fr')->isoFormat('D MMM YYYY') }}</span>
              </div>
              <h3 class="news-card-img__title">{{ $upEvt->title }}</h3>
              <p class="news-card-img__excerpt">{{ Str::limit($upEvt->description, 120) }}</p>
            </div>
          </a>
        </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- LA DIASPORA DANS LE MONDE -->
  <section class="section{{ $pastDiaspoEvents->count() > 0 && $upcomingDiaspoEvents->count() > 0 ? ' section--alt' : '' }}">
    <div class="container">
      <div class="section-title">
        <h2>La diaspora dans le monde</h2>
        <span class="section-title__line"></span>
      </div>
      <p style="color: var(--text-secondary); margin-bottom: 28px; font-size: 0.9rem;">Découvrez les communautés ivoiriennes à travers le monde. Chaque carte représente un pays où nos compatriotes construisent leur avenir.</p>

      <div class="country-grid">
        @forelse($countries as $country)
        <a href="#" class="country-card animate-on-scroll">
          <span class="country-card__flag">{{ $country->flag_emoji }}</span>
          <div class="country-card__info">
            <h3 class="country-card__name">{{ $country->name }}</h3>
            <span class="country-card__pop">{{ $country->population_label ?? '' }}</span>
          </div>
          <span class="country-card__arrow">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
          </span>
        </a>
        @empty
        {{-- Fallback statique --}}
        <a href="#" class="country-card animate-on-scroll">
          <span class="country-card__flag">🇫🇷</span>
          <div class="country-card__info">
            <h3 class="country-card__name">France</h3>
            <span class="country-card__pop">~345 000 Ivoiriens</span>
          </div>
          <span class="country-card__arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></span>
        </a>
        <a href="#" class="country-card animate-on-scroll">
          <span class="country-card__flag">🇺🇸</span>
          <div class="country-card__info">
            <h3 class="country-card__name">États-Unis</h3>
            <span class="country-card__pop">~120 000 Ivoiriens</span>
          </div>
          <span class="country-card__arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></span>
        </a>
        <a href="#" class="country-card animate-on-scroll">
          <span class="country-card__flag">🇨🇦</span>
          <div class="country-card__info">
            <h3 class="country-card__name">Canada</h3>
            <span class="country-card__pop">~45 000 Ivoiriens</span>
          </div>
          <span class="country-card__arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></span>
        </a>
        <a href="#" class="country-card animate-on-scroll">
          <span class="country-card__flag">🇮🇹</span>
          <div class="country-card__info">
            <h3 class="country-card__name">Italie</h3>
            <span class="country-card__pop">~38 000 Ivoiriens</span>
          </div>
          <span class="country-card__arrow"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg></span>
        </a>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ILS SONT RENTRÉS -->
  <section class="section section--alt">
    <div class="container">
      <div class="section-title">
        <h2>Ils sont rentrés</h2>
        <span class="section-title__line"></span>
        <a href="{{ route('nos-services') }}#retour" class="section-title__link">Tout voir <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg></a>
      </div>
      <p style="color: var(--text-secondary); margin-bottom: 28px; font-size: 0.9rem;">Témoignages d'Ivoiriens qui ont fait le choix du retour. Leurs parcours, leurs défis, leurs réussites.</p>

      <div class="return-grid">
        @forelse($testimonials as $testimonial)
        <div class="return-card animate-on-scroll">
          <div class="return-card__header">
            <div class="return-card__avatar" style="background-image: url('{{ $testimonial->avatar ? asset('storage/'.$testimonial->avatar) : 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=200&h=200&fit=crop' }}');"></div>
            <div>
              <h3 class="return-card__name">{{ $testimonial->name }}</h3>
              <span class="return-card__route">{{ $testimonial->route ?? '' }}</span>
              @if($testimonial->return_year)
              <span class="return-card__year">Retour en {{ $testimonial->return_year }}</span>
              @endif
            </div>
          </div>
          <blockquote class="return-card__quote">
            « {{ Str::limit($testimonial->quote, 250) }} »
          </blockquote>
          @if($testimonial->tags && count($testimonial->tags) > 0)
          <div class="return-card__tags">
            @foreach($testimonial->tags as $tag)
            <span class="return-card__tag">{{ $tag }}</span>
            @endforeach
          </div>
          @endif
        </div>
        @empty
        <div class="return-card animate-on-scroll">
          <div class="return-card__header">
            <div class="return-card__avatar" style="background-image: url('https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=200&h=200&fit=crop');"></div>
            <div>
              <h3 class="return-card__name">Ba Larissa</h3>
              <span class="return-card__route">Libye → Côte d'Ivoire</span>
              <span class="return-card__year">Retour en 2024</span>
            </div>
          </div>
          <blockquote class="return-card__quote">
            « Grâce à l'accompagnement de la DGIE et de la DAOSAR, j'ai pu me reconstruire. Aujourd'hui, je gère mon propre commerce à Abobo et je forme d'autres femmes de retour. »
          </blockquote>
          <div class="return-card__tags">
            <span class="return-card__tag">Retour volontaire</span>
            <span class="return-card__tag">Entrepreneuriat</span>
          </div>
        </div>
        <div class="return-card animate-on-scroll">
          <div class="return-card__header">
            <div class="return-card__avatar" style="background-image: url('https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=200&h=200&fit=crop');"></div>
            <div>
              <h3 class="return-card__name">Koné Ibrahim</h3>
              <span class="return-card__route">France → Côte d'Ivoire</span>
              <span class="return-card__year">Retour en 2023</span>
            </div>
          </div>
          <blockquote class="return-card__quote">
            « Après 15 ans à Marseille, j'ai décidé de rentrer pour lancer ma ferme avicole à Bouaké. Le Fonds de Soutien aux Activités m'a permis de démarrer sereinement. »
          </blockquote>
          <div class="return-card__tags">
            <span class="return-card__tag">Agriculture</span>
            <span class="return-card__tag">FSA</span>
          </div>
        </div>
        <div class="return-card animate-on-scroll">
          <div class="return-card__header">
            <div class="return-card__avatar" style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop');"></div>
            <div>
              <h3 class="return-card__name">Adjoua Christelle</h3>
              <span class="return-card__route">Canada → Côte d'Ivoire</span>
              <span class="return-card__year">Retour en 2025</span>
            </div>
          </div>
          <blockquote class="return-card__quote">
            « J'ai quitté Montréal avec mes compétences en informatique. Aujourd'hui, je dirige un centre de formation numérique à Abidjan qui a déjà formé 200 jeunes. »
          </blockquote>
          <div class="return-card__tags">
            <span class="return-card__tag">Tech</span>
            <span class="return-card__tag">Formation</span>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- COUPS DE CŒUR CULTURELS -->
  <section class="section">
    <div class="container">
      <div class="section-title">
        <h2>Coups de cœur culturels</h2>
        <span class="section-title__line"></span>
      </div>
      <p style="color: var(--text-secondary); margin-bottom: 28px; font-size: 0.9rem;">Notre sélection mensuelle : musique, livres, films et créations de la diaspora ivoirienne.</p>

      <div class="culture-grid">
        @forelse($culturalItems as $item)
        <div class="culture-card animate-on-scroll">
          <div class="culture-card__visual" style="background-image: url('{{ $item->image ? asset('storage/'.$item->image) : 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=400&h=400&fit=crop' }}');"></div>
          <div class="culture-card__body">
            <span class="culture-card__type">
              @if($item->type === 'musique')
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
              @elseif($item->type === 'livre')
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
              @elseif($item->type === 'film')
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/><line x1="7" y1="2" x2="7" y2="22"/><line x1="17" y1="2" x2="17" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/></svg>
              @else
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
              @endif
              {{ ucfirst($item->type ?? 'Culture') }}
            </span>
            <h3 class="culture-card__title">{{ $item->title }}</h3>
            <p class="culture-card__desc">{{ Str::limit($item->description, 150) }}</p>
          </div>
        </div>
        @empty
        <div class="culture-card animate-on-scroll">
          <div class="culture-card__visual" style="background-image: url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?w=400&h=400&fit=crop');"></div>
          <div class="culture-card__body">
            <span class="culture-card__type">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
              Musique
            </span>
            <h3 class="culture-card__title">« Racines » — Dobet Gnahoré</h3>
            <p class="culture-card__desc">Le nouvel album de l'artiste Grammy-nominée mêle traditions akan et sonorités contemporaines. Un voyage musical entre Abidjan et le monde.</p>
          </div>
        </div>
        <div class="culture-card animate-on-scroll">
          <div class="culture-card__visual" style="background-image: url('https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=400&fit=crop');"></div>
          <div class="culture-card__body">
            <span class="culture-card__type">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
              Livre
            </span>
            <h3 class="culture-card__title">« L'Enfant de la diaspora » — Edwige Renée Dro</h3>
            <p class="culture-card__desc">Un roman touchant sur l'identité biculturelle d'une jeune femme ivoirienne grandie à Londres, entre deux mondes et deux langues.</p>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- LA QUESTION DU MOIS -->
  <section class="section section--alt">
    <div class="container">
      <div class="diaspo-poll">
        <div class="diaspo-poll__header">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          <h2 class="diaspo-poll__title">La question du mois</h2>
        </div>
        @if($activePoll)
        <p class="diaspo-poll__question">{{ $activePoll->question }}</p>
        <fieldset class="diaspo-poll__options">
          <legend class="sr-only">{{ $activePoll->question }}</legend>
          @foreach($activePoll->options as $option)
          @php
            $percent = $activePoll->total_votes > 0 ? round(($option->votes / $activePoll->total_votes) * 100) : 0;
          @endphp
          <label class="diaspo-poll__option">
            <input type="radio" name="poll" value="{{ $option->id }}">
            <span class="diaspo-poll__radio"></span>
            <span class="diaspo-poll__label">{{ $option->label }}</span>
            <span class="diaspo-poll__bar" style="--poll-percent: {{ $percent }}%;"></span>
            <span class="diaspo-poll__percent">{{ $percent }}%</span>
          </label>
          @endforeach
        </fieldset>
        <p class="diaspo-poll__count">{{ $activePoll->total_votes }} votes ce mois-ci</p>
        @else
        <p class="diaspo-poll__question">Quel est le premier plat que vous mangez quand vous rentrez au pays ?</p>
        <fieldset class="diaspo-poll__options">
          <legend class="sr-only">Quel est le premier plat que vous mangez quand vous rentrez au pays ?</legend>
          <label class="diaspo-poll__option">
            <input type="radio" name="poll" value="attieke">
            <span class="diaspo-poll__radio"></span>
            <span class="diaspo-poll__label">Attiéké poisson braisé</span>
            <span class="diaspo-poll__bar" style="--poll-percent: 42%;"></span>
            <span class="diaspo-poll__percent">42%</span>
          </label>
          <label class="diaspo-poll__option">
            <input type="radio" name="poll" value="foutou">
            <span class="diaspo-poll__radio"></span>
            <span class="diaspo-poll__label">Foutou sauce graine</span>
            <span class="diaspo-poll__bar" style="--poll-percent: 28%;"></span>
            <span class="diaspo-poll__percent">28%</span>
          </label>
          <label class="diaspo-poll__option">
            <input type="radio" name="poll" value="garba">
            <span class="diaspo-poll__radio"></span>
            <span class="diaspo-poll__label">Garba</span>
            <span class="diaspo-poll__bar" style="--poll-percent: 18%;"></span>
            <span class="diaspo-poll__percent">18%</span>
          </label>
          <label class="diaspo-poll__option">
            <input type="radio" name="poll" value="kedjenou">
            <span class="diaspo-poll__radio"></span>
            <span class="diaspo-poll__label">Kédjénou de poulet</span>
            <span class="diaspo-poll__bar" style="--poll-percent: 12%;"></span>
            <span class="diaspo-poll__percent">12%</span>
          </label>
        </fieldset>
        <p class="diaspo-poll__count">247 votes ce mois-ci</p>
        @endif
      </div>
    </div>
  </section>

  <!-- BOÎTE À OUTILS DU DIASPO -->
  <section class="section">
    <div class="container">
      <div class="section-title">
        <h2>Boîte à outils du diaspo</h2>
        <span class="section-title__line"></span>
      </div>
      <p style="color: var(--text-secondary); margin-bottom: 28px; font-size: 0.9rem;">Ressources pratiques pour votre quotidien à l'étranger. Démarches, finances, santé et droits.</p>

      <div class="toolkit-grid">
        @forelse($toolkitItems as $tool)
        <div class="toolkit-card animate-on-scroll">
          <div class="toolkit-card__icon toolkit-card__icon--{{ $loop->iteration % 4 == 1 ? 'green' : ($loop->iteration % 4 == 2 ? 'orange' : ($loop->iteration % 4 == 3 ? 'blue' : 'bordeaux')) }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          </div>
          <h3 class="toolkit-card__title">{{ $tool->title }}</h3>
          <p class="toolkit-card__desc">{{ Str::limit($tool->description, 150) }}</p>
          @if($tool->url)
          <a href="{{ $tool->url }}" class="toolkit-card__link" target="_blank">Consulter le guide <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg></a>
          @endif
        </div>
        @empty
        <div class="toolkit-card animate-on-scroll">
          <div class="toolkit-card__icon toolkit-card__icon--green">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          </div>
          <h3 class="toolkit-card__title">Démarches consulaires</h3>
          <p class="toolkit-card__desc">Renouvellement de passeport, état civil, procurations, légalisations. Toutes les démarches expliquées pas à pas.</p>
          <a href="{{ route('contact') }}" class="toolkit-card__link">Consulter le guide <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg></a>
        </div>
        <div class="toolkit-card animate-on-scroll">
          <div class="toolkit-card__icon toolkit-card__icon--orange">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <h3 class="toolkit-card__title">Transferts d'argent</h3>
          <p class="toolkit-card__desc">Comparatif des services de transfert, frais, délais et conseils pour envoyer de l'argent en Côte d'Ivoire.</p>
          <a href="{{ route('nos-services') }}#investir" class="toolkit-card__link">Consulter le guide <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg></a>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- CTA PROPOSER UN CONTENU -->
  <section class="section section--alt">
    <div class="container">
      <div class="diaspo-cta">
        <div class="diaspo-cta__icon">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
        </div>
        <h2 class="diaspo-cta__title">Vous avez quelque chose à partager ?</h2>
        <p class="diaspo-cta__desc">Vous organisez un événement, vous connaissez un parcours inspirant ou vous souhaitez partager une annonce avec la communauté ? Proposez votre contenu à la DGIE.</p>
        <div class="diaspo-cta__buttons">
          <a href="{{ route('contact') }}" class="btn btn--primary">Proposer un contenu</a>
          <a href="{{ route('contact') }}" class="btn btn--outline">Contacter la DGIE</a>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
<script>
// Countdown timer for diaspora event hero
(function() {
  var el = document.getElementById('diaspoCountdown');
  if (!el) return;
  var target = new Date(el.dataset.eventDate).getTime();
  function tick() {
    var diff = target - Date.now();
    if (diff <= 0) {
      document.getElementById('cd-days').textContent = '0';
      document.getElementById('cd-hours').textContent = '0';
      document.getElementById('cd-minutes').textContent = '0';
      document.getElementById('cd-seconds').textContent = '0';
      return;
    }
    document.getElementById('cd-days').textContent = Math.floor(diff / 86400000);
    document.getElementById('cd-hours').textContent = Math.floor((diff % 86400000) / 3600000);
    document.getElementById('cd-minutes').textContent = Math.floor((diff % 3600000) / 60000);
    document.getElementById('cd-seconds').textContent = Math.floor((diff % 60000) / 1000);
  }
  tick();
  setInterval(tick, 1000);
})();
</script>
@endpush
