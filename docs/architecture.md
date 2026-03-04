# Architecture — DGIE Laravel

## Résumé

Application web full-stack Laravel 12 pour la Direction Générale des Ivoiriens de l'Extérieur (DGIE). Monolithe à rendu serveur (Blade) avec panneau d'administration complet. Contenu entièrement en français, ton institutionnel.

**Production** : https://ivoiriendelexterieur.com

---

## Stack Technologique

| Composant | Technologie | Version |
|-----------|-------------|---------|
| Backend | PHP / Laravel | 8.3.14 / ^12.0 |
| Base de données | MySQL | via MAMP (dev) / Plesk (prod) |
| Templates | Blade | Intégré Laravel |
| Build | Vite | ^7.0.7 |
| HTTP Client | Axios | ^1.11.0 |
| Graphiques | Chart.js | 4.4.7 (CDN) |
| Éditeur WYSIWYG | CKEditor 5 | 43.3.1 |
| CSS | Écriture manuelle | 2 fichiers (~14 100 lignes) |
| Tests | PHPUnit | ^11.5.3 |
| CI/CD | GitHub Actions | → FTP → Plesk |

---

## Pattern Architectural

**Type** : Monolithe MVC (Model-View-Controller) Laravel classique

```
┌─────────────────────────────────────────────────┐
│                   NAVIGATEUR                     │
├──────────────────┬──────────────────────────────┤
│   Front-End      │      Admin Panel             │
│   (public)       │      (/admin/*)              │
├──────────────────┴──────────────────────────────┤
│              Routes (web.php)                    │
│         + Middleware Chain                        │
├─────────────────────────────────────────────────┤
│              Controllers                         │
│   12 front-end  │  26 admin                     │
├─────────────────────────────────────────────────┤
│         Models (28) + Traits (Auditable)         │
├─────────────────────────────────────────────────┤
│              MySQL Database                      │
│         (47 migrations, 28 tables)               │
└─────────────────────────────────────────────────┘
```

---

## Authentification & Rôles

**3 rôles** : `super-admin`, `editeur`, `redacteur`

| Rôle | Accès |
|------|-------|
| super-admin | Tout + gestion utilisateurs + vue globale profil |
| editeur | CRUD complet sur tout le contenu |
| redacteur | Accès limité |

**Chaîne middleware** :
1. `admin` — vérifie authentification + rôle valide
2. `force-password-change` — redirige si `must_change_password=true`
3. Contrôleur
4. `superadmin` — routes utilisateurs uniquement

**Login** : `/admin/login`
**Pas de Gates/Policies** — autorisation via méthodes modèle + middleware

---

## Système d'Audit

Le trait `Auditable` (5 modèles) journalise automatiquement vers `audit_logs` :

- **Actions** : `created`, `updated`, `deleted`
- **Données** : user_id, model_type, model_id, description (FR), changes (JSON), ip_address
- **Exclut** : `password`, `remember_token`
- **Condition** : seulement si `auth()->check()` est vrai
- **Utilisé par** : User, Article, Dossier, Evenement, GalerieAlbum

---

## Système Email

**Transport** : `sendmail` (prod), `log` (dev)
**From** : `contact@ivoiriendelexterieur.com`

| Mailable | Sujet | Vue |
|----------|-------|-----|
| PasswordReset | Réinitialisation de mot de passe — Plateforme DGIE | emails.password-reset |
| UserInvitation | Invitation — Plateforme DGIE | emails.user-invitation |
| VerifyEmailChange | Vérification de votre nouvelle adresse email — DGIE | emails.verify-email-change |

Templates : HTML card-based, 520px, branding orange (#E8772A)

---

## CSS & Design System

**Deux fichiers CSS monolithiques** (pas de framework) :

| Fichier | Lignes | Usage | Version actuelle |
|---------|--------|-------|-----------------|
| `public/assets/css/style.css` | ~8 700 | Front-end (BEM) | v=21 |
| `public/assets/css/admin.css` | ~5 400 | Admin panel | v=14 |

**Variables CSS principales** :
- Couleurs : `--orange` (#E8772A), `--green` (#1D8C4F), `--bordeaux`, `--slate-*`, `--blue`, `--danger`
- Typo : `--font` (Instrument Sans), `--font-display` (Plus Jakarta Sans)
- Layout : `--max-width: 1260px`, `--header-height: 72px` (front), `--header-h: 56px` (admin)
- Ombres : `--shadow-sm` à `--shadow-2xl`

**Préfixes CSS admin** :
- Profil : `profil-*` (`.profil-hero`, `.profil-stat-card`)
- Timeline : `tl-*` (`.tl-row`, `.tl-dot`, `.tl-desc`)
- Dashboard : `dash-*`, `stat-*`

---

## UI Admin — Composants Partagés

### Système de Modales
```javascript
openModal(id)          // Ouvre modale + init CKEditor
closeModal(id)         // Ferme modale
showViewModal(title, subtitle, html, raw)  // Modale de visualisation
```
IDs standards : `#createModal`, `#editModal`, `#viewModal`, `#deleteModal`

### Système de Toasts
```javascript
showToast(type, message)  // Types: success, error, warning, info
```
Auto-dismiss après 5 secondes.

### Pattern CRUD Standard
Chaque module admin : `index.blade.php` avec :
- Tableau (`.admin-table` + `.admin-table-wrapper`)
- Barre de recherche + filtres
- Pagination (15/page standard, 20 pour commentaires/FAQs)
- Boutons d'action (voir/modifier/supprimer)
- Modales inline pour créer/éditer

### Badges
- Rôles : `.usr-role-badge.superadmin/editeur/redacteur`
- Statuts : `.badge-status.badge-publie/brouillon/archive`

---

## Stockage de Fichiers

| Type | Emplacement | Taille max |
|------|------------|-----------|
| Avatars | `storage/avatars/{user_id}.{ext}` | 2 MB |
| Images articles | `storage/articles/` | 2 MB (couverture), 5 MB (additionnelles) |
| Photos staff | `storage/staff/` | 2 MB |
| Logos partenaires | `storage/partners/` | 2 MB |
| Galerie | `storage/galerie/` | 51 MB |
| Bannières | `storage/banners/` | 5 MB |
| Documents | `storage/documents/` | 10 MB |
| Magazines (PDF) | `storage/magazines/` | 20 MB |

---

## Déploiement

```
Push main → GitHub Actions → composer install (no-dev) → .env prod → lftp FTP → Plesk
```

**Post-déploiement** (si nouvelles migrations) :
1. `GET /deploy/dgie-deploy-secure-2026/migrate`
2. `GET /deploy/dgie-deploy-secure-2026/cache-clear`

**Exclusions** : `.git`, `node_modules`, `vendor`, `tests`, `_bmad`, `CLAUDE.md`

---

## Sécurité

- **SecurityHeadersMiddleware** : X-Content-Type-Options, X-Frame-Options, X-XSS-Protection, HSTS (prod)
- **Rate limiting** : toutes les routes POST publiques
- **Bcrypt** : 12 rounds en production
- **CSRF** : protection Laravel par défaut
- **Validation** : directe dans les contrôleurs (`$request->validate()`)
