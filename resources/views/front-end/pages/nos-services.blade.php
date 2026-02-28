@extends('front-end.layouts.app')

@section('title', 'Nos services — Retour, investissement et accompagnement | DGIE')

@section('meta')
  <meta name="description" content="La DGIE vous accompagne : retour et réinsertion en Côte d'Ivoire, investissement diaspora, mobilisation des compétences et accompagnement social.">
  <meta property="og:title" content="Nos services — DGIE">
  <meta property="og:description" content="Retour et réinsertion, investissement diaspora, mobilisation des compétences : tous les services de la DGIE.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/nos-services.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Nos services — DGIE">
  <meta name="twitter:description" content="Retour et réinsertion, investissement diaspora, mobilisation des compétences : tous les services de la DGIE.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ route('nos-services') }}">
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "FAQPage",
    "mainEntity": [
      {
        "@@type": "Question",
        "name": "Comment bénéficier d'un accompagnement au retour ?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "Contactez la DGIE ou ses partenaires (OIM, OFII) avant votre retour pour bénéficier d'un accompagnement personnalisé."
        }
      },
      {
        "@@type": "Question",
        "name": "Comment investir en Côte d'Ivoire depuis l'étranger ?",
        "acceptedAnswer": {
          "@@type": "Answer",
          "text": "La DMCRIE propose un accompagnement personnalisé pour les projets d'investissement de la diaspora dans les secteurs porteurs."
        }
      }
    ]
  }
  </script>
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Nos services</span>
      </div>
      <h1 class="page-hero__title">Nos services</h1>
      <p class="page-hero__subtitle">La DGIE vous accompagne dans votre retour, votre réinsertion, vos projets d'investissement et la mobilisation de vos compétences.</p>
    </div>
  </section>

  <!-- SOUS-NAVIGATION -->
  <nav class="page-subnav">
    <div class="container">
      <a href="#retour" class="page-subnav__link page-subnav__link--active">Retour et Réintégration</a>
      <a href="#investir" class="page-subnav__link">Investir et Contribuer</a>
      <a href="#action-sociale" class="page-subnav__link">Aides sociales</a>
      <a href="#faq" class="page-subnav__link">Questions fréquentes</a>
    </div>
  </nav>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- ===========================
               VOLET 1 : RETOUR ET RÉINTÉGRATION
               =========================== -->
          <section id="retour">
            <h2>Retour et Réintégration</h2>
            <p>La Direction de l'Accueil, de l'Orientation, du Suivi et de l'Aide à la Réinsertion (DAOSAR) met en place un dispositif structuré pour accueillir chaque Ivoirien de retour. Ce parcours vise à identifier vos besoins, définir un plan d'accompagnement adapté et vous orienter vers les ressources disponibles pour faciliter votre réinstallation.</p>

            <!-- Le parcours d'accueil -->
            <h3>Le parcours d'accueil</h3>
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

            <!-- Programmes de réinsertion -->
            <h3>Programmes de réinsertion</h3>
            <p>La DGIE propose plusieurs dispositifs concrets pour soutenir la réinsertion socio-économique des Ivoiriens de retour. Ces programmes sont accessibles gratuitement et adaptés à chaque profil.</p>

            <h4>Formation professionnelle</h4>
            <p>Des sessions de formation sont organisées en partenariat avec des centres agréés, couvrant de nombreux secteurs d'activité : agriculture, artisanat, commerce, numérique, bâtiment, restauration et bien d'autres.</p>

            <h4>Appui à la création d'activité</h4>
            <p>Si vous souhaitez entreprendre, la DGIE vous accompagne dans l'élaboration de votre projet : plan d'affaires, orientation vers les dispositifs de financement, mise en relation avec des structures d'accompagnement et suivi post-création.</p>

            <h4>Insertion professionnelle</h4>
            <p>Pour ceux qui recherchent un emploi salarié, la DGIE facilite la mise en relation avec des employeurs et des agences de placement. Des ateliers de préparation à l'emploi sont également proposés.</p>

            <!-- Accompagnement social -->
            <h3>Accompagnement social (DAS)</h3>
            <p>La Direction de l'Action Sociale (DAS) répond aux besoins sociaux des personnes de retour :</p>
            <ul>
              <li>Aide psychosociale et écoute pour les personnes ayant vécu des parcours migratoires difficiles</li>
              <li>Orientation vers les structures de santé et d'aide sociale existantes</li>
              <li>Appui à l'accès au logement temporaire en cas de besoin urgent</li>
              <li>Accompagnement des familles et des mineurs non accompagnés de retour</li>
              <li>Médiation et facilitation des démarches administratives auprès des services publics</li>
            </ul>

            @if(isset($testimonials) && $testimonials->where('page_slug', 'retour-reintegration')->first())
            @php $t = $testimonials->where('page_slug', 'retour-reintegration')->first() ?? $testimonials->first(); @endphp
            <div class="testimonial">
              <p class="testimonial__quote">{{ $t->quote }}</p>
              <p class="testimonial__author">{{ $t->name }}, {{ $t->context }}</p>
            </div>
            @else
            <div class="testimonial">
              <p class="testimonial__quote">« Quand je suis rentré, je ne savais pas par où commencer. La DGIE m'a orienté vers une formation en maintenance informatique. Aujourd'hui, j'ai mon propre atelier de réparation à Yopougon. »</p>
              <p class="testimonial__author">Konan, 28 ans, de retour depuis 6 mois</p>
            </div>
            @endif

            <div class="info-box">
              <p>Pour les démarches consulaires (visa, passeport, état civil), veuillez vous rapprocher du poste consulaire compétent.</p>
            </div>
          </section>

          <!-- ===========================
               VOLET 2 : INVESTIR ET CONTRIBUER
               =========================== -->
          <section id="investir" style="padding-top: 24px;">
            <h2>Investir et Contribuer</h2>

            <!-- Mobilisation des compétences -->
            <h3>Mobilisation des compétences</h3>
            <p>La Direction de la Mobilisation des Compétences et des Ressources des Ivoiriens de l'Extérieur (DMCRIE) recense, organise et valorise les savoir-faire de la diaspora au bénéfice du développement national.</p>
            <ul>
              <li>Recensement des profils qualifiés au sein de la diaspora</li>
              <li>Mise en relation avec les institutions publiques et les entreprises ivoiriennes</li>
              <li>Organisation de missions d'expertise et de transfert de savoirs</li>
              <li>Accompagnement dans les démarches administratives liées aux missions en Côte d'Ivoire</li>
            </ul>

            <!-- Investissement diaspora -->
            <h3>Investissement diaspora</h3>
            <p>La DGIE encourage et accompagne les Ivoiriens de l'extérieur qui souhaitent investir en Côte d'Ivoire. La Direction vous oriente vers les structures compétentes et vous aide à sécuriser votre parcours d'investissement.</p>
            <ul>
              <li>Information sur le cadre juridique et fiscal ivoirien</li>
              <li>Orientation vers les guichets uniques de création d'entreprise</li>
              <li>Aide à la constitution des dossiers de financement</li>
              <li>Suivi post-création pour les entreprises nouvellement établies</li>
            </ul>

            <h4>Secteurs porteurs</h4>
            <ul>
              <li><strong>Agriculture et agro-industrie :</strong> transformation du cacao, de la noix de cajou, de l'hévéa et des produits vivriers</li>
              <li><strong>Numérique et technologies :</strong> développement de solutions digitales, fintech, e-commerce</li>
              <li><strong>Immobilier et construction :</strong> logements sociaux, infrastructures commerciales et touristiques</li>
              <li><strong>Santé :</strong> cliniques privées, télémédecine, équipements médicaux</li>
              <li><strong>Éducation et formation professionnelle :</strong> établissements privés, centres de formation, plateformes d'apprentissage</li>
            </ul>

            <!-- Appels à projets -->
            <h3>Appels à projets en cours</h3>

            <div style="background: var(--white); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; margin-bottom: 16px;">
              <span style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--green);">Appel à projets</span>
              <h4 style="margin-top: 8px;">Programme d'appui à l'entrepreneuriat de la diaspora — Édition 2026</h4>
              <p style="font-size: 0.9rem;"><strong>Date limite de candidature :</strong> 30 avril 2026</p>
              <p style="font-size: 0.9rem;">Ce programme s'adresse aux Ivoiriens de l'extérieur porteurs d'un projet de création ou de développement d'entreprise en Côte d'Ivoire. Financement d'amorçage pouvant atteindre 5 000 000 FCFA et accès au réseau de mentors de la DGIE.</p>
            </div>

            <div style="background: var(--white); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; margin-bottom: 16px;">
              <span style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--green);">Appel à projets</span>
              <h4 style="margin-top: 8px;">Initiative diaspora pour l'agriculture durable</h4>
              <p style="font-size: 0.9rem;"><strong>Date limite de candidature :</strong> 15 juin 2026</p>
              <p style="font-size: 0.9rem;">Mobiliser les compétences et les capitaux de la diaspora pour le développement de projets agricoles durables. Financement allant jusqu'à 10 000 000 FCFA pour les projets sélectionnés.</p>
            </div>

            <!-- Mentorat -->
            <h3>Transfert de compétences et mentorat</h3>
            <p>Des programmes de mentorat permettent aux professionnels de la diaspora de partager leur expérience avec les jeunes entrepreneurs et les cadres ivoiriens :</p>
            <ul>
              <li><strong>Mentorat à distance :</strong> sessions par visioconférence, suivi personnalisé et partage de ressources</li>
              <li><strong>Missions d'expertise :</strong> interventions ponctuelles en Côte d'Ivoire pour formations ou conseils stratégiques</li>
              <li><strong>Conférences et ateliers :</strong> événements pour échanger avec les acteurs économiques locaux</li>
              <li><strong>Parrainage de jeunes talents :</strong> accompagnement de jeunes diplômés dans leur insertion professionnelle</li>
            </ul>

            <div class="info-box info-box--green">
              <p><strong>La diaspora ivoirienne, un atout pour la nation.</strong> Chaque compétence partagée, chaque investissement réalisé contribue au développement économique et social de la Côte d'Ivoire.</p>
            </div>

            @if(isset($testimonials) && $testimonials->where('page_slug', 'investir-contribuer')->first())
            @php $t2 = $testimonials->where('page_slug', 'investir-contribuer')->first(); @endphp
            <div class="testimonial">
              <p class="testimonial__quote">{{ $t2->quote }}</p>
              <p class="testimonial__author">{{ $t2->name }}, {{ $t2->context }}</p>
            </div>
            @else
            <div class="testimonial">
              <p class="testimonial__quote">« Après quinze ans de pratique médicale à Montréal, j'ai souhaité mettre mon expérience au service de mon pays. Grâce à la DGIE, j'ai été mis en relation avec un hôpital régional pour une mission de formation en chirurgie laparoscopique. »</p>
              <p class="testimonial__author">Dr. Touré, médecin à Montréal</p>
            </div>
            @endif
          </section>

          <!-- ===========================
               VOLET 3 : AIDES SOCIALES
               =========================== -->
          <section id="action-sociale" style="padding-top: 24px;">
            <h2>Aides sociales</h2>
            <p>La Direction de l'Action Sociale (DAS) assure la prise en charge sociale des Ivoiriens de l'extérieur en situation de vulnérabilité. Elle intervient sur le territoire national comme à l'étranger, en coordination avec les postes consulaires.</p>

            <h3>Aide d'urgence à l'étranger</h3>
            <p>La DAS intervient en faveur des Ivoiriens confrontés à des situations de détresse dans leur pays de résidence :</p>
            <ul>
              <li>Prise en charge des frais médicaux d'urgence et rapatriement sanitaire</li>
              <li>Hébergement temporaire en cas de perte de logement</li>
              <li>Aide alimentaire et vestimentaire</li>
              <li>Accompagnement juridique en cas de litiges ou d'incarcération</li>
              <li>Assistance aux victimes de traite des personnes et de trafic de migrants</li>
            </ul>

            <h3>Accompagnement des personnes de retour</h3>
            <p>Pour les Ivoiriens de retour au pays, la DAS propose un accompagnement social global :</p>
            <ul>
              <li>Aide psychosociale et écoute pour les personnes ayant vécu des parcours migratoires difficiles</li>
              <li>Orientation vers les structures de santé et les centres d'hébergement</li>
              <li>Accompagnement des familles et des mineurs non accompagnés</li>
              <li>Médiation et facilitation des démarches administratives</li>
            </ul>

            <h3>Soutien scolaire et éducatif</h3>
            <p>La DAS, en partenariat avec le Ministère de l'Éducation Nationale, accompagne les enfants de la diaspora de retour en Côte d'Ivoire :</p>
            <ul>
              <li>Aide à l'inscription dans les établissements publics</li>
              <li>Cours de mise à niveau et soutien scolaire</li>
              <li>Accompagnement psychologique pour faciliter l'adaptation</li>
              <li>Bourses d'études pour les familles en situation de précarité</li>
            </ul>

            <h3>Comment bénéficier de l'aide sociale ?</h3>
            <div class="steps">
              <div class="step">
                <div class="step__number">1</div>
                <div class="step__content">
                  <h3>Signalement</h3>
                  <p>Contactez le consulat de Côte d'Ivoire le plus proche ou la DGIE directement pour signaler votre situation.</p>
                </div>
              </div>
              <div class="step">
                <div class="step__number">2</div>
                <div class="step__content">
                  <h3>Évaluation</h3>
                  <p>Un travailleur social évalue votre situation et détermine le type d'aide adapté à vos besoins.</p>
                </div>
              </div>
              <div class="step">
                <div class="step__number">3</div>
                <div class="step__content">
                  <h3>Prise en charge</h3>
                  <p>L'aide est déployée selon les modalités définies : intervention directe, orientation vers un partenaire ou allocation de secours.</p>
                </div>
              </div>
            </div>

            <div class="info-box info-box--green">
              <p><strong>Numéro d'urgence :</strong> Pour toute situation d'urgence à l'étranger, contactez le consulat de Côte d'Ivoire le plus proche ou appelez la DGIE au +225 27 20 25 16 00.</p>
            </div>
          </section>

          <!-- ===========================
               FAQ COMBINÉE
               =========================== -->
          <section id="faq" style="padding-top: 24px;">
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
                  <div class="faq__answer-inner">Tout ressortissant ivoirien ayant vécu à l'étranger et souhaitant se réinstaller en Côte d'Ivoire peut bénéficier de l'accompagnement de la DGIE.</div>
                </div>
              </div>
              <div class="faq__item">
                <button class="faq__question">L'accompagnement est-il payant ?</button>
                <div class="faq__answer">
                  <div class="faq__answer-inner">Non. L'ensemble des services proposés par la DGIE sont entièrement gratuits.</div>
                </div>
              </div>
              @endforelse
            </div>
          </section>

        </div>

        <!-- Sidebar -->
        <aside class="content__sidebar">
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Nos directions</h3>
            <div class="sidebar-widget__list">
              <a href="#retour">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                DAOSAR — Retour et réinsertion
              </a>
              <a href="#investir">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                DMCRIE — Compétences et investissement
              </a>
              <a href="{{ route('la-dgie') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                DAS — Action sociale
              </a>
            </div>
          </div>

          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Inscrivez-vous</h3>
            <p style="font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 16px;">Rejoignez le répertoire des compétences de la diaspora ivoirienne et participez au développement de la Côte d'Ivoire.</p>
            <a href="{{ route('contact') }}" class="btn btn--green" style="width: 100%; text-align: center;">S'inscrire au répertoire</a>
          </div>

          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Liens utiles</h3>
            <div class="sidebar-widget__list">
              <a href="{{ route('coin-des-diaspos') }}">Le Coin des Diasporas</a>
              <a href="{{ route('actualites') }}">Actualités</a>
              <a href="{{ route('dossiers') }}">Dossiers thématiques</a>
              <a href="{{ route('contact') }}">Contact & Assistance</a>
            </div>
          </div>

          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Besoin d'aide ?</h3>
            <p>Vous avez des questions sur votre retour, votre réinsertion ou vos projets d'investissement ? Nos équipes sont à votre écoute.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">Contactez-nous</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
