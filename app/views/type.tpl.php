<?php //dump($viewVars);
//dump($viewVars['name_type']);
?>
Vous êtes sur la page  <?= $viewVars['name_type']->getName() ?>

<div class="row">
    <?php foreach($viewVars['products_list'] as $producttypeObject): ?>
        <!-- product-->
        <div class="product col-xl-3 col-lg-4 col-sm-6">
            <div class="product-image">
                <a href="detail.html" class="product-hover-overlay-link">
                    <img src="<?= $producttypeObject->picture ?>" alt="product" class="img-fluid">  
                </a>
            </div>
            <div class="product-action-buttons">
                <a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a>
                <a href="<?= $router->generate('catalog-product', ['id' => $producttypeObject->getId() ]) ?>" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">Voir</span></a>
            </div>
            <div class="py-2">
                <p class="text-muted text-sm mb-1"><?= $producttypeObject->name_type?> </p>
                <h3 class="h6 text-uppercase mb-1"><a href="<?= $router->generate('catalog-product', ['id' => $producttypeObject->getId() ]) ?>" class="text-dark"><?= $producttypeObject->getName()?></a></h3><span class="text-muted"><?= $producttypeObject->price ?>€</span>
            </div>
        </div>
        <!-- /product-->
    <?php endforeach; ?>
</div>