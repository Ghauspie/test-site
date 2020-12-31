<?php //dump($viewVars); 
//dump($viewVars['products_list']);
?>
   <h3>Vous êtes sur la page marque <?= $viewVars['name_Brand']->getName() ?></h3>
<div class="row">
<?php foreach($viewVars['products_list'] as $productBrandObject): ?>
        <!-- product-->
     
        <div class="product col-xl-3 col-lg-4 col-sm-6">
            <div class="product-image">
                <a href="detail.html" class="product-hover-overlay-link">
                    <img src="<?= $productBrandObject->picture ?>" alt="product" class="img-fluid">  
                </a>
            </div>
            <div class="product-action-buttons">
                <a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a>
                <a href="<?= $router->generate('catalog-product', ['id' => $productBrandObject->getId() ]) ?>" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">Voir</span></a>
            </div>
            <div class="py-2">
                <p class="text-muted text-sm mb-1"><?= $productBrandObject->name_brand?> </p>
                <h3 class="h6 text-uppercase mb-1"><a href="<?= $router->generate('catalog-product', ['id' => $productBrandObject->getId() ]) ?>" class="text-dark"><?= $productBrandObject->getName()?></a></h3><span class="text-muted"><?= $productBrandObject->price ?>€</span>
            </div>
        </div>
        <!-- /product-->
    <?php endforeach; ?>
</div>