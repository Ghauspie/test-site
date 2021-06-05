<?php

namespace App\Controllers;

use App\Models\Category;


// Pour interdire l'instanciation de CoreModel, on rend la classe abstraite (avec abstract)
// use App\Models\CoreModel;
// $coreModelObject = new CoreModel();
// var_dump($coreModelObject);

/**
 * Controller dédié à l'affichage des catégories
 */
class CategoryController extends CoreController {
    /**
     * Listing des categories
     */
    public function list()
    {
        // On récupère toutes les catégories
        $categoryModel = new Category();
        $categories = $categoryModel->findAll();
        // var_dump($products);

        // On les envoie à la vue
        $this->show(
            'category/list',
            ['categories' => $categories,
            'tokenCSRF' => $this->generateTokenCSRF()
            ]
        );
    }

    /**
     * Ajout d'une catégorie
     * 
     * @return void
     */
    public function add()
    {
        $this->show(
            'category/add-edit',
            [
                'category' => new Category()
            ]
        );
    }    

    /**
     * Affiche la vue édition d'une catégorie (pré-remplie)
     * 
     * @param int $categoryId L'ID de la catégorie à éditer
     */
    public function edit($categoryId)
    {
        // On récupère notre catégorie
        $category = Category::find($categoryId);

        // On affiche notre vue en transmettant les infos du produit
        $this->show(
            'category/add-edit',
            [
                'category' => $category
            ]
        );
    }

    /**
     * POST Création d'une catégorie.
     *
     * @return void
     */
    public function create()
    {
        // On tente de récupèrer les données venant du formulaire.
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

        // On vérifie l'existence et la validité de ces données (gestion d'erreur).
        $errorsList = [];

        // Pour le "name", faut vérifier si la chaîne est présente *et* si elle
        // a passé le filtre de validation.
        if (empty($name)) {
            $errorsList[] = 'Le nom est vide';
        }
        if ($name === false) {
            $errorsList[] = 'Le nom est invalide';
        }
        // Pareil pour le "subtitle".
        if (empty($subtitle)) {
            $errorsList[] = 'Le sous-titre est vide';
        }
        if ($subtitle === false) {
            $errorsList[] = 'Le sous-titre est invalide';
        }
        // Pour l'URL de l'image "picture", le filtre vérifie forcément sa présence aussi.
        if ($picture === false) {
            $errorsList[] = 'L\'URL d\'image est invalide';
        }

        // S'il n'y a aucune erreur dans les données...
        if (empty($errorsList)) {
            // On instancie un nouveau modèle de type Category.
            $category = new Category();

            // On met à jour les propriétés de l'instance.
            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);

            // On tente de sauvegarder les données en DB...
            if ($category->insert()) {
                // Si la sauvegarde a fonctionné, on redirige vers la liste des catégories.
                header('Location: /category/list');
                exit;
            }
            else {
                // Sinon, on ajoute un message d'erreur à la page actuelle, et on laisse
                // l'utilisateur retenter la création.
                $errorsList[] = 'La sauvegarde a échoué';
            }
        }

