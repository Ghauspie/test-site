# Structure

## Dossier `public`

Ce dossier contient tous les fichiers "public".  
C'est-à-dire les fichiers qui peuvent être accédés par le client (navigateur).

- `index.php` (_FrontController_)
- fichiers CSS
- fichiers JS
- fichiers images
- `.htaccess` (parce qu'il fait partie du _FrontController_)

## Dossier `app`

Contient tous les fichiers qui n'ont pas besoin d'être accédés par le client (navigateur).  
Ils sont inclus par du code PHP.

- les _Controllers_
- les _Classes_
- les _Templates_ / _Views_
- => tous les fichiers "inclus"

## `app/.htaccess`

```
# on interdit l'accès
deny from all
```

Le fichier `.htaccess` dans le dossier `app` permet d'interdire l'accès au dossier, à ses sous-dossiers et à tous leurs fichiers, DEPUIS LE CLIENT.  
En interne, le code PHP pourra toujours inclure ces fichiers.

## `public/.htaccess`

```
RewriteEngine On

# dynamically setup base URI
RewriteCond %{REQUEST_URI}::$1 ^(/.+)/(.*)::\2$
RewriteRule ^(.*) - [E=BASE_URI:%1]

# redirect every request to index.php
# and give the relative URL in "_url" GET param
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?_url=/$1 [QSA,L]
```

Le fichier `.htaccess` dans le dossier `public` permet de créer un entonnoir pour toutes les requêtes HTTP faites par un client (navigateur).

Si la demande du client (URL) ne correspond pas à un fichier existant, ni à un dossier existant, alors, le fichier `public/index.php` sera exécuté (notre _FrontController_).

## `app/Controllers`

La bonne pratique à suivre pour les dossiers dans `app` qui vont contenir des classes, est de nommer ces dossiers en _UpperCamelCase_.

## "public" dans l'URL ?

En local, pour nos tests, ok  
En prod => NON !

### Mauvaise configuration en prod :x:

```
monsite.com
=> dossier /var/www/html/monsite-site.com-en-prod

mon-second-site.com
=> dossier /var/www/html/mon-site-numero2
```

### Bonne configuration en prod :heavy_check_mark:

```
monsite.com
=> dossier /var/www/html/monsite-site.com-en-prod/public

mon-second-site.com
=> dossier /var/www/html/mon-site-numero2/public
```

## `public/assets`

Dossier contenant tous les "atouts" de nos pages HTML.  
C'est la convention/bonne pratique à suivre pour organiser nos dossiers.

- fichiers CSS
- fichiers JS
- fichiers images
- etc.
