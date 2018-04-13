<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
          <div class="col-sm-1 col-md-12">
              <img src="<?= base_url('dist/img/logo.png')?>" class="img-circle img-responsive" style="background: #FFF;border:5px solid #000071;">
              <p style="font-size: 1.7em;color: #FFF;margin-top: 5px;" class="text-center text-uppercase" >Bitácora</p>   
          </div>
        <div class="pull-left info">
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
