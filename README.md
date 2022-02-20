# BIENVENUE DANS CATALOGUE

Ce référentiel contient toutes les informations capitales relatives à la conception de Catalogue


## Installation

### Etape 1 : Cloner le projet

- ` git clone ........................`

### Etape 2 : Installation des dépendances.
- `composer install`  à la racine du projet

### Etape 3 : Configuration de la Base de Données.
- `créer un fichier .env.local`  à la racine du projet et copier tout le contenu du fichier `.env`
  et modifier la ligne commançant par DATABASE_URL en mettant les parametres pour acceder a votre SGBDR

### Etape 4 : Création de la Base de Données.
- `symfony console doctrine:database:create`  à la racine du projet

### Etape 5 : Création des tables Base de Données en executant les migrations.
- `symfony console doctrine:migrations:migrate`  à la racine du projet

### Etape 6 : Lancement de l'application.
- `symfony serve`  à la racine du projet

## Forum

J'ai mis en place un forum pour la formation à l' adresse
https://join.slack.com/t/proenprogrammation/shared_invite/zt-y0p3t79h-jO0gH5SCaCxea7HRBwqpCA.  
C'est un endroit idéal pour poser des questions
sur les parties que vous n'aviez pas compris
ou pour signaler les erreurs que vous pourriez trouver.

## Contribution

Si vous souhaiter contribuer, Merci de consulter [contributing.md](contributing.md) pour plus de détail.

## Crédits

- [Suleiman KELANY ... ][Maintaineur du dépôt - suleiman.kelany@gmail.com - 96811665]

## Licence

Copyright **balise**. Veuillez consulter la [licence](#) pour plus d'information.
