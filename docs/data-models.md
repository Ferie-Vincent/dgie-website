# Modèles de Données — DGIE Laravel

## Vue d'Ensemble

- **28 modèles** Eloquent
- **47 migrations**
- **7 seeders**
- **1 trait** (Auditable)
- **6 tables** avec SoftDeletes : Article, Dossier, Evenement, GalerieAlbum, Document, Magazine

---

## Système d'Audit (App\Traits\Auditable)

Le trait `Auditable` journalise automatiquement les événements `created`, `updated`, `deleted` dans la table `audit_logs`.

- **Champs ignorés** : `password`, `remember_token`
- **Ne journalise que si** un utilisateur est authentifié (`auth()->check()`)
- **Modèles utilisant Auditable** : User, Article, Dossier, Evenement, GalerieAlbum

---

## Schéma Complet des Tables

### users

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| name | varchar | | Nom complet |
| email | varchar | UNIQUE | Email de connexion |
| pending_email | varchar | NULLABLE | Email en attente de vérification |
| email_verification_token | varchar | NULLABLE | Token de vérification (24h) |
| email_verified_at | timestamp | NULLABLE | |
| password | varchar | | Bcrypt (12 rounds en prod) |
| remember_token | varchar | NULLABLE | |
| role | enum | DEFAULT 'redacteur' | `super-admin`, `editeur`, `redacteur` |
| avatar | varchar | NULLABLE | Chemin vers l'image |
| last_login_at | timestamp | NULLABLE | |
| must_change_password | boolean | DEFAULT false | |
| created_at / updated_at | timestamp | | |

**Accessors** : `avatar_url`, `initials`
**Méthodes** : `isSuperAdmin()`, `isEditeur()`, `isRedacteur()`, `getRoleLabel()`
**Relations** : `hasMany Article (author_id)`

### articles

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| title | varchar | | |
| slug | varchar | UNIQUE | Auto-généré |
| excerpt | text | NULLABLE | |
| content | longtext | | |
| image | varchar | NULLABLE | Image de couverture |
| category_id | bigint unsigned | FK → categories | |
| dossier_id | bigint unsigned | FK → dossiers, NULLABLE | |
| author_id | bigint unsigned | FK → users | PAS `user_id` |
| status | enum | DEFAULT 'brouillon' | `brouillon`, `publie`, `archive` |
| section | enum | DEFAULT 'general' | `general`, `retour`, `investir`, `action-sociale` |
| published_at | timestamp | NULLABLE | |
| read_time | varchar | NULLABLE | Calculé : word_count/200 |
| is_featured | boolean | DEFAULT false | |
| featured_position | integer | NULLABLE | |
| deleted_at | timestamp | NULLABLE | SoftDeletes |
| created_at / updated_at | timestamp | | |

**Scopes** : `published()`, `featured()`, `section($section)`
**Relations** : `belongsTo Category`, `belongsTo Dossier`, `belongsTo User (author_id)`, `hasMany Comment`, `hasMany ArticleImage`, `morphMany FaqItem`

### article_images

| Colonne | Type | Contraintes |
|---------|------|-------------|
| id | bigint unsigned | PK |
| article_id | bigint unsigned | FK → articles, CASCADE |
| image_path | varchar | |
| caption | varchar | NULLABLE |
| order | integer | DEFAULT 0 |

### categories

| Colonne | Type | Contraintes |
|---------|------|-------------|
| id | bigint unsigned | PK |
| name | varchar | |
| slug | varchar | UNIQUE |
| color | varchar | DEFAULT 'cat-orange' |

**Relations** : `hasMany Article`

### dossiers

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| title | varchar | | |
| slug | varchar | UNIQUE | |
| description | text | NULLABLE | |
| content | longtext | | |
| image | varchar | NULLABLE | |
| department | enum | NULLABLE | `DAOSAR`, `DMCRIE`, `DAS`, `DGIE` |
| order | integer | DEFAULT 0 | |
| status | enum | DEFAULT 'brouillon' | `brouillon`, `publie`, `archive` |
| deleted_at | timestamp | NULLABLE | SoftDeletes |

**Relations** : `hasMany Article`, `hasMany Testimonial`, `morphMany FaqItem`

### evenements

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| title | varchar | | |
| slug | varchar | UNIQUE | |
| description | text | NULLABLE | |
| location | varchar | NULLABLE | |
| event_date | datetime | | Date de début |
| end_date | datetime | NULLABLE | |
| image | varchar | NULLABLE | |
| is_featured | boolean | DEFAULT false | |
| status | enum | DEFAULT 'brouillon' | `brouillon`, `publie`, `archive` |
| section | enum | DEFAULT 'general' | `general`, `diaspora` |
| deleted_at | timestamp | NULLABLE | SoftDeletes |

