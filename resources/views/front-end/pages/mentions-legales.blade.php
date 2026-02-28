@extends('front-end.layouts.app')

@section('title', 'Mentions légales — DGIE')

@section('meta')
  <meta name="description" content="Mentions légales du site de la Direction Générale des Ivoiriens de l'Extérieur (DGIE) : éditeur, directeur de la publication, hébergement, propriété intellectuelle et droit applicable.">
  <link rel="canonical" href="{{ route('mentions-legales') }}">
  <meta property="og:title" content="Mentions légales — DGIE">
  <meta property="og:description" content="Mentions légales du site de la Direction Générale des Ivoiriens de l'Extérieur : éditeur, hébergement, propriété intellectuelle et droit applicable.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/mentions-legales.html">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Mentions légales — DGIE">
  <meta name="twitter:description" content="Mentions légales du site de la Direction Générale des Ivoiriens de l'Extérieur : éditeur, hébergement, propriété intellectuelle et droit applicable.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
@endsection

@section('content')
  <!-- PAGE HERO -->
  <section class="page-hero">
    <div class="container">
      <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb__sep">/</span>
        <span>Mentions légales</span>
      </div>
      <h1 class="page-hero__title">Mentions légales</h1>
      <p class="page-hero__subtitle">Informations légales relatives au site internet de la Direction Générale des Ivoiriens de l'Extérieur.</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content" id="main-content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- Éditeur du site -->
          <section>
            <h2>Éditeur du site</h2>
            <p>Le présent site internet est édité par la <strong>Direction Générale des Ivoiriens de l'Extérieur (DGIE)</strong>, structure administrative de l'État de Côte d'Ivoire rattachée au Ministère des Affaires Étrangères, de l'Intégration Africaine et de la Diaspora.</p>
            <ul>
              <li><strong>Dénomination :</strong> Direction Générale des Ivoiriens de l'Extérieur (DGIE)</li>
              <li><strong>Adresse :</strong> {{ $contactInfo->address ?? 'Plateau, Rue du Commerce — Abidjan, Côte d\'Ivoire' }}</li>
              <li><strong>Téléphone :</strong> {{ $contactInfo->phone_1 ?? '+225 XX XX XX XX XX' }}</li>
              <li><strong>E-mail :</strong> {{ $contactInfo->email ?? 'contact@dgie.gouv.ci' }}</li>
              <li><strong>Statut juridique :</strong> Établissement public administratif, créé par le décret n°2023-973 du 06 décembre 2023</li>
            </ul>
          </section>

          <!-- Directeur de la publication -->
          <section>
            <h2>Directeur de la publication</h2>
            <p>Le directeur de la publication du site est <strong>{{ $dg->name ?? 'M. Gaoussou Karamoko' }}</strong>, {{ $dg->title ?? 'Directeur Général des Ivoiriens de l\'Extérieur' }}.</p>
            <p>En cette qualité, il est responsable du contenu éditorial publié sur le présent site.</p>
          </section>

          <!-- Hébergement -->
          <section>
            <h2>Hébergement</h2>
            <p>Le site internet de la DGIE est hébergé par :</p>
            <ul>
              <li><strong>Hébergeur :</strong> [Nom de l'hébergeur]</li>
              <li><strong>Adresse :</strong> [Adresse de l'hébergeur]</li>
              <li><strong>Téléphone :</strong> [Téléphone de l'hébergeur]</li>
            </ul>
          </section>

          <!-- Propriété intellectuelle -->
          <section>
            <h2>Propriété intellectuelle</h2>
            <p>L'ensemble des contenus présents sur le site de la DGIE (textes, images, graphismes, logos, icônes, vidéos, sons, données, mises en page) est protégé par les dispositions du droit ivoirien et des conventions internationales relatives à la propriété intellectuelle.</p>
            <p>Toute reproduction, représentation, modification, publication ou adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite sans l'autorisation écrite préalable de la DGIE.</p>
            <p>Le logo et le nom « DGIE » sont des marques déposées. Toute utilisation non autorisée de ces éléments engage la responsabilité de son auteur.</p>
          </section>

          <!-- Crédits photos -->
          <section>
            <h2>Crédits photos</h2>
            <p>Les photographies et illustrations utilisées sur ce site proviennent des sources suivantes :</p>
            <ul>
              <li>Service communication de la DGIE</li>
              <li>Présidence de la République de Côte d'Ivoire</li>
              <li>Banques d'images libres de droits</li>
            </ul>
            <p>Sauf mention contraire, les crédits photographiques sont la propriété de la DGIE ou sont utilisés avec l'autorisation de leurs auteurs respectifs.</p>
          </section>

          <!-- Liens hypertextes -->
          <section>
            <h2>Liens hypertextes</h2>
            <p>Le site de la DGIE peut contenir des liens vers des sites tiers. Ces liens sont fournis à titre informatif. La DGIE ne contrôle pas le contenu de ces sites et décline toute responsabilité quant aux informations qui y figurent.</p>
            <p>La mise en place de liens hypertextes vers le site de la DGIE est autorisée sans demande préalable, à condition que :</p>
            <ul>
              <li>Les pages du site ne soient pas intégrées à l'intérieur des pages d'un autre site (interdiction de l'utilisation de cadres ou « frames »)</li>
              <li>La source soit explicitement mentionnée par un lien direct vers la page concernée</li>
              <li>L'utilisation ne porte pas atteinte à l'image de la DGIE ou de l'État de Côte d'Ivoire</li>
            </ul>
          </section>

          <!-- Limitation de responsabilité -->
          <section>
            <h2>Limitation de responsabilité</h2>
            <p>La DGIE s'efforce de fournir des informations aussi précises que possible sur son site. Toutefois, elle ne saurait être tenue responsable des omissions, des inexactitudes ou des carences dans la mise à jour des contenus, qu'elles soient de son fait ou de celui des partenaires tiers fournissant ces informations.</p>
            <p>L'utilisation des informations et contenus disponibles sur ce site se fait sous l'entière et seule responsabilité de l'utilisateur.</p>
          </section>

          <!-- Droit applicable -->
          <section>
            <h2>Droit applicable</h2>
            <p>Le présent site et ses mentions légales sont régis par le <strong>droit ivoirien</strong>. En cas de litige, et après tentative de résolution amiable, les tribunaux compétents d'Abidjan seront seuls compétents pour connaître du différend.</p>
            <p>Les présentes mentions légales peuvent être modifiées à tout moment par la DGIE. L'utilisateur est invité à les consulter régulièrement.</p>
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
