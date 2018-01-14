<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('templates/head') ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php $this->load->view('templates/header') ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('templates/menu-right') ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Administración Precios
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Panel de control</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="<?= base_url('Parametrization')?>" style="color:#fff;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="winery-count"><i class="fa fa-object-group" aria-hidden="true"></i></h3>
                                        <p>Categorias</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/get_categories')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="<?= base_url('Parametrization/get_activities')?>" style="color:yellowgreen;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="product-count"><i class="fa fa-archive" aria-hidden="true"></i></h3>
                                        <p>Actividades</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/get_activities')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="<?= base_url('Parametrization/get_services')?>" style="color:yellow;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="product-count"><i class="fa fa-server" aria-hidden="true"></i></h3>
                                        <p>Servicios</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/get_services')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
    </body>
</html>
