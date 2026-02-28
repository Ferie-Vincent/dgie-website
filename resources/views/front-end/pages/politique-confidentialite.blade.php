@extends('front-end.layouts.app')

@section('title', 'Politique de confidentialité — DGIE')

@section('meta')
  <meta name="description" content="Politique de confidentialité du site de la DGIE : données collectées, finalités, durée de conservation, droits des utilisateurs et gestion des cookies.">
  <link rel="canonical" href="{{ route('politique-confidentialite') }}">
  <meta property="og:title" content="Politique de confidentialité — DGIE">
  <meta property="og:description" content="Politique de confidentialité du site de la DGIE : données collectées, finalités, durée de conservation, droits des utilisateurs et gestion des cookies.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/politique-confidentialite.html">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Politique de confidentialité — DGIE">
  <meta name="twitter:description" content="Politique de confidentialité du site de la DGIE : données collectées, finalités, droits des utilisateurs et cookies.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Politique de confidentialité</span>
      </div>
      <h1 class="page-hero__title">Politique de confidentialité</h1>
      <p class="page-hero__subtitle">La DGIE s'engage à protéger vos données personnelles. Découvrez comment nous collectons, utilisons et protégeons vos informations.</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content" id="main-content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- Introduction -->
          <section>
            <h2>Introduction</h2>
            <p>La Direction Générale des Ivoiriens de l'Extérieur (DGIE) accorde une importance particulière à la protection de vos données personnelles. La présente politique de confidentialité a pour objet de vous informer sur la manière dont nous collectons, traitons et protégeons vos données lorsque vous utilisez notre site internet.</p>
            <p>En naviguant sur le site <strong>www.dgie.gouv.ci</strong>, vous acceptez les pratiques décrites dans la présente politique.</p>
          </section>

          <!-- Responsable du traitement -->
          <section>
            <h2>Responsable du traitement</h2>
            <p>Le responsable du traitement des données personnelles collectées sur ce site est :</p>
            <ul>
              <li><strong>Organisme :</strong> Direction Générale des Ivoiriens de l'Extérieur (DGIE)</li>
              <li><strong>Adresse :</strong> {{ $contactInfo->address ?? 'Plateau, Rue du Commerce — Abidjan, Côte d\'Ivoire' }}</li>
              <li><strong>E-mail :</strong> {{ $contactInfo->email ?? 'contact@dgie.gouv.ci' }}</li>
            </ul>
          </section>

          <!-- Données collectées -->
          <section>
            <h2>Données collectées</h2>
            <p>La DGIE collecte des données personnelles uniquement dans le cadre des fonctionnalités proposées sur son site. Les données collectées sont les suivantes :</p>

            <h3>Formulaire de contact</h3>
            <p>Lorsque vous remplissez le formulaire de contact, les informations suivantes sont collectées :</p>
            <ul>
              <li>Nom complet</li>
              <li>Adresse e-mail</li>
              <li>Objet de la demande</li>
              <li>Contenu du message</li>
            </ul>

            <h3>Inscription à la newsletter</h3>
            <p>Lorsque vous vous inscrivez à notre newsletter, seule votre <strong>adresse e-mail</strong> est collectée.</p>

            <h3>Données de navigation</h3>
            <p>Lors de votre visite, des données techniques peuvent être collectées automatiquement : adresse IP, type de navigateur, pages consultées, date et heure de connexion. Ces données sont utilisées exclusivement à des fins statistiques et d'amélioration du site.</p>
          </section>

          <!-- Finalité du traitement -->
          <section>
            <h2>Finalité du traitement</h2>
            <p>Les données personnelles collectées sont utilisées pour les finalités suivantes :</p>
            <ul>
              <li><strong>Formulaire de contact :</strong> répondre à vos demandes d'information, vous orienter vers le service compétent de la DGIE (DAOSAR, DMCRIE ou DAS)</li>
              <li><strong>Newsletter :</strong> vous envoyer des actualités, des événements et des informations relatives aux activités de la DGIE</li>
              <li><strong>Données de navigation :</strong> analyser la fréquentation du site, améliorer l'expérience utilisateur et assurer la sécurité du site</li>
            </ul>
            <p>Vos données ne sont jamais utilisées à des fins commerciales et ne sont jamais vendues à des tiers.</p>
          </section>

          <!-- Durée de conservation -->
          <section>
            <h2>Durée de conservation</h2>
            <p>Les données personnelles sont conservées pendant une durée limitée, proportionnelle à la finalité du traitement :</p>
            <ul>
              <li><strong>Formulaire de contact :</strong> les données sont conservées pendant une durée maximale de <strong>12 mois</strong> après le traitement de votre demande</li>
              <li><strong>Newsletter :</strong> votre adresse e-mail est conservée jusqu'à votre <strong>désinscription</strong>, que vous pouvez effectuer à tout moment</li>
              <li><strong>Données de navigation :</strong> les données techniques sont conservées pendant une durée maximale de <strong>13 mois</strong></li>
            </ul>
            <p>Au-delà de ces durées, les données sont supprimées ou anonymisées de manière irréversible.</p>
          </section>

          <!-- Droits des utilisateurs -->
          <section>
            <h2>Vos droits</h2>
            <p>Conformément à la législation ivoirienne en matière de protection des données personnelles, vous disposez des droits suivants :</p>
            <ul>
              <li><strong>Droit d'accès :</strong> vous pouvez demander à consulter les données personnelles vous concernant</li>
              <li><strong>Droit de rectification :</strong> vous pouvez demander la correction de données inexactes ou incomplètes</li>
              <li><strong>Droit de suppression :</strong> vous pouvez demander la suppression de vos données personnelles</li>
              <li><strong>Droit d'opposition :</strong> vous pouvez vous opposer au traitement de vos données pour des motifs légitimes</li>
              <li><strong>Droit de désinscription :</strong> vous pouvez vous désinscrire de la newsletter à tout moment via le lien prévu à cet effet dans chaque e-mail</li>
            </ul>
            <p>Pour exercer l'un de ces droits, veuillez adresser votre demande par e-mail à l'adresse suivante : <strong>dpo@dgie.gouv.ci</strong>, en précisant votre identité et la nature de votre demande. Une réponse vous sera apportée dans un délai de 30 jours ouvrés.</p>
          </section>

          <!-- Cookies -->
          <section>
            <h2>Cookies</h2>
            <p>Le site de la DGIE peut utiliser des cookies pour assurer son bon fonctionnement et améliorer votre expérience de navigation.</p>

            <h3>Qu'est-ce qu'un cookie ?</h3>
            <p>Un cookie est un petit fichier texte déposé sur votre terminal (ordinateur, tablette, smartphone) lors de la consultation d'un site internet. Il permet de stocker des informations relatives à votre navigation.</p>

            <h3>Types de cookies utilisés</h3>
            <ul>
              <li><strong>Cookies techniques :</strong> indispensables au fonctionnement du site (session, préférences d'affichage). Ils ne nécessitent pas votre consentement.</li>
              <li><strong>Cookies de mesure d'audience :</strong> permettent de mesurer la fréquentation du site et d'identifier les pages les plus consultées, dans une démarche d'amélioration continue.</li>
            </ul>

            <h3>Gestion des cookies</h3>
            <p>Vous pouvez à tout moment configurer votre navigateur pour accepter ou refuser les cookies. La désactivation des cookies techniques peut toutefois affecter le fonctionnement de certaines parties du site.</p>
            <p>Pour gérer vos préférences, consultez la rubrique d'aide de votre navigateur :</p>
            <ul>
              <li>Google Chrome : Paramètres > Confidentialité et sécurité > Cookies</li>
              <li>Mozilla Firefox : Options > Vie privée et sécurité</li>
              <li>Safari : Préférences > Confidentialité</li>
              <li>Microsoft Edge : Paramètres > Cookies et autorisations de site</li>
            </ul>
          </section>

          <!-- Sécurité -->
          <section>
            <h2>Sécurité des données</h2>
            <p>La DGIE met en place des mesures techniques et organisationnelles appropriées pour protéger vos données personnelles contre tout accès non autorisé, toute modification, toute divulgation ou toute destruction.</p>
            <p>L'accès aux données personnelles est strictement limité aux agents habilités de la DGIE, dans le cadre de l'exercice de leurs fonctions.</p>
          </section>

          <!-- Contact DPO -->
          <section>
            <h2>Contact du délégué à la protection des données</h2>
            <p>Pour toute question relative à la protection de vos données personnelles ou pour exercer vos droits, vous pouvez contacter le délégué à la protection des données (DPO) de la DGIE :</p>
            <ul>
              <li><strong>E-mail :</strong> dpo@dgie.gouv.ci</li>
              <li><strong>Adresse postale :</strong> DGIE — Délégué à la protection des données, Plateau, Rue du Commerce, Abidjan, Côte d'Ivoire</li>
            </ul>
            <p>Vous pouvez également adresser une réclamation auprès de l'<strong>ARTCI</strong> (Autorité de Régulation des Télécommunications/TIC de Côte d'Ivoire), autorité compétente en matière de protection des données personnelles.</p>
          </section>

          <!-- Modifications -->
          <section>
            <h2>Modifications de la politique</h2>
            <p>La DGIE se réserve le droit de modifier la présente politique de confidentialité à tout moment. Les modifications prennent effet dès leur publication sur le site. Nous vous invitons à consulter régulièrement cette page pour rester informé des éventuelles mises à jour.</p>
          </section>

          <!-- Date de mise à jour -->
          <div class="info-box">
            <p><strong>Dernière mise à jour :</strong> 21 février 2026</p>
          </div>

        </div>

        <!-- Sidebar -->
        <aside class="content__sidebar">

          <div class="sidebar-widget">
            <div class="sidebar-widget__title">Pages légales</div>
            <div class="sidebar-widget__list">
              <a href="{{ route('mentions-legales') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                Mentions légales
              </a>
              <a href="{{ route('politique-confidentialite') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                Politique de confidentialité
              </a>
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
              <span>{{ $contactInfo->hours ?? 'Lun – Ven : 8h00 – 16h30' }}</span>
            </div>
            <a href="{{ route('contact') }}" class="btn btn--green" style="margin-top: 16px; width: 100%;">Nous contacter</a>
          </div>

        </aside>

      </div>
    </div>
  </section>
@endsection
