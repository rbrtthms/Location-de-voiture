# Projet de location de voiture
Ce site permet de consulter les véhicules de l'agence de location et de réserver des véhicules disponibles avec un compte client. Les vendeurs peuvent aussi créer des annonces de location de voiture, rendre indisponible un véhicule et également d'en supprimer.
Chaque location de voiture crée une facture consultable par le client concerné et les vendeurs.

# Pour commencer
Télécharger les sources du projet.

## Pré-requis
- avoir un serveur **Apache**
- avoir un serveur **MySQL**
- avoir **PHP**
- avoir **composer** et **symfony**

## Installation
Vérifier les dépendances :
`symfony check:requirements`

Récupérer les dépendances (manquantes):
 - `Composer require orm-fixtures --dev`
 - `Composer require admin`
 - `composer require symfony/webpack-encore-bundle`

Connecter votre base de donnée dans le fichier **.env**

Exécuter ce fichier pour supprimer, créer les tables et réaliser les enregistrements :
`sh schemaUpdateFixture.sh`

Afficher le sql généré :
`php bin/console doctrine:schema:update  --dump-sql`

Exécuter le sql :
`php bin/console doctrine:schema:update  --force`

lister les version php :
`symfony local:php:list`

Changer de version php si besoin :
`echo version > .php-version`

Démarrer le projet en https :
`Symfony server:start`

Stopper le server
`Symfony server:stop`

# Licenses
Toutes images et sources dans le cadre de ce projet ont été utilisées à des fins éducatifs.  