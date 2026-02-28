@extends('front-end.layouts.app')

@section('title', 'Accompagnement social des migrants — DGIE')

@section('meta')
  <meta name="description" content="La Direction de l'Action Sociale (DAS) accompagne les Ivoiriens vulnérables : aide d'urgence, soutien psychosocial, logement temporaire et médiation administrative.">
  <meta property="og:title" content="Accompagnement social des migrants — DGIE">
  <meta property="og:description" content="Le dispositif d'accompagnement social de la DGIE au service des Ivoiriens en difficulté.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/dossier-accompagnement-social.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Accompagnement social des migrants — DGIE">
  <meta name="twitter:description" content="Le dispositif d'accompagnement social de la DGIE au service des Ivoiriens en difficulté.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ url('/dossiers/accompagnement-social') }}">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero" id="main-content">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <a href="{{ route('dossiers') }}">Dossiers</a>
        <span class="breadcrumb__sep">/</span>
        <span>Accompagnement social des migrants</span>
      </div>
      <h1 class="page-hero__title">Accompagnement social des migrants</h1>
      <p class="page-hero__subtitle">La Direction de l'Action Sociale (DAS) deploie un dispositif complet au service des Ivoiriens en difficulté.</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- 1. Les missions de la DAS -->
          <h2>Les missions de la Direction de l'Action Sociale</h2>
          <p>La Direction de l'Action Sociale (DAS) est l'une des trois sous-directions de la DGIE. Elle a pour mission principale d'assurer la prise en charge sociale des Ivoiriens en situation de vulnérabilité, qu'ils soient encore à l'étranger ou de retour en Côte d'Ivoire. Son action s'inscrit dans une logique de protection, d'écoute et d'accompagnement personnalisé.</p>
          <p>La DAS intervient en coordination avec les autres services de la DGIE et avec un réseau de partenaires institutionnels et associatifs. Ses missions couvrent l'ensemble des besoins sociaux identifiés chez les migrants de retour et les personnes en transit.</p>
          <ul>
            <li>Accueil et écoute des personnes en situation de détresse ou de vulnérabilité.</li>
            <li>Évaluation des besoins sociaux individuels et familiaux.</li>
            <li>Orientation vers les dispositifs d'aide existants (santé, logement, emploi).</li>
            <li>Coordination avec les partenaires sociaux (ONG, associations, services publics).</li>
            <li>Suivi des situations individuelles jusqu'à la stabilisation de la personne accompagnée.</li>
          </ul>

          <!-- 2. Aide d'urgence et soutien psychosocial -->
          <h2>Aide d'urgence et soutien psychosocial</h2>
          <p>De nombreux Ivoiriens de retour ont traversé des parcours migratoires éprouvants. Certains ont été victimes de violences, d'exploitation ou ont vécu dans des conditions de grande précarité. La DAS propose un accompagnement adapté à ces situations.</p>

          <h3>Aide d'urgence</h3>
          <p>Dès l'arrivée, les personnes identifiées comme étant en situation d'urgence bénéficient d'une prise en charge immédiate. Cette aide peut prendre plusieurs formes : hébergement temporaire, kit de première nécessité, alimentation et orientation vers les structures de soins. L'objectif est de répondre aux besoins les plus pressants dans les premières heures et les premiers jours suivant le retour.</p>

          <h3>Soutien psychosocial</h3>
          <p>La DAS dispose d'un service d'écoute et d'accompagnement psychologique. Des conseillers formés reçoivent les personnes en entretien individuel pour les aider à verbaliser leur expérience, à identifier leurs ressources personnelles et à reconstruire un projet de vie. Des séances de groupe peuvent également être organisées pour favoriser l'échange et le soutien mutuel entre personnes ayant vécu des parcours similaires.</p>
          <p>Ce soutien est proposé sans condition de durée. Les conseillers adaptent la fréquence et la nature des entretiens en fonction de l'évolution de chaque situation.</p>

          <!-- 3. Accompagnement des personnes vulnérables -->
          <h2>Accompagnement des personnes vulnérables</h2>
          <p>La DAS porte une attention particulière aux publics les plus fragiles. Des dispositifs spécifiques sont mis en place pour répondre à leurs besoins.</p>

          <h3>Femmes en situation de vulnérabilité</h3>
          <p>Les femmes migrantes de retour font souvent face à des difficultés spécifiques : violences subies durant le parcours migratoire, isolement familial, charge de mineurs. La DAS leur propose un accompagnement renforcé comprenant un suivi psychologique adapté, une orientation vers les associations spécialisées dans la protection des droits des femmes et un appui à l'autonomisation économique.</p>

          <h3>Mineurs non accompagnés</h3>
          <p>Les mineurs non accompagnés constituent un public prioritaire de la DAS. Leur prise en charge fait l'objet d'un protocole spécifique en lien avec les autorités de protection de l'enfance. Ce protocole prévoit l'identification et l'enregistrement du mineur, la recherche de la famille, le placement temporaire en structure d'accueil adaptée, la scolarisation ou la formation professionnelle et un suivi social jusqu'à la majorité ou la réunification familiale.</p>

          <h3>Personnes en situation de handicap ou de maladie</h3>
          <p>Les personnes de retour présentant un handicap ou une pathologie nécessitant un suivi médical sont orientées vers les structures de santé compétentes. La DAS facilite les démarches d'accès aux soins et assure la coordination entre les services sociaux et les services de santé.</p>

          <!-- 4. Accès au logement temporaire -->
          <h2>Accès au logement temporaire</h2>
          <p>Le logement constitue souvent la première urgence à l'arrivée. La DAS a développé un réseau de solutions d'hébergement temporaire en partenariat avec des structures d'accueil à Abidjan et dans les principales villes du pays.</p>
          <ul>
            <li>Hébergement d'urgence pour les personnes arrivant sans solution de logement.</li>
            <li>Accueil en centre de transit pour une durée limitée, le temps de trouver une solution pérenne.</li>
            <li>Orientation vers des dispositifs de logement social ou d'aide au loyer.</li>
            <li>Accompagnement dans les démarches de recherche de logement autonome.</li>
          </ul>
          <p>La durée de l'hébergement temporaire est adaptée à chaque situation. L'objectif est de permettre à la personne de se stabiliser tout en travaillant à une solution durable.</p>

          <!-- 5. Médiation administrative -->
          <h2>Médiation administrative</h2>
          <p>Les démarches administratives peuvent représenter un obstacle majeur pour les personnes de retour, en particulier celles qui ont été longtemps absentes du territoire national. La DAS joue un rôle de facilitateur auprès des administrations publiques.</p>
          <ul>
            <li>Aide à la reconstitution des documents d'identité (carte nationale d'identité, actes d'état civil).</li>
            <li>Accompagnement dans les démarches auprès de la Caisse Nationale de Prévoyance Sociale (CNPS).</li>
            <li>Orientation vers les services compétents pour les questions de scolarisation des enfants.</li>
            <li>Facilitation de l'accès aux services de santé publique (couverture maladie universelle).</li>
            <li>Appui aux démarches de reconnaissance des diplômes et certifications obtenus à l'étranger.</li>
          </ul>
          <p>Les agents de la DAS accompagnent physiquement les personnes dans leurs démarches lorsque la situation le nécessite. Cette médiation vise à lever les obstacles administratifs qui pourraient freiner la réinsertion.</p>

          <!-- 6. Partenaires sociaux -->
          <h2>Partenaires sociaux</h2>
          <p>L'efficacité de l'accompagnement social repose sur un réseau solide de partenaires. La DAS travaille en étroite collaboration avec de nombreux acteurs institutionnels et associatifs.</p>

          <h3>Partenaires institutionnels</h3>
          <ul>
            <li>Ministère de la Solidarité et de la Lutte contre la Pauvreté.</li>
            <li>Ministère de la Femme, de la Famille et de l'Enfant.</li>
            <li>Direction de la Protection de l'Enfant.</li>
            <li>Centres sociaux et structures de santé publique.</li>
          </ul>

          <h3>Organisations internationales</h3>
          <ul>
            <li>Organisation Internationale pour les Migrations (OIM).</li>
            <li>Haut-Commissariat des Nations Unies pour les réfugiés (HCR).</li>
            <li>UNICEF, pour la protection des mineurs non accompagnés.</li>
            <li>Croix-Rouge de Côte d'Ivoire.</li>
          </ul>

          <h3>Associations et ONG</h3>
          <p>La DAS collabore avec un ensemble d'associations locales spécialisées dans l'aide aux migrants, la protection des femmes, l'insertion professionnelle et l'accompagnement psychologique. Ces partenariats permettent d'élargir l'offre de services et de garantir une prise en charge de proximité sur l'ensemble du territoire.</p>

          <!-- Info box -->
          <div class="info-box">
            <p>Si vous êtes en situation de détresse ou si vous connaissez une personne ayant besoin d'assistance, contactez la DGIE. L'ensemble des services de la DAS sont gratuits et confidentiels.</p>
          </div>

          <!-- Questions fréquentes -->
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
              <button class="faq__question">Qui peut bénéficier de l'accompagnement social de la DAS ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Tout ressortissant ivoirien de retour ou en transit, ainsi que les membres de sa famille, peuvent bénéficier des services de la DAS.</div>
              </div>
            </div>
            <div class="faq__item">
              <button class="faq__question">Le soutien psychologique est-il confidentiel ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Oui. Tous les entretiens avec les conseillers de la DAS sont strictement confidentiels.</div>
              </div>
            </div>
            @endforelse
          </div>

        </div>

        <!-- Sidebar -->
        <aside class="content__sidebar">
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Dossiers liés</h3>
            <div class="sidebar-widget__list">
              <a href="{{ route('dossier.show', 'partenariats') }}">Partenariats internationaux</a>
              <a href="{{ route('dossier.show', 'cadre-juridique') }}">Cadre juridique</a>
              <a href="{{ route('nos-services') }}#retour">Nos services</a>
              <a href="{{ route('dossiers') }}">Tous les dossiers</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Besoin d'aide ?</h3>
            <p>Vous êtes en difficulté ou vous connaissez une personne ayant besoin d'accompagnement ? Nos équipes sont disponibles pour vous écouter et vous orienter.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">Contactez-nous</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
