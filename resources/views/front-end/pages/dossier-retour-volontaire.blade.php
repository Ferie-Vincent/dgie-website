@extends('front-end.layouts.app')

@section('title', 'Retour volontaire et réinsertion — Dossier DGIE')

@section('meta')
  <meta name="description" content="Le programme de retour volontaire de la DGIE : conditions, procédure, accompagnement à l'aéroport, parcours de réinsertion et suivi pendant 12 mois.">
  <meta property="og:title" content="Retour volontaire et réinsertion — DGIE">
  <meta property="og:description" content="Découvrez le programme de retour volontaire et de réinsertion de la DGIE pour les Ivoiriens de l'extérieur.">
  <meta property="og:type" content="article">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/dossier-retour-volontaire.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Retour volontaire et réinsertion — DGIE">
  <meta name="twitter:description" content="Découvrez le programme de retour volontaire et de réinsertion de la DGIE pour les Ivoiriens de l'extérieur.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ url('/dossiers/retour-volontaire') }}">
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
        <span>Retour volontaire et réinsertion</span>
      </div>
      <h1 class="page-hero__title">Retour volontaire et réinsertion</h1>
      <p class="page-hero__subtitle">Le programme d'accompagnement au retour volontaire et de réinsertion socio-économique piloté par la DAOSAR</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- 1. Le programme de retour volontaire -->
          <h2>Le programme de retour volontaire</h2>
          <p>La Direction de l'Accueil, de l'Orientation, du Suivi et de l'Aide à la Réinsertion (DAOSAR) pilote le programme de retour volontaire destiné aux Ivoiriens établis à l'étranger qui souhaitent revenir s'installer en Côte d'Ivoire. Ce programme offre un cadre structuré et sécurisé pour accompagner chaque migrant dans sa démarche de retour, depuis la prise de décision jusqu'à la réinsertion effective.</p>
          <p>Le retour volontaire repose sur un principe fondamental : chaque personne doit pouvoir rentrer dans la dignité, avec un accompagnement adapté à sa situation personnelle et professionnelle. Le programme est entièrement gratuit et ouvert à tous les ressortissants ivoiriens, quel que soit leur pays de résidence ou la durée de leur séjour à l'étranger.</p>

          <h3>Conditions d'éligibilité</h3>
          <ul>
            <li>Etre de nationalité ivoirienne ou binational disposant d'un document d'identité valide.</li>
            <li>Résider à l'étranger de manière régulière ou irrégulière.</li>
            <li>Exprimer librement et volontairement le souhait de rentrer en Côte d'Ivoire.</li>
            <li>Accepter les conditions d'accompagnement et de suivi proposées par la DGIE.</li>
            <li>Ne faire l'objet d'aucune procédure judiciaire en cours empêchant le déplacement.</li>
          </ul>

          <h3>Procédure de demande</h3>
          <p>La procédure de retour volontaire se déroule en plusieurs temps. Le candidat au retour prend d'abord contact avec le poste consulaire ivoirien de son pays de résidence ou directement avec la DGIE. Un dossier de demande est constitué, comprenant les informations personnelles, le parcours migratoire et les motivations du retour. Le dossier est ensuite transmis à la DAOSAR pour examen et validation.</p>
          <p>Une fois la demande validée, un plan de retour personnalisé est élaboré en concertation avec le demandeur. Ce plan précise les modalités de transport, les conditions d'accueil à l'arrivée et les premières étapes de l'accompagnement.</p>

          <h3>Accompagnement à l'aéroport</h3>
          <p>A l'arrivée à l'aéroport international Félix-Houphouët-Boigny d'Abidjan, chaque migrant de retour est accueilli par une équipe dédiée de la DGIE. Cet accueil comprend plusieurs prestations essentielles :</p>
          <ul>
            <li>Accueil personnalisé par un agent de la DAOSAR dès la sortie de l'avion.</li>
            <li>Assistance aux formalités d'immigration et de douane si nécessaire.</li>
            <li>Remise d'un kit d'accueil contenant des informations pratiques sur les services disponibles.</li>
            <li>Prise en charge du transport depuis l'aéroport vers le lieu d'hébergement temporaire ou le domicile.</li>
            <li>Premier entretien d'orientation avec un conseiller de la DAOSAR dans les 48 heures suivant l'arrivée.</li>
          </ul>

          <!-- 2. Les étapes de la réinsertion -->
          <h2>Les étapes de la réinsertion</h2>
          <p>Le parcours de réinsertion mis en place par la DAOSAR est structuré en quatre phases distinctes. Chaque étape fait l'objet d'un suivi individualisé pour garantir la réussite du projet de réinstallation.</p>

          <div class="steps">
            <div class="step">
              <div class="step__number">1</div>
              <div class="step__content">
                <h3>Accueil et diagnostic</h3>
                <p>Dans les premiers jours suivant le retour, un entretien approfondi est réalisé avec un conseiller. Cet échange permet d'évaluer la situation globale du migrant : compétences professionnelles, niveau de formation, situation familiale, état de santé, besoins prioritaires. Un plan d'accompagnement personnalisé est élaboré à l'issue de ce diagnostic.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">2</div>
              <div class="step__content">
                <h3>Orientation et choix du parcours</h3>
                <p>Sur la base du diagnostic, le migrant est orienté vers le parcours le plus adapté à son profil et à ses aspirations. Trois voies principales sont proposées : la formation professionnelle qualifiante, l'appui à la création d'une activité génératrice de revenus, ou l'insertion dans l'emploi salarié.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">3</div>
              <div class="step__content">
                <h3>Formation et mise en oeuvre</h3>
                <p>Le migrant intègre le programme retenu. Les formations durent de deux à six mois selon le domaine choisi. Pour les créateurs d'activité, un accompagnement renforcé est proposé : rédaction du plan d'affaires, accès au financement, formalités de création d'entreprise et mentorat par un professionnel du secteur.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">4</div>
              <div class="step__content">
                <h3>Suivi sur 12 mois</h3>
                <p>Pendant une année complète, un référent dédié assure le suivi régulier du migrant. Des bilans mensuels permettent d'évaluer l'avancement du projet, d'identifier les éventuelles difficultés et d'apporter les ajustements nécessaires. Ce suivi prolongé est un facteur clé de réussite de la réinsertion durable.</p>
              </div>
            </div>
          </div>

          <!-- 3. Chiffres clés -->
          <h2>Chiffres clés du programme</h2>
          <p>Le programme de retour volontaire et de réinsertion affiche des résultats significatifs qui témoignent de l'engagement de la DGIE et de ses partenaires au service des migrants de retour.</p>
          <ul>
            <li><strong>2 300+ migrants accompagnés en 2025</strong> dans le cadre du retour volontaire et de la réinsertion.</li>
            <li><strong>78 % de taux de réinsertion réussie</strong> à l'issue des 12 mois de suivi.</li>
            <li><strong>850 projets d'activité créés</strong> par des migrants de retour avec l'appui de la DGIE.</li>
            <li><strong>1 200 formations professionnelles dispensées</strong> dans plus de 15 secteurs d'activité.</li>
            <li><strong>35 pays d'origine des retours</strong> accompagnés par le programme.</li>
            <li><strong>12 centres d'accueil et d'orientation</strong> opérationnels sur le territoire national.</li>
          </ul>
          <p>Ces résultats illustrent la montée en puissance du dispositif et la confiance croissante des Ivoiriens de l'extérieur dans les mécanismes d'accompagnement proposés par l'État.</p>

          <!-- 4. Témoignages -->
          <h2>Témoignages de bénéficiaires</h2>

          @forelse($testimonials as $testimonial)
          <div class="testimonial">
            <p class="testimonial__quote">{{ $testimonial->quote }}</p>
            <p class="testimonial__author">{{ $testimonial->name }}, {{ $testimonial->context }}</p>
          </div>
          @empty
          <div class="testimonial">
            <p class="testimonial__quote">&laquo; J'ai vécu sept ans en Libye dans des conditions très difficiles. Quand j'ai décidé de rentrer, l'OIM et la DGIE ont organisé mon rapatriement. A l'aéroport d'Abidjan, j'ai été accueilli par un agent qui m'a expliqué tout le dispositif. Après une formation en mécanique automobile de quatre mois, j'ai ouvert mon garage à Bouaké. Le suivi mensuel m'a beaucoup aidé à surmonter les moments de doute. Aujourd'hui, j'emploie deux apprentis. &raquo;</p>
            <p class="testimonial__author">Ouattara S., 32 ans, de retour de Libye depuis 14 mois</p>
          </div>
          <div class="testimonial">
            <p class="testimonial__quote">&laquo; Après huit ans au Maroc, je suis rentrée avec mes deux enfants. La DGIE m'a orientée vers une formation en couture et en gestion. Grâce à l'appui financier du programme, j'ai pu acheter une machine à coudre et du tissu pour démarrer. Mon atelier fonctionne depuis six mois maintenant. &raquo;</p>
            <p class="testimonial__author">Bamba A., 29 ans, de retour du Maroc depuis 10 mois</p>
          </div>
          @endforelse

          <!-- 5. Partenaires du programme -->
          <h2>Partenaires du programme</h2>
          <p>Le programme de retour volontaire et de réinsertion est mis en oeuvre grâce à une coopération étroite entre la DGIE et plusieurs partenaires nationaux et internationaux. Cette synergie permet de mobiliser des ressources complémentaires au bénéfice des migrants de retour.</p>

          <h3>Organisation Internationale pour les Migrations (OIM)</h3>
          <p>L'OIM est le principal partenaire opérationnel du programme. Elle intervient dans l'organisation logistique du retour (transport aérien, transit), l'accompagnement des migrants vulnérables et le financement de projets de réinsertion. L'OIM apporte également son expertise technique dans le suivi et l'évaluation du programme.</p>

          <h3>Union européenne (UE)</h3>
          <p>L'Union européenne soutient financièrement le programme à travers le Fonds fiduciaire d'urgence pour l'Afrique et d'autres instruments de coopération. Ce soutien permet de renforcer les capacités d'accueil, de financer les formations professionnelles et de développer les infrastructures d'accompagnement sur le territoire national.</p>

          <h3>Coopération allemande (GIZ)</h3>
          <p>La GIZ intervient dans le volet formation professionnelle et insertion économique du programme. Elle apporte un appui technique dans la conception des modules de formation, le renforcement des centres d'accueil et le développement d'outils de suivi des bénéficiaires. La GIZ soutient également des projets pilotes d'insertion dans les secteurs porteurs de l'économie ivoirienne.</p>

          <h3>Partenaires nationaux</h3>
          <p>Le programme s'appuie également sur un réseau de partenaires institutionnels ivoiriens qui contribuent à la réussite de la réinsertion :</p>
          <ul>
            <li>Le Ministère de la Promotion de la Jeunesse, de l'Insertion Professionnelle et du Service Civique.</li>
            <li>L'Agence Emploi Jeunes pour l'orientation et le placement professionnel.</li>
            <li>Le Fonds de Développement de la Formation Professionnelle (FDFP) pour le financement des formations.</li>
            <li>Les collectivités territoriales pour l'accompagnement de proximité dans les régions.</li>
            <li>Les organisations de la société civile spécialisées dans l'aide aux migrants.</li>
          </ul>

          <!-- 6. Info box -->
          <div class="info-box">
            <p>Pour entamer une démarche de retour volontaire, contactez le poste consulaire ivoirien de votre pays de résidence ou écrivez directement à la DGIE via notre page de contact. Votre demande sera traitée en toute confidentialité.</p>
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
              <button class="faq__question">Le retour volontaire est-il réservé aux migrants en situation irrégulière ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Non. Le programme est ouvert à tous les Ivoiriens de l'extérieur, qu'ils soient en situation régulière ou irrégulière.</div>
              </div>
            </div>
            <div class="faq__item">
              <button class="faq__question">Combien de temps dure l'accompagnement après le retour ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">L'accompagnement standard dure 12 mois à compter de la date d'arrivée en Côte d'Ivoire.</div>
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
              <a href="{{ route('dossier.show', 'competences-diaspora') }}">Compétences de la diaspora</a>
              <a href="{{ route('dossier.show', 'investissement-diaspora') }}">Investissement diaspora</a>
              <a href="{{ route('dossiers') }}">Tous les dossiers</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Liens utiles</h3>
            <div class="sidebar-widget__list">
              <a href="{{ route('nos-services') }}#retour">Nos services</a>
              <a href="{{ route('actualites') }}">Actualités</a>
              <a href="{{ route('contact') }}">Contact & Assistance</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Besoin d'aide ?</h3>
            <p>Vous envisagez un retour en Côte d'Ivoire ? Nos équipes sont disponibles pour vous informer et vous accompagner dans votre démarche.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">Contactez-nous</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
