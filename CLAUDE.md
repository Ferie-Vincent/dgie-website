# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Laravel 12 web application for the **DGIE** (Direction Générale des Ivoiriens de l'Extérieur), a department of Côte d'Ivoire's Ministry of Foreign Affairs dedicated to supporting the Ivorian diaspora. Entirely in French. Migrated from a static HTML/CSS/JS site to Laravel with a full admin panel.

**Production**: `https://ivoiriendelexterieur.com`

## Development Environment

- **Server**: MAMP (Apache + MySQL), dev server at `http://127.0.0.1:8001`
- **PHP**: 8.3.30 via MAMP (`/Applications/MAMP/bin/php/php8.3.30/bin/php`)
- **Database**: MySQL on port 8889, database `dgie`, credentials `root`/`root`
- **Chrome DevTools MCP** configured for live browser inspection

```bash
php artisan serve --port=8001        # Start dev server
php artisan migrate                   # Run migrations
php artisan migrate:fresh --seed      # Reset DB with seeders
php artisan cache:clear && php artisan view:clear && php artisan route:clear  # Clear caches
```

## Deployment

**Automated via GitHub Actions** (`.github/workflows/deploy.yml`): push to `main` → FTP deploy to Plesk hosting via `lftp`.

**Deploy endpoints** (production only, via `routes/deploy.php`):
```
https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/migrate
https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/cache-clear
https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/seed
```

**After deploying new migrations**: always hit the `/migrate` endpoint, then `/cache-clear`.

**CSS versioning**: bump `?v=N` on `admin.css` in `resources/views/back-end/layouts/admin.blade.php` (currently `v=13`) and `style.css` in `resources/views/front-end/layouts/app.blade.php` after CSS changes.

## Architecture

### File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # 26 admin controllers (CRUD + auth + profile)
│   │   └── *.php           # 12 front-end controllers
│   └── Middleware/          # AdminMiddleware, SuperAdminMiddleware, ForcePasswordChangeMiddleware, SecurityHeadersMiddleware
├── Mail/                   # PasswordReset, UserInvitation, VerifyEmailChange
├── Models/                 # 28 models
└── Traits/
    └── Auditable.php       # Auto-logs created/updated/deleted to audit_logs table

resources/views/
├── front-end/
│   ├── layouts/app.blade.php    # Front layout (uses @push('scripts')/@endpush)
│   └── pages/                   # 22 page templates
├── back-end/
│   ├── layouts/admin.blade.php  # Admin layout (uses @section('scripts')/@endsection)
│   ├── partials/                # sidebar, header, alerts
│   ├── auth/login.blade.php
│   ├── dashboard.blade.php
│   ├── profil/                  # Profile page + partials
│   └── [module]/                # 18 CRUD module directories
└── emails/                      # 3 email templates (card-based HTML)

public/assets/css/
├── style.css              # Front-end (~8700 lines), BEM naming
└── admin.css              # Admin panel (~5400 lines)

