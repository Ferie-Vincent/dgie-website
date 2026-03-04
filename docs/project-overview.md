# Vue d'Ensemble du Projet — DGIE Laravel

## Résumé Exécutif

Application web full-stack pour la **Direction Générale des Ivoiriens de l'Extérieur (DGIE)**, rattachée au Ministère des Affaires Étrangères de Côte d'Ivoire. Migrée d'un site statique HTML/CSS/JS vers Laravel 12 avec panneau d'administration complet. Entièrement en français, ton institutionnel (vouvoiement).

**Production** : https://ivoiriendelexterieur.com

---

## Informations Clés

| Attribut | Valeur |
|----------|--------|
| Framework | Laravel 12 / PHP 8.3.14 |
| Base de données | MySQL (MAMP dev / Plesk prod) |
| Templates | Blade (rendu serveur) |
| CSS | 2 fichiers manuels (~14 100 lignes), pas de framework |
| Build | Vite 7.x |
| CI/CD | GitHub Actions → FTP (lftp) → Plesk |
| Hébergement | Plesk (51.15.161.204) |
| Langue | Français exclusivement |

---

## Périmètre Fonctionnel

### Site Public (Front-End)
- **Accueil** : articles vedettes, galerie, événements, staff, bannières, magazines
- **Actualités** : liste d'articles avec filtres (catégorie, section, date, recherche)
- **Pages institutionnelles** : La DGIE, Nos services, Retour & réintégration, Investir & contribuer
- **Coin des diaspos** : événements diaspora, témoignages, pays, culture, sondage, toolkit
- **Galerie & Médiathèque** : albums photo/vidéo, vidéos YouTube
- **Dossiers thématiques** : contenus structurés par département
- **Contact** : formulaire avec FAQ
- **Recherche globale** : articles, dossiers, événements
- **Newsletter** : inscription publique
- **Commentaires** : soumission publique (modération admin)

### Panneau d'Administration
- **18 modules CRUD** : articles, catégories, dossiers, événements, flash infos, galerie, staff, partenaires, pays, sondages, documents, départements, témoignages, items culturels, toolkit, bannières, FAQs, magazines
- **Modération** : commentaires (approuver/rejeter), messages de contact (répondre)
- **Newsletter** : gestion des abonnés
- **Paramètres** : configuration site (footer, réseaux sociaux, général)
- **Utilisateurs** : CRUD complet (super-admin uniquement)
- **Profil** : avatar, modification nom/email, timeline d'activité, graphiques Chart.js
- **Dashboard** : statistiques globales, activité récente

---

## Rôles Utilisateur

| Rôle | Accès |
|------|-------|
| `super-admin` | Tout + gestion utilisateurs + vue globale profil + leaderboard |
| `editeur` | CRUD complet sur tout le contenu |
| `redacteur` | Accès limité (consultation) |

---

## Chiffres Clés

| Métrique | Valeur |
|----------|--------|
| Modèles Eloquent | 28 |
| Contrôleurs | 38 (26 admin + 12 front) |
| Vues Blade | 111 |
| Migrations | 48 |
| Seeders | 7 |
| Middleware | 4 |
| Mailables | 3 |
| Routes | 100+ |
| Tables MySQL | 28 |
| Fichiers CSS | 2 (~14 100 lignes) |

---

## Dépendances Principales

### PHP (Composer)
- `laravel/framework` ^12.0
- `laravel/tinker` ^2.10.1
- Extensions : mbstring, xml, ctype, json, bcmath, curl, gd, intl, zip, pdo_mysql

### JavaScript (npm)
- `vite` ^7.0.7
- `laravel-vite-plugin` ^2.0.0
- `axios` ^1.11.0
- `tailwindcss` ^4.0.0 (installé mais non utilisé — CSS manuel)
- `concurrently` ^9.0.1

### CDN
- **Chart.js** 4.4.7 (graphiques profil/dashboard)
- **CKEditor 5** 43.3.1 (éditeur WYSIWYG)

---

## Points d'Attention pour les Développeurs

1. **Pas de framework CSS** : malgré Tailwind dans `package.json`, tout le CSS est écrit manuellement
2. **Directives Blade différentes** : front-end utilise `@push/@endpush`, admin utilise `@section/@endsection`
3. **Versioning CSS** : incrémenter `?v=N` dans les layouts après modification CSS
4. **Noms de modèles** : `PollQuestion` (pas Poll), `author_id` (pas user_id), `population_label` (pas diaspora_population)
5. **Statuts en français** : `brouillon`, `publie`, `archive`
6. **Pas de Gates/Policies** : autorisation via middleware + méthodes modèle
7. **Audit automatique** : le trait `Auditable` journalise les changements sur 5 modèles clés
