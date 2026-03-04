# Contrats API & Routes — DGIE Laravel

## Middleware

| Middleware | Fichier | Rôle |
|-----------|---------|------|
| **AdminMiddleware** | `AdminMiddleware.php` | Vérifie rôle `super-admin`, `editeur` ou `redacteur`. Redirige vers login sinon. |
| **SuperAdminMiddleware** | `SuperAdminMiddleware.php` | Restreint au `super-admin`. Retourne 403 sinon. |
| **ForcePasswordChangeMiddleware** | `ForcePasswordChangeMiddleware.php` | Redirige vers changement de mot de passe si `must_change_password=true`. |
| **SecurityHeadersMiddleware** | `SecurityHeadersMiddleware.php` | Headers de sécurité : X-Content-Type-Options, X-Frame-Options, HSTS (prod). |

**Chaîne admin** : `admin` → `force-password-change` → contrôleur
**Routes utilisateurs** : ajoutent `superadmin` en plus

---

## Routes Publiques (Front-End)

| Méthode | URI | Contrôleur | But |
|---------|-----|-----------|-----|
| GET | `/` | HomeController@index | Accueil : articles vedettes, galerie, événements, staff, bannières, magazines |
| GET | `/actualites` | ActualiteController@index | Liste articles avec filtres : catégorie, section, date, recherche |
| GET | `/actualites/{slug}` | ActualiteController@show | Détail article avec commentaires approuvés, articles liés |
| GET | `/coin-des-diaspos` | CoinDiasposController@index | Coin diaspora : événement, témoignages, pays, culture, sondage, toolkit |
| GET | `/nos-services` | InstitutionController@nosServices | Services avec FAQs et témoignages |
| GET | `/la-dgie` | InstitutionController@laDgie | À propos : DG, départements, documents, contact |
| GET | `/retour-reintegration` | InstitutionController@retourReintegration | Retour/réintégration avec FAQs |
| GET | `/investir-contribuer` | InstitutionController@investirContribuer | Investissement avec FAQs |
| GET | `/galerie` | GalerieFrontController@index | Albums photo/vidéo (exclut YouTube) |
| GET | `/mediatheque` | MediathequeController@index | Vidéos YouTube depuis galerie |
| GET | `/contact` | ContactController@index | Formulaire de contact avec FAQ |
| GET | `/evenements/{slug}` | EvenementFrontController@show | Détail événement |
| GET | `/dossiers` | DossierFrontController@index | Liste dossiers |
| GET | `/dossiers/{slug}` | DossierFrontController@show | Détail dossier avec témoignages et FAQs |
| GET | `/recherche` | SearchController@index | Recherche articles, dossiers, événements (min 3 car, param `q`) |
| GET | `/mentions-legales` | InstitutionController@mentionsLegales | Mentions légales |
| GET | `/politique-confidentialite` | InstitutionController@politiqueConfidentialite | Politique de confidentialité |
| GET | `/verify-email/{token}` | ProfileController@verifyEmail | Vérification email (public, 24h) |

### Soumissions Publiques (Rate-Limited)

| Méthode | URI | Contrôleur | Rate Limit |
|---------|-----|-----------|-----------|
| POST | `/contact` | FormSubmissionController@submitContact | 3 / 10 min |
| POST | `/newsletter` | FormSubmissionController@subscribeNewsletter | 3 / 10 min |
| POST | `/commentaire` | FormSubmissionController@submitComment | 5 / 10 min |
| POST | `/sondage/vote` | FormSubmissionController@votePoll | 5 / 10 min |

---

## Routes Admin — Authentification

| Méthode | URI | Contrôleur | Notes |
|---------|-----|-----------|-------|
| GET | `/admin/login` | LoginController@showLogin | Redirige vers dashboard si déjà connecté |
| POST | `/admin/login` | LoginController@login | throttle:5,1. Met à jour `last_login_at` |
| POST | `/admin/logout` | LoginController@logout | Invalide la session |
| GET | `/admin/changer-mot-de-passe` | LoginController@showChangePassword | Middleware: admin (sans force-password) |
| POST | `/admin/changer-mot-de-passe` | LoginController@changePassword | Met `must_change_password=false` |

---

## Routes Admin — CRUD Resources

Middleware : `['admin', 'force-password-change']`, préfixe `/admin/`

### Articles
- `resource('articles', ArticleController)` — CRUD complet
- `DELETE article-images/{image}` — Supprimer image individuelle (AJAX, retourne JSON)
- **Validation store/update** : title (255), excerpt (500), content, category_id (exists), status (brouillon/publie/archive), section, image (2MB), additional_images (5MB×10)
- **Logique** : auto-slug, read_time = word_count/200, author_id = auth()->id()

### Catégories
- `resource('categories', CategoryController)` — CRUD complet
- **Validation** : name (255, unique), color (50)
- **Suppression** : bloquée si articles liés

### Dossiers
- `resource('dossiers', DossierController)` — CRUD complet
- **Validation** : title (255), content, department (DAOSAR/DMCRIE/DAS/DGIE), status, image (2MB)