### flash_infos

| Colonne | Type | Contraintes |
|---------|------|-------------|
| id | bigint unsigned | PK |
| content | varchar | Message |
| is_active | boolean | DEFAULT true |
| order | integer | DEFAULT 0 |

### galerie_albums

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| title | varchar | | |
| slug | varchar | UNIQUE | |
| type | enum | DEFAULT 'photo' | `photo`, `video` |
| cover_image | varchar | NULLABLE | |
| description | text | NULLABLE | |
| event_date | date | NULLABLE | |
| location | varchar(255) | NULLABLE | |
| items_count | integer | DEFAULT 0 | |
| status | enum | DEFAULT 'brouillon' | |
| deleted_at | timestamp | NULLABLE | SoftDeletes |

**Relations** : `hasMany GalerieItem (album_id)`

### galerie_items

| Colonne | Type | Contraintes |
|---------|------|-------------|
| id | bigint unsigned | PK |
| album_id | bigint unsigned | FK → galerie_albums, CASCADE |
| title | varchar | NULLABLE |
| file_path | varchar | |
| type | enum | `image`, `video` |
| order | integer | DEFAULT 0 |

### comments

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| article_id | bigint unsigned | FK → articles, CASCADE | |
| parent_id | bigint unsigned | FK → comments, NULLABLE | Self-référence pour les réponses |
| name | varchar | | |
| email | varchar | | |
| content | text | | |
| is_admin | boolean | DEFAULT false | |
| is_approved | boolean | DEFAULT false | |

### faq_items (polymorphe)

| Colonne | Type | Contraintes |
|---------|------|-------------|
| id | bigint unsigned | PK |
| faqable_id | bigint unsigned | FK polymorphe |
| faqable_type | varchar | `Article` ou `Dossier` |
| question | varchar | |
| answer | text | |
| order | integer | DEFAULT 0 |

### testimonials

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| page_slug | varchar | NULLABLE | Filtrage par page |
| dossier_id | bigint unsigned | FK, NULLABLE | |
| name | varchar | | |
| context | varchar | NULLABLE | |
| route | varchar | NULLABLE | PAS `origin` |
| return_year | varchar | NULLABLE | |
| quote | text | | |
| avatar | varchar | NULLABLE | |
| tags | json | NULLABLE | Cast en array |
| type | enum | DEFAULT 'general' | `general`, `retour`, `success_story` |
| order | integer | DEFAULT 0 | |
| is_active | boolean | DEFAULT true | |

### staff

| Colonne | Type | Contraintes | Notes |
|---------|------|-------------|-------|
| id | bigint unsigned | PK | |
| name, title, role | varchar | | |
| photo | varchar | NULLABLE | Portrait |
| photo_page | varchar | NULLABLE | Photo page dédiée |
| quote | text | NULLABLE | |
| bio | text | NULLABLE | |
| type | enum | DEFAULT 'autre' | `ministre`, `dg`, `directeur`, `autre` |
| order | integer | DEFAULT 0 | |
| is_active | boolean | DEFAULT true | |

### partners

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| name | varchar | |
| abbreviation | varchar | NULLABLE |
| logo | varchar | NULLABLE |
| url | varchar | NULLABLE |
| order | integer | DEFAULT 0 |
| is_active | boolean | DEFAULT true |

### countries

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| name | varchar | |
| flag_emoji | varchar | NULLABLE (ex: 🇫🇷) |
| population_label | varchar | NULLABLE — PAS `diaspora_population` |
| order | integer | DEFAULT 0 |
| is_active | boolean | DEFAULT true |

### poll_questions (PAS `polls`)

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| question | varchar | |
| is_active | boolean | DEFAULT true |
| total_votes | integer | DEFAULT 0 |

**Relations** : `hasMany PollOption`

### poll_options

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| poll_question_id | bigint unsigned | FK → poll_questions |
| label | varchar | |
| votes_count | integer | DEFAULT 0 |
| percentage | decimal(5,2) | DEFAULT 0 |
| order | integer | DEFAULT 0 |

### documents

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| title | varchar | |
| file_path | varchar | |
| file_size | varchar | NULLABLE (ex: "2.5MB") |
| type | enum | `juridique`, `rapport`, `organigramme`, `autre` |
| description | text | NULLABLE |
| order | integer | DEFAULT 0 |
| is_active | boolean | DEFAULT true |
| deleted_at | timestamp | SoftDeletes |

### banners

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| title | varchar | NULLABLE |
| image | varchar | |
| url | varchar | NULLABLE |
| alt_text | varchar | NULLABLE |
| position | varchar | `top`, `sidebar`, `popup` |
| is_active | boolean | DEFAULT true |
| order | integer | DEFAULT 0 |

