<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Plutôt que d'aller mettre l'URL absolue sur toutes les liens assets,
  on peut utiliser la balise <base> : https://developer.mozilla.org/fr/docs/Web/HTML/Element/base 
  qui permet de définir l'URL de base à utiliser pour toutes les URLs relatives
  de notre site.
  /!\ Attention, la balise base doit être définie dans le head avant toute autre
  balise comportant lien.
  -->
  <base href="<?= $absoluteUrl ?>">
  
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <title>oShop</title>
</head>

<body>
  <header>
    <div class="top-bar">
      <div class="container-fluid">
        <div class="row d-flex align-items-center">
          <div class="col-sm-7 d-none d-sm-block">
            <ul class="list-inline mb-0">
              <li class="list-inline-item pr-3 mr-0">
                <i class="fa fa-phone"></i><a href="tel:+33102030405">01 02 03 04 05</a>
              </li>
              <li class="list-inline-item px-3 border-left d-none d-lg-inline-block">Livraison offerte à partir de 100€</li>
            </ul>
          </div>
          <div class="col-sm-5 d-flex justify-content-end">
            <!-- Currency Dropdown-->
            <div class="dropdown pl-3 ml-0">
              <a id="currencyDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle topbar-link">EUR</a>
              <div aria-labelledby="currencyDropdown" class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item text-sm">USD</a>
                <a href="#" class="dropdown-item text-sm">GBP</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-sticky navbar-airy navbar-light">
      <div class="container-fluid">
        <!-- Navbar Header  -->
        <a href="./" class="navbar-brand">oShop</a>
        <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
          aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
        <!-- Navbar Collapse -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a href="./" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Catégories</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Types de produit</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Marques</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Blog</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Contact</a>
            </li>
          </ul>
          <div class="d-flex align-items-center justify-content-between justify-content-lg-end mt-1 mb-2 my-lg-0">
            <!-- Search Button-->
            <div class="nav-item navbar-icon-link">
              <a href="#" class="navbar-icon-link"><i class="fa fa-search"></i></a>
            </div>
            <!-- User Not Logged - link to login page-->
            <div class="nav-item">
              <a href="#" class="navbar-icon-link"><i class="fa fa-user"></i></a>
            </div>
            <!-- Cart Dropdown-->
            <div class="nav-item dropdown">
              <a href="cart.html" class="navbar-icon-link d-lg-none">
                  <span class="badge badge-secondary">New</span>
              </a>
              <div class="d-none d-lg-block">
                <a id="cartdetails" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" href="cart.html" class="navbar-icon-link dropdown-toggle">
                <i class="fa fa-shopping-cart"></i>
                <span class="badge badge-secondary">2</span>
                </a>
                <div aria-labelledby="cartdetails" class="dropdown-menu dropdown-menu-right p-4">
                  <div class="navbar-cart-product-wrapper">
                    <!-- cart item-->
                    <div class="navbar-cart-product">
                        
                      <div class="w-100">
                          
                          <div> <a href="detail.html" class="navbar-cart-product-link">Retro socks</a><small
                              class="d-block text-muted">Quantité : 1 </small><strong class="d-block text-sm">45 €
                            </strong></div>
                      </div>
                    </div>
                    <div class="navbar-cart-product">
                        
                      <div class="w-100">
                          
                          <div> <a href="detail.html" class="navbar-cart-product-link">Dillinger</a><small
                              class="d-block text-muted">Quantité : 1 </small><strong class="d-block text-sm">30 €
                            </strong></div>
                      </div>
                    </div>
                    
                    <!-- total price-->
                    <div class="navbar-cart-total"><span class="text-uppercase text-muted">Total</span><strong class="text-uppercase">75 €</strong></div>
                    <!-- buttons-->
                    <div class="d-flex justify-content-between">
                      <a href="cart.html" class="btn btn-link text-dark mr-3">Voir le panier <i class="fa-arrow-right fa"></i></a>
                      <a href="#" class="btn btn-outline-dark">Commander</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>