# PROJET INF102 --- Dadabe noely

**IT-University --- Novembre 2020**

## Caractéristiques

-   Groupe de 2 (1 seul groupe de 3 si impair).
-   À rendre le mercredi 02 décembre 2020 à 17h30.
-   Rendre le projet sur Git (dépôt GitHub/GitLab) contenant :
    -   le projet Laravel complet (avec les fichiers Docker) ;
    -   les migrations et seeders de la base de données.
-   Envoyer le lien du dépôt à `p13.ituniversity@gmail.com`.

## Technologies

Technologies à utiliser :

-   Laravel (PHP)
-   Docker (l'application doit se lancer avec `docker compose up`)
-   MySQL
-   Frontend au choix (Blade, Inertia + Vue/React, ou autre), avec
    HTML / CSS / JavaScript

## Thème : Dadabe noely

À l'approche des fêtes de Noël, le projet consiste à créer un site
permettant aux enfants de demander des cadeaux au Père Noël.

-   Les enfants s'inscrivent sur le site et reçoivent aléatoirement des
    **bons points** (ex. : 100 pts).
-   Ils peuvent ensuite choisir les cadeaux qu'ils souhaitent sans
    dépasser leur total de bons points.
-   Chaque cadeau correspond à un nombre de bons points nécessaire pour
    l'obtenir.
    -   Exemple : PS5 = 150 pts
    -   Barbie = 30 pts

## Base de données

Tables demandées :

### `gifts`

-   `id`
-   `name`
-   `points`
-   `category_id`
-   `image`

### `categories`

-   `id`
-   `name`

### `children`

-   `id`
-   `email`
-   `password`
-   `birth_year`
-   `contact`
-   `bonus_points`

### `wishes`

-   `id`
-   `child_id`
-   `gift_id`
-   `quantity`
-   `wished_at`
-   `is_validated`

### `admins`

-   `id`
-   `login`
-   `password`

## Règles de gestion

-   Exemples de catégories : jeux de société, console, poupée, etc.
-   Exemples de cadeaux : PS5, Monopoly, Barbie.
-   L'enfant ajoute les cadeaux souhaités à sa liste de souhaits.
-   Une page permet ensuite de **valider le souhait**. Après validation,
    il ne peut plus être modifié.
-   Tant que le souhait n'est pas validé, l'enfant peut le modifier
    autant de fois qu'il le souhaite, même après s'être déconnecté puis
    reconnecté.
-   L'enfant doit avoir **18 ans maximum** au moment de l'inscription.
-   Le total des cadeaux ne doit pas dépasser le nombre de bons points
    obtenu à l'inscription.
-   À l'inscription, l'enfant reçoit aléatoirement l'un des quatre
    niveaux de bons points suivants :
    -   100
    -   200
    -   350
    -   500

## Pages à faire

### Côté administrateur

-   Page de connexion administrateur.
-   Pages permettant d'ajouter, modifier et supprimer les données des
    tables :
    -   Catégorie
    -   Produit / cadeau
-   Pages de statistiques :
    -   Top 5 des cadeaux les plus demandés.
    -   Nombre d'enfants par valeur de bons points obtenue.

### Côté enfant

-   Inscription et connexion.
-   Affichage du nombre de bons points restant disponible.
-   Liste et recherche des cadeaux selon plusieurs critères :
    -   catégorie ;
    -   nom du cadeau ;
    -   points minimum ;
    -   points maximum.
-   Bouton **Ajouter souhait** sur la page d'un cadeau.
-   Liste des souhaits avec possibilité de modification et de
    suppression tant que la liste n'est pas validée.
-   Validation des souhaits.
-   Consultation des souhaits des autres enfants.

## Données de test

La base doit déjà contenir des données de test réelles (via les
seeders), en s'inspirant par exemple de sites de jouets.

Minimum demandé :

-   30 cadeaux ;
-   10 enfants ;
-   6 catégories.

Créer une page `/acces` contenant les identifiants de connexion
valides.

## Évaluation / Notes

Les éléments pris en compte sont :

-   Design (thème Noël)
-   Code
-   Fonctionnalités
-   Bonus pour une fonctionnalité supplémentaire
