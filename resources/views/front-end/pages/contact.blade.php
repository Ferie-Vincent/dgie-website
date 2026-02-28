@extends('front-end.layouts.app')

@section('title', 'Contactez la DGIE — Assistance et informations')

@section('meta')
  <meta name="description" content="Besoin d'aide ? Contactez la DGIE par formulaire, téléphone ou e-mail. Horaires, adresse et assistance pour les Ivoiriens de l'extérieur.">
  <meta property="og:title" content="Contact — DGIE">
  <meta property="og:description" content="Contactez la DGIE par formulaire, téléphone ou e-mail. Assistance pour les Ivoiriens de l'extérieur.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="{{ route('contact') }}">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Contact — DGIE">
  <meta name="twitter:description" content="Contactez la DGIE par formulaire, téléphone ou e-mail.">
  <meta name="twitter:image" content="{{ asset('assets/images/logo-dgie.png') }}">
  <link rel="canonical" href="{{ route('contact') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Contact</span>
      </div>
      <h1 class="page-hero__title">Contactez la DGIE</h1>
      <p class="page-hero__subtitle">Vous avez une question sur nos programmes, besoin d'assistance ou souhaitez signaler un incident ? Notre équipe est à votre disposition pour vous répondre.</p>
    </div>
  </section>

  <!-- CONTACT : 2 COLONNES -->
  <section class="section">
    <div class="container">
      <div class="contact-layout">

        <!-- COLONNE GAUCHE — Informations -->
        <div class="contact-layout__info">
          <h2 class="contact-section-title">Siège de la DGIE</h2>

          <div class="contact-item">
            <div class="contact-item__icon contact-item__icon--green">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
              <h3 class="contact-item__label">Adresse Physique</h3>
              <p class="contact-item__text">Direction Générale des Ivoiriens de l'Extérieur</p>
              <p class="contact-item__text">{{ $contactInfo->address ?? 'Plateau, Rue du Commerce, Abidjan, Côte d\'Ivoire' }}</p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-item__icon contact-item__icon--orange">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div>
              <h3 class="contact-item__label">Téléphone & Fax</h3>
              <p class="contact-item__text">{{ $contactInfo->phone_1 ?? '+225 XX XX XX XX XX' }}</p>
              @if($contactInfo && $contactInfo->phone_2)
              <p class="contact-item__text">{{ $contactInfo->phone_2 }}</p>
              @endif
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-item__icon contact-item__icon--slate">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div>
              <h3 class="contact-item__label">Courrier Électronique</h3>
              <p class="contact-item__text">{{ $contactInfo->email ?? 'contact@dgie.gouv.ci' }}</p>
            </div>
          </div>

          <div class="contact-item">
            <div class="contact-item__icon contact-item__icon--green">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div>
              <h3 class="contact-item__label">Horaires d'ouverture</h3>
              <p class="contact-item__text">Lundi – Vendredi : 8h00 – 16h30</p>
              <p class="contact-item__text">Samedi, dimanche et jours fériés : fermé</p>
            </div>
          </div>

          <div class="contact-cta-box">
            <h3>Besoin de contacter une direction ?</h3>
            <p>Vous pouvez joindre directement la DAOSAR, la DMCRIE ou la DAS en sélectionnant le service concerné dans le formulaire ci-contre.</p>
            <a href="{{ route('la-dgie') }}" class="contact-cta-box__link">Voir l'organisation de la DGIE &rarr;</a>
          </div>
        </div>

        <!-- COLONNE DROITE — Formulaire -->
        <div class="contact-layout__form">
          <div class="contact-form-card">
            <h2 class="contact-form-card__title">Envoyez-nous un message</h2>

            @if(session('success'))
            <div class="form__success" style="display:block;">{{ session('success') }}</div>
            @endif

            <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
              @csrf
              <div class="contact-form__row">
                <div class="contact-form__group">
                  <label class="contact-form__label" for="nom">Nom complet *</label>
                  <input class="contact-form__input" type="text" id="nom" name="name" required placeholder="Votre nom complet" value="{{ old('name') }}">
                  @error('name') <span style="color:#e53e3e;font-size:.8rem;">{{ $message }}</span> @enderror
                </div>
                <div class="contact-form__group">
                  <label class="contact-form__label" for="email">Adresse e-mail *</label>
                  <input class="contact-form__input" type="email" id="email" name="email" required placeholder="exemple@email.com" value="{{ old('email') }}">
                  @error('email') <span style="color:#e53e3e;font-size:.8rem;">{{ $message }}</span> @enderror
                </div>
              </div>
              <div class="contact-form__group">
                <label class="contact-form__label" for="objet">Objet de votre demande *</label>
                <select class="contact-form__input contact-form__select" id="objet" name="subject" required>
                  <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Sélectionnez un objet</option>
                  <option value="Question générale" {{ old('subject') == 'Question générale' ? 'selected' : '' }}>Question générale</option>
                  <option value="Retour et réintégration (DAOSAR)" {{ old('subject') == 'Retour et réintégration (DAOSAR)' ? 'selected' : '' }}>Retour et réintégration (DAOSAR)</option>
                  <option value="Investissement et compétences (DMCRIE)" {{ old('subject') == 'Investissement et compétences (DMCRIE)' ? 'selected' : '' }}>Investissement et compétences (DMCRIE)</option>
                  <option value="Accompagnement social (DAS)" {{ old('subject') == 'Accompagnement social (DAS)' ? 'selected' : '' }}>Accompagnement social (DAS)</option>
                  <option value="Autre" {{ old('subject') == 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('subject') <span style="color:#e53e3e;font-size:.8rem;">{{ $message }}</span> @enderror
              </div>
              <div class="contact-form__group">
                <label class="contact-form__label" for="message">Votre message *</label>
                <textarea class="contact-form__input contact-form__textarea" id="message" name="message" required placeholder="Comment pouvons-nous vous aider ?">{{ old('message') }}</textarea>
                @error('message') <span style="color:#e53e3e;font-size:.8rem;">{{ $message }}</span> @enderror
              </div>
              <button type="submit" class="contact-form__submit">
                Envoyer le message
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
              </button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- INFO BOX -->
  <section class="section" style="padding-top: 0;">
    <div class="container">
      <div class="info-box">
        <p>Pour les démarches consulaires (visa, passeport, état civil), veuillez vous rapprocher du poste consulaire compétent.</p>
      </div>
    </div>
  </section>

  <!-- LOCALISATION -->
  <section class="section section--alt">
    <div class="container">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: var(--slate-900);">Notre Localisation</h2>
        <a href="https://maps.google.com/?q=DGIE+Plateau+Rue+du+Commerce+Abidjan" target="_blank" rel="noopener" style="font-size: 0.8rem; font-weight: 600; color: var(--green);">Ouvrir dans Google Maps &nearr;</a>
      </div>
      <div class="contact-map">
        <div class="contact-map__placeholder">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:48px;height:48px;color:var(--slate-400);"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          <p>DGIE — {{ $contactInfo->address ?? 'Plateau, Rue du Commerce, Abidjan' }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="section">
    <div class="container">
      <div class="section__header">
        <h2>Questions fréquentes</h2>
        <p>Retrouvez les réponses aux questions les plus courantes sur la DGIE et ses services.</p>
      </div>
      <div class="faq">
        @forelse($faqs as $faq)
        <div class="faq__item">
          <button class="faq__question">{{ $faq->question }}</button>
          <div class="faq__answer">
            <div class="faq__answer-inner">{!! $faq->answer !!}</div>
          </div>
        </div>
        @empty
        {{-- Fallback statique si pas de FAQ en BDD --}}
        <div class="faq__item">
          <button class="faq__question">Qu'est-ce que la DGIE ?</button>
          <div class="faq__answer">
            <div class="faq__answer-inner">La DGIE (Direction Générale des Ivoiriens de l'Extérieur) est une structure administrative de l'État ivoirien créée par le décret n° 2023-973. Elle est rattachée au ministère en charge des Affaires étrangères.</div>
          </div>
        </div>
        <div class="faq__item">
          <button class="faq__question">Les services de la DGIE sont-ils gratuits ?</button>
          <div class="faq__answer">
            <div class="faq__answer-inner">Oui, entièrement gratuits. La DGIE est un service public financé par le budget national.</div>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection
