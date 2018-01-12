<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= base_url('dist/img/logo.png')?>" class="img-circle" style="width: 90px !important;height: 90px !important;max-width: 90px !important;max-height: 90px !important;">
        </div>
        <div class="pull-left info">
          <p style="font-size: 1.7em;margin-top: 30px;margin-left: 50px;">Bitácora</p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> En linea</a> -->
        </div>
      </div>
      <ul class="sidebar-menu">
      <a href="<?= base_url('home') ?>"><li class="header">Inicio</li></a>
        <?php foreach($datos as $fila){ ?>
          <li>
          <a href="<?= base_url($fila->name_controller); ?>">
            <span><?= $fila->name_permit; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <?php } ?>
      </ul>
    </section>
  </aside>
