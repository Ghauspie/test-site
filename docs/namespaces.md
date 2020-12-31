# Namespace

Un namespace est un "dossier virtuel" dans lequel est rangé une classe
- permet d'avoir plusieurs classes du même nom (entre notre code et le code des dépendances par exemple avec 2 classes "Data" qui provoquerait un conflit si on n'avait pas les namespaces pour distinguer ces 2 classes)
- doit être déclaré au tout début du fichier (avant le mot clé 'class')
- n'est valable que pour le fichier courant
- le séparateur de "dossiers virtuels" est le `\`

## Placer une classe dans un _Namespace_

La classe `Joconde` est "rangée" dans le "dossier virtuel" `Terre\Europe\France\Paris\Louvre`

```php
<?php

namespace Terre\Europe\France\Paris\Louvre;

class Joconde {
    // [...]

    public function smile() {
        // [...]
    }
}
```

Attention, toute classe "utilisée" dans le code interne à la classe sera considérée comme faisant partie du _Namespace_ de la classe (chemin relatif).

```php
<?php

namespace Terre\Europe\France\Paris\Louvre;

class Joconde {
    // [...]

    public function smile() {
        // [...]
        $mouth = new Mouth(); // => new \Terre\Europe\France\Paris\Louvre\Mouth()
    }
}
```

Pour éviter cela, il faudra spécifier le FQCN (fully qualified class name) de la classe (chemin absolu).

## Utiliser une classe d'un _Namespace_

### Fully Qualified Class Name

C'est le "chemin absolu" de l'endroit où est rangé la classe (namespace) + le nom de la classe.

```php
<?php

$tableau = new \Terre\Europe\France\Paris\Louvre\Joconde();
$tableau->smile();

```

### Mot clé `use`

Dès qu'on "utilise" au moins deux fois la classe dans un fichier PHP, il est intéressant de ne pas avoir à indiquer le FQCN.
- comme le mot-clé `namespace`, `use` n'est valable que pour le fichier courant
- le premier `\` est optionnel car il est implicite
- il doit être placé en haut du fichier, après le mot-clé `namespace` s'il y en a un

```php
<?php
use Terre\Europe\France\Paris\Louvre\Joconde;

$tableau1 = new Joconde();
$tableau1->smile();

$tableau2 = new Joconde();

```

## Classes natives PHP & classes d'autres _namespaces_

Toutes les classes natives de PHP se trouvent à la racine des _namespaces_  qui est `\`.

```php
<?php

namespace Terre\Europe\France\Paris\Louvre;

use Animals\Human\Face\Mouth;

class Joconde {
    // [...]

    public function smile() {
        // [...]
        $mouth = new Mouth(); // => \Animals\Human\Face\Mouth

        // Utilisation de la classe PDO, native à PHP (et donc rangée à la racine `\` des namespaces)
        $pdo = new \PDO();
    }
}
```

On pourrait aussi utiliser la classe PDO ainsi :

```php
<?php

namespace Terre\Europe\France\Paris\Louvre;

use Animals\Human\Face\Mouth;
use PDO;

class Joconde {
    // [...]

    public function smile() {
        // [...]
        $mouth = new Mouth(); // => \Animals\Human\Face\Mouth

        // Utilisation de la classe PDO, native à PHP (et donc rangée à la racine `\` des namespaces)
        $pdo = new PDO();
    }
}
```