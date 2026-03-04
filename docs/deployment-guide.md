# Guide de Déploiement — DGIE Laravel

## Architecture de Déploiement

```
┌──────────────┐     ┌──────────────────┐     ┌──────────────────┐
│  Développeur │────▶│  GitHub (main)   │────▶│  Plesk Hosting   │
│  git push    │     │  Actions CI/CD   │     │  51.15.161.204   │
└──────────────┘     └──────────────────┘     └──────────────────┘
                            │                         │
                      lftp (FTP)               Apache + PHP 8.3
                      composer install         MySQL
                      .env production          sendmail
```

**URL Production** : https://ivoiriendelexterieur.com

---

## Pipeline CI/CD

### Déclencheurs

Le workflow GitHub Actions (`.github/workflows/deploy.yml`) se déclenche sur :
- **Push** sur la branche `main`
- **Déclenchement manuel** via `workflow_dispatch`

### Étapes du Pipeline

1. **Checkout** du code (actions/checkout@v4)

2. **Setup PHP 8.3** avec extensions :
   - mbstring, xml, ctype, json, bcmath, curl, gd, intl, zip, pdo_mysql

3. **Installation Composer** (mode production) :
   ```bash
   composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
   ```

4. **Génération du .env production** (variables intégrées au workflow)

5. **Installation lftp** pour le transfert FTP

6. **Déploiement FTP** vers le serveur Plesk :
   - Serveur : `51.15.161.204`
   - Utilisateur FTP : `ivoirien`
   - Répertoire cible : `/httpdocs/`
   - Synchronisation manuelle de `vendor/composer/` (autoloader)

7. **Nettoyage du cache** serveur :
   ```bash
   curl -sf "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/cache-clear"
   ```

### Fichiers Exclus du Déploiement

```
.git/
node_modules/
vendor/          # Sauf vendor/composer/ (autoloader)
tests/
_bmad/
.env.example
phpunit.xml
CLAUDE.md
```

---

## Endpoints de Déploiement

Base : `https://ivoiriendelexterieur.com/deploy/{token}/`

Le token est vérifié contre `config('app.deploy_token')` (valeur : `dgie-deploy-secure-2026`).

Fichier : `routes/deploy.php`

### Endpoints Principaux

| Endpoint | Action | Quand l'utiliser |
|----------|--------|------------------|
| `/migrate` | `migrate --force` | Après ajout de nouvelles migrations |
| `/cache-clear` | config:clear, view:clear, route:clear, cache:clear | Après chaque déploiement |
| `/seed` | `db:seed --force` | Pour ajouter des données de base |
| `/storage-link` | `storage:link` | Premier déploiement uniquement |
| `/optimize` | config:cache, route:cache, view:cache | Pour optimiser les performances |

### Endpoints de Diagnostic

| Endpoint | Action |
|----------|--------|
| `/status` | Résumé système (PHP, Laravel, env, DB, APP_KEY, stockage) |
| `/check-logs` | 80 dernières lignes de `laravel.log` |
| `/check-permissions` | Vérifier que `storage/` et `bootstrap/cache/` sont inscriptibles |
| `/check-files` | Vérifier l'existence des fichiers critiques |
| `/check-views` | Lister tous les templates Blade |

### Endpoints de Maintenance

| Endpoint | Action | Attention |
|----------|--------|-----------|
| `/migrate-fresh` | Recréer toutes les tables | **Destructif** — perte de données |
| `/create-admin` | Créer le super-admin par défaut | Si le compte admin a été supprimé |
| `/test-login` | Vérifier que le compte admin fonctionne | Diagnostic uniquement |
| `/key-generate` | Générer une nouvelle APP_KEY | **Invalide les sessions** |
| `/fix-autoloader` | Nettoyer l'autoloader Composer | Si erreurs de chargement de classes |
| `/fix-opcache` | Réinitialiser OPcache + caches Laravel | Si modifications non prises en compte |

---

## Procédure de Déploiement Standard

### Déploiement Simple (pas de migration)

```bash
# 1. Commit et push sur main
git add <fichiers>
git commit -m "Description du changement"
git push origin main

# 2. GitHub Actions déploie automatiquement + clear cache
# Rien d'autre à faire
```

### Déploiement avec Nouvelles Migrations

```bash
# 1. Push sur main
git push origin main

# 2. Attendre la fin du déploiement GitHub Actions

# 3. Exécuter les migrations en production
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/migrate"

# 4. Vider les caches
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/cache-clear"
```

### Déploiement avec Modifications CSS

```bash
# 1. Modifier le CSS (admin.css ou style.css)

# 2. Incrémenter le numéro de version dans le layout
#    - admin.css : dans resources/views/back-end/layouts/admin.blade.php
#    - style.css : dans resources/views/front-end/layouts/app.blade.php

# 3. Commit et push
git add public/assets/css/admin.css resources/views/back-end/layouts/admin.blade.php
git commit -m "Mise à jour CSS admin"
git push origin main
```

---

## Configuration Production

### Différences Dev vs Prod

| Paramètre | Développement | Production |
|-----------|---------------|------------|
| `APP_ENV` | `local` | `production` |
| `APP_DEBUG` | `true` | `false` |
| `APP_TIMEZONE` | UTC | `Africa/Abidjan` |
| `DB_PORT` | 8889 | 3306 |
| `DB_DATABASE` | `dgie` | `db_dgie` |
| `SESSION_DRIVER` | `database` | `file` |
| `CACHE_STORE` | `database` | `file` |
| `QUEUE_CONNECTION` | `database` | `sync` |
| `MAIL_MAILER` | `log` | `sendmail` |
| `FILESYSTEM_DISK` | `local` | `public` |

### Sécurité en Production

- **SecurityHeadersMiddleware** : X-Content-Type-Options, X-Frame-Options, X-XSS-Protection, HSTS
- **Rate limiting** : toutes les routes POST publiques (3-5 requêtes / 10 min)
- **Bcrypt** : 12 rounds
- **CSRF** : protection Laravel par défaut
- **DEPLOY_TOKEN** : protège les endpoints de maintenance

---

## Dépannage

### Vérifier le Statut du Serveur

```bash
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/status"
```

### Consulter les Logs

```bash
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/check-logs"
```

### Problèmes Courants

| Problème | Solution |
|----------|----------|
| Erreur 500 après déploiement | `/cache-clear` puis `/check-logs` |
| Classe non trouvée | `/fix-autoloader` |
| Modifications non visibles | `/fix-opcache` puis `/cache-clear` |
| Migrations en attente | `/migrate` |
| CSS non mis à jour | Vérifier le `?v=N` dans le layout |
| Permissions fichiers | `/check-permissions` |
| Compte admin perdu | `/create-admin` |

---

## Premier Déploiement

Pour un déploiement initial sur un nouveau serveur :

```bash
# 1. Déployer via GitHub Actions (push sur main)

# 2. Créer le lien de stockage
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/storage-link"

# 3. Exécuter les migrations
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/migrate"

# 4. Peupler la base de données
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/seed"

# 5. Optimiser les caches
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/optimize"

# 6. Vérifier le statut
curl "https://ivoiriendelexterieur.com/deploy/dgie-deploy-secure-2026/status"
```
