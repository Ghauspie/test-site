<?php

if (isset($errorsList)) {
    var_dump($errorsList);
}

?>

<a href="<?= $router->generate('category-list') ?>" class="btn btn-success float-right">Retour</a>
<h2><?php if ($category->getName() === null) : ?>Ajouter<?php else : ?>Modifier<?php endif; ?> une catégorie</h2>
        
        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nom de la catégorie" value="<?= $category->getName(); ?>">
            </div>
            <div class="form-group">
                <label for="subtitle">Sous-titre</label>
                <input name="subtitle" type="text" class="form-control" id="subtitle" placeholder="Sous-titre" aria-describedby="subtitleHelpBlock" value="<?= $category->getSubTitle(); ?>">
                <small id="subtitleHelpBlock" class="form-text text-muted">
                    Sera affiché sur la page d'accueil comme bouton devant l'image
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Image</label>
                <input name="picture" type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= $category->getPicture(); ?>">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            <input type="hidden" value="<?= $tokenCSRF ?>" name="tokenCSRF">
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>