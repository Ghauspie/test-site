<?php/*

namespace App\Models;

use App\Utils\Database;
use App\Utils\Category;
use PDO;

class Order extends CoreModel{

protected $id;
protected $home_order;

public static function findAll(){}
public function insert(){} // CREATE
public function delete(){} // DELETE

public static function find($Id)
{
    // récupérer un objet PDO = connexion à la BDD
    $pdo = Database::getPDO();

    // on écrit la requête SQL pour récupérer le produit
    $sql = '
        SELECT *
        FROM `category`
        WHERE id = ' . $Id;

    // query ? exec ?
    // On fait de la LECTURE = une récupration => query()
    // si on avait fait une modification, suppression, ou un ajout => exec
    $pdoStatement = $pdo->query($sql);

    // fetchObject() pour récupérer un seul résultat
    // si j'en avais eu plusieurs => fetchAll
    $result = $pdoStatement->fetchObject('App\Models\Order');
    
    return $result;
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
         WHERE 'id' = :id
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




