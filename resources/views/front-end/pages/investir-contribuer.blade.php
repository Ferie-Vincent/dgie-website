@extends('front-end.layouts.app')

@section('title', 'Investir et Contribuer — Diaspora ivoirienne et DGIE')

@section('meta')
  <meta name="description" content="Mobilisez vos compétences et investissez en Côte d'Ivoire avec l'appui de la DGIE. Programmes, appels à projets et accompagnement.">
  <meta property="og:title" content="Investir et Contribuer — DGIE">
  <meta property="og:description" content="Mobilisez vos compétences et investissez en Côte d'Ivoire avec l'appui de la DGIE.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/investir-contribuer.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Investir et Contribuer — DGIE">
  <meta name="twitter:description" content="Mobilisez vos compétences et investissez en Côte d'Ivoire avec l'appui de la DGIE.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ route('investir-contribuer') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Investir et Contribuer</span>
      </div>
      <h1 class="page-hero__title">Investir et Contribuer</h1>
      <p class="page-hero__subtitle">Mobilisez vos compétences et ressources au service du développement de la Côte d'Ivoire.</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- MAIN -->
        <div class="content__main">

          <!-- Intro avec icône -->
          <div class="info-box info-box--green" style="margin-top: 0;">
            <p><strong>Votre expertise, votre capital, votre réseau — au service de la Côte d'Ivoire.</strong> La DGIE accompagne chaque membre de la diaspora qui souhaite investir ou contribuer au développement national.</p>
          </div>

          <h2>Mobilisation des compétences</h2>
          <p>La DMCRIE recense, organise et valorise les savoir-faire de la diaspora ivoirienne au bénéfice du développement national. À travers le <strong>répertoire des compétences</strong>, elle identifie les profils qualifiés dans les domaines stratégiques.</p>

          <!-- Étapes visuelles -->
          <div class="steps" style="margin: 24px 0;">
            <div class="step">
              <div class="step__number">1</div>
              <div class="step__content">
                <h3>Inscription au répertoire</h3>
                <p>Faites connaître vos compétences en remplissant le formulaire de la DMCRIE.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">2</div>
              <div class="step__content">
                <h3>Mise en relation</h3>
                <p>La DGIE vous connecte aux institutions publiques et entreprises ivoiriennes.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">3</div>
              <div class="step__content">
                <h3>Missions et transferts</h3>
                <p>Participez à des missions d'expertise, formations ou projets de coopération technique.</p>
              </div>
            </div>
          </div>

          <h2>Investissement diaspora</h2>
          <p>La DGIE encourage et accompagne les Ivoiriens de l'extérieur qui souhaitent investir en Côte d'Ivoire. Que vous portiez un projet individuel ou collectif, la Direction vous oriente vers les structures compétentes.</p>

          <h3>Accompagnement personnalisé</h3>
          <p>Chaque porteur de projet bénéficie d'un suivi adapté. La DGIE facilite la mise en relation avec le CEPICI, les chambres consulaires et les banques partenaires :</p>
          <ul>
            <li>Information sur le cadre juridique et fiscal ivoirien</li>
            <li>Orientation vers les guichets uniques de création d'entreprise</li>
            <li>Aide à la constitution des dossiers de financement</li>
            <li>Suivi post-création pour les entreprises nouvellement établies</li>
          </ul>

          <h3>Secteurs porteurs</h3>
          <p>La Côte d'Ivoire offre de nombreuses opportunités dans des secteurs à fort potentiel :</p>
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px; margin: 16px 0 24px;">
            <div style="background: var(--slate-50); border-radius: var(--radius); padding: 16px; border-left: 3px solid var(--green);">
              <strong style="color: var(--green);">Agriculture</strong>
              <p style="font-size: 0.82rem; margin: 4px 0 0; color: var(--text-secondary);">Cacao, cajou, hévéa, produits vivriers et agro-industrie</p>
            </div>
            <div style="background: var(--slate-50); border-radius: var(--radius); padding: 16px; border-left: 3px solid var(--orange);">
              <strong style="color: var(--orange);">Numérique</strong>
              <p style="font-size: 0.82rem; margin: 4px 0 0; color: var(--text-secondary);">Fintech, e-commerce, solutions digitales et services en ligne</p>
            </div>
            <div style="background: var(--slate-50); border-radius: var(--radius); padding: 16px; border-left: 3px solid var(--bordeaux);">
              <strong style="color: var(--bordeaux);">Immobilier</strong>
              <p style="font-size: 0.82rem; margin: 4px 0 0; color: var(--text-secondary);">Logements sociaux, infrastructures commerciales et touristiques</p>
            </div>
            <div style="background: var(--slate-50); border-radius: var(--radius); padding: 16px; border-left: 3px solid #3b82f6;">
              <strong style="color: #3b82f6;">Santé</strong>
              <p style="font-size: 0.82rem; margin: 4px 0 0; color: var(--text-secondary);">Cliniques, télémédecine, équipements et produits pharmaceutiques</p>
            </div>
            <div style="background: var(--slate-50); border-radius: var(--radius); padding: 16px; border-left: 3px solid #8b5cf6;">
              <strong style="color: #8b5cf6;">Éducation</strong>
              <p style="font-size: 0.82rem; margin: 4px 0 0; color: var(--text-secondary);">Établissements privés, formation technique, plateformes d'apprentissage</p>
            </div>
          </div>

          <h2>Appels à projets en cours</h2>
          <p>La DGIE publie régulièrement des appels à projets offrant financement, accompagnement technique et suivi sur mesure.</p>

          <div class="info-box" style="border-left: 4px solid var(--green); background: linear-gradient(135deg, rgba(29,140,79,0.04), rgba(29,140,79,0.01));">
            <span style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--green); display: inline-block; background: rgba(29,140,79,0.1); padding: 3px 10px; border-radius: 20px; margin-bottom: 8px;">Appel ouvert</span>
            <h3 style="margin: 0 0 8px; font-size: 1rem;">Programme d'appui à l'entrepreneuriat — Édition 2026</h3>
            <p style="font-size: 0.85rem; margin-bottom: 4px;"><strong>Date limite :</strong> 30 avril 2026 &nbsp;|&nbsp; <strong>Financement :</strong> jusqu'à 5 000 000 FCFA</p>
            <p style="font-size: 0.82rem;">Accompagnement technique de six mois, financement d'amorçage et accès au réseau de mentors de la DGIE.</p>
          </div>

          <div class="info-box" style="border-left: 4px solid var(--orange); background: linear-gradient(135deg, rgba(232,119,42,0.04), rgba(232,119,42,0.01));">
            <span style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--orange); display: inline-block; background: rgba(232,119,42,0.1); padding: 3px 10px; border-radius: 20px; margin-bottom: 8px;">Appel ouvert</span>
            <h3 style="margin: 0 0 8px; font-size: 1rem;">Initiative diaspora pour l'agriculture durable</h3>
            <p style="font-size: 0.85rem; margin-bottom: 4px;"><strong>Date limite :</strong> 15 juin 2026 &nbsp;|&nbsp; <strong>Financement :</strong> jusqu'à 10 000 000 FCFA</p>
            <p style="font-size: 0.82rem;">Transformation des produits locaux, agriculture biologique et circuits courts de distribution.</p>
          </div>

          <h2>Transfert de compétences et mentorat</h2>
          <p>Au-delà de l'investissement financier, la DGIE valorise le <strong>transfert de compétences</strong> comme levier essentiel du développement. Le programme de mentorat met en relation des experts de la diaspora avec des porteurs de projets en Côte d'Ivoire.</p>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin: 16px 0 24px;">
            <div style="background: #fff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; text-align: center;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(232,119,42,0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="1.8"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg>
              </div>
              <div style="font-weight: 700; font-size: 0.85rem; color: var(--text-primary); margin-bottom: 4px;">Mentorat à distance</div>
              <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">Visioconférences, suivi personnalisé, partage de ressources</p>
            </div>
            <div style="background: #fff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; text-align: center;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(29,140,79,0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div style="font-weight: 700; font-size: 0.85rem; color: var(--text-primary); margin-bottom: 4px;">Missions sur le terrain</div>
              <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">Formations, audits, conseils stratégiques en Côte d'Ivoire</p>
            </div>
            <div style="background: #fff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; text-align: center;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(59,130,246,0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              </div>
              <div style="font-weight: 700; font-size: 0.85rem; color: var(--text-primary); margin-bottom: 4px;">Conférences et ateliers</div>
              <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">Échanges avec les acteurs économiques locaux</p>
            </div>
            <div style="background: #fff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; text-align: center;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: rgba(134,25,50,0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--bordeaux)" stroke-width="1.8"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
              </div>
              <div style="font-weight: 700; font-size: 0.85rem; color: var(--text-primary); margin-bottom: 4px;">Parrainage de talents</div>
              <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">Accompagnement de jeunes diplômés ivoiriens</p>
            </div>
          </div>

          @forelse($testimonials as $testimonial)
          <div class="testimonial">
            <p class="testimonial__quote">{{ $testimonial->quote }}</p>
            <p class="testimonial__author">{{ $testimonial->name }}, {{ $testimonial->context }}</p>
          </div>
          @empty
          <div class="testimonial">
            <p class="testimonial__quote">« Après quinze ans de pratique médicale à Montréal, j'ai souhaité mettre mon expérience au service de mon pays d'origine. Grâce à la DGIE, j'ai été mis en relation avec un hôpital régional. »</p>
            <p class="testimonial__author">Dr. Touré, médecin à Montréal</p>
          </div>
          @endforelse

          <h2>Questions fréquentes</h2>
          <div class="faq">
            @forelse($faqs as $faq)
            <div class="faq__item">
              <button class="faq__question">{{ $faq->question }}</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">{!! nl2br(e($faq->answer)) !!}</div>
              </div>
            </div>
            @empty
            <div class="faq__item">
              <button class="faq__question">Comment investir en Côte d'Ivoire depuis l'étranger ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">La DGIE vous oriente vers les structures compétentes. Contactez nos services via la page Contact.</div>
              </div>
            </div>
            @endforelse
          </div>

        </div>

        <!-- SIDEBAR -->
        <aside class="content__sidebar">

          <div class="sidebar-widget">
            <div class="sidebar-widget__title">Liens utiles</div>
            <div class="sidebar-widget__list">
              <a href="{{ route('nos-services') }}#retour">Nos services</a>
              <a href="{{ route('actualites') }}">Actualités</a>
              <a href="{{ route('contact') }}">Contact et Assistance</a>
            </div>
          </div>

          <div class="sidebar-widget">
            <div class="sidebar-widget__title">Inscrivez-vous</div>
            <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 16px;">Rejoignez le répertoire des compétences de la diaspora ivoirienne. Faites connaître votre expertise et participez au développement de la Côte d'Ivoire en vous inscrivant auprès de la DMCRIE.</p>
            <a href="{{ route('contact') }}" class="btn btn--green" style="width: 100%; text-align: center;">S'inscrire au répertoire</a>
          </div>

        </aside>

      </div>
    </div>
  </section>
@endsection
