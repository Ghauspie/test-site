<?php

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

class Category extends CoreModel {

    protected $subtitle;
    protected $picture;
    protected $home_order;




    public function categoryFindAll($id) {
        // Récupération de la connexion à la BDD avec PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = '
        SELECT product.*, category.name as name_category
        FROM product
        left join category ON product.category_id=category.id
        WHERE category_id = '.$id
        ;

        


        /*SELECT `product`.`id`, `product`.`name`, `product`.`price`, `product`.`picture`, `type`.`name` AS `type_name`
        FROM `product`
        INNER JOIN `type` ON `type`.`id` = `product`.`type_id`
        WHERE `product`.`category_id` ='.$id
       
        
        SELECT product.* ,category.name as name_category, type.name as name_type
        FROM `product`
        inner join type ON product.type_id=type.id
        inner join category ON product.category_id=category.id
        WHERE `category.id` = '*/
        

        // Exécution de la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // Récupération des résultats
        // Avec l'option PDO::FETCH_CLASS, on peut indiquer à PDO de nous
        // retourner le résultat sous la forme d'une liste d'objets
        // issus de la classe Product.
        // /!\ Pour que ça fonctionne, il faut absolument que le nom
        // des propriétés de la classe Product soit le même que le nom
        // des colonnes dans la table `product` dans la BDD
        $productsList = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);

        // On retourne la liste des produits
        return $productsList;
    }


    public function categoryName($id) {
        
        // Récupération de la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT category.name, category.subtitle
            FROM category
            WHERE id = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $nameCategory = $pdoStatement->fetchObject(self::class);

        // On retourne l'objet catégorie correspondant
        return $nameCategory;
    }
    /**
     * Méthode retournant la liste de toutes les catégories
     *
     */
    public function findAll() {
        // Récupération de la connexion à la BDD avec PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = '
            SELECT *
            FROM category
        ';

        // Exécution de la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // Récupération des résultats
        $categoriesList = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);

        // On retourne la liste des catégories
        return $categoriesList;
    }

    /**
     * Méthode permettant de retourner les informations d'une catégorie à partir
     * de son id
     * 
     * @param int $id L'identifiant de la catégorie à récupérer
     * 
     * @return Category L'objet catégorie correspond à l'id fourni
     */
    public function find($id) {
        
        // Récupération de la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT *
            FROM category
            WHERE id = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $category = $pdoStatement->fetchObject(self::class);

        // On retourne l'objet catégorie correspondant
        return $category;
    }
    public function homeCategory() {
        
        // Récupération de la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
        SELECT *
        FROM category
where  home_order != 0
order by home_order ASC 
        Limit 5 

            ';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $category = $pdoStatement->fetchall(PDO::FETCH_CLASS,self::class);

        // On retourne l'objet catégorie correspondant
        return $category;
    }


    /**
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }

  
}