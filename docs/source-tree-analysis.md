# Analyse de l'Arborescence — DGIE Laravel

## Arborescence Racine

```
dgie-laravel/
├── .claude/                          # Configuration Claude Code
├── .github/
│   └── workflows/
│       └── deploy.yml                # CI/CD GitHub Actions → FTP → Plesk
├── _bmad/                            # Framework BMAD (agents IA)
├── _bmad-output/                     # Sorties BMAD
├── app/                              # Code applicatif (80 fichiers PHP)
├── bootstrap/                        # Bootstrap Laravel
├── config/                           # 10 fichiers de configuration
├── database/                         # Migrations (48), seeders (7), factories (1)
├── docs/                             # Documentation projet
├── lang/                             # Localisation (français)
├── manuel-screenshots/               # Captures d'écran du manuel utilisateur
├── public/                           # Fichiers web accessibles
├── resources/                        # Vues, CSS source, JS source
├── routes/                           # Définitions de routes (3 fichiers)
├── storage/                          # Uploads, logs, cache
├── tests/                            # Tests PHPUnit
├── vendor/                           # Dépendances Composer
│
├── CLAUDE.md                         # Instructions pour Claude Code
├── MANUEL-UTILISATEUR.md             # Manuel utilisateur (Markdown)
├── MANUEL-UTILISATEUR.html           # Manuel utilisateur (HTML)
├── MANUEL-UTILISATEUR.pdf            # Manuel utilisateur (PDF, 10.5 MB)
├── README.md                         # README projet
├── artisan                           # CLI Laravel
├── composer.json / composer.lock     # Dépendances PHP
├── package.json                      # Dépendances Node.js
├── phpunit.xml                       # Configuration tests
├── vite.config.js                    # Configuration Vite
├── vendor.zip                        # Backup compressé du vendor (32 MB)
└── .env / .env.example               # Variables d'environnement
```

---

## app/ — Code Applicatif

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/                    # 26 contrôleurs admin
│   │   │   ├── ArticleController.php
│   │   │   ├── BannerController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── CommentController.php
│   │   │   ├── ContactMessageController.php
│   │   │   ├── CountryController.php
│   │   │   ├── CulturalItemController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── DepartmentController.php
│   │   │   ├── DocumentController.php
│   │   │   ├── DossierController.php
│   │   │   ├── EvenementController.php
│   │   │   ├── FaqItemController.php
│   │   │   ├── FlashInfoController.php
│   │   │   ├── GalerieController.php
│   │   │   ├── LoginController.php
│   │   │   ├── MagazineController.php
│   │   │   ├── NewsletterController.php
│   │   │   ├── PartnerController.php
│   │   │   ├── PollController.php
│   │   │   ├── ProfileController.php
│   │   │   ├── SettingController.php
│   │   │   ├── StaffController.php
│   │   │   ├── TestimonialController.php
│   │   │   ├── ToolkitItemController.php
│   │   │   └── UserController.php
│   │   │
│   │   ├── Controller.php            # Contrôleur de base
│   │   ├── ActualiteController.php   # Articles publics
│   │   ├── CoinDiasposController.php # Coin diaspora
│   │   ├── ContactController.php     # Page contact
│   │   ├── DossierFrontController.php
│   │   ├── EvenementFrontController.php
│   │   ├── FormSubmissionController.php  # Soumissions publiques (rate-limited)
│   │   ├── GalerieFrontController.php
│   │   ├── HomeController.php        # Accueil
│   │   ├── InstitutionController.php # Pages institutionnelles (5 pages)
│   │   ├── MediathequeController.php # Vidéos YouTube
│   │   └── SearchController.php      # Recherche globale
│   │
│   ├── Middleware/
│   │   ├── AdminMiddleware.php           # Vérifie rôle admin
│   │   ├── ForcePasswordChangeMiddleware.php  # Force changement mdp
│   │   ├── SecurityHeadersMiddleware.php # Headers sécurité (HSTS, XSS, etc.)
│   │   └── SuperAdminMiddleware.php      # Restreint au super-admin
│   │
│   └── Requests/                     # 4 Form Request classes
│       ├── CommentRequest.php
│       ├── ContactFormRequest.php
│       ├── NewsletterRequest.php
│       └── PollVoteRequest.php
│
├── Mail/                             # 3 Mailables
│   ├── PasswordReset.php
│   ├── UserInvitation.php
│   └── VerifyEmailChange.php
│
├── Models/                           # 28 modèles Eloquent
│   ├── AuditLog.php
│   ├── Article.php                   # SoftDeletes + Auditable
│   ├── ArticleImage.php
│   ├── Banner.php
│   ├── Category.php
│   ├── Comment.php
│   ├── ContactInfo.php
│   ├── ContactMessage.php
│   ├── Country.php
│   ├── CulturalItem.php
│   ├── Department.php
│   ├── Document.php                  # SoftDeletes
│   ├── Dossier.php                   # SoftDeletes + Auditable
│   ├── Evenement.php                 # SoftDeletes + Auditable
│   ├── FaqItem.php                   # Polymorphe (faqable)
│   ├── FlashInfo.php
│   ├── GalerieAlbum.php             # SoftDeletes + Auditable
│   ├── GalerieItem.php
│   ├── Magazine.php                  # SoftDeletes
│   ├── NewsletterSubscriber.php
│   ├── Partner.php
│   ├── PollOption.php
│   ├── PollQuestion.php              # ⚠ Pas "Poll"
│   ├── Setting.php                   # Méthodes statiques get/set/getGroup
│   ├── Staff.php
│   ├── Testimonial.php
│   ├── ToolkitItem.php
│   └── User.php                      # Auditable, accessors: avatar_url, initials
│
├── Providers/
│   └── AppServiceProvider.php
│
├── Traits/
│   └── Auditable.php                 # Auto-log create/update/delete → audit_logs
│
└── View/
    └── Composers/
        └── FrontendComposer.php      # Données partagées front-end
