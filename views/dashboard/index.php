<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      Dashboard
    </li>
  </ol>
</nav>
<div class="row">
  <?php 
    $colorIndex = 0;
    $colors = MenuHelper::bgColor();
    foreach ($menuTree as $menu):
      if ($menu['IsMenu']){ ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-<?= $colors[$colorIndex % count($colors)] ?>">
            <div class="inner">
              <h3><i class="fa <?= $menu['MenuIcon'] ?>"></i></h3>
              <p><?= $menu['MenuName'] ?></p>
            </div>
            <div class="icon">
              <i class="fa <?= $menu['MenuIcon'] ?>"></i>
            </div>
            <a href="<?= ALTERNATE_BASE_URL . "/" . $menu['MenuUrl'] ?>" class="small-box-footer">
              Selengkapnya <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php
        $colorIndex++;
      }
      if (isset($menu['children'])): 
      ?>
          <?php foreach ($menu['children'] as $child): ?>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-<?= $colors[$colorIndex % count($colors)] ?>">
                  <div class="inner">
                    <h3><i class="fa <?= $child['MenuIcon'] ?>"></i></h3>
                    <p><?= $child['MenuName'] ?></p>
                  </div>
                  <div class="icon">
                    <i class="fa <?= $child['MenuIcon'] ?>"></i>
                  </div>
                  <a href="<?= ALTERNATE_BASE_URL . $child['MenuUrl'] ?>" class="small-box-footer">
                    Selengkapnya <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
          <?php $colorIndex++; ?>
          <?php endforeach ?>
      <?php endif;
    endforeach
  ?>
</div>
