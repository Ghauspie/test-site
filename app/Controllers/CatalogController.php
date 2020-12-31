<?php

namespace Oshop\Controllers;


use Oshop\Models\Brand;
use Oshop\Models\Type;
use Oshop\Models\Category;
use Oshop\Models\Product;

class CatalogController extends CoreController {

    public function categoryAction($params) {
        // dump($params);
        $id = $params['id'];
        // dump($categoryId);

        // Pour tester nos modèles, on va essayer d'afficher la liste de 
        // tous les produits, prochainement on affichera uniquement
        // les produits de la catégorie demandée

        $productObject = new Category();
        $productsList = $productObject->categoryFindAll($id);
        $nameCategory= $productObject->categoryName($id);

        $this->show('category', [
            'id_category' => $id,
            'products_list' => $productsList,
            'name_category' => $nameCategory
        ]);
    }

    public function typeAction($params) {
        $id = $params['id'];

        $productObject = new Type();
        $productsList = $productObject->typeFindAll($id);
        $nameType= $productObject->typeName($id);
        $this->show('type', [
            'id_type' => $id,
            'products_list' => $productsList,
            'name_type' => $nameType
        ]);
    }

    public function brandAction($params) {
        $id = $params['id'];
        $productObject = new Brand();
        $productsList = $productObject->brandFindAll($id);
        $nameBrand= $productObject->brandName($id);
        $this->show('brand', [
            'id_brand' => $id,
            'products_list' => $productsList,
            'name_Brand' => $nameBrand
        ]);
    }

    public function productAction($params) {
        $id=$params['id'];
        $productObject= new Product();
        $productFind= $productObject->productFind($id);
        $this->show('product', [
            'id_product' => $id,
            'product' => $productFind
        ]);
    }
}