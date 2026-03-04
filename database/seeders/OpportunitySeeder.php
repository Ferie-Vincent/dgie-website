<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Opportunity;

class OpportunitySeeder extends Seeder
{
    public function run(): void
    {
        $opportunities = [
            // ── EMPLOI ──────────────────────────────────────────
            [
                'title' => 'Recrutement de cadres de la diaspora — Ministère de l\'Économie et des Finances',
                'description' => 'Le Ministère de l\'Économie et des Finances lance un appel à candidatures pour le recrutement de cadres issus de la diaspora ivoirienne dans les domaines de la finance publique, l\'audit et le contrôle de gestion.',
                'content' => '<p>Dans le cadre du renforcement des capacités de l\'administration publique, le Ministère de l\'Économie et des Finances recrute des cadres de haut niveau issus de la diaspora ivoirienne.</p><h3>Profils recherchés</h3><ul><li>Experts en finances publiques (BAC+5 minimum)</li><li>Auditeurs internes certifiés (CIA, CISA)</li><li>Contrôleurs de gestion senior</li><li>Analystes financiers (CFA souhaité)</li></ul><h3>Conditions</h3><ul><li>Nationalité ivoirienne</li><li>Minimum 5 ans d\'expérience à l\'international</li><li>Disponibilité pour une prise de poste à Abidjan</li></ul><h3>Avantages</h3><ul><li>Rémunération compétitive alignée sur les standards internationaux</li><li>Aide à la réinstallation</li><li>Logement de fonction pendant 6 mois</li></ul>',
                'type' => 'emploi',
                'organisme' => 'Ministère de l\'Économie et des Finances',
                'location' => 'Abidjan, Plateau',
                'url' => 'https://www.finances.gouv.ci',
                'date_limite' => '2026-06-30',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Programme « Talents de la Diaspora » — Orange Côte d\'Ivoire',
                'description' => 'Orange CI recrute des ingénieurs et managers de la diaspora pour renforcer ses équipes dans les domaines du numérique, de la data science et de la cybersécurité.',
                'content' => '<p>Orange Côte d\'Ivoire lance la 3ème édition de son programme « Talents de la Diaspora » visant à attirer les compétences ivoiriennes établies à l\'étranger.</p><h3>Postes ouverts</h3><ul><li>Data Scientists / ML Engineers</li><li>Architectes Cloud & DevOps</li><li>Experts Cybersécurité</li><li>Product Managers Digital</li><li>Responsables Marketing Digital</li></ul><h3>Package</h3><ul><li>Salaire compétitif + bonus de performance</li><li>Billet d\'avion aller-retour</li><li>3 mois de logement pris en charge</li><li>Accompagnement administratif (visa, déménagement)</li></ul>',
                'type' => 'emploi',
                'organisme' => 'Orange Côte d\'Ivoire',
                'location' => 'Abidjan, Marcory',
                'url' => 'https://www.orange.ci/fr/carrieres',
                'date_limite' => '2026-05-15',
                'is_featured' => false,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Recrutement d\'enseignants-chercheurs — Université Félix Houphouët-Boigny',
                'description' => 'L\'Université FHB d\'Abidjan recrute des enseignants-chercheurs de la diaspora pour ses facultés de sciences, médecine et ingénierie. Postes de Maître de Conférences et Professeur Titulaire.',
                'content' => '<p>L\'Université Félix Houphouët-Boigny, première université de Côte d\'Ivoire, ouvre 25 postes d\'enseignants-chercheurs pour renforcer ses départements stratégiques.</p><h3>Disciplines prioritaires</h3><ul><li>Intelligence Artificielle et Sciences des Données</li><li>Énergies Renouvelables</li><li>Biotechnologie et Génie Génétique</li><li>Médecine spécialisée (cardiologie, oncologie)</li><li>Génie Civil et Urbanisme</li></ul><h3>Conditions</h3><ul><li>Doctorat obtenu dans une université reconnue</li><li>Publications dans des revues indexées</li><li>Expérience d\'enseignement supérieur</li></ul>',
                'type' => 'emploi',
                'organisme' => 'Université Félix Houphouët-Boigny',
                'location' => 'Abidjan, Cocody',
                'url' => null,
                'date_limite' => '2026-07-31',
                'is_featured' => false,
                'is_active' => true,
                'order' => 3,
            ],

            // ── INVESTISSEMENT ──────────────────────────────────
            [
                'title' => 'Zone Économique Spéciale de Grand-Bassam — Lots industriels disponibles',
                'description' => 'Le CEPICI met à disposition des lots industriels viabilisés dans la nouvelle Zone Économique Spéciale de Grand-Bassam, avec des avantages fiscaux exceptionnels pour les investisseurs de la diaspora.',
                'content' => '<p>La Zone Économique Spéciale (ZES) de Grand-Bassam offre un cadre idéal pour les investisseurs de la diaspora souhaitant implanter une activité industrielle ou de services en Côte d\'Ivoire.</p><h3>Avantages</h3><ul><li>Exonération d\'impôts sur les bénéfices pendant 5 ans</li><li>TVA réduite sur les équipements importés</li><li>Terrain viabilisé (eau, électricité, fibre optique)</li><li>Proximité du port autonome d\'Abidjan (35 km)</li></ul><h3>Secteurs ciblés</h3><ul><li>Transformation agroalimentaire</li><li>Industrie pharmaceutique</li><li>Technologies de l\'information</li><li>Logistique et entreposage</li></ul><h3>Guichet unique</h3><p>Un accompagnement personnalisé est assuré par le CEPICI pour toutes les démarches administratives (création d\'entreprise en 24h).</p>',
                'type' => 'investissement',
                'organisme' => 'CEPICI — Centre de Promotion des Investissements en Côte d\'Ivoire',
                'location' => 'Grand-Bassam',
                'url' => 'https://www.cepici.gouv.ci',
                'date_limite' => null,
                'is_featured' => true,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Programme immobilier « Diaspora Habitat » — 5 000 logements à Abidjan',
                'description' => 'Le gouvernement lance un programme de 5 000 logements sociaux et économiques réservés aux Ivoiriens de la diaspora, avec des facilités de paiement échelonné depuis l\'étranger.',
                'content' => '<p>Le Ministère de la Construction, du Logement et de l\'Urbanisme, en partenariat avec la SICOGI, lance le programme « Diaspora Habitat » pour faciliter l\'accès à la propriété aux Ivoiriens vivant à l\'étranger.</p><h3>Types de logements</h3><ul><li>Appartements F3 : à partir de 18 000 000 FCFA</li><li>Appartements F4 : à partir de 25 000 000 FCFA</li><li>Villas basse standing : à partir de 30 000 000 FCFA</li><li>Villas moyen standing : à partir de 45 000 000 FCFA</li></ul><h3>Sites disponibles</h3><ul><li>Cocody — Riviera Palmeraie</li><li>Bingerville — Extension</li><li>Grand-Bassam — Azuretti</li><li>Songon — Nouveau quartier</li></ul><h3>Facilités de paiement</h3><ul><li>Apport initial : 20% du prix</li><li>Paiement échelonné sur 15 ans via virement international</li><li>Partenariat avec banques ivoiriennes pour crédit diaspora</li></ul>',
                'type' => 'investissement',
                'organisme' => 'Ministère de la Construction / SICOGI',
                'location' => 'Abidjan et périphérie',
                'url' => null,
                'date_limite' => '2026-12-31',
                'is_featured' => true,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Fonds d\'investissement « Diaspora Business Angels » — Appel à souscription',
                'description' => 'Lancement d\'un fonds d\'investissement dédié aux startups ivoiriennes, ouvert aux souscriptions de la diaspora à partir de 500 000 FCFA.',
                'content' => '<p>La Bourse Régionale des Valeurs Mobilières (BRVM) et le Ministère des Affaires Étrangères, en collaboration avec la DGIE, lancent le fonds « Diaspora Business Angels ».</p><h3>Objectif</h3><p>Mobiliser l\'épargne de la diaspora pour financer les startups innovantes ivoiriennes dans les secteurs de la technologie, l\'agriculture et la santé.</p><h3>Modalités</h3><ul><li>Souscription minimale : 500 000 FCFA (≈ 760 EUR)</li><li>Rendement cible : 8-12% par an</li><li>Durée : 5 ans avec possibilité de sortie anticipée</li><li>Gestion assurée par un fonds agréé par la BRVM</li></ul><h3>Startups du portefeuille</h3><ul><li>AgriTech : solutions de traçabilité cacao/café</li><li>FinTech : paiement mobile et transfert d\'argent</li><li>HealthTech : télémédecine rurale</li><li>EdTech : formation professionnelle en ligne</li></ul>',
                'type' => 'investissement',
                'organisme' => 'BRVM / DGIE',
                'location' => 'Abidjan',
                'url' => 'https://www.brvm.org',
                'date_limite' => '2026-09-30',
                'is_featured' => false,
                'is_active' => true,
                'order' => 6,
            ],

            // ── FORMATION ───────────────────────────────────────
            [
                'title' => 'Programme de formation « Entreprendre en Côte d\'Ivoire » — Session 2026',
                'description' => 'Formation gratuite de 3 mois pour les Ivoiriens de la diaspora souhaitant créer ou développer une entreprise en Côte d\'Ivoire. Modules en ligne + bootcamp à Abidjan.',
                'content' => '<p>Le programme « Entreprendre en Côte d\'Ivoire » est une initiative conjointe de la DGIE et de la Chambre de Commerce et d\'Industrie de Côte d\'Ivoire (CCI-CI).</p><h3>Programme</h3><ul><li><strong>Phase 1 — En ligne (8 semaines) :</strong> Environnement des affaires en CI, cadre juridique et fiscal, étude de marché, business plan</li><li><strong>Phase 2 — Bootcamp Abidjan (2 semaines) :</strong> Immersion terrain, rencontres avec des entrepreneurs, visites d\'entreprises, mentorat</li><li><strong>Phase 3 — Accompagnement (4 semaines) :</strong> Suivi personnalisé, mise en relation avec des partenaires</li></ul><h3>Prise en charge</h3><ul><li>Formation entièrement gratuite</li><li>Billet d\'avion A/R pour le bootcamp (sous conditions)</li><li>Hébergement à Abidjan pendant le bootcamp</li></ul><h3>Profil recherché</h3><ul><li>Ivoirien de la diaspora (toute zone géographique)</li><li>Porteur d\'un projet entrepreneurial viable</li><li>Disponibilité pour les sessions en ligne et le bootcamp</li></ul>',
                'type' => 'formation',
                'organisme' => 'DGIE / CCI-CI',
                'location' => 'En ligne + Abidjan',
                'url' => null,
                'date_limite' => '2026-04-30',
                'is_featured' => false,
                'is_active' => true,
                'order' => 7,
            ],
            [
                'title' => 'Certification numérique « Digital Côte d\'Ivoire » — 500 places',
                'description' => 'Programme de certification en compétences numériques (développement web, data, cybersécurité) financé par l\'État, destiné aux jeunes de la diaspora souhaitant travailler dans le secteur tech ivoirien.',
                'content' => '<p>Le Ministère de la Transition Numérique et de la Digitalisation, en partenariat avec l\'Agence Nationale du Service Universel des Télécommunications (ANSUT), lance le programme « Digital Côte d\'Ivoire ».</p><h3>Parcours proposés</h3><ul><li><strong>Développement Web & Mobile :</strong> 6 mois — HTML/CSS, JavaScript, React, Laravel, Flutter</li><li><strong>Data Science & IA :</strong> 6 mois — Python, Machine Learning, Big Data, Visualisation</li><li><strong>Cybersécurité :</strong> 4 mois — Sécurité réseau, Ethical Hacking, Conformité</li><li><strong>Marketing Digital :</strong> 3 mois — SEO/SEA, Social Media, E-commerce</li></ul><h3>Modalités</h3><ul><li>Formation 100% en ligne</li><li>Certification reconnue par l\'État ivoirien</li><li>Stage garanti dans une entreprise tech ivoirienne</li></ul>',
                'type' => 'formation',
                'organisme' => 'Ministère de la Transition Numérique / ANSUT',
                'location' => 'En ligne',
                'url' => null,
                'date_limite' => '2026-05-31',
                'is_featured' => false,
                'is_active' => true,
                'order' => 8,
            ],
            [
                'title' => 'Ateliers « Retour & Réintégration » — Accompagnement personnalisé',
                'description' => 'Ateliers mensuels gratuits pour les Ivoiriens de la diaspora préparant un retour en Côte d\'Ivoire : démarches administratives, insertion professionnelle, logement, scolarité des enfants.',
                'content' => '<p>La DGIE organise chaque mois des ateliers en visioconférence pour accompagner les membres de la diaspora dans leur projet de retour en Côte d\'Ivoire.</p><h3>Thèmes abordés</h3><ul><li><strong>Démarches administratives :</strong> transfert de résidence fiscale, reconnaissance de diplômes, immatriculation consulaire</li><li><strong>Emploi :</strong> marché du travail ivoirien, secteurs porteurs, rédaction de CV adapté</li><li><strong>Logement :</strong> quartiers, prix du marché, conseils pour la location/achat</li><li><strong>Famille :</strong> scolarisation des enfants, système de santé, vie quotidienne</li></ul><h3>Format</h3><ul><li>Sessions en visioconférence (Zoom) — 2h par atelier</li><li>Calendrier : 1er samedi de chaque mois, 14h (UTC) / 15h (Paris)</li><li>Inscription gratuite, places limitées à 50 participants</li></ul>',
                'type' => 'formation',
                'organisme' => 'DGIE',
                'location' => 'En ligne (visioconférence)',
                'url' => null,
                'date_limite' => null,
                'is_featured' => false,
                'is_active' => true,
                'order' => 9,
            ],

            // ── BOURSE ──────────────────────────────────────────
            [
                'title' => 'Bourses d\'excellence « Houphouët-Boigny » pour la diaspora — Master & Doctorat',
                'description' => 'Le gouvernement offre 100 bourses d\'excellence aux enfants de la diaspora ivoirienne pour poursuivre des études de Master ou Doctorat dans les universités publiques de Côte d\'Ivoire.',
                'content' => '<p>Le Ministère de l\'Enseignement Supérieur et de la Recherche Scientifique lance la 2ème édition des bourses d\'excellence « Houphouët-Boigny » destinées aux jeunes de la diaspora.</p><h3>Montant de la bourse</h3><ul><li><strong>Master :</strong> 250 000 FCFA/mois pendant 2 ans</li><li><strong>Doctorat :</strong> 350 000 FCFA/mois pendant 3 ans</li><li>Billet d\'avion A/R pris en charge</li><li>Logement en résidence universitaire</li></ul><h3>Universités partenaires</h3><ul><li>Université Félix Houphouët-Boigny (Abidjan)</li><li>Université Nangui Abrogoua (Abidjan)</li><li>INP-HB (Yamoussoukro)</li><li>Université Jean Lorougnon Guédé (Daloa)</li></ul><h3>Conditions</h3><ul><li>Avoir la nationalité ivoirienne ou être d\'origine ivoirienne</li><li>Être titulaire d\'une Licence (pour le Master) ou d\'un Master (pour le Doctorat)</li><li>Avoir moins de 35 ans (Master) ou 40 ans (Doctorat)</li><li>Résider à l\'étranger depuis au moins 2 ans</li></ul>',
                'type' => 'bourse',
                'organisme' => 'Ministère de l\'Enseignement Supérieur',
                'location' => 'Abidjan / Yamoussoukro / Daloa',
                'url' => null,
                'date_limite' => '2026-08-15',
                'is_featured' => false,
                'is_active' => true,
                'order' => 10,
            ],
            [
                'title' => 'Bourse de recherche « Innovation Agricole » — CNRA',
                'description' => 'Le Centre National de Recherche Agronomique offre 20 bourses de recherche aux chercheurs de la diaspora dans les domaines du cacao, de l\'hévéa, du palmier à huile et des cultures vivrières.',
                'content' => '<p>Le CNRA, en partenariat avec la Banque Mondiale, finance des projets de recherche portés par des chercheurs ivoiriens de la diaspora.</p><h3>Domaines de recherche</h3><ul><li>Amélioration variétale du cacaoyer</li><li>Lutte biologique contre les ravageurs</li><li>Agriculture de précision et IoT</li><li>Transformation et valorisation des produits agricoles</li></ul><h3>Financement</h3><ul><li>Bourse de recherche : jusqu\'à 15 000 000 FCFA par projet</li><li>Équipement de laboratoire fourni</li><li>Hébergement sur le campus du CNRA</li><li>Durée : 12 à 24 mois</li></ul>',
                'type' => 'bourse',
                'organisme' => 'CNRA — Centre National de Recherche Agronomique',
                'location' => 'Abidjan / Bouaké / Gagnoa',
                'url' => 'https://www.cnra.ci',
                'date_limite' => '2026-06-15',
                'is_featured' => false,
                'is_active' => true,
                'order' => 11,
            ],

            // ── APPEL À PROJETS ─────────────────────────────────
            [
                'title' => 'Appel à projets « Diaspora Innov\' » — Fonds de soutien aux startups',
                'description' => 'Le FSDCI lance un appel à projets innovants portés par la diaspora ivoirienne. Financement de 5 à 50 millions FCFA pour les projets sélectionnés dans le numérique, l\'agriculture et la santé.',
                'content' => '<p>Le Fonds de Soutien au Développement de la Côte d\'Ivoire (FSDCI), en partenariat avec la DGIE, lance l\'appel à projets « Diaspora Innov\' » pour soutenir les initiatives entrepreneuriales de la diaspora.</p><h3>Montant du financement</h3><ul><li><strong>Amorçage :</strong> 5 000 000 à 15 000 000 FCFA (projets en phase d\'idéation)</li><li><strong>Développement :</strong> 15 000 000 à 30 000 000 FCFA (projets avec prototype)</li><li><strong>Accélération :</strong> 30 000 000 à 50 000 000 FCFA (projets avec premiers revenus)</li></ul><h3>Secteurs éligibles</h3><ul><li>Technologies numériques (FinTech, EdTech, HealthTech, AgriTech)</li><li>Agriculture et agroalimentaire</li><li>Santé et bien-être</li><li>Énergie et environnement</li><li>Industries créatives et culturelles</li></ul><h3>Accompagnement</h3><ul><li>Mentorat par des entrepreneurs expérimentés</li><li>Incubation pendant 6 mois au Village de l\'Innovation d\'Abidjan</li><li>Mise en réseau avec des investisseurs</li></ul>',
                'type' => 'appel_a_projets',
                'organisme' => 'FSDCI / DGIE',
                'location' => 'Abidjan',
                'url' => null,
                'date_limite' => '2026-07-15',
                'is_featured' => true,
                'is_active' => true,
                'order' => 12,
            ],
            [
                'title' => 'Concours « Ma Commune, Mon Projet » — Développement local',
                'description' => 'Appel à projets pour les Ivoiriens de la diaspora souhaitant contribuer au développement de leur commune d\'origine. Subvention jusqu\'à 20 millions FCFA par projet.',
                'content' => '<p>Le Ministère de l\'Intérieur et de la Sécurité, en partenariat avec le PNUD, lance le concours « Ma Commune, Mon Projet » pour encourager la diaspora à investir dans le développement local.</p><h3>Types de projets éligibles</h3><ul><li>Infrastructures communautaires (centres de santé, écoles, bibliothèques)</li><li>Accès à l\'eau potable et assainissement</li><li>Énergie solaire pour les zones rurales</li><li>Marchés et centres commerciaux communautaires</li><li>Centres de formation professionnelle</li></ul><h3>Financement</h3><ul><li>Subvention de l\'État : jusqu\'à 20 000 000 FCFA (50% du coût total)</li><li>Contribution du porteur de projet : minimum 30%</li><li>Contribution de la commune : minimum 20%</li></ul><h3>Critères de sélection</h3><ul><li>Impact social mesurable</li><li>Viabilité économique du projet</li><li>Implication de la communauté locale</li><li>Innovation dans l\'approche</li></ul>',
                'type' => 'appel_a_projets',
                'organisme' => 'Ministère de l\'Intérieur / PNUD',
                'location' => 'Toutes communes de Côte d\'Ivoire',
                'url' => null,
                'date_limite' => '2026-08-31',
                'is_featured' => false,
                'is_active' => true,
                'order' => 13,
            ],
            [
                'title' => 'Programme « Agripreneurs Diaspora » — Filières cacao, anacarde et mangue',
                'description' => 'Appel à candidatures pour des projets agro-industriels portés par la diaspora dans les filières stratégiques. Accompagnement technique + financement jusqu\'à 75 millions FCFA.',
                'content' => '<p>Le Ministère de l\'Agriculture et du Développement Rural, en collaboration avec le Conseil du Café-Cacao et le Conseil du Coton et de l\'Anacarde, lance le programme « Agripreneurs Diaspora ».</p><h3>Filières prioritaires</h3><ul><li><strong>Cacao :</strong> transformation locale (chocolaterie, beurre de cacao, cosmétiques)</li><li><strong>Anacarde :</strong> unités de transformation de noix de cajou</li><li><strong>Mangue :</strong> séchage, jus, purée pour l\'exportation</li><li><strong>Hévéa :</strong> transformation du caoutchouc naturel</li></ul><h3>Package</h3><ul><li>Financement : 25 000 000 à 75 000 000 FCFA</li><li>Terrain agricole mis à disposition (bail emphytéotique)</li><li>Formation technique par des experts du CNRA</li><li>Accès facilité aux marchés d\'exportation</li></ul><h3>Processus de sélection</h3><ol><li>Soumission du dossier en ligne</li><li>Présélection sur dossier (30 projets)</li><li>Pitch devant un jury (15 projets retenus)</li><li>Incubation de 3 mois + financement</li></ol>',
                'type' => 'appel_a_projets',
                'organisme' => 'Ministère de l\'Agriculture / Conseil Café-Cacao',
                'location' => 'Zones agricoles — San-Pédro, Bouaké, Korhogo, Man',
                'url' => null,
                'date_limite' => '2026-09-15',
                'is_featured' => false,
                'is_active' => true,
                'order' => 14,
            ],

            // ── Opportunité expirée (pour tester l'affichage) ───
            [
                'title' => 'Forum Économique de la Diaspora Ivoirienne — Édition 2025',
                'description' => 'Le Forum annuel de la diaspora ivoirienne s\'est tenu à Abidjan en décembre 2025. Retour sur les opportunités présentées lors de cet événement.',
                'content' => '<p>Le Forum Économique de la Diaspora Ivoirienne 2025 a rassemblé plus de 500 participants venus de 30 pays.</p>',
                'type' => 'formation',
                'organisme' => 'DGIE',
                'location' => 'Abidjan, Sofitel Hôtel Ivoire',
                'url' => null,
                'date_limite' => '2025-12-15',
                'is_featured' => false,
                'is_active' => true,
                'order' => 15,
            ],
        ];

        foreach ($opportunities as $data) {
            Opportunity::updateOrCreate(['title' => $data['title']], $data);
        }
    }
}
