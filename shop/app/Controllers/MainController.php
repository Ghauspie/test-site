<?php

namespace App\Controllers;

// Si j'ai besoin du Model Category
use App\Models\{Category, Product};

class MainController extends CoreController {

    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {

        // On vérifie que l'utilisateur connecté a le droit d'accéder à cette page (il doit être admin ou catalog-manager)
        //CoreController::checkAuthorization(['admin', 'catalog-manager']);
        //désormais on utilise via le corecontroller
        

        // On récupère les catégories de la home
        // $categoryModel = new Category();

        // appel de la méthode statique
        $categories = Category::findAllHomepage();

        // On récupère les produits de la home
        // $productModel = new Product;
        $products = Product::findAllHomepage();

        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show(
            'main/home',
            [
                'categories' => $categories,
                'products' => $products
            ]
        );
    }
}