        // S'il y a une ou de(s) erreur(s) dans les données...
        else {
            // On réaffiche le formulaire, mais pré-rempli avec les (mauvaises) données
            // proposées par l'utilisateur.
            // Pour ce faire, on instancie un modèle Category, qu'on passe au template.

            $category = new Category();
            $category->setName(filter_input(INPUT_POST, 'name'));
            $category->setSubtitle(filter_input(INPUT_POST, 'subtitle'));
            $category->setPicture(filter_input(INPUT_POST, 'picture'));

            $this->show(
                'category/add-edit',
                [
                    // On pré-remplit les inputs avec les données BRUTES initialement
                    // reçues en POST, qui sont actuellement stockées dans le modèle.
                    'category' => $category,
                    // On transmet aussi le tableau d'erreurs, pour avertir l'utilisateur.
                    'errorsList' => $errorsList
                ]
            );
        }
    }

     /**
     * POST Modification d'une catégorie(dans la BDD).
     *
     * @return void
     */
    public function update($categoryId)
    {

        // var_dump($categoryId);
        // exit;

        // On tente de récupèrer les données venant du formulaire.
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, 'picture', FILTER_VALIDATE_URL);

        // On vérifie l'existence et la validité de ces données (gestion d'erreur).
        $errorsList = [];

        // Pour le "name", faut vérifier si la chaîne est présente *et* si elle
        // a passé le filtre de validation.
        if (empty($name)) {
            $errorsList[] = 'Le nom est vide';
        }
        if ($name === false) {
            $errorsList[] = 'Le nom est invalide';
        }
        // Pareil pour le "subtitle".
        if (empty($subtitle)) {
            $errorsList[] = 'Le sous-titre est vide';
        }
        if ($subtitle === false) {
            $errorsList[] = 'Le sous-titre est invalide';
        }
        // Pour l'URL de l'image "picture", le filtre vérifie forcément sa présence aussi.
        if ($picture === false) {
            $errorsList[] = 'L\'URL d\'image est invalide';
        }

        // S'il n'y a aucune erreur dans les données...
        if (empty($errorsList)) {

            // 1. On récupère la catégorie concernée dans la BDD => on récupère un objet
            // 2. On alimente cet objet avec les données mises à jour
            // 3. On met à jour dans la BDD

            // On récupère la catégorie courante (dans la BDD)
            $category = Category::find($categoryId);

            // var_dump($category);
            // die;

            // On met à jour les propriétés de l'instance.
            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);

            // On execute la méthode update sur le modèle
            $ok = $category->update();

            // On tente de sauvegarder les données en DB...
            if ($ok) {
                // Si la sauvegarde a fonctionné, on redirige vers la liste des catégories.
                header('Location: /category/list');
                exit;
            }
            else {
                // Sinon, on ajoute un message d'erreur à la page actuelle, et on laisse
                // l'utilisateur retenter la création.
                $errorsList[] = 'La sauvegarde a échoué';
            }
        }

        // S'il y a une ou de(s) erreur(s) dans les données...
        else {
            // On réaffiche le formulaire, mais pré-rempli avec les (mauvaises) données
            // proposées par l'utilisateur.
            // Pour ce faire, on instancie un modèle Category, qu'on passe au template.

            $category = new Category();
            $category->setName(filter_input(INPUT_POST, 'name'));
            $category->setSubtitle(filter_input(INPUT_POST, 'subtitle'));
            $category->setPicture(filter_input(INPUT_POST, 'picture'));

            $this->show(
                'category/add-edit',
                [
                    // On pré-remplit les inputs avec les données BRUTES initialement
                    // reçues en POST, qui sont actuellement stockées dans le modèle.
                    'category' => $category,
                    // On transmet aussi le tableau d'erreurs, pour avertir l'utilisateur.
                    'errorsList' => $errorsList
                ]
            );
        }
    }

    public function delete($categoryId)
    {
        $category = Category::find($categoryId);

        // si la catégorie existe
        if($category) {
            // on la supprime de la BDD
            $category->delete();
            // on redirige vers la liste
            header('Location: /category/list');
        }
        else {
            echo 'La catégorie n\'existe pas';
        }
    }

    public function listorder()
    {
        $this->show('order/order');
    }

    public function updateorder()
    {
       
        $reset=New category;
        $reset=$reset->reset();
        
            // 1. On récupère la catégorie concernée dans la BDD => on récupère un objet
            // 2. On alimente cet objet avec les données mises à jour
            // 3. On met à jour dans la BDD
            foreach ($_POST['emplacement'] as $home_order => $categoryId) {
                // On récupère la catégorie courante (dans la BDD)
                $home_order+=1;
                dump($home_order, $categoryId);
                $Order = Category::find($categoryId);
                //dump($Order);
                //die;
                // On met à jour les propriétés de l'instance.
                $Order->getId($categoryId);
                $Order->setHomeOrder($home_order);
                dump($Order);
                // on met a jours les données sur la BDD
                $ok = $Order->updateorder();
                
                
                }
        if ($ok) {
            // Si la sauvegarde a fonctionné, on redirige vers la liste des catégories.
            header('Location: /category/list');
                    
        }
        else {
            // Sinon, on ajoute un message d'erreur à la page actuelle, et on laisse
            // l'utilisateur retenter la création.
            echo 'La sauvegarde a échoué';
        }
           
            exit;
    }
    
}