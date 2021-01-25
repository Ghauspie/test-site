<?php

if (isset($errorsList)) {
    var_dump($errorsList);
}

?>

<a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-right">Retour</a>
<h2><?php if ($user->getEmail() === null) : ?>Ajouter<?php else : ?>Modifier<?php endif; ?> un utilisateur</h2>
        
<form action="" method="POST" class="mt-5">
    <div class="form-group">
        <label for="Firstname">Prénom</label>
        <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Prénom" value="<?= $user->getFirstname(); ?>">
    </div>
    <div class="form-group">
        <label for="Lastname">Nom</label>
        <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Nom" value="<?= $user->getLastname(); ?>">
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="<?= $user->getEmail(); ?>">
    </div>
    <?php if ($user->getEmail() === null) : ?>
    <div class="form-group">
        <label for="Password_1">Mot de passe</label>
        <input name="password_1" type="password" class="form-control" id="password_1" placeholder="Mot de passe">
    </div>
    <div class="form-group">
        <label for="Password_2">Mot de passe</label>
        <input name="password_2" type="password" class="form-control" id="password_2" placeholder="Mot de passe">
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Role</label>
        <select name="role" class="form-control" id="exampleFormControlSelect1">
        <option>Admin</option>
        <option>Catalog-manager</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Status</label>
        <select name="status" class="form-control" id="exampleFormControlSelect1">
        <option value=0>-</option>
        <option value=1>Actif</option>
        <option value=2>Désactivé</option>
        </select>
    </div>
    <input type="hidden" value="<?= $tokenCSRF ?>" name="tokenCSRF">
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>