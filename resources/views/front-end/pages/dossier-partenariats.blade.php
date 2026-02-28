@extends('front-end.layouts.app')

@section('title', 'Partenariats internationaux — DGIE')

@section('meta')
  <meta name="description" content="La DGIE renforce sa coopération avec l'OIM, l'Union européenne, la GIZ et ses partenaires bilatéraux pour améliorer la gouvernance migratoire en Côte d'Ivoire.">
  <meta property="og:title" content="Partenariats internationaux — DGIE">
  <meta property="og:description" content="Les partenariats de la DGIE avec les organisations internationales et la coopération bilatérale.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/dossier-partenariats.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Partenariats internationaux — DGIE">
  <meta name="twitter:description" content="Les partenariats de la DGIE avec les organisations internationales et la coopération bilatérale.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ url('/dossiers/partenariats') }}">
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
        <span>Partenariats internationaux</span>
      </div>
      <h1 class="page-hero__title">Partenariats internationaux</h1>
      <p class="page-hero__subtitle">La DGIE renforce ses alliances pour une gouvernance migratoire efficace et solidaire.</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- 1. La coopération avec l'OIM -->
          <h2>La coopération avec l'Organisation Internationale pour les Migrations</h2>
          <p>L'Organisation Internationale pour les Migrations (OIM) est le principal partenaire technique de la DGIE en matière d'accompagnement au retour volontaire et de réintégration. Cette coopération, formalisée par un accord-cadre, couvre plusieurs domaines stratégiques.</p>
          <ul>
            <li>Aide au retour volontaire assisté (AVRR) : l'OIM finance et organise le retour des Ivoiriens en situation de vulnérabilité à l'étranger, en coordination avec la DGIE qui assure l'accueil et le suivi à l'arrivée.</li>
            <li>Renforcement des capacités : des programmes de formation sont régulièrement organisés au bénéfice des agents de la DGIE sur les thématiques de la gestion migratoire, de la protection des migrants et de la collecte de données.</li>
            <li>Appui technique : l'OIM fournit une assistance technique pour la mise en place d'outils de suivi des migrants de retour et pour l'élaboration de politiques migratoires fondées sur les données.</li>
            <li>Projets conjoints : plusieurs programmes sont mis en oeuvre conjointement, portant sur la réintégration économique, la sensibilisation aux risques de la migration irrégulière et le développement communautaire dans les zones de départ.</li>
          </ul>

          <!-- 2. L'Union européenne -->
          <h2>Le partenariat avec l'Union européenne</h2>
          <p>L'Union européenne (UE) est un partenaire majeur de la Côte d'Ivoire en matière de gouvernance migratoire. Plusieurs programmes financés par l'UE sont mis en oeuvre en collaboration avec la DGIE.</p>

          <h3>Le Fonds fiduciaire d'urgence pour l'Afrique</h3>
          <p>Le Fonds fiduciaire de l'Union européenne pour l'Afrique a financé plusieurs projets en Côte d'Ivoire visant à renforcer la gestion des flux migratoires, à accompagner les migrants de retour et à développer les zones de forte émigration. La DGIE a été impliquée dans la mise en oeuvre de ces projets en tant que structure d'accueil et d'orientation des bénéficiaires.</p>

          <h3>Programmes de développement</h3>
          <p>Au-delà de la gestion des flux, la coopération avec l'UE porte également sur le développement des compétences de la diaspora, la facilitation des transferts de fonds et l'appui à l'investissement productif des Ivoiriens de l'extérieur. Ces programmes visent à renforcer la contribution positive de la migration au développement de la Côte d'Ivoire.</p>

          <!-- 3. La GIZ -->
          <h2>La coopération avec la GIZ</h2>
          <p>La Deutsche Gesellschaft für Internationale Zusammenarbeit (GIZ), agence de coopération allemande, collabore avec la DGIE dans le cadre de programmes de réintégration et de formation professionnelle.</p>
          <ul>
            <li>Programme de réintégration durable : la GIZ soutient des projets d'accompagnement des migrants de retour vers l'emploi et l'entrepreneuriat, en finançant des formations professionnelles et des kits de démarrage d'activité.</li>
            <li>Appui institutionnel : la GIZ contribue au renforcement des capacités de la DGIE en matière de gestion des données migratoires et de coordination interinstitutionnelle.</li>
            <li>Sensibilisation : des campagnes d'information sur les risques de la migration irrégulière et sur les alternatives à l'émigration sont menées conjointement dans les régions de forte émigration.</li>
          </ul>

          <!-- 4. La coopération bilatérale -->
          <h2>La coopération bilatérale</h2>
          <p>La DGIE entretient des relations de coopération avec plusieurs pays, dans le cadre d'accords bilatéraux portant sur la gestion des flux migratoires et la protection des ressortissants ivoiriens à l'étranger.</p>

          <h3>France et OFII</h3>
          <p>La coopération avec la France s'appuie principalement sur le partenariat avec l'Office Français de l'Immigration et de l'Intégration (OFII). Ce partenariat couvre l'aide au retour volontaire depuis la France, l'accompagnement à la réinsertion en Côte d'Ivoire, la formation professionnelle et le suivi post-retour. L'OFII dispose d'un bureau de représentation en Côte d'Ivoire qui travaille en lien direct avec la DGIE.</p>

          <h3>Allemagne</h3>
          <p>Outre la coopération via la GIZ, la Côte d'Ivoire entretient des échanges bilatéraux avec l'Allemagne dans le domaine de la migration de travail et de la formation professionnelle. Des programmes pilotes visent à faciliter la mobilité professionnelle régulière entre les deux pays.</p>

          <h3>Maroc</h3>
          <p>La coopération avec le Royaume du Maroc porte sur l'échange d'expériences en matière de politique migratoire, la protection des migrants ivoiriens en transit ou établis au Maroc et la lutte contre les réseaux de traite et de trafic de personnes. Des accords bilatéraux encadrent cette coopération.</p>

          <!-- 5. Les accords-cadres -->
          <h2>Les accords-cadres</h2>
          <p>L'action de la DGIE en matière de partenariat s'appuie sur un ensemble d'accords-cadres qui définissent les engagements réciproques des parties et les modalités de coopération.</p>
          <ul>
            <li>Accord-cadre DGIE-OIM pour l'assistance au retour volontaire et la réintégration durable.</li>
            <li>Convention de partenariat avec l'OFII pour l'accompagnement des Ivoiriens de retour de France.</li>
            <li>Protocole d'accord avec la GIZ dans le cadre du programme de migration et développement.</li>
            <li>Accords bilatéraux de coopération migratoire avec les pays partenaires.</li>
            <li>Conventions de partenariat avec les organisations de la société civile ivoirienne.</li>
          </ul>
          <p>Ces accords sont régulièrement évalués et actualisés afin de s'adapter à l'évolution du contexte migratoire et aux besoins identifiés sur le terrain.</p>

          <!-- 6. Les projets en cours -->
          <h2>Les projets en cours</h2>
          <p>Plusieurs projets sont actuellement en cours d'exécution dans le cadre des partenariats de la DGIE. Ces projets couvrent l'ensemble du spectre de l'action migratoire.</p>

          <h3>Projet de réintégration communautaire</h3>
          <p>Financé par l'Union européenne et mis en oeuvre avec l'OIM, ce projet vise à renforcer la réintégration des migrants de retour dans leurs communautés d'origine. Il combine un accompagnement individuel (formation, appui à la création d'activité) et un volet communautaire (projets d'infrastructure, développement économique local).</p>

          <h3>Programme de mobilisation de la diaspora</h3>
          <p>En partenariat avec plusieurs agences de coopération, la DGIE pilote un programme visant à recenser les compétences de la diaspora ivoirienne et à faciliter leur mobilisation au service du développement national. Ce programme inclut la mise en place d'une plateforme numérique de mise en relation.</p>

          <h3>Sensibilisation à la migration régulière</h3>
          <p>Des campagnes de sensibilisation sont menées dans les régions à forte émigration pour informer les jeunes sur les risques de la migration irrégulière et sur les voies légales de migration. Ces campagnes associent les autorités locales, les leaders communautaires et les associations de jeunesse.</p>

          <!-- 7. Les résultats obtenus -->
          <h2>Les résultats obtenus</h2>
          <p>Les partenariats de la DGIE ont permis d'obtenir des résultats significatifs depuis la création de la structure.</p>
          <ul>
            <li>Plus de 2 300 migrants de retour accompagnés dans leur réinsertion socio-économique.</li>
            <li>Plusieurs centaines de bénéficiaires de formations professionnelles qualifiantes.</li>
            <li>Mise en place d'un système de suivi informatisé des migrants de retour.</li>
            <li>Renforcement des capacités des agents de la DGIE en gestion migratoire.</li>
            <li>Organisation de campagnes de sensibilisation dans plus de 15 localités.</li>
            <li>Signature de plusieurs accords-cadres structurants avec les partenaires internationaux.</li>
          </ul>
          <p>La DGIE s'engage à poursuivre et à renforcer ces partenariats pour améliorer continuellement la qualité de l'accompagnement offert aux Ivoiriens de l'extérieur et aux migrants de retour.</p>

          <!-- Info box -->
          <div class="info-box">
            <p>La DGIE est ouverte à de nouveaux partenariats avec les organisations et institutions partageant ses objectifs. Pour toute proposition de coopération, veuillez nous contacter via la page dédiée.</p>
          </div>

        </div>

        <!-- Sidebar -->
        <aside class="content__sidebar">
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Dossiers liés</h3>
            <div class="sidebar-widget__list">
              <a href="{{ route('dossier.show', 'accompagnement-social') }}">Accompagnement social</a>
              <a href="{{ route('dossier.show', 'cadre-juridique') }}">Cadre juridique</a>
              <a href="{{ route('la-dgie') }}">La DGIE</a>
              <a href="{{ route('dossiers') }}">Tous les dossiers</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Partenaires clés</h3>
            <p>OIM, Union européenne, GIZ, OFII, ainsi que les partenaires bilatéraux et les organisations de la société civile.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">Contactez-nous</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
