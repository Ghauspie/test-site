<?php

namespace Oshop\Controllers;

// use Oshop\Models\Brand;
// use Oshop\Models\Type;
// Ecriture raccourcie si on a plusieurs classes issues du même endroit
use Oshop\Models\{Brand,Type};

class CoreController {
    /* Si on veut que la méthode show soit accessible aux classes héritant
    de CoreController, il faut la passer de private à protected */
    protected function show($viewName, $viewVars = []) {

        // C'est pas beau ce qu'on fait là, mais c'est une façon 
        // plus accessible pour aujourd'hui de donner accès à la variable
        // $router (définie dans index.php) dans la méthode show
        // au lieu de faire des choses trop compliquées
        global $router;

        // Pour corriger les liens des assets sur notre site,
        // on doit utiliser des urls absolues
        // On rajoute donc une variable contenant le chemin
        // vers le répertoire 'public'
        $absoluteUrl = $_SERVER['BASE_URI'].'/';
        
        // On récupère les informations communes à toutes les pages
        // - les 5 marques présentes dans le footer
        $brandObject = new Brand();
        $footerBrands = $brandObject->findFooterBrands();
        // - les 5 types présents dans le footer
        $typeObject = new Type();
        $footerTypes = $typeObject->findFooterTypes();

        // extract permet de créer des variables à partir des clés
        // d'un tableau associatif, ces variables contiendront les valeurs
        // associées aux clés du tableaux
        // Par exemple si $viewVars contient :
        // $viewVars = [
        //     'cle1' => 'valeur1',
        //     'cle2' => 'valeur2'
        // ];
        // Alors après le extract, PHP aurait créé les variables suivantes :
        // $cle1 = 'valeur1';
        // $cle2 = 'valeur2';
        extract($viewVars);

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/footer.tpl.php';
    }
}