<?php // TODO : gérer l'afichage des erreurs (UI)

if (isset($errorsList)) {
    var_dump($errorsList);
}
?>

<a href="<?= $router->generate('product-list') ?>" class="btn btn-success float-right">Retour</a>
<?php // le traitement ci dessous peut-être délégué à une méthode... 
?>
<h2><?php if ($product->getName() === null) : ?>Ajouter<?php else : ?>Modifier<?php endif; ?> un produit</h2>

<form action="" method="POST" class="mt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Nom de la catégorie" value="<?= $product->getName(); ?>">
    </div>
    <div class="form-group">
        <label for="subtitle">Description</label>
        <input name="description" type="text" class="form-control" id="subtitle" placeholder="Description" aria-describedby="subtitleHelpBlock" value="<?= $product->getDescription(); ?>">
        <small id="subtitleHelpBlock" class="form-text text-muted">
            Sera affiché sur la page d'accueil comme bouton devant l'image
        </small>
    </div>
    <div class="form-group">
        <label for="picture">Image</label>
        <input name="picture" type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= $product->getPicture(); ?>">
        <small id="pictureHelpBlock" class="form-text text-muted">
            URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
        </small>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Prix" value="<?= $product->getPrice(); ?>" aria-describedby="priceHelpBlock">
            <small id="priceHelpBlock" class="form-text text-muted">
                Le prix du produit
            </small>
        </div>
        <div class="form-group">
            <label for="rate">Note</label>
            <input type="text" class="form-control" id="rate" name="rate" placeholder="Note" value="<?= $product->getRate(); ?>" aria-describedby="rateHelpBlock">
            <small id="rateHelpBlock" class="form-text text-muted">
                Le note du produit
            </small>
        </div>
        <div class="form-group">
            <label for="status">Statut</label>
            <select class="custom-select" id="status" name="status" aria-describedby="statusHelpBlock" value="">
                <option value="0">Inactif</option>
                <option value="1">Actif</option>
            </select>
            <small id="statusHelpBlock" class="form-text text-muted">
                Le statut du produit
            </small>
        </div>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select class="custom-select" id="category" name="category_id" aria-describedby="categoryHelpBlock" value="<?= (isset($product)) ? $product->getCategoryId() : ''; ?>">

                <?php foreach ($categories as $category) : ?>

                    <option value="<?= $category->getId() ?>" <?php if (isset($product)) {
                                                                    if ($product->getCategoryId() == $category->getId()) {
                                                                        echo " selected ";
                                                                    }
                                                                }
                                                                ?>>
                        <?= $category->getName() ?>
                    </option>

                <?php endforeach; ?>

            </select>
            <small id="categoryHelpBlock" class="form-text text-muted">
                La catégorie du produit
            </small>
        </div>
        <div class="form-group">
            <label for="brand">Marque</label>
            <select class="custom-select" id="brand" name="brand_id" aria-describedby="brandHelpBlock" value="">
                <?php foreach ($brands as $brand) : ?>

                    <option value="<?= $brand->getId() ?>">
                        <?= $brand->getName() ?>
                    </option>

                <?php endforeach; ?>
            </select>
            <small id="brandHelpBlock" class="form-text text-muted">
                La marque du produit
            </small>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="custom-select" id="type" name="type_id" aria-describedby="typeHelpBlock" value="">
                <?php foreach ($types as $type) : ?>

                    <option value="<?= $type->getId() ?>">
                        <?= $type->getName() ?>
                    </option>

                <?php endforeach; ?>
            </select>
            <small id="typeHelpBlock" class="form-text text-muted">
                Le type de produit
            </small>
        </div>
        <input type="hidden" value="<?= $tokenCSRF ?>" name="tokenCSRF">
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>