# Guide de Développement — DGIE Laravel

## Prérequis

| Outil | Version | Notes |
|-------|---------|-------|
| PHP | 8.3.14 | Via MAMP (`/Applications/MAMP/bin/php/php8.3.14/bin/php`) |
| MySQL | 5.7+ | Via MAMP (port 8889) |
| Composer | Dernière version | Gestionnaire de dépendances PHP |
| Node.js | LTS | Pour Vite et npm |
| MAMP | Dernière version | Serveur local Apache + MySQL |

**Extensions PHP requises** : mbstring, xml, ctype, json, bcmath, curl, gd, intl, zip, pdo_mysql

---

## Installation Locale

### Setup Automatique

```bash
composer run-script setup
```

Cette commande exécute :
1. `composer install`
2. Copie `.env.example` → `.env`
3. `php artisan key:generate`
4. `php artisan migrate --force`
5. `npm install`
6. `npm run build`

### Setup Manuel

```bash
# 1. Cloner le dépôt
git clone <repo-url>
cd dgie-laravel

# 2. Installer les dépendances PHP
composer install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer la base de données dans .env
# DB_HOST=127.0.0.1
# DB_PORT=8889
# DB_DATABASE=dgie
# DB_USERNAME=root
# DB_PASSWORD=root

# 5. Créer la base et les données initiales
php artisan migrate:fresh --seed

# 6. Créer le lien de stockage
php artisan storage:link

# 7. Installer les dépendances front
npm install
npm run build
```

---

## Commandes de Développement

### Démarrer l'Environnement

```bash
# Mode complet (serveur + queue + logs + Vite en parallèle)
composer run-script dev

# Ou démarrage individuel
php artisan serve --port=8001        # Serveur de développement
npm run dev                           # Vite en mode watch
php artisan queue:listen --tries=1    # Écoute de la queue
php artisan pail                      # Visualiseur de logs temps réel
```

**URL de développement** : `http://127.0.0.1:8001`

### Base de Données

```bash
php artisan migrate                   # Exécuter les migrations en attente
php artisan migrate:fresh --seed      # Réinitialiser la base + seeders
php artisan migrate:status            # Voir le statut des migrations
php artisan db:seed                   # Exécuter les seeders seuls
```

### Cache

```bash
php artisan cache:clear               # Vider le cache applicatif
php artisan view:clear                # Vider le cache des vues
php artisan route:clear               # Vider le cache des routes
php artisan config:clear              # Vider le cache de configuration

# Tout en une commande
php artisan cache:clear && php artisan view:clear && php artisan route:clear
```

### Tests

```bash
composer run-script test              # Clear config + lance PHPUnit
php artisan test                      # Lancer les tests directement
php artisan test --filter=NomDuTest   # Test spécifique
php artisan test --coverage           # Avec couverture de code
```