### departments

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| acronym | varchar | Ex: DAOSAR |
| name | varchar | |
| description | text | NULLABLE |
| icon | varchar | NULLABLE |
| link | varchar | NULLABLE |
| order | integer | DEFAULT 0 |
| is_active | boolean | DEFAULT true |

### magazines

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| title | varchar | |
| cover_image | varchar | NULLABLE |
| pdf_file | varchar | NULLABLE |
| published_at | date | NULLABLE |
| description | text | NULLABLE |
| is_active | boolean | DEFAULT true |
| order | integer | DEFAULT 0 |
| deleted_at | timestamp | SoftDeletes |

### contact_messages

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| name, email, subject | varchar | |
| message | text | |
| reply_message | text | NULLABLE |
| status | varchar | `unread`, `read`, `replied` |
| replied_at | timestamp | NULLABLE |

### contact_infos

| Colonne | Type |
|---------|------|
| id | bigint unsigned |
| address | text |
| phone_1, phone_2 | varchar |
| email | varchar |

### newsletter_subscribers

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| email | varchar | UNIQUE |
| is_active | boolean | DEFAULT true |
| subscribed_at | timestamp | |
| unsubscribed_at | timestamp | NULLABLE |

### settings

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| key | varchar | UNIQUE |
| value | text | NULLABLE |
| group | varchar | `contact`, `social`, `stats`, `seo`, `general`, `dgie` |

**Méthodes statiques** : `get($key, $default)`, `set($key, $value, $group)`, `getGroup($group)`

### cultural_items

| Colonne | Type | Notes |
|---------|------|-------|
| type | enum | `musique`, `livre`, `film`, `gastronomie` |
| title, description, image | varchar/text | |
| order | integer | DEFAULT 0 |
| is_active | boolean | DEFAULT true |

### toolkit_items

| Colonne | Type | Notes |
|---------|------|-------|
| title, description | varchar/text | |
| icon_color | varchar | NULLABLE |
| url | varchar | NULLABLE |
| order | integer | DEFAULT 0 |
| is_active | boolean | DEFAULT true |

### audit_logs

| Colonne | Type | Notes |
|---------|------|-------|
| id | bigint unsigned | PK |
| user_id | bigint unsigned | FK → users, NULLABLE |
| action | varchar | `created`, `updated`, `deleted` |
| model_type | varchar | Nom de classe complet |
| model_id | bigint unsigned | NULLABLE |
| description | varchar | Description en français |
| changes | json | NULLABLE — {old, new} |
| ip_address | varchar(45) | NULLABLE |

**Index** : (model_type, model_id), user_id, created_at

---

## Carte des Relations

```
User 1───∞ Article (author_id)
User 1───∞ AuditLog

Category 1───∞ Article
Dossier 1───∞ Article
Dossier 1───∞ Testimonial
Dossier 1───∞ FaqItem (morphMany)

Article 1───∞ Comment
Article 1───∞ ArticleImage
Article 1───∞ FaqItem (morphMany)

Comment 1───∞ Comment (self-join via parent_id)

GalerieAlbum 1───∞ GalerieItem (album_id)

PollQuestion 1───∞ PollOption (poll_question_id)
```

---

## Données Seedées

**Catégories** (10) : Communiqués, Événements, Programmes, Investissement, Témoignages, Politique, Bilan, Forum, Sensibilisation, Diaspora

**Pages** (7) : La DGIE, Nos services, Contact, Coin des diaspos, Mentions légales, Politique de confidentialité, Plan du site

**Pays** (12) : France, États-Unis, Canada, Maroc, Tunisie, Belgique, Allemagne, Italie, Royaume-Uni, Chine, Sénégal, Gabon

**Départements** (3) : DAOSAR, DMCRIE, DAS

**Paramètres** (56) : 6 groupes (contact, social, stats, seo, dgie, general)

**Super-admin** : `admin@dgie.gouv.ci` / `Dgie@2026!`

---

## Référence des Valeurs Enum

| Champ                   | Valeurs                                  |
|-------------------------|------------------------------------------|
| users.role              | super-admin, editeur, redacteur          |
| articles.status         | brouillon, publie, archive               |
| articles.section        | general, retour, investir, action-sociale|
| evenements.section      | general, diaspora                        |
| dossiers.department     | DAOSAR, DMCRIE, DAS, DGIE                |
| galerie_albums.type     | photo, video                             |
| testimonials.type       | general, retour, success_story           |
| staff.type              | ministre, dg, directeur, autre           |
| documents.type          | juridique, rapport, organigramme, autre  |
| banners.position        | top, sidebar, popup                      |
| cultural_items.type     | musique, livre, film, gastronomie        |
| contact_messages.status | unread, read, replied                    |
