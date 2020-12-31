# Composer

## Configuration du projet (optionnel)

`composer init`

## Installation des dépendances

Basé sur le fichier `composer.json` (à la racine du projet) :

`composer install`

Commande à effectuer juste après avoir cloné un projet qui contient un fichier `composer.json`  
=> composer va télécharger les sources de toutes les dépendances

## Mise à jour des dépendances

Basé sur le fichier `composer.json` (à la racine du projet) :

`composer update`

## Listing de toutes les dépendances disponibles

https://packagist.org/

## Dépendance

= librairie  
= package

## Ajouter une dépendance à un projet

Ouvrir un terminal, dans le dossier du projet :

`composer require author/dependancy`

Pour [var-dumper](https://packagist.org/packages/symfony/var-dumper), par exemple : `composer require symfony/var-dumper`

:warning: On oubliera pas le `require 'vendor/autoload.php'` dans notre fichier index pour que les dépendances soient accessibles dans le projet.

## On ignore les sources externes

Le code source des librairies/dépendances ne doit jamais être modifié.  
Ainsi, pourquoi les versionner ? (ajouter dans Git)  
=> on va dire à Git d'ignorer le dossier `vendor`

**fichier `.gitignore` à la racine du projet**

```
# ignorer les fichiers & dossiers liés à Composer
# sauf composer.json bien sûr
vendor
```
