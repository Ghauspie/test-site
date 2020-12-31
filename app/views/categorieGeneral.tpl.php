<?php //dump($viewVars); ?>
<section class="hero">
    <div class="container">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Détente</li>
      </ol>
      <!-- Hero Content-->
      <div class="hero-content pb-5 text-center">
        <h1 class="hero-heading">Page des categories</h1>
        <div class="row">
          <div class="col-xl-8 offset-xl-2">
            <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
              incididunt.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="products-grid">
    <div class="container-fluid">

      <header class="product-grid-header d-flex align-items-center justify-content-between">
        <div class="mr-3 mb-3">
          Affichage <strong>1-12 </strong>de <strong>158 </strong>résultats
        </div>
        <div class="mr-3 mb-3"><span class="mr-2">Voir</span><a href="#" class="product-grid-header-show active">12 </a><a
            href="#" class="product-grid-header-show ">24 </a><a href="#" class="product-grid-header-show ">Tout </a>
        </div>
        <div class="mb-3 d-flex align-items-center"><span class="d-inline-block mr-1">Trier par</span>
          <select class="custom-select w-auto border-0">
            <option value="orderby_0">Defaut</option>
            <option value="orderby_1">Popularité</option>
            <option value="orderby_2">Vote</option>
            <option value="orderby_3">Nouveauté</option>
          </select>
        </div>
      </header>
      <div class="row">
        <?php foreach($viewVars['products_list'] as $productObject): ?>
            <!-- product-->
                     <div class="product col-xl-3 col-lg-4 col-sm-6">
            <div class="product-image">
                <a href="detail.html" class="product-hover-overlay-link">
                <img src="<?= $productObject->getPicture() ?>" alt="product" class="img-fluid">
                </a>
            </div>
            <div class="product-action-buttons">
                <a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a>
                <a href="detail.html" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">Voir</span></a>
            </div>
            <div class="py-2">
                <p class="text-muted text-sm mb-1">Chausson</p>
                <h3 class="h6 text-uppercase mb-1"><a href="detail.html" class="text-dark"><?= $productObject->getName() ?></a></h3><span class="text-muted"><?= $productObject->getPrice() ?>€</span>
            </div>
            </div>
        
            <!-- /product-->
        <?php endforeach; ?>
      </div>
      
    </div>
  </section>