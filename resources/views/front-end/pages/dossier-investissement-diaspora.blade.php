@extends('front-end.layouts.app')

@section('title', 'Investissement diaspora en Côte d\'Ivoire — Dossier DGIE')

@section('meta')
  <meta name="description" content="Guichet unique, fonds d'investissement, secteurs porteurs et incitations fiscales : tout savoir pour investir en Côte d'Ivoire depuis la diaspora.">
  <meta property="og:title" content="Investissement diaspora en Côte d'Ivoire — DGIE">
  <meta property="og:description" content="Découvrez les mécanismes mis en place pour faciliter l'investissement de la diaspora ivoirienne dans les secteurs porteurs.">
  <meta property="og:type" content="article">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/dossier-investissement-diaspora.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Investissement diaspora en Côte d'Ivoire — DGIE">
  <meta name="twitter:description" content="Découvrez les mécanismes mis en place pour faciliter l'investissement de la diaspora ivoirienne dans les secteurs porteurs.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ url('/dossiers/investissement-diaspora') }}">
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
        <span>Investissement diaspora en Côte d'Ivoire</span>
      </div>
      <h1 class="page-hero__title">Investissement diaspora en Côte d'Ivoire</h1>
      <p class="page-hero__subtitle">Les mécanismes et les opportunités pour investir dans les secteurs porteurs de l'économie ivoirienne</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- 1. Le guichet unique -->
          <h2>Le guichet unique pour la diaspora</h2>
          <p>La Direction de la Mobilisation des Compétences, des Ressources de l'Investissement de l'Extérieur (DMCRIE) a mis en place un guichet unique dédié aux investisseurs de la diaspora. Ce dispositif centralise l'ensemble des démarches nécessaires à la réalisation d'un projet d'investissement en Côte d'Ivoire, afin de simplifier le parcours de l'investisseur et de réduire les délais de traitement.</p>

          <h3>Services proposés par le guichet unique</h3>
          <ul>
            <li>Information et orientation sur les opportunités d'investissement et les secteurs porteurs.</li>
            <li>Accompagnement dans les démarches administratives : création d'entreprise, obtention de licences, formalités douanières.</li>
            <li>Mise en relation avec les institutions publiques compétentes : CEPICI, chambre de commerce, services fiscaux.</li>
            <li>Appui à la recherche de partenaires locaux et de terrains ou locaux professionnels.</li>
            <li>Suivi personnalisé du projet depuis la conception jusqu'à la mise en exploitation.</li>
            <li>Assistance juridique pour la rédaction de contrats et la protection de la propriété intellectuelle.</li>
          </ul>

          <h3>Fonctionnement</h3>
          <p>Le guichet unique est accessible en présentiel au siège de la DGIE à Abidjan et à distance via une plateforme numérique dédiée. Un conseiller référent est attribué à chaque porteur de projet pour assurer un accompagnement continu et personnalisé. Les délais de traitement des dossiers sont réduits grâce à des conventions de partenariat avec les administrations impliquées dans le processus de création d'entreprise.</p>

          <!-- 2. Le fonds d'investissement diaspora -->
          <h2>Le fonds d'investissement diaspora</h2>
          <p>Pour répondre aux besoins de financement des projets portés par la diaspora, l'État de Côte d'Ivoire a institué un fonds d'investissement spécifiquement dédié aux Ivoiriens de l'extérieur. Ce fonds vise à combler le déficit de financement qui constitue souvent le principal obstacle à la concrétisation des projets d'investissement.</p>

          <h3>Caractéristiques du fonds</h3>
          <ul>
            <li><strong>Dotation initiale de 10 milliards de FCFA</strong> alimentée par l'État et les partenaires au développement.</li>
            <li><strong>Prêts à taux bonifiés</strong> compris entre 3 % et 6 %, nettement inférieurs aux taux du marché bancaire.</li>
            <li><strong>Montants de financement</strong> compris entre 5 millions et 200 millions de FCFA selon la nature du projet.</li>
            <li><strong>Durée de remboursement</strong> allant de 3 à 7 ans, avec un différé de remboursement pouvant atteindre 18 mois.</li>
            <li><strong>Garantie partielle de l'État</strong> couvrant jusqu'à 50 % du montant emprunté, facilitant l'accès au crédit bancaire complémentaire.</li>
          </ul>

          <h3>Conditions d'éligibilité</h3>
          <p>Pour bénéficier du fonds d'investissement, le porteur de projet doit remplir les conditions suivantes :</p>
          <ul>
            <li>Etre de nationalité ivoirienne et résider ou avoir résidé à l'étranger.</li>
            <li>Présenter un plan d'affaires détaillé et viable, validé par le guichet unique.</li>
            <li>Disposer d'un apport personnel représentant au minimum 20 % du coût total du projet.</li>
            <li>S'engager à créer au moins trois emplois directs dans les deux premières années d'activité.</li>
            <li>Investir dans un secteur éligible identifié par le comité d'investissement du fonds.</li>
          </ul>

          <!-- 3. Les secteurs porteurs -->
          <h2>Les secteurs porteurs</h2>
          <p>La Côte d'Ivoire offre de nombreuses opportunités d'investissement dans des secteurs en pleine croissance. La DMCRIE a identifié quatre secteurs prioritaires qui présentent un potentiel de rentabilité élevé et un impact significatif sur le développement économique du pays.</p>

          <h3>Agriculture et agro-industrie</h3>
          <p>Premier secteur de l'économie ivoirienne, l'agriculture représente un potentiel d'investissement considérable. La transformation locale des matières premières agricoles (cacao, noix de cajou, hévéa, palmier à huile, fruits tropicaux) constitue une filière particulièrement prometteuse. Les besoins en infrastructures de stockage, de conditionnement et de transformation sont immenses. L'agriculture biologique et les cultures maraîchères connaissent également une forte demande liée à l'urbanisation croissante.</p>

          <h3>Immobilier et construction</h3>
          <p>Avec un déficit estimé à plus de 600 000 logements et une croissance démographique soutenue, le secteur immobilier offre des perspectives d'investissement durables. Les opportunités couvrent la promotion immobilière résidentielle, la construction de bureaux et de locaux commerciaux, l'immobilier touristique et les infrastructures logistiques. Le gouvernement a mis en place des incitations spécifiques pour encourager la construction de logements sociaux et économiques.</p>

          <h3>Numérique et technologies</h3>
          <p>L'économie numérique ivoirienne connaît une croissance annuelle supérieure à 15 %. Les opportunités d'investissement sont nombreuses : fintech et services financiers mobiles, e-commerce, solutions de gestion pour entreprises, services cloud, formation en ligne, applications de santé numérique. Le gouvernement soutient activement ce secteur à travers la politique nationale de transformation digitale et l'aménagement de zones technologiques dédiées.</p>

          <h3>Énergie et énergies renouvelables</h3>
          <p>La Côte d'Ivoire ambitionne de porter la part des énergies renouvelables dans son mix énergétique à 42 % d'ici 2030. Cette ambition crée des opportunités d'investissement dans la production d'énergie solaire, la biomasse, la mini-hydraulique et l'efficacité énergétique. La distribution d'énergie en zone rurale et les solutions d'électrification hors réseau constituent également des créneaux porteurs.</p>

          <!-- 4. Les incitations fiscales -->
          <h2>Les incitations fiscales</h2>
          <p>L'État de Côte d'Ivoire a mis en place un ensemble de mesures fiscales incitatives pour encourager l'investissement de la diaspora. Ces avantages s'ajoutent aux dispositifs généraux du Code des investissements et visent à réduire le coût de l'investissement initial et à améliorer la rentabilité des projets.</p>

          <h3>Avantages du Code des investissements</h3>
          <ul>
            <li><strong>Exonération de TVA</strong> sur les équipements et matériels importés dans le cadre de l'investissement pendant la phase d'installation.</li>
            <li><strong>Exonération d'impôt sur les bénéfices</strong> pendant les 5 premières années d'activité pour les entreprises agréées.</li>
            <li><strong>Réduction de 50 % des droits de douane</strong> sur les matières premières et les intrants nécessaires à la production.</li>
            <li><strong>Exonération de la patente</strong> pendant les 3 premières années d'activité.</li>
            <li><strong>Crédit d'impôt</strong> de 10 % sur les investissements réalisés dans les zones rurales ou les régions défavorisées.</li>
          </ul>

          <h3>Avantages spécifiques à la diaspora</h3>
          <ul>
            <li>Franchise douanière sur les effets personnels et les biens professionnels importés lors de l'installation.</li>
            <li>Accès facilité au foncier industriel dans les zones économiques spéciales à tarif préférentiel.</li>
            <li>Exonération de la taxe sur les transferts de fonds à destination de projets d'investissement validés.</li>
          </ul>

          <!-- 5. Success stories -->
          <h2>Success stories</h2>
          <p>Plusieurs investisseurs de la diaspora ont déjà concrétisé des projets réussis en Côte d'Ivoire avec l'accompagnement de la DGIE. Leurs parcours illustrent la diversité des opportunités et la pertinence du dispositif d'accompagnement mis en place.</p>

          @forelse($testimonials as $testimonial)
          <div class="testimonial">
            <p class="testimonial__quote">{{ $testimonial->quote }}</p>
            <p class="testimonial__author">{{ $testimonial->name }}, {{ $testimonial->context }}</p>
          </div>
          @empty
          <div class="testimonial">
            <p class="testimonial__quote">&laquo; Après quinze ans en France dans le secteur de la logistique, j'ai voulu investir dans la chaîne du froid en Côte d'Ivoire. Le guichet unique m'a accompagné dans toutes les démarches. Aujourd'hui, mon entreprise emploie 22 personnes. &raquo;</p>
            <p class="testimonial__author">Koné M., entrepreneur dans la logistique frigorifique, de retour de France</p>
          </div>
          <div class="testimonial">
            <p class="testimonial__quote">&laquo; Installée au Canada depuis dix ans, j'ai créé une start-up spécialisée dans les solutions de paiement mobile à Abidjan. La DMCRIE m'a mise en relation avec des partenaires bancaires locaux. En deux ans, notre application compte déjà 45 000 utilisateurs actifs. &raquo;</p>
            <p class="testimonial__author">Touré F., fondatrice d'une fintech, basée entre le Canada et la Côte d'Ivoire</p>
          </div>
          @endforelse

          <!-- 6. Comment démarrer son projet -->
          <h2>Comment démarrer son projet d'investissement</h2>
          <p>La DMCRIE a structuré un parcours clair et accessible pour accompagner chaque porteur de projet depuis l'idée initiale jusqu'à la mise en exploitation effective de son activité.</p>

          <div class="steps">
            <div class="step">
              <div class="step__number">1</div>
              <div class="step__content">
                <h3>Prise de contact et information</h3>
                <p>Contactez le guichet unique de la DMCRIE par courrier électronique, par téléphone ou via la page de contact du site de la DGIE. Un conseiller vous accueille, recueille les grandes lignes de votre projet et vous fournit les premières informations sur les opportunités, les secteurs éligibles et les conditions du fonds d'investissement.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">2</div>
              <div class="step__content">
                <h3>Élaboration du plan d'affaires</h3>
                <p>Avec l'appui de votre conseiller référent, vous élaborez un plan d'affaires structuré comprenant l'étude de marché, le plan financier, le plan opérationnel et la stratégie de développement. Des sessions de formation à la rédaction de plan d'affaires sont proposées en présentiel et à distance.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">3</div>
              <div class="step__content">
                <h3>Demande de financement</h3>
                <p>Votre plan d'affaires validé, vous déposez votre demande de financement auprès du fonds d'investissement diaspora. Le comité d'investissement examine votre dossier dans un délai de 30 jours. En parallèle, le guichet unique vous aide à solliciter d'éventuels financements complémentaires auprès des banques partenaires.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">4</div>
              <div class="step__content">
                <h3>Création de l'entreprise</h3>
                <p>Une fois le financement obtenu, le guichet unique vous accompagne dans les formalités de création d'entreprise au CEPICI. Les démarches sont centralisées et accélérées grâce aux partenariats établis. La création effective de votre entreprise peut être finalisée en moins de 72 heures.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">5</div>
              <div class="step__content">
                <h3>Lancement et suivi</h3>
                <p>Votre entreprise créée, vous bénéficiez d'un suivi régulier pendant les 24 premiers mois d'activité. Ce suivi comprend des bilans trimestriels, un accès à un réseau de mentors expérimentés et une assistance technique en cas de difficulté. L'objectif est de consolider votre activité et de maximiser les chances de pérennité de votre investissement.</p>
              </div>
            </div>
          </div>

          <!-- Info box -->
          <div class="info-box">
            <p>Vous avez un projet d'investissement en Côte d'Ivoire ? Contactez le guichet unique de la DMCRIE dès aujourd'hui pour bénéficier d'un accompagnement personnalisé. Nos conseillers sont disponibles pour répondre à toutes vos questions et vous orienter vers les dispositifs adaptés à votre projet.</p>
          </div>

          <!-- 7. Questions fréquentes -->
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
              <button class="faq__question">Faut-il résider en Côte d'Ivoire pour investir ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Non. Le dispositif est conçu pour permettre aux membres de la diaspora d'investir depuis leur pays de résidence.</div>
              </div>
            </div>
            <div class="faq__item">
              <button class="faq__question">Quel est le montant minimum pour investir ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Il n'y a pas de montant minimum imposé. Le capital social minimum d'une SARL est de 100 000 FCFA.</div>
              </div>
            </div>
            @endforelse
          </div>

        </div>

        <!-- Sidebar -->
        <aside class="content__sidebar">
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Dossiers associés</h3>
            <div class="sidebar-widget__list">
              <a href="{{ route('dossier.show', 'retour-volontaire') }}">Retour volontaire et réinsertion</a>
              <a href="{{ route('dossier.show', 'competences-diaspora') }}">Compétences de la diaspora</a>
              <a href="{{ route('dossiers') }}">Tous les dossiers</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Liens utiles</h3>
            <div class="sidebar-widget__list">
              <a href="{{ route('nos-services') }}#investir">Nos services</a>
              <a href="{{ route('actualites') }}">Actualités</a>
              <a href="{{ route('contact') }}">Contact & Assistance</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Prêt à investir ?</h3>
            <p>Vous avez un projet d'investissement en Côte d'Ivoire ? Contactez le guichet unique de la DMCRIE pour un accompagnement personnalisé.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">Contactez-nous</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
