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
                        Modulo de administración
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
                            <a href="<?= base_url('Users')?>" style="color:#fff;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="winery-count"><i class="fa fa-users"></i></h3>
                                        <p>Usuarios</p>
                                    </div>
                                    <a href="<?= base_url('Users')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="<?= base_url('Parametrization/activities')?>" style="color:#FF7840;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="product-count"><i class="fa fa-dollar"></i></h3>
                                        <p>Precio de Venta</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/prices')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="<?= base_url('Parametrization/payment_methods')?>" style="color:#40BCFF;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="providers-count"><i class="fa fa-credit-card"></i></h3>
                                        <p>Formas de Pago</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/payment_methods')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="<?= base_url('Parametrization/taxes')?>" style="color:#863AE8;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="providers-count"><i class="fa fa-info"></i></h3>
                                        <p>Impuestos</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/taxes')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="#" style="color:#FF4C4C;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="providers-count"><i class="fa fa-file-pdf"></i></h3>
                                        <p>Documentos</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/docs')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="#" style="color:#E8A13A;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="providers-count"><i class="fa fa-caret-up"></i></h3>
                                        <p>Áreas</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/areas')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <a href="#" style="color:#032365;">
                                <div class="small-box color-default">
                                    <div class="inner" style="margin: 10px;">
                                        <h3 id="providers-count"><i class="fa fa-archive"></i></h3>
                                        <p>Bodegas</p>
                                    </div>
                                    <a href="<?= base_url('Parametrization/cellar')?>" class="small-box-footer">Administrar<i class="fa fa-arrow-circle-right"></i></a>
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