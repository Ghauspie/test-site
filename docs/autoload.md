# Autoload

## Les PSRs

[Les PSRs sur le site PHP-FIG](https://www.php-fig.org/psr)

Pour charger le fichier `Vendor/Model/Foo.php` déclarant la classe `Foo`

### Selon la norme PSR-0

Le nom de classe contient les dossiers et sous-dossiers jusqu'au fichier déclarant la classe. Le séparateur de dossier est remplace par un `_` dans le nom de la classe.

```php
<?php
// PHP 5.2.x and earlier:
class Vendor_Model_Foo
{
}
```

### PSR-4

Le "dossier virtuel" de chaque classe (son _Namespace_) est une représentation du dossier réel dans lequel le fichier déclarant la classe est placé.  
Le fichier déclarant la classe est du nom exact de la classe.

```php
<?php
// PHP 5.3 and later:
namespace Vendor\Model;

class Foo
{
}
```

## Mise en place

### #1 - configurer l'autoload avec Composer

Dans le fichier composer.json

```js

    "autoload": {
        "psr-4": {
            "NomDuProjet\\": "app/"
        }
    }
```

Puis, pour chaque modification de cette partie "autoload" du fichier composer.json, on exécute la commande :  
`composer dump-autoload`

:warning: On oubliera pas le `require 'vendor/autoload.php'` dans notre fichier index pour que les dépendances soient accessibles.

### #2 - on "place" chaque classe dans un namespace

Au début de chaque classe, on précise le namespace (dossier virtuel) dans lequel elle se trouve.

Exemple, pour la classe MainController se situant dans `app/Controllers/MainController.php`

```php
<?php

namespace NomDuProjet\Controllers;

class MainController {
    // ...
}

```

### #3 - utilisation de nos classes

Désormais, `MainController` ne suffit plus pour déterminer la classe `MainController` qui se situe dans `app/Controllers/MainController.php`.

On doit préciser son Fully Qualified Class Name (FQCN), c'est-à-dire son "chemin absolu" (commençant par `\`).

```php
<?php

$controller = new \NomDuProjet\Controllers\MainController();
$controllerBis = new \NomDuProjet\Controllers\MainController();

```

### #4 - coder avec les _Namespaces_

[Pour plus d'infos sur les _Namespaces_](namespace.md)

## Debug

- vérifier que tous les fchiers sont sauvegardés
- ré-exécuter la commande `composer dump-autoload`
- vérifier la présence de `require 'vendor/autoload.php'` dans le code du projet
- vérifier que le use ou le FQCN est correct, à la majuscule/minuscule près
- vérifier que la classe est bien placée dans le bon namespace
- vérifier que le namespace de la classe est correct, à la majuscule/minuscule près
