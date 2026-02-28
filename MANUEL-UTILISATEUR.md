# Manuel Utilisateur — Plateforme DGIE

**Direction Generale des Ivoiriens de l'Exterieur**
*Ministere des Affaires Etrangeres de Cote d'Ivoire*

---

## Table des matieres

1. [Presentation generale](#1-presentation-generale)
2. [Connexion et securite](#2-connexion-et-securite)
3. [Tableau de bord](#3-tableau-de-bord)
4. [Gestion du contenu — Page d'accueil](#4-gestion-du-contenu--page-daccueil)
5. [Coin des Diasporas](#5-coin-des-diasporas)
6. [Nos Services et La DGIE](#6-nos-services-et-la-dgie)
7. [Mediatheque](#7-mediatheque)
8. [Communication](#8-communication)
9. [Administration (Super-Admin)](#9-administration-super-admin)
10. [Structure du site public](#10-structure-du-site-public)
11. [Roles et permissions](#11-roles-et-permissions)
12. [Conventions et bonnes pratiques](#12-conventions-et-bonnes-pratiques)

---

## 1. Presentation generale

La plateforme DGIE est un site web institutionnel compose de deux parties :

- **Le site public** : accessible a tous les visiteurs, il presente les missions de la DGIE, les actualites, les services offerts a la diaspora ivoirienne, la galerie, les dossiers thematiques, etc.
- **Le panneau d'administration** : accessible uniquement aux utilisateurs autorises, il permet de gerer l'ensemble du contenu du site.

### Adresse du site

| Espace | URL |
|--------|-----|
| Site public | `https://votre-domaine.com/` |
| Administration | `https://votre-domaine.com/admin/login` |

---

## 2. Connexion et securite

### 2.1 Se connecter

1. Rendez-vous sur `https://votre-domaine.com/admin/login`
2. Saisissez votre **adresse e-mail** et votre **mot de passe**
3. Cochez **"Se souvenir de moi"** si vous souhaitez rester connecte sur cet appareil
4. Cliquez sur **"Se connecter"**

> L'icone en forme d'oeil a droite du champ mot de passe permet d'afficher/masquer le mot de passe saisi.

### 2.2 Premiere connexion — Changement de mot de passe obligatoire

Lors de votre premiere connexion (ou si votre compte vient d'etre cree par un administrateur), vous serez automatiquement redirige vers la page **"Changer votre mot de passe"**.

1. Saisissez un **nouveau mot de passe** (minimum 8 caracteres)
2. **Confirmez** le mot de passe en le saisissant une seconde fois
3. Cliquez sur **"Enregistrer le nouveau mot de passe"**

Vous serez ensuite redirige vers le tableau de bord.

> **Important** : Le mot de passe temporaire qui vous a ete communique ne sera plus valide apres ce changement. Conservez votre nouveau mot de passe en lieu sur.

### 2.3 Se deconnecter

Cliquez sur votre **avatar/nom** en haut a droite du panneau d'administration, puis sur **"Deconnexion"**.

---

## 3. Tableau de bord

Le tableau de bord est la page d'accueil de l'administration. Il offre une vue d'ensemble de la plateforme.

### 3.1 Statistiques rapides

Quatre cartes affichent les compteurs principaux :

| Carte | Description |
|-------|-------------|
| **Articles** | Nombre total d'articles publies |
| **Dossiers** | Nombre de dossiers thematiques |
| **Evenements** | Nombre d'evenements programmes |
| **Utilisateurs** | Nombre d'utilisateurs du panneau admin |

### 3.2 Banniere Hero

La banniere hero est l'image principale affichee en haut de la page d'accueil du site public.

**Pour modifier la banniere :**
1. Cliquez sur le bouton **"Modifier"** dans la section "Banniere Hero"
2. Telechargez une nouvelle image (format recommande : **2400 x 800 px**)
3. Ajoutez un lien optionnel si la banniere doit rediriger vers une page
4. Enregistrez

### 3.3 Organigramme officiel

Cette section affiche les portraits du **Ministre** et du **Directeur General**. Ces portraits apparaissent sur la page d'accueil du site public.

**Pour modifier un portrait :**
1. Cliquez sur le bouton d'edition sous le portrait concerne
2. Modifiez le nom, le titre, la citation, ou la photo
3. Enregistrez

### 3.4 Espaces publicitaires

Trois emplacements de bannieres publicitaires sont disponibles sur le site. Ils peuvent afficher des communications institutionnelles, des annonces ou des partenariats.

**Pour modifier un espace publicitaire :**
1. Cliquez sur le bouton d'edition de l'espace concerne
2. Telechargez l'image (dimensions recommandees : **728 x 90 px** ou **300 x 250 px**)
3. Ajoutez un lien de destination
4. Activez ou desactivez l'espace
5. Enregistrez

### 3.5 Alertes

Le tableau de bord affiche des alertes pour :
- **Commentaires en attente** de moderation
- **Messages non lus** recus via le formulaire de contact

### 3.6 Contenu recent

Deux tableaux affichent :
- Les **articles recemment publies** (titre, categorie, date)
- Les **evenements a venir** (titre, date, type)

### 3.7 Acces rapides

Des cartes d'acces rapide permettent de naviguer directement vers les modules les plus utilises avec un compteur d'elements en temps reel.

---

## 4. Gestion du contenu — Page d'accueil

Cette section regroupe les modules qui alimentent la page d'accueil du site.

### 4.1 Articles

Les articles constituent le contenu principal du site. Ils apparaissent dans la section "Actualites", sur la page d'accueil, et dans les sections thematiques.

**Creer un article :**
1. Cliquez sur **"Nouvel article"** (bouton vert en haut a droite)
2. Remplissez les champs :

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Titre | Oui | Titre de l'article |
| Resume | Non | Court extrait affiche dans les listes |
| Contenu | Oui | Corps de l'article (editeur enrichi) |
| Image a la une | Non | Image principale (format 16:9, max 2 Mo) |
| Credit image | Non | Source/credit de l'image |
| Categorie | Oui | Classification de l'article |
| Section | Oui | Retour et Reintegration / Investir et Contribuer / Actions Sociales |
| Dossier | Non | Rattachement a un dossier thematique |
| Statut | Oui | Brouillon / Publie / Archive |
| Date de publication | Non | Date de publication (defaut : aujourd'hui) |

3. Cliquez sur **"Enregistrer"**

**Statuts des articles :**
- **Brouillon** : l'article n'est pas visible sur le site public
- **Publie** : l'article est visible sur le site public
- **Archive** : l'article n'est plus visible mais reste en base de donnees

**Filtrer et rechercher :**
- Utilisez la **barre de recherche** pour chercher par titre ou resume
- Filtrez par **categorie**, **statut**, ou **section**

**Modifier ou supprimer :**
- Cliquez sur l'icone **crayon** pour modifier un article
- Cliquez sur l'icone **oeil** pour pre-visualiser
- Cliquez sur l'icone **corbeille** pour supprimer (une confirmation sera demandee)

> **Note** : La suppression d'un article est "douce" (soft delete). L'article peut etre restaure par un administrateur technique si necessaire.

---

### 4.2 Categories

Les categories servent a classer les articles par thematique.

**Creer une categorie :**
1. Cliquez sur **"Nouvelle categorie"**
2. Saisissez le **nom** de la categorie
3. Choisissez une **couleur** (optionnel, pour l'affichage des badges)
4. Enregistrez

> Le **slug** (identifiant URL) est genere automatiquement a partir du nom.

---

### 4.3 Flash Infos

Les flash infos sont des messages courts qui defilent dans la barre d'information en haut du site public.

**Creer un flash info :**
1. Cliquez sur **"Nouveau flash info"**
2. Redigez le **message** (court et percutant)
3. Definissez l'**ordre d'affichage** (les numeros les plus bas s'affichent en premier)
4. Activez ou desactivez le message
5. Enregistrez

> Seuls les flash infos **actifs** sont affiches sur le site public.

---

### 4.4 Evenements

Les evenements peuvent etre de type **general** (DGIE) ou **diaspora** et apparaissent sur la page d'accueil, la page "Coin des Diasporas", et dans le calendrier.

**Creer un evenement :**
1. Cliquez sur **"Nouvel evenement"**
2. Remplissez les champs :

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Titre | Oui | Nom de l'evenement |
| Type | Oui | General (DGIE) ou Diaspora |
| Lieu | Non | Lieu de l'evenement |
| Description | Non | Details de l'evenement |
| Date de debut | Oui | Date et heure de debut |
| Date de fin | Non | Date et heure de fin |
| Image | Non | Affiche (format 16:9, max 2 Mo) |
| Statut | Oui | Brouillon / Publie / Archive |
| Mis en avant | Non | Cochez pour afficher dans la popup d'accueil |

3. Enregistrez

> Un **compte a rebours** s'affiche automatiquement sur le site pour le prochain evenement a venir.

---

### 4.5 Personnel (Staff)

Ce module gere l'organigramme officiel affiche sur la page "La DGIE".

**Creer une fiche personnel :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Nom | Oui | Nom complet |
| Titre | Non | Ex : "Ministre d'Etat" |
| Fonction | Non | Ex : "Directeur de la DAOSAR" |
| Type | Oui | Ministre / Directeur General / Directeur / Autre |
| Citation | Non | Citation ou mot de la personne |
| Biographie | Non | Parcours et informations |
| Photo | Non | Photo portrait (format portrait) |
| Ordre | Non | Ordre d'affichage (0 = premier) |
| Actif | Non | Active ou desactive l'affichage |

---

### 4.6 Partenaires

Les logos des partenaires institutionnels s'affichent sur la page d'accueil.

**Creer un partenaire :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Nom | Oui | Nom complet du partenaire |
| Abreviation | Non | Ex : "OIM", "HCR" |
| Site web | Non | URL du site du partenaire |
| Logo | Non | Logo (format carre recommande, max 2 Mo) |
| Ordre | Non | Ordre d'affichage |
| Actif | Non | Active ou desactive l'affichage |

---

## 5. Coin des Diasporas

Cette section concerne le contenu specifique a la diaspora ivoirienne.

### 5.1 Temoignages

Les temoignages sont des recits de membres de la diaspora qui partagent leur experience.

**Creer un temoignage :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Nom | Oui | Nom du temoin |
| Type | Oui | General / Retour / Investissement / Competence |
| Temoignage | Oui | Le recit du temoin |
| Contexte | Non | Ex : "Ivoirien de retour de France" |
| Parcours | Non | Ex : "France — Abidjan" |
| Annee de retour | Non | Annee de retour au pays |
| Photo | Non | Photo portrait (max 2 Mo) |
| Dossier associe | Non | Rattachement a un dossier |
| Ordre | Non | Ordre d'affichage |
| Actif | Non | Active ou desactive l'affichage |

---

### 5.2 Pays

Liste des pays de concentration de la diaspora ivoirienne.

**Creer un pays :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Nom du pays | Oui | Ex : "France" |
| Drapeau (emoji) | Non | Ex : flag emoji |
| Population | Non | Ex : "~120 000 Ivoiriens" |
| Ordre | Non | Ordre d'affichage |
| Actif | Non | Active ou desactive l'affichage |

---

### 5.3 Coups de coeur culturels

Recommandations culturelles mises en avant sur la page "Coin des Diasporas".

**Creer un coup de coeur :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Titre | Oui | Nom de l'oeuvre/item |
| Type | Oui | Musique / Livre / Film / Gastronomie |
| Description | Non | Presentation de l'oeuvre |
| Image | Non | Visuel (max 2 Mo) |
| Ordre | Non | Ordre d'affichage |
| Actif | Non | Active ou desactive l'affichage |

---

### 5.4 Sondages

Les sondages permettent de recueillir l'avis des visiteurs.

**Creer un sondage :**
1. Cliquez sur **"Nouveau sondage"**
2. Saisissez la **question**
3. Ajoutez les **options de reponse** (minimum 2)
4. Activez le sondage
5. Enregistrez

> Un seul sondage actif est affiche a la fois sur le site public. Le nombre de votes est visible dans le tableau de gestion.

---

### 5.5 Boite a outils

Ressources et outils utiles pour la diaspora (liens, guides, documents).

**Creer un outil :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Titre | Oui | Nom de la ressource |
| Description | Non | Presentation |
| Lien URL | Non | Lien vers la ressource externe |
| Couleur d'icone | Non | Pour la distinction visuelle |
| Ordre | Non | Ordre d'affichage |
| Actif | Non | Active ou desactive l'affichage |

---

## 6. Nos Services et La DGIE

### 6.1 FAQ (Foire aux questions)

Les FAQ sont organisees par thematique et associees aux dossiers.

**Creer une FAQ :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Question | Oui | La question posee |
| Reponse | Oui | La reponse detaillee |
| Type | Non | Categorie de la question |
| Element associe | Non | Rattachement a un dossier specifique |
| Ordre | Non | Ordre d'affichage |

---

### 6.2 Directions (Sous-directions)

Gestion des 3 sous-directions de la DGIE : **DAOSAR**, **DMCRIE**, **DAS**.

**Creer une direction :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Acronyme | Oui | Ex : "DAOSAR" |
| Nom complet | Oui | Ex : "Direction de l'Assistance..." |
| Description | Non | Missions et attributions |
| Icone | Non | Icone illustrative |
| Lien | Non | Lien vers plus d'informations |
| Ordre | Non | Ordre d'affichage |
| Actif | Non | Active ou desactive l'affichage |

---

### 6.3 Dossiers

Les dossiers sont des pages thematiques approfondies (ex : retour volontaire, cadre juridique, investissement diaspora).

**Creer un dossier :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Titre | Oui | Titre du dossier |
| Description | Oui | Resume du dossier |
| Contenu | Oui | Corps du dossier (editeur enrichi) |
| Sous-direction | Non | Direction associee |
| Image a la une | Non | Image (format 16:9, max 2 Mo) |
| Statut | Oui | Brouillon / Publie / Archive |
| Ordre | Non | Ordre d'affichage |

> Les dossiers peuvent etre associes a des articles, des temoignages et des FAQ pour creer un contenu riche et interconnecte.

---

### 6.4 Documents

Documents telechargeables (PDF, rapports, textes juridiques).

**Creer un document :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Titre | Oui | Nom du document |
| Type | Oui | Juridique / Rapport / Organigramme / Autre |
| Fichier | Oui | Le fichier PDF a telecharger |
| Actif | Non | Active ou desactive l'affichage |

> La taille du fichier est calculee automatiquement et affichee dans le tableau de gestion.

---

## 7. Mediatheque

### 7.1 Galerie et Videos

La galerie organise les photos et videos en **albums**.

**Creer un album :**
1. Cliquez sur **"Nouvel album"**
2. Saisissez le **titre** et la **description**
3. Choisissez une **image de couverture**
4. Definissez le **statut** (Brouillon / Publie / Archive)
5. Enregistrez

**Ajouter des medias a un album :**
1. Ouvrez l'album en cliquant sur le bouton de gestion
2. Cliquez sur **"Ajouter des medias"**
3. Selectionnez les fichiers images ou indiquez les liens video
4. Enregistrez

> Les 2 derniers albums publies apparaissent automatiquement dans la section "Galerie" de la page d'accueil. Tous les albums sont accessibles sur la page `/galerie`.

---

### 7.2 Bannieres

Gestion des bannieres promotionnelles affichees sur le site.

**Creer une banniere :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Image | Oui | Visuel de la banniere |
| Titre | Non | Description interne |
| Position | Oui | Top / Sidebar / Popup |
| Lien | Non | URL de destination au clic |
| Actif | Non | Active ou desactive l'affichage |

**Dimensions recommandees selon la position :**
- **Top (hero)** : 2400 x 800 px
- **Sidebar / Publicite** : 728 x 90 px ou 300 x 250 px

---

### 7.3 Magazines

Publication des editions du magazine de la DGIE.

**Creer un magazine :**

| Champ | Obligatoire | Description |
|-------|:-----------:|-------------|
| Titre | Oui | Titre de l'edition |
| Description | Non | Resume du contenu |
| Image de couverture | Non | Couverture (max 2 Mo) |
| Fichier PDF | Oui | Le magazine au format PDF |
| Date de publication | Non | Date de parution |
| Actif | Non | Active ou desactive l'affichage |

> Les magazines sont telechargeables au format PDF par les visiteurs du site.

---

## 8. Communication

### 8.1 Messages de contact

Ce module centralise les messages envoyes par les visiteurs via le formulaire de contact du site.

**Statistiques affichees :**
- Nombre de messages recus ce mois-ci
- Nombre de messages **non lus**
- Temps de reponse moyen

**Actions sur un message :**
- **Voir** : lire le contenu complet du message
- **Marquer comme lu** : change le statut de "Non lu" a "Lu"
- **Repondre** : saisir une reponse (la reponse est enregistree dans le systeme)
- **Supprimer** : supprimer definitivement le message

**Filtrer les messages :**
- Par **statut** : Non lu / Lu / Repondu
- Par **recherche** : nom, email, ou sujet

**Coordonnees de contact :**
En bas de la page, un formulaire permet de mettre a jour les **coordonnees officielles** affichees sur le site public :
- Adresse physique
- Telephones (principal et secondaire)
- Adresse e-mail officielle

---

### 8.2 Newsletter

Gestion de la liste des abonnes a la newsletter.

**Fonctionnalites :**
- Voir la liste de tous les abonnes (email + date d'inscription)
- Rechercher un abonne par email
- Supprimer un abonne

> Les inscriptions se font automatiquement depuis le formulaire newsletter du site public.

---

### 8.3 Commentaires

Moderation des commentaires laisses par les visiteurs sur les articles.

**Statuts des commentaires :**
- **En attente** : le commentaire attend la validation d'un administrateur
- **Approuve** : le commentaire est visible sur le site
- **Rejete** : le commentaire n'est pas publie

**Actions :**
- **Approuver** : rend le commentaire visible sur l'article
- **Rejeter** : masque le commentaire
- **Supprimer** : supprime definitivement le commentaire

> **Important** : Les commentaires ne sont jamais publies automatiquement. Chaque commentaire doit etre approuve manuellement.

---

## 9. Administration (Super-Admin)

> **Acces restreint** : cette section n'est visible et accessible que pour les utilisateurs ayant le role **Super-Admin**.

### 9.1 Gestion des utilisateurs

**Creer un utilisateur :**
1. Cliquez sur **"Nouvel utilisateur"**
2. Remplissez :
   - **Nom** (obligatoire)
   - **Email** (obligatoire, unique)
   - **Role** (obligatoire) : Super-Admin / Editeur / Redacteur
3. Enregistrez

> A la creation, un **mot de passe temporaire** est automatiquement genere et affiche. Communiquez-le de maniere securisee a l'utilisateur. Lors de sa premiere connexion, il devra obligatoirement le changer.

**Modifier un utilisateur :**
- Changez le nom, l'email ou le role
- La derniere date de connexion est visible dans le tableau

**Supprimer un utilisateur :**
- Cliquez sur le bouton de suppression et confirmez

### 9.2 Parametres du site

Les parametres permettent de configurer le **pied de page** (footer) du site public.

**Le footer est organise en 4 colonnes :**

| Colonne | Contenu |
|---------|---------|
| **A propos** | Nom, description, liens reseaux sociaux (Facebook, Twitter/X, LinkedIn, YouTube) |
| **Liens rapides** | Liens internes vers les pages du site |
| **Liens utiles** | Liens vers des sites institutionnels externes |
| **Informations legales** | Liens vers mentions legales, politique de confidentialite, politique cookies |

**Modifier les parametres :**
1. Modifiez les champs souhaites
2. Ajoutez ou supprimez des liens dans les listes
3. Cliquez sur **"Enregistrer"**

---

## 10. Structure du site public

Le site public est accessible a tous les visiteurs. Voici les pages disponibles :

### Pages principales

| Page | URL | Description |
|------|-----|-------------|
| **Accueil** | `/` | Hub principal : actualites a la une, galerie, mediatheque, evenements, partenaires, newsletter |
| **Actualites** | `/actualites` | Liste de tous les articles publies |
| **La DGIE** | `/la-dgie` | Presentation de l'institution, organigramme, directions |
| **Nos Services** | `/nos-services` | Services proposes par la DGIE |
| **Retour et Reintegration** | `/retour-reintegration` | Programmes de retour et de reinsertion |
| **Investir et Contribuer** | `/investir-contribuer` | Opportunites d'investissement pour la diaspora |
| **Coin des Diasporas** | `/coin-des-diaspos` | Espace dedie a la communaute diasporique |
| **Dossiers** | `/dossiers` | Dossiers thematiques approfondis |
| **Galerie** | `/galerie` | Tous les albums photos et videos |
| **Contact** | `/contact` | Formulaire de contact et coordonnees |

### Pages legales

| Page | URL |
|------|-----|
| **Mentions legales** | `/mentions-legales` |
| **Politique de confidentialite** | `/politique-confidentialite` |

### Pages dynamiques

| Page | URL | Description |
|------|-----|-------------|
| Article | `/actualites/{slug}` | Detail d'un article |
| Evenement | `/evenements/{slug}` | Detail d'un evenement |
| Dossier | `/dossiers/{slug}` | Detail d'un dossier thematique |
| Recherche | `/recherche` | Resultats de recherche (min. 3 caracteres) |

### Fonctionnalites interactives du site public

- **Flash infos** : bandeau defilant en haut de chaque page
- **Popup evenementiel** : s'affiche une seule fois par session a l'accueil pour les evenements mis en avant
- **Formulaire de contact** : les visiteurs peuvent envoyer un message (limite : 3 envois par 10 minutes)
- **Newsletter** : inscription a la newsletter via le formulaire en pied de page
- **Commentaires** : les visiteurs peuvent commenter les articles (soumis a moderation)
- **Sondages** : vote sur le sondage actif (limite : 5 votes par 10 minutes)
- **Recherche** : barre de recherche dans le header pour trouver des articles
- **Partage** : boutons de partage sur les articles (Facebook, Twitter/X, LinkedIn, WhatsApp)

---

## 11. Roles et permissions

La plateforme dispose de trois niveaux d'acces :

### Super-Admin

| Privilege | Description |
|-----------|-------------|
| Tous les modules | Acces complet en lecture, creation, modification et suppression |
| Utilisateurs | Creer, modifier, supprimer des utilisateurs |
| Parametres | Configurer le footer et les parametres du site |

### Editeur

| Privilege | Description |
|-----------|-------------|
| Tous les modules de contenu | Acces complet en lecture, creation, modification et suppression |
| Utilisateurs | **Pas d'acces** |
| Parametres | **Pas d'acces** |

### Redacteur

| Privilege | Description |
|-----------|-------------|
| Articles | Creation et modification uniquement |
| Autres modules | **Pas d'acces** |
| Suppression | **Pas autorisee** |
| Utilisateurs / Parametres | **Pas d'acces** |

---

## 12. Conventions et bonnes pratiques

### Redaction de contenu

- Utilisez le **vouvoiement** dans tous les contenus publics
- Privilegiez des phrases **courtes** (25 mots maximum)
- Utilisez la **voix active** autant que possible
- N'utilisez jamais "cliquez ici" comme texte de lien — preferez des ancres descriptives (ex : "Consulter le guide de retour")

### Images

| Type | Format recommande | Taille max |
|------|:-----------------:|:----------:|
| Article / Evenement | 16:9 (paysage) | 2 Mo |
| Personnel / Temoignage | Portrait | 2 Mo |
| Partenaire (logo) | Carre | 2 Mo |
| Banniere hero | 2400 x 800 px | 2 Mo |
| Banniere pub | 728 x 90 px ou 300 x 250 px | 2 Mo |
| Magazine (couverture) | Portrait | 2 Mo |

> Les formats acceptes sont **JPG**, **PNG** et **WebP**.

### Statuts du contenu

| Statut | Badge | Effet |
|--------|:-----:|-------|
| **Brouillon** | Gris | Non visible sur le site public |
| **Publie** | Vert | Visible sur le site public |
| **Archive** | Rouge | Retire du site public mais conserve en base |

### Champs automatiques

- Les **slugs** (identifiants URL) sont generes automatiquement a partir des titres
- Les **dates de creation/modification** sont enregistrees automatiquement
- Le **compteur d'elements** des albums galerie se met a jour automatiquement
- La **taille des fichiers** est calculee automatiquement pour les documents et magazines

### Securite

- Ne partagez jamais vos identifiants de connexion
- Deconnectez-vous apres chaque session sur un poste partage
- Les actions sensibles (creation, modification, suppression) sont enregistrees dans un **journal d'audit** pour la tracabilite

---

*Document genere pour la plateforme DGIE — Direction Generale des Ivoiriens de l'Exterieur*
*Derniere mise a jour : Fevrier 2026*
