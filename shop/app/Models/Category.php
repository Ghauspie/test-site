<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
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
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     * 
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
    public static function find($categoryId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `category` WHERE `id` =' . $categoryId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $category = $pdoStatement->fetchObject('App\Models\Category');

        // retourner le résultat
        return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     * 
     * @return Category[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $results;
    }

    /**
     * Récupérer les 3 catégories mises en avant sur la home
     * 
     * @return Category[]
     */
    public static function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            WHERE home_order > 0
            ORDER BY home_order ASC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Category');
        
        return $categories;
    }

    /**
     * Méthode permettant d'ajouter un enregistrement dans la table category.
     * L'objet courant doit contenir toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     * 
     * @return bool
     */
    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO
        $sql = "
            INSERT INTO `category` (name, subtitle, picture)
            VALUES (:name, :subtitle, :picture)
        ";

        // Préparation de la requête d'insertion (+ sécurisé que exec directement)
        // @see https://www.php.net/manual/fr/pdo.prepared-statements.php
        //
        // Permet de lutter contre les injections SQL
        // @see https://portswigger.net/web-security/sql-injection (exemples avec SELECT)
        // @see https://stackoverflow.com/questions/681583/sql-injection-on-insert (exemples avec INSERT INTO)
        $query = $pdo->prepare($sql);

        // Execution de la requête d'insertion
        // On peut envoyer les données « brutes » à execute() qui va les "sanitize" pour SQL.
        $query->execute([
          ':name' => $this->name,
          ':subtitle' => $this->subtitle,
          ':picture' => $this->picture,
        ]);

        // Si au moins une ligne ajoutée
        if ($query->rowCount() > 0) {
            // Alors on récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // On retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
            // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
        }
        
        // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
        return false;
    }

    /**
     * Méthode permettant de mettre à jour un enregistrement dans la table category
     * L'objet courant doit contenir l'id, et toutes les données à ajouter : 1 propriété => 1 colonne dans la table
     * 
     * @return bool
     */
    public function update()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête UPDATE
        $sql = "
            UPDATE `category`
            SET
                name = :name,
                subtitle = :subtitle,
                picture = :picture,
                updated_at = NOW()
            WHERE id = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        // on utilise bindValue et pas simplement un array
        // avantage : on peut contraindre les types de données
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $pdoStatement->bindValue(':picture', $this->picture, PDO::PARAM_STR);

        // Execution de la requête de mise à jour
       return $pdoStatement->execute();
    }

    /**
     * Méthode de supression d'une catégorie
     *
     * @return bool Return `true` si la catégorie a bien été supprimée
     */
    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = '
            DELETE FROM `category`
            WHERE id = :id
        ';

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

        $pdoStatement->execute();

        // https://www.php.net/manual/fr/pdostatement.rowcount.php
        // on return true si au moins une ligne a été supprimée
        return ($pdoStatement->rowCount() > 0);
    }
    public function updateorder(){
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();
   
        // Ecriture de la requête UPDATE
        $sql = "
        UPDATE `category`
            SET
                home_order = :home_order,
                updated_at = NOW()
            WHERE id = :id
        ";
   
           $query = $pdo->prepare($sql);
   
           // Execution de la requête d'insertion (ici, on utilise execute car on a fait un prepare())
           $insertedRows = $query->execute([
               ':id' => $this->id,
               ':home_order' => $this->home_order,
           ]); 
   
         // Si au moins une ligne ajoutée
         if ($insertedRows > 0) {
           // Alors on récupère l'id auto-incrémenté généré par MySQL
           $this->id = $pdo->lastInsertId();
   
           // On retourne VRAI car l'ajout a parfaitement fonctionné
           return true;
           // => l'interpréteur PHP sort de cette fonction car on a retourné une donnée
       }
       
       // Si on arrive ici, c'est que quelque chose n'a pas bien fonctionné => FAUX
       return false;
       
        // Execution de la requête de mise à jour
   }

   public function reset(){
       // Récupération de l'objet PDO représentant la connexion à la DB
       $pdo = Database::getPDO();

       // Ecriture de la requête UPDATE
       $sql = "
        UPDATE `category`
        SET
            home_order = 0,
            updated_at = NOW()
    ";

       $pdoStatement = $pdo->prepare($sql);


       // Execution de la requête de mise à jour
       return $pdoStatement->execute();
   }

}
