<?php

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

// Pour créer un modèle, on s'inspire totalement de la table correspondante
// dans la BDD.
// On prend le nom de la table qu'on transforme en UpperCamelCase pour 
// trouver le nom de la class PHP.
// Ensuite, on prend le nom de chaque colonne de la table
// et on en fait une propriété de la classe.
// Dernière étape, on ajoute des getters et setters pour donner
// accès en lecture et/ou écriture à chaque propriété selon nos besoins.
class Type extends CoreModel {
    
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
     * Méthode permettant de retourner les 5 types dans le footer
     *
     * @return array
     */
    public function findFooterTypes() {
        // Récupération de la connexion à la BDD avec PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT *
            FROM `type`
            WHERE `footer_order` > 0
            ORDER BY `footer_order` ASC
            LIMIT 5
        ';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $typesList = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);

        // On retourne la liste des 5 types
        return $typesList;
    }
    public function typeName($id) {
        
        // Récupération de la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit la requête
        $sql = '
            SELECT name
            FROM type
            WHERE id = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère le résultat
        $nameType = $pdoStatement->fetchObject(self::class);

        // On retourne l'objet catégorie correspondant
        return $nameType;
    }

    public function typeFindAll($id) {
        // Récupération de la connexion à la BDD avec PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = '
        SELECT product.* ,type.name as name_type
        FROM `product`
        inner join type ON product.type_id=type.id
        WHERE `type_id` = '.$id
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