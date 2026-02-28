@extends('front-end.layouts.app')

@section('title', 'La DGIE — Missions, organisation et cadre juridique')

@section('meta')
  <meta name="description" content="Découvrez la Direction Générale des Ivoiriens de l'Extérieur : missions, organisation (DAOSAR, DMCRIE, DAS) et textes de référence.">
  <meta property="og:title" content="La DGIE — Missions et Organisation">
  <meta property="og:description" content="Découvrez la Direction Générale des Ivoiriens de l'Extérieur : missions, organisation et textes de référence.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/la-dgie.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="La DGIE — Missions et Organisation">
  <meta name="twitter:description" content="Découvrez la Direction Générale des Ivoiriens de l'Extérieur : missions, organisation et textes de référence.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ route('la-dgie') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>La DGIE</span>
      </div>
      <h1 class="page-hero__title">La DGIE</h1>
      <p class="page-hero__subtitle">Direction Générale des Ivoiriens de l'Extérieur</p>
    </div>
  </section>

  <!-- SOUS-NAVIGATION -->
  <nav class="page-subnav">
    <div class="container">
      <a href="#mot-dg" class="page-subnav__link page-subnav__link--active">Mot du Directeur Général</a>
      <a href="#organisation" class="page-subnav__link">Organisation</a>
      <a href="#missions" class="page-subnav__link">Nos missions</a>
      <a href="#cadre-juridique" class="page-subnav__link">Cadre juridique</a>
    </div>
  </nav>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- Mot du Directeur Général -->
          <section id="mot-dg">
            <h2>Mot du Directeur Général</h2>

            <!-- Bloc citation hero -->
            <div class="dg-hero">
              <div class="dg-hero__photo">
                <div class="dg-hero__photo-img">
                  @if($dg && $dg->photo_page)
                  <img src="{{ asset('storage/' . $dg->photo_page) }}" alt="{{ $dg->name }}, {{ $dg->title }}">
                  @elseif($dg && $dg->photo)
                  <img src="{{ asset('storage/' . $dg->photo) }}" alt="{{ $dg->name }}, {{ $dg->title }}">
                  @else
                  <img src="{{ asset('assets/images/person/gaoussou_karamoko.jpg') }}" alt="Directeur Général des Ivoiriens de l'Extérieur">
                  @endif
                </div>
                <div class="dg-hero__photo-info">
                  <div class="dg-hero__name">{{ $dg->name ?? 'M. Gaoussou Karamoko' }}</div>
                  <div class="dg-hero__role">{{ $dg->title ?? 'Directeur Général des Ivoiriens de l\'Extérieur' }}</div>
                </div>
              </div>
              <div class="dg-hero__body">
                <svg class="dg-hero__quote-mark" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" opacity="0.15"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11h4v10H0z"/></svg>
                <p class="dg-hero__quote-text">{{ $dg->quote ?? 'La Direction Générale des Ivoiriens de l\'Extérieur incarne la volonté de l\'État de Côte d\'Ivoire de maintenir un lien fort et durable avec chacun de ses fils et filles établis à travers le monde. Notre mission est claire : accompagner, soutenir et valoriser notre diaspora, tout en offrant à ceux qui font le choix du retour un cadre d\'accueil digne et des perspectives concrètes de réinsertion.' }}</p>
              </div>
            </div>

            <!-- Texte éditorial -->
            <div class="dg-editorial">
              <p>La DGIE a été créée par décret n°2023-973 du 06 décembre 2023 avec pour ambition de coordonner l'ensemble des actions de l'État en faveur des Ivoiriens de l'extérieur. Nous nous engageons à mettre en place des dispositifs efficaces d'accompagnement au retour, à mobiliser les compétences et les ressources de la diaspora pour le développement national, et à apporter une assistance sociale à nos compatriotes en situation de vulnérabilité.</p>
              <p>À travers nos trois directions opérationnelles — la DAOSAR, la DMCRIE et la DAS — nous déployons une approche globale qui place l'usager au centre de notre action. Chaque Ivoirien de l'extérieur doit pouvoir compter sur sa patrie, et chaque migrant de retour doit trouver les conditions favorables à sa réintégration.</p>
              <p>Je vous invite à découvrir nos programmes, nos services et nos initiatives. La DGIE est à votre écoute et à votre service.</p>
            </div>
          </section>

          <!-- Chiffres clés -->
          <section class="dgie-stats">
            <div class="dgie-stats__grid">
              <div class="dgie-stats__item">
                <div class="dgie-stats__icon dgie-stats__icon--green">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="dgie-stats__number">1,24M</div>
                <div class="dgie-stats__label">Ivoiriens à l'étranger</div>
              </div>
              <div class="dgie-stats__item">
                <div class="dgie-stats__icon dgie-stats__icon--orange">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div class="dgie-stats__number">2 300+</div>
                <div class="dgie-stats__label">Migrants accompagnés</div>
              </div>
              <div class="dgie-stats__item">
                <div class="dgie-stats__icon dgie-stats__icon--slate">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <div class="dgie-stats__number">3</div>
                <div class="dgie-stats__label">Directions opérationnelles</div>
              </div>
              <div class="dgie-stats__item">
                <div class="dgie-stats__icon dgie-stats__icon--green">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <div class="dgie-stats__number">1 042 Mds</div>
                <div class="dgie-stats__label">FCFA de transferts (2023)</div>
              </div>
            </div>
          </section>

          <!-- Organisation -->
          <section id="organisation">
            <h2>Organisation</h2>
            <p>La DGIE est structurée autour de trois directions opérationnelles, chacune dédiée à un volet spécifique de sa mission auprès des Ivoiriens de l'extérieur et des migrants de retour.</p>

            <!-- Organigramme hiérarchique -->
            <div class="org-hierarchy">
              <div class="org-hierarchy__top">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Direction Générale (DGIE)
              </div>
              <div class="org-hierarchy__line"></div>
              <div class="org-hierarchy__branches">
                <div class="org-hierarchy__branch">
                  <div class="org-hierarchy__branch-label">DAOSAR</div>
                </div>
                <div class="org-hierarchy__branch">
                  <div class="org-hierarchy__branch-label">DMCRIE</div>
                </div>
                <div class="org-hierarchy__branch">
                  <div class="org-hierarchy__branch-label">DAS</div>
                </div>
              </div>
            </div>

            <!-- Cartes détaillées -->
            <div class="org-chart">
              <div class="org-card">
                <div class="org-card__icon">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div class="org-card__acronym">DAOSAR</div>
                <div class="org-card__name">Direction de l'Accueil, de l'Orientation et du Suivi des Actions de Réinsertion</div>
                <p class="org-card__desc">La DAOSAR assure l'accueil des Ivoiriens de retour, les oriente vers les dispositifs d'accompagnement adaptés et assure le suivi de leur parcours de réinsertion socio-économique.</p>
                <a href="{{ route('nos-services') }}#retour" class="org-card__link">En savoir plus <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></a>
              </div>
              <div class="org-card">
                <div class="org-card__icon">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <div class="org-card__acronym">DMCRIE</div>
                <div class="org-card__name">Direction de la Mobilisation des Compétences et des Ressources des Ivoiriens de l'Extérieur</div>
                <p class="org-card__desc">La DMCRIE identifie et mobilise les compétences, les expertises et les ressources financières de la diaspora ivoirienne pour le développement national.</p>
                <a href="{{ route('nos-services') }}#investir" class="org-card__link">En savoir plus <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></a>
              </div>
              <div class="org-card">
                <div class="org-card__icon">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <div class="org-card__acronym">DAS</div>
                <div class="org-card__name">Direction de l'Action Sociale</div>
                <p class="org-card__desc">La DAS intervient en faveur des Ivoiriens de l'extérieur et des migrants de retour en situation de vulnérabilité. Elle coordonne les actions d'assistance et d'accompagnement psychosocial.</p>
                <a href="{{ route('contact') }}" class="org-card__link">En savoir plus <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></a>
              </div>
            </div>
          </section>

          <!-- Nos missions -->
          <section id="missions">
            <h2>Nos missions</h2>
            <div class="missions-grid">
              <div class="mission-item">
                <div class="mission-item__num">01</div>
                <div class="mission-item__content">
                  <h3 class="mission-item__title">Accueil et orientation</h3>
                  <p>Accueillir, informer et orienter les Ivoiriens de retour vers les dispositifs de réinsertion adaptés.</p>
                </div>
              </div>
              <div class="mission-item">
                <div class="mission-item__num">02</div>
                <div class="mission-item__content">
                  <h3 class="mission-item__title">Suivi de la réintégration</h3>
                  <p>Assurer le suivi et l'accompagnement des parcours de réintégration socio-économique sur le territoire national.</p>
                </div>
              </div>
              <div class="mission-item">
                <div class="mission-item__num">03</div>
                <div class="mission-item__content">
                  <h3 class="mission-item__title">Mobilisation des compétences</h3>
                  <p>Identifier et mobiliser les compétences de la diaspora ivoirienne au profit du développement national.</p>
                </div>
              </div>
              <div class="mission-item">
                <div class="mission-item__num">04</div>
                <div class="mission-item__content">
                  <h3 class="mission-item__title">Investissements diaspora</h3>
                  <p>Faciliter les investissements et les transferts de ressources de la diaspora vers la Côte d'Ivoire.</p>
                </div>
              </div>
              <div class="mission-item">
                <div class="mission-item__num">05</div>
                <div class="mission-item__content">
                  <h3 class="mission-item__title">Assistance sociale</h3>
                  <p>Apporter une assistance aux Ivoiriens de l'extérieur en situation de vulnérabilité et coordonner l'aide d'urgence.</p>
                </div>
              </div>
              <div class="mission-item">
                <div class="mission-item__num">06</div>
                <div class="mission-item__content">
                  <h3 class="mission-item__title">Politique migratoire</h3>
                  <p>Contribuer à l'élaboration de la politique nationale en matière de migration et renforcer le lien avec la diaspora.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Cadre juridique -->
          <section id="cadre-juridique">
            <h2>Cadre juridique</h2>
            <p>La DGIE a été instituée par le décret n°2023-973 du 06 décembre 2023 portant création, attributions, organisation et fonctionnement de la Direction Générale des Ivoiriens de l'Extérieur.</p>

            <div class="legal-cards">
              <div class="legal-card">
                <div class="legal-card__icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <div class="legal-card__body">
                  <div class="legal-card__title">Décret n°2023-973</div>
                  <div class="legal-card__date">06 décembre 2023</div>
                  <p class="legal-card__desc">Portant création, attributions, organisation et fonctionnement de la Direction Générale des Ivoiriens de l'Extérieur.</p>
                </div>
              </div>
              <div class="legal-card">
                <div class="legal-card__icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <div class="legal-card__body">
                  <div class="legal-card__title">Politique nationale de migration</div>
                  <div class="legal-card__date">Cadre stratégique</div>
                  <p class="legal-card__desc">Cadre normatif régissant l'action de la DGIE et la politique migratoire ivoirienne, en cohérence avec les engagements internationaux.</p>
                </div>
              </div>
            </div>
          </section>

          <!-- Info box -->
          <div class="info-box info-box--green">
            <div style="display:flex; align-items:center; gap:12px;">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
              <p>La DGIE place l'usager au centre de son action. Pour les démarches consulaires, veuillez vous rapprocher du poste consulaire compétent.</p>
            </div>
          </div>

        </div>

        <!-- Sidebar -->
        <aside class="content__sidebar">

          <div class="sidebar-widget">
            <div class="sidebar-widget__title">Liens rapides</div>
            <div class="sidebar-widget__list">
              <a href="{{ route('nos-services') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                Nos services
              </a>
              <a href="{{ route('dossiers') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                Dossiers thématiques
              </a>
              <a href="{{ route('actualites') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                Actualités
              </a>
              <a href="{{ route('galerie') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                Galerie
              </a>
            </div>
          </div>

          <!-- Téléchargements -->
          <div class="sidebar-widget sidebar-widget--dark">
            <div class="sidebar-widget__title">Documents utiles</div>
            <div class="sidebar-widget__downloads">
              @forelse($documents as $doc)
              <a href="{{ asset('storage/' . $doc->file_path) }}" class="sidebar-download" target="_blank">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                <div>
                  <span class="sidebar-download__name">{{ $doc->title }}</span>
                  <span class="sidebar-download__size">{{ $doc->file_size ?? 'PDF' }}</span>
                </div>
              </a>
              @empty
              <p style="color:rgba(255,255,255,0.6);font-size:.85rem;">Aucun document disponible.</p>
              @endforelse
            </div>
          </div>

          <div class="sidebar-widget">
            <div class="sidebar-widget__title">Contact</div>
            <div class="sidebar-contact-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>{{ $contactInfo->address ?? 'Plateau, Rue du Commerce, Abidjan' }}</span>
            </div>
            <div class="sidebar-contact-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span>{{ $contactInfo->phone_1 ?? '+225 XX XX XX XX XX' }}</span>
            </div>
            <div class="sidebar-contact-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              <span>{{ $contactInfo->email ?? 'contact@dgie.gouv.ci' }}</span>
            </div>
            <div class="sidebar-contact-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span>Lun – Ven : 8h00 – 16h30</span>
            </div>
            <a href="{{ route('contact') }}" class="btn btn--green" style="margin-top: 16px; width: 100%;">Nous contacter</a>
          </div>

        </aside>

      </div>
    </div>
  </section>
@endsection
