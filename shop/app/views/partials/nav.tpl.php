<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">oShop</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $router->generate('main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('category-list') ?>">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('product-list') ?>">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Types</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Marques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('user-list') ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('category-order') ?>">Sélections Accueil &amp; Footer</a>
                    </li>
                    <?php if (!isset($_SESSION['userObject'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('user-login') ?>">Connexion</a>
                    </li>
                    <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('user-disconnect') ?>">Déconnexion</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>