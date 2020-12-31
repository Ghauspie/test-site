<?php

namespace Oshop\Controllers;

use Oshop\Models\Category;

class MainController extends CoreController {

    // Méthode dédiée à la gestion de la page d'accueil
    public function homeAction() {
        // Délègue l'affichage à la méthode "show" du MainController
        $homeObject= new Category;
        $category = $homeObject->homeCategory();
        $this->show('home',[
            'home_category'=>$category
        ]);
    }

    public function legalMentionsAction() {
        $this->show('legal-mentions');
    }

    /**
     * Méthode permettant de faire des tests pour valider notre code
     *
     */
    public function testAction() {
        // Récupérer la liste de tous les produits
        // $productObject = new Product();
        // dump($productObject->findAll());

        // Récupérer le produit ayant l'id 12
        // $productObject = new Product();
        // dump($productObject->find(12));

        // Récupérer la liste de toutes les catégories
        // $categoryObject = new Category();
        // $allCategories = $categoryObject->findAll();
        // dump($allCategories);
        // dump($categoryObject->findAll());

        // Récupérer la catégorie n° 3
        $categoryObject = new Category();
        //dump($categoryObject->find(3));
    }
}