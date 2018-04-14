<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('templates/head') ?>
        <link rel="stylesheet" href="<?= base_url('plugins/hover/animate.css') ?>">

        <style>
            .global-text {
                color: #00B0F0;
                font-size: 1em;
                font-weight: bold;
            }

            .global-text::before {
                content: "l";
                background-color: #00B0F0;
                width: 1px;
                margin-right: 5px;
                height: 2px;
            }

            .bg-dark {
                background-color: #262626;
                padding: 15px;
            }

            .title-item{
                color: #ccc !important;
                font-size: 0.8em;
                text-align: center;
            }
            .title-item a{
                color: #ccc !important;
            }

            .node {
                margin: 0px 0px 10px 0px;
                background: #262626;
                height: 1px;
                border-bottom: 1px solid #ccc;
            }

            .bg-item {
                background: #337ab7;
                border-radius: 10px;
            }

            .bg-res {
                background: #337ab7;
                color: #ccc;
                
            }

            .bg-res2 {
                background: transparent;
                color: #ccc;
                background: #F48024;
            }

            .bg-res2 a {
                color: #ccc;
            }

            .hvr-bounce-in nvl wow rubberBand {
                height: 20px;
                width: 32px;
            }

            .nvl-2 {
                margin-top: 25px;
            }

            .nvl-3 {
                margin-top: 50px;
            }

            .nvl-4 {
                margin-top: 75px;
            }

            .nvl-5 {
                margin-top: 100px;
            }

            .nvl-6 {
                margin-top: 125px;
            }

            .nvl-7 {
                margin-top: 150px;
            }

            .nvl-8 {
                margin-top: 175px;
            }

            .nvl-9 {
                margin-top: 200px;
            }

            .nvl-10 {
                margin-top: 225px;
            }

            .nvl-11 {
                margin-top: 250px;
            }

            .nvl-12 {
                margin-top: 275px;
            }
            .nvl-13 {
                margin-top: 300px;
            }
            .bar-middle{
                height: 7px;
                background: #333;
                border: 0px;
            }
            .lines{

            }
            .lines .col-xs-1{
                border-left: 1px solid #666;
                margin: 0;
                padding: 0;
                width: 7.6%;
            }
            .lines .col-xs-1 .hvr-bounce-in .row{
                margin: 0;
                padding: 0;
            }
            .block-text .col-xs-1{
                width: 7.6%;
                margin: 0;
                padding: 0;
            }

            .blockq{
                /*  width: 80% !important;*/
                /*margin-right: 0px !important;
              margin-left: 10px !important;
               //background: #337ab7;*/
                border-radius: 10px;
            }
            #preloader {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #fff;
                /* change if the mask should have another color then white */
                z-index: 10000;
                /* makes sure it stays on top */
            }

            #status img {
                width: 180px;
                height: 180px;
                margin-top: 18%;
                /*width:200px;
                   height:200px;
                   position:absolute;*/
                /* left:50%;*/
                /* centers the loading animation horizontally one the screen */
                /*top:50%;*/
                /* centers the loading animation vertically one the screen */
                /*  background-image:url(../loading.gif);*/
                /* path to your loading animation */
                /* background-repeat:no-repeat;
                   background-position:center;
                   margin:-100px 0 0 -100px; */
                /* is width and height divided by two */
            }

            #status p {
                margin: 0px;
                padding: 0px;
                color: #999;
                font-size: 18px;
            }
        </style>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="preloader">
            <div id="status">
                <center>
                    <img src="dist/img/logo.png" alt="Cargando...">
                    <p class="desc">Cargando...</p>
                </center>
            </div>
        </div>
        <div class="wrapper">
            <?php $this->load->view('templates/header') ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('templates/menu-right') ?>
            <!-- Content Wrapper. Contains page content -->
            
            
            <div class="content-wrapper">
                <h2><?= $titulo ?></h2>
                <div id="spinner"></div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="col-md-4 text-center" style="margin: 50px 0;">
                                <h4>TOTAL ORDENES</h4><h2 class=""><strong><?= $totalorders->total ?></strong></h2>
                            </div>
                            <div class="col-md-8 center-block">
                                <div id="donutchart"></div>
                            </div> 
                        </div>
                        <div class="col-xs-6">
                            <div class="row" style="margin:20px 0;">
                                <div class="col-xs-6" >
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Numero total de ordenes: <strong><?= $totalorders->total ?></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Ordenes fuera de tiempo: <strong><?php
                                            $sql = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
    ON tbl_orders.idOrderState = tbl_orders_state.id WHERE DATEDIFF(CURDATE(), tbl_orders.dateSave) <= tbl_orders_state.days";
                                            $q = $this->db->query($sql)->row();
                                            $pendientes = $q->cont;

                                            echo $q->cont;
                                            ?></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Ordenes dentro de tiempo: <strong><?php
                                            $sql = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
    ON tbl_orders.idOrderState = tbl_orders_state.id WHERE DATEDIFF(CURDATE(), tbl_orders.dateSave) > tbl_orders_state.days";
                                            $query = $this->db->query($sql)->row();
                                            $cumplidas = $query->cont;

                                            echo $query->cont;
                                            ?></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">% de ordenes fuera de tiempo: <strong>
                                            <?php
                                            $percentOut = ($pendientes * 100) / $totalorders->total;
                                            echo round($percentOut, 2) . '%';
                                            ?></strong></p>
                                    </strong></p>
                                </div>
                                <div class="col-xs-6">
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Valor total venta: <strong><?php
                                            setlocale(LC_MONETARY, 'es_CO');
                                            echo money_format('%.2n', $totalsale->total) . "\n";
                                            ?></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Valor total costos: <strong><?php
                                            setlocale(LC_MONETARY, 'es_CO');
                                            echo money_format('%.2n', $totalcost->total) . "\n";
                                            ?></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">% Utilidad total: <strong><?php
                                            $dif = $totalsale->total - $totalcost->total;
                                            $utilpercent = ($dif * 100) / $totalsale->total;
                                            echo round($utilpercent, 2) . '%';
                                            ?></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Valor utilidad total: <strong><?php
                                            $util = $totalsale->total - $totalcost->total;
                                            setlocale(LC_MONETARY, 'es_CO');
                                            echo money_format('%.2n', $util) . "\n";
                                            ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#gestion" aria-controls="gestion" role="tab" data-toggle="tab">Modular</a></li>
                    <li role="presentation"><a href="#barras" aria-controls="barras" role="tab" data-toggle="tab" id="barsMenu">Barras</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="gestion"> 
                        <section class="content">
                            
                            
                            <div class="bg-dark">
                                <div class="row block-text">
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Orders'); ?>">Registo Inicial</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Visit/program'); ?>">Asignacion visita inicial</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Visit/site_init'); ?>">Registro visita inicial</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Visit/validation'); ?>">Auditoria visita inicial</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Design/register'); ?>">Registro de diseño</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Design/audit'); ?>">Auditoria de diseño</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Audit/pl_1'); ?>">Presupuesto # 1</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Audit/pl_2'); ?>">Presupuesto # 2</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Audit/pl_3'); ?>">Aprobación de presupuesto</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Audit/auth_pay'); ?>">Autorizacion de pagos</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Audit/financial'); ?>">Area financiera</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Materials'); ?>">Inicio actividad</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Materials/get_materials_cellar_mer'); ?>">Gestion de materiales</a></p>
                                    </div>
                                </div>
                                <hr class="node">
                                <div class="row lines">
                                    <?php
                                    for ($i = 1; $i <= 13; $i++) {
                                        $sql = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
                                    ON tbl_orders.idOrderState = tbl_orders_state.id WHERE tbl_orders.idOrderState='$i' and
                                    DATEDIFF(CURDATE(), tbl_orders.dateSave) <= tbl_orders_state.days";
                                        $query = $this->db->query($sql)->row();
                                        $sql1 = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
                                    ON tbl_orders.idOrderState = tbl_orders_state.id WHERE tbl_orders.idOrderState='$i' and
                                    DATEDIFF(CURDATE(), tbl_orders.dateSave) > tbl_orders_state.days";
                                        $query1 = $this->db->query($sql1)->row();
                                        $total = $query->cont + $query1->cont;
                                        $porc1 = 0;
                                        $porc2 = 0;
                                        if ($query->cont) {
                                            $porc1 = round((($query->cont * 100) / $total) / 10);
                                        }
                                        if ($query1->cont) {
                                            $porc2 = round((($query1->cont * 100) / $total) / 10);
                                        }
                                        if ($porc1 == $porc2) {
                                            $porc1 = $porc2 = 6;
                                        }
                                        if (!$porc1) {
                                            $porc2 = 13;
                                        }
                                        if (!$porc2) {
                                            $porc1 = 13;
                                        }
                                        if ($i == 1) {
                                            $link = 'Orders';
                                        }
                                        if ($i == 2) {
                                            $link = 'Visit/program';
                                        }
                                        if ($i == 3) {
                                            $link = 'Visit/site_init';
                                        }
                                        if ($i == 4) {
                                            $link = 'Visit/validation';
                                        }
                                        if ($i == 5) {
                                            $link = 'Design/register';
                                        }
                                        if ($i == 6) {
                                            $link = 'Design/audit';
                                        }
                                        if ($i == 7) {
                                            $link = 'Audit/pl_1';
                                        }
                                        if ($i == 8) {
                                            $link = 'Audit/pl_2';
                                        }
                                        if ($i == 9) {
                                            $link = 'Audit/pl_3';
                                        }
                                        if ($i == 10) {
                                            $link = 'Audit/auth_pay';
                                        }
                                        if ($i == 11) {
                                            $link = 'Audit/financial';
                                        }
                                        if ($i == 12) {
                                            $link = 'Projects/activitie_init';
                                        }
                                        if ($i == 13) {
                                            $link = 'Materials';
                                        }
                                        ?>

                                        <div class="col-xs-1">
                                            <div class="hvr-bounce-in nvl wow bounceInDown <?= 'nvl-' . $i ?>" data-wow-duration="2s" data-wow-delay="1s">
                                                <div class="row blockq">
                                                    <div class="bg-item text-center">
                                                        <?php if ($porc1) { ?>
                                                            <div class="col-xs-<?php echo $porc1 > $porc2 ? $porc1 - 1 : $porc1; ?> bg-res">
                                                                <a href="<?= base_url($link) ?>"><?php echo $query->cont; ?></a>
                                                            </div>
                                                            <?php
                                                        }
                                                        if ($porc2) {
                                                            ?>
                                                            <div class="col-xs-<?php echo $porc2 > $porc1 ? $porc2 - 1 : $porc2; ?> bg-res2">
                                                                <a href="<?= base_url($link) ?>"><?php echo $query1->cont; ?></a>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-xs-12">
                                                            <?php echo $total; ?>                                                   
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <hr class="bar-middle">
                                <div class="row block-text">
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Billing'); ?>">Facturacion</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Settlemen/audit'); ?>">Auditoria liquidacion</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Settlemen'); ?>">Centro de liquidacion</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Audit/financial'); ?>">Area financiera</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Audit/auth_pay'); ?>">Autorizacion de pagos</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Documents/audit'); ?>">Auditoria Documentación</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Documents'); ?>">Centro de Documentación</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Materials'); ?>">Devoluciones</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Visit/site_init'); ?>">Registro visita</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Visit/program'); ?>">Programacion visita</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Projects/activitie_init'); ?>">Actividad en proceso</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Materials/get_materials_cellar_ext'); ?>">Bodega Externa</a></p>
                                    </div>
                                    <div class="col-xs-1">
                                        <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Materials/get_materials_cellar_mer'); ?>">Bodega interna</a></p>
                                    </div>
                                    <!-- <div class="col-xs-1"><p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s">Gestion de materiales</p></div> -->
                                </div>
                                <hr class="node">
                                <div class="row lines">
                                    <?php
                                    $j = 13;
                                    for ($i = 14; $i <= 26; $i++) {
                                        $sql = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
                                        ON tbl_orders.idOrderState = tbl_orders_state.id WHERE tbl_orders.idOrderState='$i' and
                                        DATEDIFF(CURDATE(), tbl_orders.dateSave) <= tbl_orders_state.days";
                                        $query = $this->db->query($sql)->row();
                                        $sql1 = "SELECT count(tbl_orders.id) cont,tbl_orders.dateSave,tbl_orders_state.days FROM tbl_orders JOIN tbl_orders_state
                                        ON tbl_orders.idOrderState = tbl_orders_state.id WHERE tbl_orders.idOrderState='$i' and
                                        DATEDIFF(CURDATE(), tbl_orders.dateSave) > tbl_orders_state.days";
                                        $query1 = $this->db->query($sql1)->row();
                                        $total = $query->cont + $query1->cont;
                                        $porc1 = 0;
                                        $porc2 = 0;
                                        if ($query->cont) {
                                            $porc1 = round((($query->cont * 100) / $total) / 10);
                                        }
                                        if ($query1->cont) {
                                            $porc2 = round((($query1->cont * 100) / $total) / 10);
                                        }
                                        if ($porc1 == $porc2) {
                                            $porc1 = $porc2 = 6;
                                        }
                                        if (!$porc1) {
                                            $porc2 = 13;
                                        }
                                        if (!$porc2) {
                                            $porc1 = 13;
                                        }
                                        if ($i == 26) {
                                            $link = 'Materials/get_materials_cellar_mer';
                                        }
                                        if ($i == 25) {
                                            $link = 'Materials/get_materials_cellar_ext';
                                        }
                                        if ($i == 24) {
                                            $link = 'Projects/closing_visit_request';
                                        }
                                        if ($i == 23) {
                                            $link = 'Visit/program';
                                        }
                                        if ($i == 22) {
                                            $link = 'Visit/validation_close';
                                        }
                                        if ($i == 21) {
                                            $link = 'Materials';
                                        }
                                        if ($i == 20) {
                                            $link = 'Documents';
                                        }
                                        if ($i == 19) {
                                            $link = 'Documents/audit';
                                        }
                                        if ($i == 18) {
                                            $link = 'Audit/auth_pay';
                                        }
                                        if ($i == 17) {
                                            $link = 'Audit/financial';
                                        }
                                        if ($i == 16) {
                                            $link = 'Settlement';
                                        }
                                        if ($i == 15) {
                                            $link = 'Settlement/audit';
                                        }
                                        if ($i == 14) {
                                            $link = 'Billing';
                                        }
                                        ?>

                                        <div class="col-xs-1">
                                            <div class="hvr-bounce-in nvl wow bounceInUp <?= 'nvl-' . $j-- ?>" data-wow-duration="2s" data-wow-delay="1s">
                                                <div class="row blockq">
                                                    <div class="bg-item text-center">
                                                        <?php if ($porc1) { ?>
                                                            <div class="col-xs-<?php echo $porc1 > $porc2 ? $porc1 - 1 : $porc1; ?> bg-res">
                                                                <a href="<?= base_url($link) ?>"><?php echo $query->cont; ?></a>
                                                            </div>
                                                            <?php
                                                        }
                                                        if ($porc2) {
                                                            ?>
                                                            <div class="col-xs-<?php echo $porc2 > $porc1 ? $porc2 - 1 : $porc2; ?> bg-res2">
                                                                <a href="<?= base_url($link) ?>"><?php echo $query1->cont; ?></a>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-xs-12">
                                                            <?php echo $total; ?>                                                
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </section>
                    </div> 
                    <div role="tabpanel" class="tab-pane" id="barras">
                        <?php $this->load->view('managerViews/bars.php') ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">.qweq..</div>
                    <div role="tabpanel" class="tab-pane" id="settings">.agagag..</div>
                </div>
                <!-- section -->

            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <!-- wow  -->
        <script src="<?= base_url('plugins/hover/wow.min.js') ?>"></script>
        <script>
            // metodos de mensajes
            function showFade() {
                $('#preloader').fadeIn('slow');
                $('#status').fadeIn();
            }
            function hideFade() {
                $('#preloader').fadeOut('slow');
                $('#status').fadeOut();
            }
            window.onload = function () {
                hideFade();
                new WOW().init();
            };

            $("#barsMenu").click(function (e) {
                google.charts.load('current', {'packages': ['bar']});
                google.charts.setOnLoadCallback(barStacked);
            });

            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Ordenes Dentro de Tiempo estimado', <?= $cumplidas ?>],
                    ['Ordenes Fuera de Tiempo estimado',<?= $pendientes ?>]
                ]);

                var options = {
                    title: 'Ordenes totales  ' +<?= $totalorders->total ?>,
                    pieHole: 0.4,
                    width:400,
                    legend:'bottom',
                    colors: ['#337ab7','#F48024']
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }
        </script>
    </body>
</html>
