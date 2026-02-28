@extends('front-end.layouts.app')

@section('title', 'Mobilisation des compétences de la diaspora — Dossier DGIE')

@section('meta')
  <meta name="description" content="Le répertoire national des compétences de la diaspora, les programmes de transfert de compétences et les missions d'expertise pilotés par la DMCRIE.">
  <meta property="og:title" content="Mobilisation des compétences de la diaspora — DGIE">
  <meta property="og:description" content="Découvrez comment la DGIE mobilise les compétences de la diaspora ivoirienne au service du développement national.">
  <meta property="og:type" content="article">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/dossier-competences-diaspora.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Mobilisation des compétences de la diaspora — DGIE">
  <meta name="twitter:description" content="Découvrez comment la DGIE mobilise les compétences de la diaspora ivoirienne au service du développement national.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ url('/dossiers/competences-diaspora') }}">
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
        <span>Mobilisation des compétences de la diaspora</span>
      </div>
      <h1 class="page-hero__title">Mobilisation des compétences de la diaspora</h1>
      <p class="page-hero__subtitle">Mettre l'expertise des Ivoiriens de l'extérieur au service du développement national</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- 1. Le répertoire national des compétences -->
          <h2>Le répertoire national des compétences</h2>
          <p>La Direction de la Mobilisation des Compétences, des Ressources de l'Investissement de l'Extérieur (DMCRIE) a mis en place un répertoire national des compétences de la diaspora ivoirienne. Cet outil stratégique recense les profils, les expertises et les savoir-faire des Ivoiriens établis à l'étranger afin de les mettre au service des projets de développement du pays.</p>
          <p>Le répertoire constitue une base de données structurée qui permet à l'État, aux institutions publiques, aux entreprises et aux organisations de développement d'identifier rapidement les compétences disponibles au sein de la diaspora. Il couvre l'ensemble des secteurs d'activité : santé, ingénierie, numérique, agriculture, finance, droit, enseignement, recherche et bien d'autres.</p>

          <h3>Objectifs du répertoire</h3>
          <ul>
            <li>Cartographier les compétences et les expertises des Ivoiriens vivant à l'étranger.</li>
            <li>Créer un lien permanent entre la diaspora qualifiée et les besoins du marché ivoirien.</li>
            <li>Faciliter la mise en relation entre les professionnels de la diaspora et les institutions nationales.</li>
            <li>Alimenter les programmes de transfert de compétences et les missions d'expertise.</li>
            <li>Valoriser le capital humain de la diaspora dans les politiques publiques de développement.</li>
          </ul>

          <h3>Chiffres du répertoire</h3>
          <ul>
            <li><strong>4 500+ professionnels inscrits</strong> dans le répertoire à ce jour.</li>
            <li><strong>85 pays de résidence</strong> représentés dans la base de données.</li>
            <li><strong>120 domaines d'expertise</strong> couverts par les profils enregistrés.</li>
            <li><strong>35 % de femmes</strong> parmi les inscrits au répertoire.</li>
          </ul>

          <!-- 2. Programmes de transfert de compétences -->
          <h2>Programmes de transfert de compétences</h2>
          <p>La DMCRIE coordonne plusieurs programmes visant à faciliter le transfert de compétences depuis la diaspora vers les institutions et les entreprises ivoiriennes. Ces programmes permettent aux professionnels de la diaspora de contribuer concrètement au développement de la Côte d'Ivoire, sans nécessairement s'installer de manière permanente dans le pays.</p>

          <h3>Programme de mentorat à distance</h3>
          <p>Ce programme met en relation des professionnels expérimentés de la diaspora avec de jeunes cadres ou entrepreneurs ivoiriens. Le mentorat se déroule sur une période de six à douze mois, avec des sessions régulières en visioconférence. Les mentors partagent leur expertise sectorielle, leur réseau professionnel et leurs conseils stratégiques pour accélérer le développement des compétences locales.</p>

          <h3>Programme de formation à distance</h3>
          <p>Des experts de la diaspora conçoivent et animent des modules de formation spécialisés à destination des professionnels ivoiriens. Ces formations couvrent des domaines de pointe où les compétences locales nécessitent un renforcement : technologies de l'information, gestion hospitalière, ingénierie environnementale, finance internationale, ou encore gouvernance institutionnelle.</p>

          <h3>Programme d'échanges universitaires</h3>
          <p>En partenariat avec les universités ivoiriennes et les établissements d'enseignement supérieur, la DMCRIE facilite la venue d'enseignants-chercheurs de la diaspora pour des séminaires, des conférences et des encadrements de travaux de recherche. Ce programme contribue au renforcement de la qualité de l'enseignement supérieur et à la mise à jour des programmes académiques.</p>

          <!-- 3. Missions d'expertise court terme -->
          <h2>Missions d'expertise court terme</h2>
          <p>Les missions d'expertise court terme permettent à des professionnels de la diaspora d'intervenir pendant deux à huit semaines au sein d'institutions publiques, d'entreprises ou d'organisations de développement en Côte d'Ivoire. Ces missions répondent à des besoins identifiés et offrent un cadre structuré d'intervention.</p>

          <h3>Déroulement d'une mission</h3>
          <div class="steps">
            <div class="step">
              <div class="step__number">1</div>
              <div class="step__content">
                <h3>Expression du besoin</h3>
                <p>Une institution ou une entreprise identifie un besoin spécifique en expertise et soumet une demande à la DMCRIE. Le besoin est formalisé dans des termes de référence précisant les objectifs, la durée et le profil recherché.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">2</div>
              <div class="step__content">
                <h3>Recherche de profils</h3>
                <p>La DMCRIE interroge le répertoire national des compétences pour identifier les profils correspondant au besoin exprimé. Les candidats sont contactés et informés des modalités de la mission.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">3</div>
              <div class="step__content">
                <h3>Réalisation de la mission</h3>
                <p>L'expert retenu se rend en Côte d'Ivoire pour la durée de la mission. La DGIE prend en charge les frais de transport et d'hébergement. L'expert travaille en immersion au sein de l'institution d'accueil et livre ses recommandations à l'issue de la mission.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">4</div>
              <div class="step__content">
                <h3>Suivi et capitalisation</h3>
                <p>Un rapport de mission est rédigé et partagé avec l'institution d'accueil et la DMCRIE. Les enseignements sont capitalisés pour améliorer les interventions futures et renforcer la base de connaissances du répertoire.</p>
              </div>
            </div>
          </div>

          <h3>Domaines d'intervention prioritaires</h3>
          <ul>
            <li>Santé publique : gestion hospitalière, formation du personnel médical, protocoles de soins.</li>
            <li>Technologies de l'information : transformation numérique, cybersécurité, développement logiciel.</li>
            <li>Agriculture : techniques agricoles modernes, chaînes de valeur, agro-industrie.</li>
            <li>Énergie : énergies renouvelables, efficacité énergétique, gestion des réseaux.</li>
            <li>Finance : structuration de fonds, microfinance, inclusion financière.</li>
            <li>Éducation : ingénierie pédagogique, formation professionnelle, enseignement supérieur.</li>
          </ul>

          <!-- 4. Le réseau des professionnels ivoiriens à l'étranger -->
          <h2>Le réseau des professionnels ivoiriens à l'étranger</h2>
          <p>La DMCRIE anime un réseau structuré de professionnels ivoiriens établis à l'étranger. Ce réseau vise à créer une communauté active et solidaire, capable de mutualiser ses ressources et ses compétences au service du développement national.</p>

          <h3>Organisation du réseau</h3>
          <p>Le réseau est organisé par zones géographiques et par secteurs d'activité. Des correspondants régionaux assurent l'animation des communautés locales et servent de relais avec la DMCRIE. Des rencontres annuelles, organisées dans les principales villes de résidence de la diaspora, permettent de renforcer les liens entre les membres et de présenter les opportunités de contribution.</p>

          <h3>Activités du réseau</h3>
          <ul>
            <li>Rencontres professionnelles thématiques organisées dans les pays de résidence.</li>
            <li>Webinaires mensuels sur les opportunités et les enjeux du développement en Côte d'Ivoire.</li>
            <li>Plateforme numérique de mise en relation entre les membres du réseau.</li>
            <li>Participation aux salons et forums économiques de la diaspora.</li>
            <li>Parrainage de jeunes professionnels ivoiriens par des membres expérimentés du réseau.</li>
          </ul>

          <!-- 5. Comment s'inscrire au répertoire -->
          <h2>Comment s'inscrire au répertoire</h2>
          <p>L'inscription au répertoire national des compétences est ouverte à tout ressortissant ivoirien résidant à l'étranger et disposant d'une qualification professionnelle ou d'une expertise avérée dans un domaine d'activité. La démarche est simple, gratuite et entièrement dématérialisée.</p>

          <div class="steps">
            <div class="step">
              <div class="step__number">1</div>
              <div class="step__content">
                <h3>Constitution du dossier</h3>
                <p>Préparez les éléments suivants : une pièce d'identité ivoirienne en cours de validité, un curriculum vitae à jour, les copies de vos diplômes et certifications, ainsi qu'une lettre de motivation précisant les domaines dans lesquels vous souhaitez contribuer.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">2</div>
              <div class="step__content">
                <h3>Soumission en ligne</h3>
                <p>Transmettez votre dossier par voie électronique via le formulaire disponible sur le site de la DGIE ou par courrier électronique à l'adresse dédiée de la DMCRIE. Vous recevrez un accusé de réception dans les 48 heures.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">3</div>
              <div class="step__content">
                <h3>Validation et inscription</h3>
                <p>Votre dossier est examiné par l'équipe de la DMCRIE. Après vérification des informations, votre profil est enregistré dans le répertoire. Vous recevez une confirmation d'inscription et un identifiant personnel vous permettant de mettre à jour vos informations à tout moment.</p>
              </div>
            </div>
            <div class="step">
              <div class="step__number">4</div>
              <div class="step__content">
                <h3>Mise en relation</h3>
                <p>Une fois inscrit, votre profil est consultable par les institutions et les organisations partenaires. Vous pouvez être sollicité pour des missions d'expertise, des programmes de mentorat ou des opportunités de collaboration en fonction de votre domaine de compétence.</p>
              </div>
            </div>
          </div>

          <!-- Info box -->
          <div class="info-box">
            <p>Vous souhaitez vous inscrire au répertoire national des compétences ou en savoir plus sur les programmes de transfert de compétences ? Contactez la DMCRIE via notre page de contact. Votre expertise est une richesse pour la Côte d'Ivoire.</p>
          </div>

          <!-- 6. Questions fréquentes -->
          <h2>Questions fréquentes</h2>

          <div class="faq">
            @forelse($faqs as $faq)
            <div class="faq__item">
              <button class="faq__question">{{ $faq->question }}</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">{!! $faq->answer !!}</div>
              </div>
            </div>
            @empty
            <div class="faq__item">
              <button class="faq__question">Faut-il résider à l'étranger pour s'inscrire au répertoire ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Oui, le répertoire est destiné aux Ivoiriens résidant à l'étranger. Cependant, si vous êtes récemment rentré en Côte d'Ivoire, vous pouvez également soumettre votre candidature.</div>
              </div>
            </div>
            <div class="faq__item">
              <button class="faq__question">Les missions d'expertise sont-elles rémunérées ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Les missions d'expertise court terme sont organisées sur une base volontaire. Les frais de transport et d'hébergement sont pris en charge par le programme.</div>
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
              <a href="{{ route('dossier.show', 'investissement-diaspora') }}">Investissement diaspora</a>
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
            <h3 class="sidebar-widget__title">Rejoignez le réseau</h3>
            <p>Vous êtes un professionnel ivoirien à l'étranger ? Inscrivez-vous au répertoire national des compétences et contribuez au développement de la Côte d'Ivoire.</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">S'inscrire</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
