# Documentation DGIE Laravel — Index

> Documentation générée automatiquement pour le projet DGIE Laravel.
> Dernière mise à jour : 2026-03-03

## Le Projet

Application web full-stack **Laravel 12** pour la Direction Générale des Ivoiriens de l'Extérieur (DGIE).
Monolithe MVC, rendu serveur (Blade), 28 modèles, 38 contrôleurs, 111 vues Blade.

**Production** : https://ivoiriendelexterieur.com

---

## Documents

| # | Document | Description | Public cible |
|---|----------|-------------|-------------|
| 1 | [Vue d'ensemble](project-overview.md) | Résumé exécutif, périmètre fonctionnel, rôles, chiffres clés, dépendances | Tous |
| 2 | [Architecture](architecture.md) | Stack technique, pattern MVC, auth, audit, email, CSS, sécurité | Développeurs, Architectes |
| 3 | [Modèles de données](data-models.md) | Schéma complet des 28 tables, relations, enums, données seedées | Développeurs |
| 4 | [Contrats API & Routes](api-contracts.md) | 100+ routes, middleware, validation, rate limiting, patterns de réponse | Développeurs |
| 5 | [Arborescence source](source-tree-analysis.md) | Structure complète des fichiers, comptages, annotations | Développeurs, Onboarding |
| 6 | [Guide de développement](development-guide.md) | Setup local, commandes, conventions, patterns UI, débogage | Développeurs |
| 7 | [Guide de déploiement](deployment-guide.md) | Pipeline CI/CD, endpoints de maintenance, procédures, dépannage | DevOps, Développeurs |

---

## Fichiers Complémentaires

| Fichier | Emplacement | Description |
|---------|-------------|-------------|
| CLAUDE.md | `/CLAUDE.md` | Instructions pour Claude Code (IA) |
| project-context.md | `/_bmad-output/project-context.md` | Règles critiques pour agents IA (47 règles) |
| Manuel utilisateur | `/MANUEL-UTILISATEUR.pdf` | Guide complet pour les administrateurs |

---

## Navigation Rapide

### Par Besoin

- **Je veux comprendre le projet** → [Vue d'ensemble](project-overview.md)
- **Je veux contribuer au code** → [Guide de développement](development-guide.md) + [Architecture](architecture.md)
- **Je cherche un modèle/table** → [Modèles de données](data-models.md)
- **Je cherche une route/API** → [Contrats API](api-contracts.md)
- **Je veux déployer** → [Guide de déploiement](deployment-guide.md)
- **Je cherche un fichier** → [Arborescence source](source-tree-analysis.md)

### Par Rôle

- **Nouveau développeur** : Vue d'ensemble → Guide de développement → Architecture
- **Développeur confirmé** : Modèles de données → Contrats API → Arborescence
- **DevOps** : Guide de déploiement → Architecture (section sécurité)
- **Agent IA** : CLAUDE.md → project-context.md → Documents pertinents

---

## Méta

| Attribut | Valeur |
|----------|--------|
| Générateur | BMAD Document Project Workflow |
| Mode | Deep Scan |
| Type de projet | Full-stack Laravel Web Application |
| Classification | Monolithe |
| Stack | Laravel 12 / PHP 8.3 / MySQL |
| Documents générés | 7 + index |
