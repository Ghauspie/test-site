<?php //dump($viewVars);?>
<?php foreach ($viewVars as $categoryType): ?>
<section>
 <?php //dump($categoryType)?>
    <div class="container-fluid">
      <div class="row mx-0">
        <?php //dump($categoryType[0])?>
        <div class="col-md-6">
          <div class="card border-0 text-white text-center"><img src="<?= $categoryType[0]->getPicture() ?>"
              alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100 py-3">
                <h2 class="display-3 font-weight-bold mb-4"><?= $categoryType[0]->getName() ?></h2><a href="<?= $router->generate('catalog-category',['id' => $categoryType[0]->getId()]);?>" class="btn btn-light"><?= $categoryType[0]->getSubtitle() ?></a>
              </div>
            </div>
          </div>
     
        </div>
        <?php //for ($categorytype==$category->getHomeOrder(2)): ?> 
        <div class="col-md-6">
          <div class="card border-0 text-white text-center"><img src="<?= $categoryType[1]->getPicture() ?>"
              alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100 py-3">
                <h2 class="display-3 font-weight-bold mb-4"><?= $categoryType[1]->getName() ?></h2><a href="<?= $router->generate('catalog-category',['id' => $categoryType[1]->getId()]);?>" class="btn btn-light"><?= $categoryType[1]->getSubtitle() ?></a>
              </div>
            </div>
          </div>
        </div>
        <?php //endfor?>
      </div>
      <div class="row mx-0">
        <?php //for ($categorytype==$category->getHomeOrder(3)): ?> 
        <div class="col-lg-4">
          <div class="card border-0 text-center text-white"><img src="<?= $categoryType[2]->getPicture() ?>"
              alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4"><?= $categoryType[2]->getName() ?></h2><a href="<?= $router->generate('catalog-category',['id' => $categoryType[2]->getId()]);?>" class="btn btn-link text-white"><?= $categoryType[2]->getSubtitle() ?>
                  <i class="fa-arrow-right fa ml-2"></i></a>
              </div>
            </div>
          </div>
          <?php //endfor?>
        </div>
        <?php //for ($categorytype==$category->getHomeOrder(4)): ?> 
        <div class="col-lg-4">
            <div class="card border-0 text-center text-dark">
              <img src="<?= $categoryType[3]->getPicture() ?>"
                alt="Card image" class="card-img">
              <div class="card-img-overlay d-flex align-items-center">
                <div class="w-100">
                  <h2 class="display-4 mb-4"><?= $categoryType[3]->getName() ?></h2>
                  <a href="<?= $router->generate('catalog-category',['id' => $categoryType[3]->getId()]);?>" class="btn btn-link text-dark"><?= $categoryType[3]->getSubtitle() ?>
                    <i class="fa-arrow-right fa ml-2"></i>
                  </a>
                </div>
              </div>
            </div>
            <?php //endfor?>
          </div>
          <?php //for ($categorytype==$category->getHomeOrder(5)): ?> 
        <div class="col-lg-4">
          <div class="card border-0 text-center text-white"><img src="<?= $categoryType[4]->getPicture() ?>"
              alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4"><?= $categoryType[4]->getName() ?></h2><a href="<?= $router->generate('catalog-category',['id' => $categoryType[4]->getId()]);?>" class="btn btn-link text-white"><?= $categoryType[4]->getSubtitle() ?><i class="fa-arrow-right fa ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php //endfor?>
      </div>
    </div>
         
</section>
          <?php endforeach;?>