### Événements
- `resource('evenements', EvenementController)` — CRUD complet
- **Validation** : title (255), description, location, event_date, end_date (after_or_equal), section (general/diaspora), image (2MB)

### Flash Infos
- `resource('flash-infos', FlashInfoController)` — CRUD complet
- **Validation** : content (500), is_active, order

### Galerie
- `resource('galerie', GalerieController)` — sauf create, show, edit (modales inline)
- **Validation** : title (255), type (photo/video), status, photos (51MB chacune), video_url (URL)

### Staff, Partners, Countries, Polls, Documents, Departments, Testimonials, Cultural Items, Toolkit Items
- Tous suivent le même pattern CRUD `resource()`
- Pagination standard : 15/page (sauf FAQs et commentaires : 20/page)

### Bannières (Visuels)
- `resource('visuels', BannerController)->names('banners')->parameters(['visuels' => 'banner'])`
- **Noms de routes** : `admin.banners.*` (PAS `admin.visuels.*`)
- **Validation** : image (5MB), position (top/sidebar/popup)

### FAQs
- `resource('faqs', FaqItemController)` — sauf create et show
- **Polymorphe** : faqable_type + faqable_id

### Magazines
- `resource('magazines', MagazineController)` — sauf create et show
- **Validation** : cover_image (5MB), pdf_file (20MB, mimes:pdf)

---

## Routes Admin — Modules Spéciaux

### Commentaires (Modération)
| Méthode | URI | Action |
|---------|-----|--------|
| GET | `/admin/comments` | Liste avec filtres : search, status (approuve/en_attente) |
| POST | `/admin/comments/{comment}/approve` | Approuver |
| POST | `/admin/comments/{comment}/reject` | Rejeter |
| DELETE | `/admin/comments/{comment}` | Supprimer |

### Messages de Contact
| Méthode | URI | Action | Type |
|---------|-----|--------|------|
| GET | `/admin/contact-messages` | Liste avec stats (total_month, unread, avg_response_time) | Page |
| POST | `/admin/contact-messages/{id}/mark-as-read` | Marquer comme lu | AJAX JSON |
| POST | `/admin/contact-messages/{id}/reply` | Répondre | AJAX JSON |
| POST | `/admin/contact-messages/contact-info` | Mettre à jour infos de contact globales | AJAX JSON |
| DELETE | `/admin/contact-messages/{id}` | Supprimer | Page |

### Newsletter
| Méthode | URI | Action |
|---------|-----|--------|
| GET | `/admin/newsletter` | Liste abonnés avec counts actif/total |
| DELETE | `/admin/newsletter/{subscriber}` | Supprimer abonné |

### Paramètres
| Méthode | URI | Action |
|---------|-----|--------|
| GET | `/admin/settings` | Page paramètres (groupes : footer, social, general) |
| POST | `/admin/settings` | Mise à jour (auto-détection du groupe par préfixe de clé) |

### Profil
| Méthode | URI | Action | Autorisation |
|---------|-----|--------|-------------|
| GET | `/admin/profil/{user}` | Page profil complète | Super-admin OU propre profil |
| GET | `/admin/profil/{user}/timeline` | Timeline AJAX | Super-admin OU propre profil |
| GET | `/admin/profil/{user}/global-timeline` | Timeline globale AJAX | Super-admin (propre profil uniquement) |
| PUT | `/admin/profil/{user}/update-profile` | Modifier nom/email | Super-admin OU propre profil |

### Avatar
| Méthode | URI | Action |
|---------|-----|--------|
| POST | `/admin/utilisateurs/{id}/avatar` | Upload avatar (2MB, jpg/png/webp) |
| DELETE | `/admin/utilisateurs/{id}/avatar` | Supprimer avatar |

### Utilisateurs (Super-Admin uniquement)
| Méthode | URI | Action |
|---------|-----|--------|
| GET | `/admin/utilisateurs` | Liste utilisateurs avec counts par rôle |
| POST | `/admin/utilisateurs` | Créer + invitation email + mot de passe temporaire |
| PUT | `/admin/utilisateurs/{id}` | Modifier nom/email/rôle |
| DELETE | `/admin/utilisateurs/{id}` | Supprimer (pas soi-même) |
| POST | `/admin/utilisateurs/{id}/reset-password` | Reset mot de passe + email |

---

## Endpoints de Déploiement (Production)

Base : `/deploy/{token}/` — le token est comparé avec `config('app.deploy_token')`

| URI | Action Artisan |
|-----|---------------|
| `/migrate` | `migrate --force` |
| `/cache-clear` | config:clear, view:clear, route:clear, cache:clear |
| `/seed` | `db:seed --force` |
| `/storage-link` | `storage:link` |
| `/optimize` | config:cache, route:cache, view:cache |
| `/status` | Résumé système (PHP, Laravel, env, DB, APP_KEY) |
| `/check-logs` | 80 dernières lignes de laravel.log |

---

## Patterns de Réponse

**Redirections** : `redirect()->back()->with('success', 'Message')`
**AJAX JSON** : `{ 'success': bool, 'message': string, ...data }`
**Erreurs validation** : Session flash (page) ou 422 JSON (AJAX)
**Accès refusé** : `abort(403, 'Accès non autorisé.')`
