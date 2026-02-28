@extends('front-end.layouts.app')

@section('title', 'Cadre juridique et textes de référence — DGIE')

@section('meta')
  <meta name="description" content="Le cadre juridique de la DGIE : décret de création, textes organiques, politique nationale de migration, conventions internationales et accords bilatéraux.">
  <meta property="og:title" content="Cadre juridique et textes de référence — DGIE">
  <meta property="og:description" content="L'ensemble du cadre normatif qui régit l'action de la DGIE et la politique migratoire ivoirienne.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <meta property="og:locale" content="fr_CI">
  <meta property="og:url" content="https://www.dgie.gouv.ci/pages/dossier-cadre-juridique.html">
  <meta property="og:site_name" content="DGIE — Direction Générale des Ivoiriens de l'Extérieur">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Cadre juridique et textes de référence — DGIE">
  <meta name="twitter:description" content="L'ensemble du cadre normatif qui régit l'action de la DGIE et la politique migratoire ivoirienne.">
  <meta name="twitter:image" content="https://www.dgie.gouv.ci/assets/images/logo-dgie.png">
  <link rel="canonical" href="{{ url('/dossiers/cadre-juridique') }}">
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
        <span>Cadre juridique et textes de référence</span>
      </div>
      <h1 class="page-hero__title">Cadre juridique et textes de référence</h1>
      <p class="page-hero__subtitle">L'ensemble du cadre normatif qui fonde et encadre l'action de la DGIE.</p>
    </div>
  </section>

  <!-- CONTENU PRINCIPAL -->
  <section class="content">
    <div class="container">
      <div class="content__grid">

        <!-- Colonne principale -->
        <div class="content__main">

          <!-- 1. Décret de création de la DGIE -->
          <h2>Le décret de création de la DGIE</h2>
          <p>La Direction Générale des Ivoiriens de l'Extérieur (DGIE) a été créée par décret pour répondre à la nécessité de doter la Côte d'Ivoire d'une structure dédiée à la gestion de la relation avec sa diaspora et à l'accompagnement des migrants de retour. Ce décret fondateur définit les missions, l'organisation et le rattachement institutionnel de la DGIE.</p>
          <p>La DGIE est placée sous la tutelle du Ministère des Affaires Étrangères, de l'Intégration Africaine et de la Diaspora. Elle constitue la structure opérationnelle de l'État en matière de politique migratoire et de relation avec les Ivoiriens établis à l'étranger.</p>
          <p>Le décret de création confie à la DGIE les missions suivantes :</p>
          <ul>
            <li>Accueillir, orienter et accompagner les Ivoiriens de retour dans leur réinsertion socio-économique.</li>
            <li>Mobiliser les compétences et les ressources de la diaspora au service du développement national.</li>
            <li>Assurer la prise en charge sociale des migrants en situation de vulnérabilité.</li>
            <li>Contribuer à l'élaboration et à la mise en oeuvre de la politique nationale de migration.</li>
            <li>Développer les partenariats avec les organisations internationales et les pays partenaires.</li>
          </ul>

          <!-- 2. Textes organiques -->
          <h2>Les textes organiques</h2>
          <p>Au-delà du décret de création, l'organisation et le fonctionnement de la DGIE sont régis par un ensemble de textes réglementaires qui précisent les attributions de chaque direction et les modalités de fonctionnement interne.</p>

          <h3>Attributions et organisation</h3>
          <p>La DGIE est structurée en trois sous-directions, chacune dotée de compétences spécifiques :</p>
          <ul>
            <li><strong>DAOSAR</strong> (Direction de l'Accueil, de l'Orientation, du Suivi et de l'Aide à la Réinsertion) : en charge de l'accueil des migrants de retour, de l'évaluation de leurs besoins, de l'orientation vers les programmes de réinsertion et du suivi individualisé de chaque bénéficiaire.</li>
            <li><strong>DMCRIE</strong> (Direction de la Mobilisation des Compétences et des Ressources des Ivoiriens de l'Extérieur) : responsable du recensement des compétences de la diaspora, de la facilitation de l'investissement et de la mise en relation entre la diaspora et les opportunités de développement en Côte d'Ivoire.</li>
            <li><strong>DAS</strong> (Direction de l'Action Sociale) : chargée de la prise en charge sociale des personnes vulnérables, de l'aide d'urgence, du soutien psychosocial et de la médiation administrative.</li>
          </ul>

          <h3>Fonctionnement interne</h3>
          <p>Les textes organiques définissent également les procédures de gestion administrative, les règles de coordination entre les directions et les mécanismes de reporting. Un comité de direction se réunit régulièrement pour assurer la cohérence de l'action de la DGIE et le suivi de la mise en oeuvre des programmes.</p>

          <!-- 3. Politique nationale de migration -->
          <h2>La politique nationale de migration</h2>
          <p>La Côte d'Ivoire s'est dotée d'une politique nationale de migration qui constitue le cadre stratégique de l'action de l'État en matière migratoire. Cette politique, élaborée avec l'appui des partenaires internationaux, vise à assurer une gestion ordonnée, régulière et responsable des flux migratoires.</p>

          <h3>Objectifs stratégiques</h3>
          <p>La politique nationale de migration poursuit plusieurs objectifs complémentaires :</p>
          <ul>
            <li>Protéger les droits des migrants ivoiriens à l'étranger et des étrangers en Côte d'Ivoire.</li>
            <li>Faciliter la contribution de la migration au développement économique et social du pays.</li>
            <li>Prévenir et lutter contre la migration irrégulière et ses conséquences.</li>
            <li>Renforcer la gouvernance migratoire et la coordination interinstitutionnelle.</li>
            <li>Améliorer la collecte et l'analyse des données migratoires pour des politiques fondées sur les faits.</li>
          </ul>

          <h3>Rôle de la DGIE</h3>
          <p>Dans le cadre de cette politique, la DGIE joue un rôle opérationnel central. Elle met en oeuvre les volets relatifs à l'accueil et à la réinsertion des migrants de retour, à la mobilisation de la diaspora et à l'accompagnement social. Elle participe également aux instances de coordination interministérielle sur les questions migratoires.</p>

          <!-- 4. Conventions internationales -->
          <h2>Les conventions internationales ratifiées par la Côte d'Ivoire</h2>
          <p>La Côte d'Ivoire a ratifié un ensemble de conventions internationales qui constituent le socle juridique de la protection des droits des migrants et des réfugiés. Ces instruments internationaux guident l'action de la DGIE et de l'ensemble des acteurs de la gouvernance migratoire.</p>

          <h3>Convention de Genève relative au statut des réfugiés (1951)</h3>
          <p>La Convention de Genève de 1951, complétée par le Protocole de 1967, définit le statut de réfugié et les obligations des États en matière de protection internationale. La Côte d'Ivoire, en tant qu'État partie, s'engage à ne pas refouler les personnes qui craignent avec raison d'être persécutées et à leur accorder une protection sur son territoire.</p>

          <h3>Protocole de Palerme contre la traite des personnes (2000)</h3>
          <p>Le Protocole additionnel à la Convention des Nations Unies contre la criminalité transnationale organisée, dit Protocole de Palerme, vise à prévenir, réprimer et punir la traite des personnes, en particulier des femmes et des enfants. La Côte d'Ivoire a ratifié ce protocole et s'engage à protéger les victimes de traite et à poursuivre les auteurs de ces infractions.</p>

          <h3>Convention internationale sur la protection des droits de tous les travailleurs migrants (1990)</h3>
          <p>Cette convention des Nations Unies établit les droits fondamentaux des travailleurs migrants et des membres de leur famille, qu'ils soient en situation régulière ou irrégulière. Elle vise à promouvoir le respect des droits humains des migrants dans toutes les phases du processus migratoire.</p>

          <h3>Convention de l'Union africaine sur la protection et l'assistance aux personnes déplacées en Afrique (Convention de Kampala, 2009)</h3>
          <p>La Convention de Kampala constitue le premier instrument juridique continental contraignant sur les déplacements forcés en Afrique. Elle couvre les personnes déplacées internes et oblige les États à prévenir les déplacements arbitraires et à protéger les personnes déplacées.</p>

          <h3>Pacte mondial pour des migrations sûres, ordonnées et régulières (2018)</h3>
          <p>Le Pacte mondial sur les migrations, adopté à Marrakech en 2018, constitue un cadre de coopération non contraignant couvrant l'ensemble des dimensions de la migration internationale. La Côte d'Ivoire a adhéré à ce pacte et s'engage à mettre en oeuvre ses 23 objectifs au niveau national.</p>

          <!-- 5. Accords bilatéraux -->
          <h2>Les accords bilatéraux</h2>
          <p>En complément du cadre multilatéral, la Côte d'Ivoire a conclu plusieurs accords bilatéraux avec des États partenaires pour encadrer les flux migratoires, protéger ses ressortissants à l'étranger et organiser la coopération en matière de retour et de réintégration.</p>

          <h3>Accords de réadmission</h3>
          <p>Des accords de réadmission ont été conclus avec plusieurs pays pour organiser les conditions du retour des ressortissants ivoiriens en situation irrégulière. Ces accords garantissent que le retour s'effectue dans le respect de la dignité des personnes et prévoient des mécanismes d'accompagnement à la réinsertion.</p>

          <h3>Accords de coopération migratoire</h3>
          <p>La Côte d'Ivoire a signé des accords de coopération migratoire avec plusieurs pays, notamment :</p>
          <ul>
            <li><strong>France</strong> : accord de gestion concertée des flux migratoires couvrant l'admission au séjour, la lutte contre l'immigration irrégulière, la coopération policière et le développement solidaire.</li>
            <li><strong>Allemagne</strong> : accord de coopération portant sur la migration de travail, la formation professionnelle et le retour volontaire.</li>
            <li><strong>Maroc</strong> : accord de coopération en matière de lutte contre la migration irrégulière et de protection des migrants en transit.</li>
            <li><strong>États de la CEDEAO</strong> : protocole sur la libre circulation des personnes, le droit de résidence et d'établissement, facilitant la mobilité régionale des Ivoiriens dans l'espace communautaire.</li>
          </ul>

          <h3>Conventions consulaires</h3>
          <p>La Côte d'Ivoire a conclu des conventions consulaires avec plusieurs États afin de garantir la protection de ses ressortissants à l'étranger. Ces conventions définissent les droits et obligations des autorités consulaires et les mécanismes de coopération en cas de difficulté rencontrée par un ressortissant ivoirien.</p>

          <!-- Info box -->
          <div class="info-box">
            <p>Les textes juridiques mentionnés dans ce dossier sont présentés à titre informatif. Pour toute question relative à l'application de ces textes, veuillez contacter la DGIE ou consulter un professionnel du droit.</p>
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
              <button class="faq__question">Quel est le texte fondateur de la DGIE ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">La DGIE a été créée par décret, placée sous la tutelle du Ministère des Affaires Étrangères, de l'Intégration Africaine et de la Diaspora.</div>
              </div>
            </div>
            <div class="faq__item">
              <button class="faq__question">Quels sont les droits des Ivoiriens dans l'espace CEDEAO ?</button>
              <div class="faq__answer">
                <div class="faq__answer-inner">Le protocole de la CEDEAO sur la libre circulation des personnes garantit aux ressortissants des États membres le droit d'entrer, de séjourner et de s'établir dans tout État de la communauté.</div>
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
              <a href="{{ route('dossier.show', 'accompagnement-social') }}">Accompagnement social</a>
              <a href="{{ route('la-dgie') }}">La DGIE</a>
              <a href="{{ route('dossiers') }}">Tous les dossiers</a>
            </div>
          </div>
          <div class="sidebar-widget">
            <h3 class="sidebar-widget__title">Textes clés</h3>
            <p>Décret de création de la DGIE, Convention de Genève (1951), Protocole de Palerme (2000), Pacte mondial sur les migrations (2018).</p>
            <a href="{{ route('contact') }}" class="btn btn--primary" style="margin-top: 12px; display: inline-block;">Contactez-nous</a>
          </div>
        </aside>

      </div>
    </div>
  </section>
@endsection
