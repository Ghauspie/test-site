<?php

namespace App\Controllers;

use App\Models\AppUser;

/**
 * Contrôleur permettant de gérer les pages et actions liées aux utilisateurs
 */
class UserController extends CoreController {

    /**
     * Afficher le formulaire de connexion
     */
    public function login()
    {
        // var_dump($_SESSION);
        $this->show('user/login');
    }

    /**
     * Gestion de la connexion de l'utilisateur depuis le formulaire de login
     */
    public function loginPost()
    {
        // On commence par récupérer les données soumises depuis le form
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // var_dump($email, $password);

        $errorsList = [];

        // Vérifier l'existence du user
        $currentUser = AppUser::findByEmail($email);

        if (empty($password)) {
            $errorsList[] = 'Veuillez saisir un mot de passe.';
        }

        if (empty($email)) {
            $errorsList[] = 'Veuillez saisir une adresse email.';
        }
        
        else if (!$currentUser) {
            $errorsList[] = 'Utilisateur inconnu.';
        }

        // Vérification du mot de passe saisi dans le form
        if (
                $currentUser // si l'utilisateur existe => true / sinon => false
                && !empty($password) // si le mot de passe n'est pas vide => true / sinon false
                && !password_verify($password, $currentUser->getPassword()) // si la vérification du mot de passe échoue => true / sinon => false
            )
        {
            $errorsList[] = 'Mot de passe invalide !';
        }

        // si on a des erreurs, 
        if (!empty($errorsList)) {
            var_dump($errorsList);
        }
        // sinon, on connecte l'utilisateur
        else {
            $_SESSION['userId'] = $currentUser->getId();
            $_SESSION['userObject'] = $currentUser;
            // var_dump($_SESSION);
            header('Location: /');
        }

        // var_dump($currentUser);
    }

    public function disconnect()
    {
        session_destroy();
        header('Location: /user/login');
    }

    /**
     * Liste les utilisateurs
     *
     * @return void
     */
    public function list()
    {

        // On autorise uniquement les admin à accéder à cette page
        //CoreController::checkAuthorization(['admin']);

        // On récupère tous les users
        $users = AppUser::findAll();

        // On les envoie à la vue
        $this->show('user/list', ['users' => $users]);
    }

    /**
     * Ajout d'un compte utilisateur (affichage du form)
     *
     * @return void
     */
    public function add()
    {
        // On autorise uniquement les admin à accéder à cette page
        //CoreController::checkAuthorization(['admin']);
        $this->show('user/add-edit', 
        [
            'user' => new AppUser(),
            'tokenCSRF' => $this->generateTokenCSRF()
        ]);
    }

    /**
     * POST Création d'un user
     *
     * @return void
     */
    public function create()
    {

        //CoreController::checkAuthorization(['admin']);
        
        // On tente de récupèrer les données venant du formulaire.
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password_1 = filter_input(INPUT_POST, 'password_1', FILTER_SANITIZE_STRING);
        $password_2 = filter_input(INPUT_POST, 'password_2', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);

        // On vérifie l'existence et la validité de ces données (gestion d'erreur).
        $errorsList = [];

        if (empty($firstname)) {
            $errorsList[] = 'Le prénom est vide';
        }
        if ($firstname === false) {
            $errorsList[] = 'Le prénom est invalide';
        }       
        if (empty($lastname)) {
            $errorsList[] = 'Le nom est vide';
        }
        if ($lastname === false) {
            $errorsList[] = 'Le nom est invalide';
        }
        if (empty($email)) {
            $errorsList[] = 'L\'email est vide';
        }
        if ($email === false) {
            $errorsList[] = 'L\'email est invalide';
        }
        if (empty($role)) {
            $errorsList[] = 'Le role est vide';
        }
        if ($role === false) {
            $errorsList[] = 'Le role est invalide';
        }
        if (empty($status)) {
            $errorsList[] = 'Le status est vide';
        }
        if ($status === false) {
            $errorsList[] = 'Le status est invalide';
        }
        if (empty($password_1)) {
            $errorsList[] = 'Le mot de passe est vide';
        }
        if ($password_1 === false) {
            $password_1[] = 'Le mot de passe est invalide';
        }
        if (empty($password_2)) {
            $errorsList[] = 'Le mot de passe est vide';
        }
        if ($password_2 === false) {
            $errorsList[] = 'Le mot de passe est invalide';
        }
        if ($password_1 === $password_2) {
        } else {
            $errorsList[] = 'Les mots de passe ne correspondent pas';
        }

        // S'il n'y a aucune erreur dans les données...
        if (empty($errorsList)) {
            // On instancie un nouveau modèle de type AppUser.
            $user = new AppUser();

            //on hash le pswd
            $password = password_hash($password_1 , PASSWORD_BCRYPT);

            $status = intval($status);

            // On met à jour les propriétés de l'instance.
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setStatus($status);
            $user->setRole($role);
            $user->setPassword($password);

            // On tente de sauvegarder les données en DB...
            if ($user->insert()) {
                // Si la sauvegarde a fonctionné, on redirige vers la liste des catégories.
                header('Location: /user/list');
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

            $user = new AppUser();

            $user->setFirstname(filter_input(INPUT_POST, 'firstname'));
            $user->setLastname(filter_input(INPUT_POST, 'lastname'));
            $user->setEmail(filter_input(INPUT_POST, 'email'));
            $user->setStatus(filter_input(INPUT_POST, 'status'));
            $user->setRole(filter_input(INPUT_POST, 'role'));

            $this->show(
                'user/add-edit',
                [
                    // On pré-remplit les inputs avec les données BRUTES initialement
                    // reçues en POST, qui sont actuellement stockées dans le modèle.
                    'user' => $user,
                    // On transmet aussi le tableau d'erreurs, pour avertir l'utilisateur.
                    'errorsList' => $errorsList
                ]
            );
        }
    }
}