```

---

## resources/views/ — Vues Blade (111 fichiers)

```
resources/views/
├── front-end/
│   ├── layouts/
│   │   └── app.blade.php            # Layout principal (utilise @push/@endpush)
│   ├── pages/                        # 22 templates de pages
│   │   ├── home.blade.php
│   │   ├── actualites.blade.php
│   │   ├── article.blade.php
│   │   ├── coin-des-diaspos.blade.php
│   │   ├── contact.blade.php
│   │   ├── dossiers.blade.php
│   │   ├── dossier-*.blade.php       # 6 pages dossier spécifiques
│   │   ├── evenement.blade.php
│   │   ├── galerie.blade.php
│   │   ├── investir-contribuer.blade.php
│   │   ├── la-dgie.blade.php
│   │   ├── mediatheque.blade.php
│   │   ├── mentions-legales.blade.php
│   │   ├── nos-services.blade.php
│   │   ├── politique-confidentialite.blade.php
│   │   ├── retour-reintegration.blade.php
│   │   └── search.blade.php
│   └── partials/                     # 8 composants réutilisables
│       ├── header.blade.php
│       ├── footer.blade.php
│       ├── flash-infos.blade.php
│       ├── newsletter.blade.php
│       ├── banner-pub.blade.php
│       ├── back-to-top.blade.php
│       ├── preloader.blade.php
│       └── top-bar.blade.php
│
├── back-end/
│   ├── layouts/
│   │   └── admin.blade.php          # Layout admin (utilise @section/@endsection)
│   ├── partials/
│   │   ├── sidebar.blade.php
│   │   ├── header.blade.php
│   │   └── alerts.blade.php
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── change-password.blade.php
│   ├── dashboard.blade.php           # Dashboard principal
│   ├── profil/
│   │   ├── show.blade.php            # Page profil
│   │   ├── _timeline-items.blade.php
│   │   └── _global-timeline-items.blade.php
│   ├── settings/
│   │   └── index.blade.php
│   │
│   │   # 18 modules CRUD (pattern : index + modales create/edit)
│   ├── articles/          (create, edit, index, show)
│   ├── banners/           (create, edit, index)
│   ├── categories/        (create, edit, index)
│   ├── comments/          (index)
│   ├── contact-messages/  (index, show)
│   ├── countries/         (create, edit, index)
│   ├── cultural-items/    (create, edit, index)
│   ├── departments/       (create, edit, index)
│   ├── documents/         (create, edit, index)
│   ├── dossiers/          (create, edit, index)
│   ├── evenements/        (create, edit, index)
│   ├── faqs/              (create, edit, index)
│   ├── flash-infos/       (create, edit, index)
│   ├── galerie/           (create, edit, index)
│   ├── magazines/         (index)
│   ├── newsletter/        (index)
│   ├── partners/          (create, edit, index)
│   ├── polls/             (create, edit, index)
│   ├── staff/             (create, edit, index)
│   ├── testimonials/      (create, edit, index)
│   ├── toolkit-items/     (create, edit, index)
│   └── utilisateurs/      (create, edit, index)
│
├── emails/                           # 3 templates email (HTML card-based)
│   ├── password-reset.blade.php
│   ├── user-invitation.blade.php
│   └── verify-email-change.blade.php
│
├── errors/                           # 4 pages d'erreur
│   ├── 403.blade.php
│   ├── 404.blade.php
│   ├── 419.blade.php
│   └── 500.blade.php
│
└── vendor/
    └── pagination/
        ├── admin.blade.php           # Pagination personnalisée admin
        └── front.blade.php           # Pagination personnalisée front
