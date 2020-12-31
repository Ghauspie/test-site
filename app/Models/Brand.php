<?php

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

class Brand extends CoreModel {

    protected $footer_order;

    /**
     * Get the value of footer_order
     */ 
    public function getFooterOrder()
    {
        return $this->footer_order;
    }

    /** 
     * Set the new footer_order value
     */
    public function setFooterOrder($footer_order) {
        $this->footer_order = $footer_order;
    }

    /**
     * Méthode permettant de retourner les 5 marques dans le footer
     *
     * @return array
     */
    public function findFooterBrands() {
        // Récupération de la connexion à la BDD avec PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT *
            FROM `brand`
            WHERE `footer_order` > 0
            ORDER BY `footer_order` ASC
            LIMIT 5
        ';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        // Comme c'est PDO qui crée les objets Brand, que PDO est à la racine
        // des namespaces `\`, si on lui donne à instancier une classe Brand
        // il fera des new \Brand();
        // il faut donc lui donner le FQCN de la classe
        // $brandsList = $pdoStatement->fetchAll(PDO::FETCH_CLASS,'\Oshop\Models\Brand');
        // Hereusement, on peut utiliser un raccourci automatique pour récupérer
        // ce nom
        // Version 1 :
        // dump(__CLASS__);
        //$brandsList = $pdoStatement->fetchAll(PDO::FETCH_CLASS,__CLASS__);
        // Version 2 :
        // self fait référence à la classe dans laquelle on est
        // et class va chercher le FQCN de celle-ci
        // dump(self::class);
        $brandsList = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);

        // On retourne la liste des 5 marques
        return $brandsList;
    }

    public function brandName($id) {
        
        // Récupération de la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT name
            FROM brand
            WHERE id = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $namebrand = $pdoStatement->fetchObject(self::class);

        // On retourne l'objet catégorie correspondant
        return $namebrand;
    }
    public function brandFindAll($id) {
        // Récupération de la connexion à la BDD avec PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = '
        SELECT product.* ,brand.name as name_brand
        FROM `product`
        inner join brand ON product.brand_id=brand.id
        WHERE `brand_id` = '.$id
        ;

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
}