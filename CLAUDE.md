# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Laravel 12 web application for the **DGIE** (Direction Générale des Ivoiriens de l'Extérieur), a department of Côte d'Ivoire's Ministry of Foreign Affairs dedicated to supporting the Ivorian diaspora. Entirely in French. Migrated from a static HTML/CSS/JS site to Laravel with a full admin panel.

## Development Environment

- **Server**: MAMP (Apache + MySQL), dev server at `http://127.0.0.1:8001`
- **PHP**: 8.3.14 via MAMP (`/Applications/MAMP/bin/php/php8.3.14/bin/php`)
- **Database**: MySQL on port 8889, database `dgie`, credentials `root`/`root`
- **Start dev server**: `php artisan serve --port=8001`
- **Run migrations**: `php artisan migrate`
- **Seed database**: `php artisan db:seed`
- **Clear caches**: `php artisan cache:clear && php artisan view:clear && php artisan route:clear`

## Architecture

### Dual Front-end / Back-end Structure

```
resources/views/
├── front-end/           # Public-facing pages
│   ├── layouts/app.blade.php   # Front layout (header, footer, flash-infos)
│   └── pages/           # 19 page templates (home, actualites, coin-des-diaspos, dossiers, etc.)
└── back-end/            # Admin panel
    ├── layouts/admin.blade.php  # Admin layout (sidebar, header, alerts)
    ├── partials/         # sidebar.blade.php, header.blade.php, alerts.blade.php
    ├── auth/login.blade.php
    ├── dashboard.blade.php
    └── [module]/         # 17 CRUD module directories (articles, evenements, countries, etc.)
```

### Models (25 total in `app/Models/`)

Key relationships:
- `Article` belongsTo `Category`, belongsTo `User` (author)
- `GalerieItem` belongsTo `GalerieAlbum`
- `PollQuestion` hasMany `PollOption` (not "Poll" — the model is `PollQuestion`)
- `Evenement` has `section` enum field: `general` or `diaspora`
- `Testimonial` casts `tags` as array (not comma-separated string), uses `route` field (not `origin`)
- `Country` uses `population_label` field (not `diaspora_population`)

### Admin Controllers (24 in `app/Http/Controllers/Admin/`)

All CRUD controllers follow Laravel resource conventions. Admin routes are prefixed with `/admin` and protected by `AdminMiddleware`. User management is additionally restricted by `SuperAdminMiddleware`.

### Auth & Roles

Three roles: `super-admin` (full access + user management), `editeur` (full CRUD), `redacteur` (limited). Admin login at `/admin/login`. Default super-admin: `admin@dgie.gouv.ci` / `password`.

### Front-end Controllers

- `HomeController` — serves the homepage with dynamic data
- `CoinDiasposController` — serves the diaspora page with events, testimonials, countries, polls, etc.
- Most other front-end pages are still `Route::view()` with static content

## CSS Architecture

Two separate hand-written CSS files (no Tailwind, no framework):

- **`public/assets/css/style.css`** (~7500 lines) — Front-end styles using BEM naming (`.article-card__title`, `.featured-card--small`)
- **`public/assets/css/admin.css`** (~4100 lines) — Admin panel styles

Design system (CSS custom properties in `:root`):
- Colors: `--orange` (#E8772A), `--green` (#1D8C4F), `--bordeaux`, `--slate-*` scale
- Typography: `--font` (Instrument Sans), `--font-display` (Plus Jakarta Sans)
- Layout: `--max-width: 1260px`

## Admin UI Patterns

### Modal System

Admin pages use a shared modal pattern via `showViewModal(title, subtitle, html, raw)`:
- `title`: modal header title
- `subtitle`: shown below title
- `html`: content rendered as HTML by default
- `raw`: when `true`, `html` is inserted as raw innerHTML (for complex layouts)

### CRUD Views

Each module typically has `index.blade.php` (list + create/edit modals inline) following the same table + modal pattern. Some modules (evenements) have enhanced layouts with hero sections and cards.

## Key Commands

```bash
# Development
php artisan serve --port=8001
php artisan migrate
php artisan migrate:fresh --seed    # Reset DB with seeders
php artisan db:seed

# Artisan generators
php artisan make:model ModelName -m  # Model + migration
php artisan make:controller Admin/NameController --resource

# Cache management
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan route:list              # List all routes
```

## Conventions

- All content in French, following institutional tone (vouvoiement)
- Front-end layout uses `@push('scripts')` / `@endpush` (not `@section('scripts')`)
- Image uploads stored in `public/uploads/[module]/`
- Event types distinguished by `section` field (`general` vs `diaspora`) with colored badges
- Status values: `brouillon`, `publie`, `archive` (French terms)
- Slugs auto-generated from titles using `Str::slug()`
