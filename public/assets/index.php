<?php

// --------------------------------------------------------------
// Inclusions des classes
// --------------------------------------------------------------

// Inclusion spécifique pour utiliser les dépendances installées avec composer
require __DIR__.'/../vendor/autoload.php';


// --------------------------------------------------------------
// Tentative de chargement automatique des classes
// --------------------------------------------------------------
// Avec spl_autoload_register : https://www.php.net/spl_autoload_register

/*function classNotFoundCallback($notFoundClassName) {
    // la fonction de callback reçoit un paramètre qui contient le nom
    // de la classe qui n'a pas été trouvée
    dump($notFoundClassName);
    // Dans l'idée, il faudrait regarder si le nom de la classe correspond
    // à une classe de contrôleur
    // Si c'est le cas, je vais charger cette classe à partir du Dossier
    // app/Controllers
    // Est-ce que le nom de la classe non trouvée contient 'Controller'
    // si oui, je vais chercher dans le dossier correspondant
    if (strpos($notFoundClassName,'Controller') !== false) {
        require __DIR__.'/../app/Controllers/'.$notFoundClassName.'.php';
    }
    // Même principe pour charger les Models
    else if (strpos($notFoundClassName,'Model') !== false) {
        require __DIR__.'/../app/Models/'.$notFoundClassName.'.php';
        // problème, nos classes Models ne contiennent pas le mot Model
        // => il faudrait toutes les renommées ainsi que les fichiers correspondants
    }
}*/

// Ci-dessous, on définit le nom de la fonction à appeler
// si PHP tombe sur une classe non définie (non incluse)
// Le but est de pouvoir charger uniquement les classes dont on a besoin
// pour génrer les pages de notre site (cela permettrait d'éviter de charger
// toutes les classes alors que seulement une poignée d'entre elles sont
// nécessaires pour une page donnée)
// Par exemple: l'accueil n'a besoin de la classe CatalogController
// spl_autoload_register('classNotFoundCallback');

// --------------------------------------------------------------
// Préparation d'AltoRouter
// --------------------------------------------------------------
$router = new AltoRouter();

// Comme la racine de notre site oShop n'est pas située à la racine du
// serveur web (qui est elle est directement localhost/ située dans /var/www/html)
// On doit préciser où se situe la racine d'oShop
// Pourquoi ? => pour permettre à AltoRouter d'analyser la bonne partie de l'url
// Par exemple pour l'url :
// http://localhost/Socle/Marty/5/S05-projet-oShop-StephaneP43/public/catalogue/category
// on veut qu'AltoRouter analyse la partie après '/public'
// => '/catalogue/category'
// on pourrait donner la racine de notre site en dur comme ceci à AltoRouter :
// $router->setBasePath('/Socle/Marty/5/S05-projet-oShop-StephaneP43/public');
// MAIS ça ne marcherait pour toute la promo car personne n'est exactement la même
// structure de répertoires pour le projet oShop
// Heureusement, avec $_SERVER['BASE_URI'] (dont la valeur est calculée par le fichier .htaccess
// présent dans le répertoire public, on a une valeur dynamique qui fonctionnera pour tout le monde)
// dump($_SERVER['BASE_URL']);
$router->setBasePath($_SERVER['BASE_URI']);

// Définition des routes
// Route pour la page d'acceuil
$router->map(
    'GET', // la méthode HTTP qui est autorisée pour cette route
    '/', // la partie d'url (après la racine du site) qui correspond à la page demandée
    // les informations qu'on récupèrera plus tard si on tombe sur cette route
    [
        'controller' => 'MainController',
        'method' => 'homeAction'
    ], 
    'main-home' // un identifiant unique pour cette route, celui peut permettre
    // avec la méthode generate d'AltoRouter de générer l'URL correspondante
);

// Route pour les mentions légales
$router->map(
    'GET',
    '/mentions-legales/',
    [
        'controller' => 'MainController',
        'method' => 'legalMentionsAction'
    ],
    'main-legal-mentions'
);

// Route pour la page affichant une catégorie et tous les produits associés
$router->map(
    'GET',
    '/catalogue/categorie/[i:id]', // i correspond à la recherche d'un entier
                                   // id correspond au nom de la clé qui contiendra
                                   // la valeur de cet entier dans le tableau params
                                   // extrait dans $match
    [
        'controller' => 'CatalogController',
        'method' => 'categoryAction'
    ], 
    'catalog-category'
);

// Route pour la page affichant un type et tous les produits associés
$router->map(
    'GET',
    '/catalogue/type/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'typeAction'
    ], 
    'catalog-type'
);

// Route pour la page affichant une marque et tous les produits associés
$router->map(
    'GET',
    '/catalogue/marque/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'brandAction'
    ], 
    'catalog-brand'
);

// Route pour la page affichant un produit et tous les détails de ce produit
$router->map(
    'GET',
    '/catalogue/produit/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'productAction'
    ], 
    'catalog-product'
);

// Route pour la page de test
$router->map(
    'GET',
    '/test/',
    [
        'controller' => 'MainController',
        'method' => 'testAction'
    ],
    'main-test'
);

// On regarde s'il y a une route pour la page demandée ?
$match = $router->match();
// dump($match);

// if ( $match !== false ) {
if ( $match ) {

    // on récupère le nom du contrôleur à instancier
    $controllerToUse = '\\Oshop\\Controllers\\' . $match['target']['controller'];
    // dump($controllerToUse);

    // on récupère la méthode à appeler dans le MainController
    $methodToCall = $match['target']['method'];
    // dump($methodToCall);

    // on récupère les données dynamiques issues de l'url qui ont été
    // extraite par AltoRouter lors du ->match()
    $params = $match['params'];
    
    // on instancie le bon contrôleur
    $controller = new $controllerToUse();
    // pour l'accueil, si $controllerToUse vaut 'MainController'
    // alors PHP exécutera : $controller = new MainController();
    // dump($controller);

    // on appelle la méthode du contrôleur
    $controller->$methodToCall($params);
    // Pour l'accueil :
    // $methodToCall vaut 'homeAction'
    // et Php appelera donc : $controller->homeAction();

} else {
    // Si on ne trouve pas de route => erreur 404
    $errorController = new \Oshop\Controllers\ErrorController();
    $errorController->pageNotFoundAction();
}