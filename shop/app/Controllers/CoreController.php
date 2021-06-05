<?php

namespace App\Controllers;

use App\Controllers\ErrorController;

abstract class CoreController {


    public function __construct()
    {
         // Récupération des infos sur la route courante grâce à la variable $match
         global $match;
         var_dump($match);

         // On récupère le nom de la route courante
        $routeName = $match['name'];

          // On définit la liste des permissions pour les routes nécessitant une connexion utilisateur
          $acl = [
            'main-home' => ['admin', 'catalog-manager'],
            // 'user-login' => [] // pas besoin car aucune authentification pour accéder à la route
            'user-add' => ['admin'],
            'user-create' => ['admin'],
            'user-list' => ['admin'],
            'product-add' => ['admin', 'catalog-manager'],
            'product-list' => ['admin', 'catalog-manager'],
            'product-delete' => ['admin', 'catalog-manager'],
            'product-create' => ['admin', 'catalog-manager'],
            'product-edit' => ['admin', 'catalog-manager'],
            'product-update' => ['admin', 'catalog-manager'],
            'category-add' => ['admin', 'catalog-manager'],
            'category-list' => ['admin', 'catalog-manager'],
            'category-delete' => ['admin', 'catalog-manager'],
            'category-create' => ['admin', 'catalog-manager'],
            'category-edit' => ['admin', 'catalog-manager'],
            'category-update' => ['admin', 'catalog-manager']
          ];

          // Si la route actuelle est dans la liste des ACL(acces control list)
          if (array_key_exists($routeName, $acl)) {
              // Alors on récupère l'array des roles asoociés
            $authorizedRoles = $acl[$routeName];
            $this->checkAuthorization($authorizedRoles);
        }

          // Routes avec check anti-CSRF en POST
          $csrfTokenToCheckInPost = [
            'user-update',
            'product-update',
            'category-update',
            'user-create',
            'product-create',
            //'home-postOrder'
            //etc...
        ];

        $csrfTokenToCheckInGet = [
            'category-delete',
            //'home-list'
            // etc...
        ];


        // Si la route courante nécessite la vérification du token CSRF
        if (in_array($routeName, $csrfTokenToCheckInPost)){
            $token = filter_input(INPUT_POST, 'tokenCSRF');
           // var_dump($token);
            //var_dump($_SESSION);
           // exit;
           // si ils ne sont pas égaux ou vide

            // si $_SESSION['tokenCSRF'] est définit, alors $sessionToken = $_SESSION['tokenCSRF'], sinon $sessionToken = '';
           $sessionToken = isset($_SESSION['tokenCSRF'])? $_SESSION['tokenCSRF']: '';
           if ($token !==$sessionToken || empty($token))
           {
             // on a un souci, on affiche une 403
             ErrorController::err403();
             // et surtout, on arrête tout !!!
             exit;
           }
           else 
           {
            unset($_SESSION['tokenCSRF']);
           }
        };
        // Si la route courante nécessite la vérification du token CSRF
        if (in_array($routeName, $csrfTokenToCheckInGet)){
            $token = filter_input(INPUT_GET, 'tokenCSRF');
           // var_dump($token);
            //var_dump($_SESSION);
           // exit;
           // si ils ne sont pas égaux ou vide

            // si $_SESSION['tokenCSRF'] est définit, alors $sessionToken = $_SESSION['tokenCSRF'], sinon $sessionToken = '';
           $sessionToken = isset($_SESSION['tokenCSRF'])? $_SESSION['tokenCSRF']: '';
           if ($token !==$sessionToken || empty($token))
           {
             // on a un souci, on affiche une 403
             ErrorController::err403();
             // et surtout, on arrête tout !!!
             exit;
           }
           else 
           {
            unset($_SESSION['tokenCSRF']);
           }
        };

    }

    protected function generateTokenCSRF()
    {
        // on met en session une string générée aléatoirement
        $_SESSION['tokenCSRF']=bin2hex(random_bytes(32));
        // puis on return cette string (depuis la session)
        return $_SESSION['tokenCSRF'];
        // on pourait générer le token de différentes manières...(hash...)
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected static function show(string $viewName, $viewVars = []) {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        // De cette manière, on a accès à $router dans les vues (car on a modifié sa portée)
        global $router;

        // Comme $viewVars est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewVars['currentPage'] = $viewName; 

        // définir l'url absolue pour nos assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . '/assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewVars, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewVars);
        // var_dump($viewVars);
        // var_dump($baseUri);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }

    /**
     * Méthode de vérification des droits du user courant pour faire telle ou telle action
     *
     * @param array $roles
     * @return bool return true si ok, redirige vers une erreur si pas ok
     */
    public static function checkAuthorization($roles=[]) {

        global $router;

        // Si l'utilisateur est connecté
        if (isset($_SESSION['userId'])) {
            // Alors on récupère cet utilisateur
            $currentUser = $_SESSION['userObject'];
            // On récupère son rôle
            $currentUserRole = $currentUser->getRole();
            // Si le rôle fait partie des rôles autorisés (fournis en paramètre)
            if (in_array($currentUserRole, $roles)) {
                // Alors on return true
                return true;
            }
            else {
                // Sinon, on affiche une erreur 403
                ErrorController::err403();
                //$error->err403();
                // Et on arrête tout...
                exit;

            }
        }
        // Sinon (l'utilisateur n'est pas connecté)
        else {
            //$loginPageUrl = $router->generate('user-login');
            // On redirige vers la page de login
        header('Location: /user/login'  /*$loginPageUrl*/);
            exit;
        }
    }
}