routes/
├── web.php                # All app routes (front + admin groups)
└── deploy.php             # Production deploy/migration endpoints
```

### Auth & Roles

Three roles: `super-admin`, `editeur`, `redacteur`.
- **super-admin**: full access + user management + global platform overview on profile
- **editeur**: full CRUD on all content
- **redacteur**: limited access

Admin login at `/admin/login`. Default super-admin: `admin@dgie.gouv.ci` / `password`.

**Middleware chain**: `admin` (auth check) → `force-password-change` → controller. User management routes additionally use `superadmin` middleware.

### Key Models & Relationships

- `User`: roles, avatar upload (`storage/avatars/`), `pending_email`/`email_verification_token` for email change flow, `must_change_password`, `initials` accessor. Uses `Auditable` trait.
- `Article` belongsTo `Category`, belongsTo `User` (author via `author_id`). Has `ArticleImage` for multiple images.
- `AuditLog`: `user_id`, `action` (created/updated/deleted), `model_type`, `model_id`, `description`, `changes` (JSON), `ip_address`. Central to profile page analytics.
- `Evenement`: `section` field (`general` or `diaspora`), distinguished by colored badges.
- `PollQuestion` hasMany `PollOption` (not "Poll" — the model is `PollQuestion`).
- `GalerieAlbum` hasMany `GalerieItem`.
- `Testimonial`: `tags` cast as array, `route` field (not `origin`).
- `Country`: `population_label` field (not `diaspora_population`).

### Audit System

`App\Traits\Auditable` trait (used by most models) auto-logs to `audit_logs` table on create/update/delete. Skips `password` and `remember_token` fields. Only logs when authenticated.

### Email System

Uses `sendmail` in production. Three Mailables:
- `PasswordReset` — admin resets a user's password
- `UserInvitation` — admin invites new user with temporary password
- `VerifyEmailChange` — user changes email, must confirm via token link (24h expiry)

All emails use card-based HTML templates in `resources/views/emails/` with DGIE branding (orange CTA #E8772A).

### Profile Page (`/admin/profil/{user}`)

Rich profile page with:
- **Hero section**: avatar upload, name, role badge, edit button (own profile only)
- **Inline edit form**: AJAX name change (immediate) + email change (verification email)
- **Activity stats**: 6 cards showing 3-month activity counts from `audit_logs`
- **Chart.js**: stacked bar chart of weekly activity (created/updated/deleted)
- **Content summary**: article stats + recent articles list
- **Compact timeline**: single-line rows with colored dots, icons, description, time, IP
- **Super-admin global overview** (own profile only): global stats, contributor leaderboard with medals, global timeline showing all users' actions

Key controller: `ProfileController` with methods `show`, `timelineMore`, `globalTimelineMore`, `updateProfile`, `verifyEmail`.

### Admin UI Patterns

**Modal system**: `showViewModal(title, subtitle, html, raw)` — shared across CRUD pages.

**Toast notifications**: `showToast(type, message)` — types: `success`, `error`, `warning`.

**CRUD views**: each module typically has `index.blade.php` with table + inline create/edit modals.

**Tables**: `.admin-table` class with `.admin-table-wrapper` for horizontal scroll.

**Badges**: `.usr-role-badge.superadmin/editeur/redacteur`, `.badge-status.badge-publie/brouillon/archive`.

## CSS Architecture

Two hand-written CSS files (no Tailwind, no framework).

**Design system** (CSS custom properties in `:root`):
- Colors: `--orange` (#E8772A), `--green` (#1D8C4F), `--bordeaux`, `--slate-*` scale, `--blue`, `--danger`
- Typography: `--font` (Instrument Sans), `--font-display` (Plus Jakarta Sans)
- Layout: `--max-width: 1260px`, `--header-height: 72px`
- Shadows: `--shadow-sm` to `--shadow-2xl`, `--shadow-card`

**Admin CSS naming**: profile section uses `profil-*` prefix (e.g., `.profil-hero`, `.profil-stat-card`, `.profil-leaderboard-*`). Compact timeline uses `tl-*` prefix (`.tl-row`, `.tl-dot`, `.tl-icon`, `.tl-user`, `.tl-desc`, `.tl-time`, `.tl-ip`).

## Routes Overview

**Front-end** (public):
- `/` — home, `/actualites` — articles list, `/actualites/{slug}` — article detail
- `/coin-des-diaspos`, `/nos-services`, `/la-dgie`, `/retour-reintegration`, `/investir-contribuer`
- `/galerie`, `/mediatheque`, `/contact`, `/recherche`, `/dossiers`, `/dossiers/{slug}`
- `/evenements/{slug}`, `/mentions-legales`, `/politique-confidentialite`
- `/verify-email/{token}` — email change verification (public, no auth)
- POST: `/contact`, `/newsletter`, `/commentaire`, `/sondage/vote` (all rate-limited)

**Admin** (`/admin` prefix, `admin` + `force-password-change` middleware):
- `resource` routes for: articles, categories, dossiers, evenements, flash-infos, galerie, staff, partners, countries, polls, documents, departments, testimonials, cultural-items, toolkit-items, banners, faqs, magazines
- Comments: `/comments` (index, approve, reject, destroy)
- Contact messages: `/contact-messages` (index, reply, mark-read, update-contact-info, destroy)
- Newsletter: `/newsletter` (index, destroy)
- Settings: `/settings` (index, update)
- Profile: `/profil/{user}` (show), `/profil/{user}/timeline` (AJAX), `/profil/{user}/global-timeline` (AJAX), `/profil/{user}/update-profile` (PUT)
- Avatar: `/utilisateurs/{id}/avatar` (POST update, DELETE remove)
- Users: `/utilisateurs` (CRUD, super-admin only), `/utilisateurs/{id}/reset-password`

## Conventions

- All content in French, institutional tone (vouvoiement)
- **Front-end** layout uses `@push('scripts')` / `@endpush`
- **Back-end** layout uses `@section('scripts')` / `@endsection` — never forget `@endsection` between `@section('content')` and `@section('scripts')`
- Image uploads: avatars in `storage/avatars/`, other uploads in `storage/[module]/` (banners, staff, etc.)
- Status values: `brouillon`, `publie`, `archive` (French terms)
- Slugs auto-generated from titles using `Str::slug()`
- AJAX responses follow `{ success: bool, message: string, ...data }` pattern
- CSS version bump required in layout file after any CSS change
