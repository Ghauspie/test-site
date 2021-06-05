<?php

namespace App\Utils;

use PDO;

// Retenir son utilisation  => Database::getPDO()
// Design Pattern : Singleton
class Database {
    /**
     * Objet PDO représentant la connexion à la base de données
     * 
     * @var PDO
     */
    private $dbh;
    /**
     * Propriété statique (liée à la classe) stockant l'unique instance objet
     * 
     * @var Database
     */
    private static $_instance;

    /**
     * Constructeur
     * 
     * en visibilité private
     * => seule le code de la classe a le droit de créer une instance de cette classe
     */
    private function __construct() {
        // Récupération des données du fichier de config
        // la fonction parse_ini_file parse le fichier et retourne un array associatif
        $configData = parse_ini_file(__DIR__.'/../config.ini');
        
        // PHP essaie d'exécuter tout le code à l'intérieur du bloc "try", mais...
        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
            );
        }
        // ... mais si une erreur (Exception) survient, alors on attrapte l'exception et on exécute le code que l'on souhaite (ici, on affiche un message d'erreur)
        catch(\Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }

    /**
     * Méthode permettant de retourner, dans tous les cas,
     * la propriété dbh (objet PDO) de l'unique instance de Database
     *
     * @return PDO
     */
    public static function getPDO() {
        // Si on n'a pas encore créé la seule instance de la classe
        if (empty(self::$_instance)) {
            // Alors, on crée cette instance et on la stocke dans la propriété statique $_instance
            self::$_instance = new Database();
        }
        // Sinon, on ne fait rien l'instance a déjà été créée

        // Enfin, on retourne la propriété dbh de l'instance unique de Database
        return self::$_instance->dbh;
    }
}