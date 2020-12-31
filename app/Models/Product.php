<?php

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

class Product extends CoreModel {

    protected $description;
    protected $picture;
    protected $price;
    protected $rate;
    protected $status;
    protected $brand_id;
    protected $category_id;
    protected $type_id;

    /**
     * Méthode retournant la liste de tous les produits
     *
     */
    public function findAll() {
        // Récupération de la connexion à la BDD avec PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = '
            SELECT *
            FROM product
        ';

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

    /**
     * Méthode permettant de retourner les informations d'un produit à partir
     * de son id
     */
    public function find($id) {
        
        // Récupération de la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT *
            FROM product
            WHERE id = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $product = $pdoStatement->fetchObject(self::class);

        // On retourne le produit correspondant
        return $product;
    }


    public function productFind($id) {
        
        // Récupération de la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT product.*, type.name as name_type, category.name as name_category, brand.name as name_brand  
            FROM product
            inner join type ON product.type_id=type.id
            inner join brand ON product.brand_id=brand.id
            left outer join category ON product.category_id=category.id
            WHERE product.id = ' . $id
            ;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $productFind = $pdoStatement->fetchObject(self::class);

        // On retourne le produit correspondant
        return $productFind;
    }
    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */ 
    public function setDescription($description)
    {
        $this->description = $description;
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
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of rate
     */ 
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     */ 
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */ 
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get the value of brand_id
     */ 
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     */ 
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Get the value of category_id
     */ 
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */ 
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of type_id
     */ 
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     */ 
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;
    }
}