**Configuration des tests** (`phpunit.xml`) :
- Base de données : SQLite en mémoire
- Session/Cache/Queue : drivers `array`/`sync`
- Mail : driver `array` (pas d'envoi réel)

---

## Configuration Environnement

### Variables .env Clés (développement)

```ini
APP_NAME=DGIE
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8001
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=dgie
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
MAIL_MAILER=log
FILESYSTEM_DISK=local
```

### Compte Admin par Défaut

| Champ | Valeur |
|-------|--------|
| Email | `admin@dgie.gouv.ci` |
| Mot de passe | `Dgie@2026!` |
| Rôle | `super-admin` |

---

## Conventions de Code

### Blade

| Contexte | Directive Scripts | Exemple |
|----------|-------------------|---------|
| Front-end (`app.blade.php`) | `@push('scripts')` / `@endpush` | Contenu front |
| Admin (`admin.blade.php`) | `@section('scripts')` / `@endsection` | Pages admin |

**Important** : ne jamais oublier `@endsection` entre `@section('content')` et `@section('scripts')` dans les vues admin.

### CSS

- **Pas de framework** : CSS vanilla uniquement (malgré Tailwind dans `package.json`)
- **Front-end** (`style.css`) : convention BEM
- **Admin** (`admin.css`) : préfixes modulaires (`profil-*`, `tl-*`, `dash-*`, `stat-*`)
- **Versioning** : incrémenter `?v=N` dans les layouts après modification

| Layout | Fichier CSS | Paramètre actuel |
|--------|-------------|-------------------|
| `admin.blade.php` | `admin.css` | `?v=14` |
| `app.blade.php` | `style.css` | `?v=21` |

### Variables CSS Principales

```css
:root {
    --orange: #E8772A;
    --green: #1D8C4F;
    --font: 'Instrument Sans';
    --font-display: 'Plus Jakarta Sans';
    --max-width: 1260px;
    --header-height: 72px;     /* front */
    --header-h: 56px;          /* admin */
}
```

### PHP

- **Validation** : directe dans les contrôleurs (`$request->validate()`)
- **Statuts** : toujours en français (`brouillon`, `publie`, `archive`)
- **Slugs** : auto-générés via `Str::slug()`
- **Pas de Gates/Policies** : autorisation via middleware + méthodes modèle
- **AJAX** : réponse `{ success: bool, message: string, ...data }`

### Modèles — Pièges de Nommage

| Ce qu'on pourrait croire | Nom réel |
|--------------------------|----------|
| `Poll` | `PollQuestion` |
| `user_id` (articles) | `author_id` |
| `diaspora_population` (pays) | `population_label` |
| `origin` (témoignages) | `route` |
| `admin.visuels.*` (routes bannières) | `admin.banners.*` |

---

## Système d'Audit

Le trait `Auditable` (`app/Traits/Auditable.php`) journalise automatiquement dans `audit_logs` :

- **Actions** : `created`, `updated`, `deleted`
- **Données** : user_id, model_type, model_id, description (FR), changes (JSON old/new), ip_address
- **Exclut** : `password`, `remember_token`
- **Condition** : seulement si utilisateur authentifié
- **Modèles** : User, Article, Dossier, Evenement, GalerieAlbum

---

## Système Email

### Configuration

| Environnement | Transport | Notes |
|---------------|-----------|-------|
| Développement | `log` | Emails dans `storage/logs/` |
| Production | `sendmail` | Envoi réel |

### Mailables

| Classe | Déclencheur | Vue |
|--------|-------------|-----|
| `PasswordReset` | Admin reset mot de passe | `emails.password-reset` |
| `UserInvitation` | Admin crée un utilisateur | `emails.user-invitation` |
| `VerifyEmailChange` | Utilisateur change son email | `emails.verify-email-change` |

Templates HTML card-based, 520px, branding orange (#E8772A).

---

## UI Admin — Patterns Réutilisables

### Modales

```javascript
openModal(id)          // Ouvre modale + init CKEditor
closeModal(id)         // Ferme modale
showViewModal(title, subtitle, html, raw)  // Modale de visualisation
```

IDs standards : `#createModal`, `#editModal`, `#viewModal`, `#deleteModal`

### Toasts

```javascript
showToast(type, message)  // Types: success, error, warning, info
```

Auto-dismiss après 5 secondes.

### Pattern CRUD

Chaque module admin (`index.blade.php`) contient :
- Tableau (`.admin-table` + `.admin-table-wrapper`)
- Barre de recherche + filtres
- Pagination (15/page standard, 20 pour commentaires/FAQs)
- Boutons d'action (voir/modifier/supprimer)
- Modales inline pour créer/éditer

### Badges

```html
<!-- Rôles -->
<span class="usr-role-badge superadmin">Super-Admin</span>
<span class="usr-role-badge editeur">Éditeur</span>
<span class="usr-role-badge redacteur">Rédacteur</span>

<!-- Statuts -->
<span class="badge-status badge-publie">Publié</span>
<span class="badge-status badge-brouillon">Brouillon</span>
<span class="badge-status badge-archive">Archivé</span>
```

---

## Stockage de Fichiers

| Type | Emplacement | Taille max |
|------|-------------|------------|
| Avatars | `storage/avatars/{user_id}.{ext}` | 2 MB |
| Images articles | `storage/articles/` | 2 MB (couverture), 5 MB (additionnelles) |
| Photos staff | `storage/staff/` | 2 MB |
| Logos partenaires | `storage/partners/` | 2 MB |
| Galerie | `storage/galerie/` | 51 MB |
| Bannières | `storage/banners/` | 5 MB |
| Documents | `storage/documents/` | 10 MB |
| Magazines (PDF) | `storage/magazines/` | 20 MB |

---

## Débogage

```bash
# Logs temps réel
php artisan pail

# Ou lecture directe
tail -f storage/logs/laravel.log

# Emails en développement (driver log)
cat storage/logs/laravel.log | grep -A 50 "Message-ID"
```