```

---

## database/ — Base de Données

```
database/
├── migrations/                       # 48 fichiers de migration
│   ├── 0001_01_01_*                 # 3 tables Laravel de base (users, cache, jobs)
│   ├── 2026_02_21_*                 # Tables principales (categories, dossiers, articles, etc.)
│   ├── 2026_02_22_*                 # Tables fonctionnelles + altérations
│   ├── 2026_02_23_*                 # Sections, contact, login tracking
│   ├── 2026_02_24_*                 # Corrections valeurs enum
│   ├── 2026_02_27_*                 # Magazines
│   ├── 2026_02_28_*                 # Password change, indexes, soft deletes, audit_logs
│   ├── 2026_03_01_*                 # Galerie dates, article images
│   └── 2026_03_03_*                 # Email en attente (pending_email)
│
├── seeders/                          # 7 seeders
│   ├── DatabaseSeeder.php           # Orchestrateur (appelle les 6 suivants)
│   ├── UserSeeder.php               # Super-admin par défaut
│   ├── CategorySeeder.php           # 10 catégories d'articles
│   ├── PageSeeder.php               # 7 pages statiques
│   ├── SettingSeeder.php            # 56 paramètres (6 groupes)
│   ├── CountrySeeder.php            # 12 pays
│   └── DepartmentSeeder.php         # 3 départements (DAOSAR, DMCRIE, DAS)
│
├── factories/
│   └── UserFactory.php              # Factory utilisateur
│
└── database.sqlite                   # Base SQLite de test (94 KB)
```

---

## public/assets/ — Ressources Statiques

```
public/assets/
├── css/
│   ├── style.css                    # Front-end (~8 700 lignes), BEM
│   └── admin.css                    # Admin (~5 400 lignes), préfixes modulaires
├── js/
│   └── main.js                      # JavaScript principal
└── images/
    ├── logo-dgie.png                # Logo DGIE (91 KB)
    ├── armoirie-ci.png              # Armoiries CI (146 KB)
    ├── favicon.svg                  # Favicon
    ├── hero-bg.jpg                  # Image héro (248 KB)
    ├── icon-192.png / icon-512.png  # Icônes PWA
    ├── whatsapp-qr.png             # QR code WhatsApp
    ├── ad-banner-*.jpg             # Bannières publicitaires
    ├── partners/                    # Logos partenaires
    ├── person/                      # Photos staff
    └── icons/                       # Icônes divers
```

---

## routes/ — Fichiers de Routes

```
routes/
├── web.php                          # Toutes les routes (front + admin), 9.6 KB
├── deploy.php                       # Endpoints de déploiement prod, 14.4 KB
└── console.php                      # Commandes console, 210 B
```

---

## Comptage par Type de Fichier

| Type | Nombre | Emplacement |
|------|--------|-------------|
| Contrôleurs admin | 26 | `app/Http/Controllers/Admin/` |
| Contrôleurs front | 12 | `app/Http/Controllers/` |
| Modèles | 28 | `app/Models/` |
| Middleware | 4 | `app/Http/Middleware/` |
| Form Requests | 4 | `app/Http/Requests/` |
| Mailables | 3 | `app/Mail/` |
| Vues Blade | 111 | `resources/views/` |
| Migrations | 48 | `database/migrations/` |
| Seeders | 7 | `database/seeders/` |
| Fichiers CSS | 2 | `public/assets/css/` |
| Fichiers JS | 1 | `public/assets/js/` |
| Fichiers de config | 10 | `config/` |
| Fichiers de routes | 3 | `routes/` |
| **Total estimé** | **~386** | |
