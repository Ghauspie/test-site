<section class="hero">
    <div class="container">
      <!-- Hero Content-->
      <div class="hero-content pb-5 text-center">
        <h1 class="hero-heading">Marque n° <?= $id_marque ?></h1>
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
      </header>
      <div class="row">
        <?php foreach($viewVars['brand_List'] as $brandObject): ?>
            <!-- product-->
            <div class="product col-xl-3 col-lg-4 col-sm-6">
            <div class="py-2">
               
                <h3 class="h6 text-uppercase mb-1"><a href="detail.html" class="text-dark"><?= $brandObject->getName() ?></a></h3>
            </div>
            </div>
            <!-- /product-->
        <?php endforeach; ?>
      </div>
      
    </div>
  </section>