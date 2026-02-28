@extends('front-end.layouts.app')

@section('title', 'Retour et Réintégration — Accompagnement DGIE')

@section('meta')
  <meta name="description" content="Vous rentrez en Côte d'Ivoire ? La DGIE vous accueille, vous oriente et vous aide dans votre réinsertion socio-économique.">
  <meta property="og:title" content="Retour et Réintégration — DGIE">
  <meta property="og:description" content="La DGIE vous accueille, vous oriente et vous aide dans votre réinsertion socio-économique.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/retour-reintegration.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Retour et Réintégration — DGIE">
  <meta name="twitter:description" content="La DGIE vous accueille, vous oriente et vous aide dans votre réinsertion socio-économique.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ route('retour-reintegration') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Retour et Réintégration</span>
      </div>
      <h1 class="page-hero__title">Retour et Réintégration</h1>
      <p class="page-hero__subtitle">La DGIE vous accompagne dans votre retour et votre réinsertion en Côte d'Ivoire.</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- 1. Le parcours d'accueil -->
          <h2>Le parcours d'accueil</h2>
          <p>La Direction de l'Accueil, de l'Orientation, du Suivi et de l'Aide à la Réinsertion (DAOSAR) met en place un dispositif structuré pour accueillir chaque Ivoirien de retour. Ce parcours vise à identifier vos besoins, définir un plan d'accompagnement adapté et vous orienter vers les ressources disponibles pour faciliter votre réinstallation.</p>

          <div class="steps">
            <div class="step">
              <div class="step__number">1</div>
              <div class="step__content">
                <h3>Prise de contact</h3>
                <p>Dès votre arrivée ou en amont de votre retour, prenez contact avec la DGIE. Un agent vous accueille, recueille vos informations et ouvre votre dossier d'accompagnement.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">2</div>
              <div class="step__content">
                <h3>Entretien individuel</h3>
                <p>Un conseiller vous reçoit en entretien confidentiel pour évaluer votre situation personnelle, professionnelle et sociale. Cet échange permet d'identifier vos compétences, vos besoins et vos attentes.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">3</div>
              <div class="step__content">
                <h3>Orientation</h3>
                <p>Sur la base de l'entretien, vous êtes orienté vers les programmes et les partenaires les mieux adaptés à votre profil : formation, appui à la création d'activité, insertion professionnelle ou accompagnement social.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">4</div>
              <div class="step__content">
                <h3>Suivi personnalisé</h3>
                <p>Un référent vous est attribué pour assurer le suivi de votre parcours de réinsertion. Des points réguliers sont organisés afin d'ajuster l'accompagnement selon l'évolution de votre situation.</p>
              </div>
            </div>
          </div>

          <!-- 2. Programmes de réinsertion -->
          <h2>Programmes de réinsertion</h2>
          <p>La DGIE propose plusieurs dispositifs concrets pour soutenir la réinsertion socio-économique des Ivoiriens de retour. Ces programmes sont accessibles gratuitement et adaptés à chaque profil.</p>

          <h3>Formation professionnelle</h3>
          <p>Des sessions de formation sont organisées en partenariat avec des centres agréés, couvrant de nombreux secteurs d'activité : agriculture, artisanat, commerce, numérique, bâtiment, restauration et bien d'autres. Ces formations visent à renforcer vos compétences ou à vous en faire acquérir de nouvelles pour faciliter votre insertion sur le marché du travail ivoirien.</p>

          <h3>Appui à la création d'activité</h3>
          <p>Si vous souhaitez entreprendre, la DGIE vous accompagne dans l'élaboration de votre projet. Cet appui comprend l'aide à la rédaction du plan d'affaires, l'orientation vers des dispositifs de financement, la mise en relation avec des structures d'accompagnement à l'entrepreneuriat et un suivi post-création pour consolider votre activité.</p>

          <h3>Insertion professionnelle</h3>
          <p>Pour ceux qui recherchent un emploi salarié, la DGIE facilite la mise en relation avec des employeurs et des agences de placement. Des ateliers de préparation à l'emploi (rédaction de CV, techniques d'entretien, connaissance du marché local) sont également proposés pour maximiser vos chances d'insertion.</p>

          <!-- 3. Accompagnement social (DAS) -->
          <h2>Accompagnement social (DAS)</h2>
          <p>La Direction de l'Action Sociale (DAS) intervient en complément des programmes de réinsertion économique pour répondre aux besoins sociaux des personnes de retour. Son action couvre plusieurs domaines essentiels :</p>
          <ul>
            <li>Aide psychosociale et écoute pour les personnes ayant vécu des parcours migratoires difficiles.</li>
            <li>Orientation vers les structures de santé et d'aide sociale existantes.</li>
            <li>Appui à l'accès au logement temporaire en cas de besoin urgent.</li>
            <li>Accompagnement des familles et des mineurs non accompagnés de retour.</li>
            <li>Médiation et facilitation des démarches administratives auprès des services publics.</li>
          </ul>
          <p>L'objectif de la DAS est de garantir que chaque personne de retour bénéficie d'un accompagnement global, prenant en compte aussi bien les dimensions économiques que sociales de la réinsertion.</p>

          <!-- 4. Info box -->
          <div class="info-box">
            <p>Pour les démarches consulaires (visa, passeport, état civil), veuillez vous rapprocher du poste consulaire compétent.</p>
          </div>

          <!-- 5. Témoignage -->
          @forelse($testimonials as $testimonial)
          <div class="testimonial">
            <p class="testimonial__quote">{{ $testimonial->quote }}</p>
            <p class="testimonial__author">{{ $testimonial->name }}, {{ $testimonial->context }}</p>
          </div>
          @empty
          <div class="testimonial">
            <p class="testimonial__quote">« Quand je suis rentré, je ne savais pas par où commencer. La DGIE m'a orienté vers une formation en maintenance informatique. Aujourd'hui, j'ai mon propre atelier de réparation à Yopougon. »</p>
            <p class="testimonial__author">Konan, 28 ans, de retour depuis 6 mois</p>
          </div>
          @endforelse

          <!-- 6. Questions fréquentes -->
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
              <button class="faq__question">Qui peut bénéficier de l'accompagnement au retour ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Tout ressortissant ivoirien ayant vécu à l'étranger peut bénéficier de l'accompagnement gratuit de la DGIE.</div>
              </div>
            </div>
            @endforelse
          </div>

        </div>

        <!-- Sidebar -->
        <aside class="content__sidebar">
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Liens utiles</h3>
            <div class="sidebar-widget__list">
              <a href="{{ route('nos-services') }}#investir">Nos services</a>
              <a href="{{ route('actualites') }}">Actualités</a>
              <a href="{{ route('contact') }}">Contact & Assistance</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Besoin d'aide ?</h3>
            <p>Vous avez des questions sur votre retour ou votre réinsertion ? Nos équipes sont disponibles pour vous orienter et répondre à vos préoccupations.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">Contactez-nous</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
