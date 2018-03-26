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
                background: #F48024;
                border-radius: 10px;
            }

            .bg-res2 {
                background: transparent;
                color: #ccc;
                border-radius: 8px;
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
                width: 80% !important;
                margin-right: 0px !important;
                margin-left: 10px !important;
                background: #337ab7;
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
                <!-- section -->
                <section class="content">
                    <div class="col-xs-12 nav-tabs-custom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#" role="tab" data-toggle="tab"><h1><?= $titulo ?></h1></a></li>
                        </ul>
                    </div>
                    <div id="spinner"></div>
                    <div class="row">
                        <div class="col-xs-6">

                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Numero total de ordenes: <strong><?= $totalorders->total ?></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Ordenes fuera de tiempo: <strong></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">Ordenes dentro de tiempo: <strong></strong></p>
                                    <p class="global-text wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s">% de ordenes fuera de tiempo: <strong></strong></p>
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
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-1" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#"><?= $regouttime->cont ?></a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#"><?= $reg->cont ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-2" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#"><?= $progvisitouttime->cont ?></a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#"><?= $progvisit->cont ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-3" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#"><?= $regvisitiniouttime->cont ?></a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#"><?= $regvisitini->cont ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-4" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-5" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-6" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-7" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-8" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-9" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-10" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-11" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-12" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInDown nvl-13" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="bar-middle">
                        <div class="row block-text">
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Materials/get_materials_cellar_ext'); ?>">Facturacion</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Projects/activitie_init'); ?>">Auditoria liquidacion</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Projects/closing_visit_request'); ?>">Centro de liquidacion</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Visit/validation_close'); ?>">Area financiera</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Documents'); ?>">Autorizacion de pagos</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Documents/audit'); ?>">Auditoria Documentación</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Settlement'); ?>">Centro de Documentación</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Settlement/audit'); ?>">Devoluciones</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Billing'); ?>">Registro visita</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Management'); ?>">Programacion visita</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Management'); ?>">Actividad en proceso</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Management'); ?>">Bodega Externa</a></p>
                            </div>
                            <div class="col-xs-1">
                                <p class="title-item hvr-bounce-in wow bounceInUp" data-wow-duration="2s" data-wow-delay="1s"><a href="<?= base_url('Management'); ?>">Bodega interna</a></p>
                            </div>
                            <!-- <div class="col-xs-1"><p class="title-item hvr-bounce-in wow bounceInDown" data-wow-duration="2s" data-wow-delay="1s">Gestion de materiales</p></div> -->
                        </div>
                        <hr class="node">
                        <div class="row lines">
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-13" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row">
                                        <div class="row blockq">
                                            <div class="bg-item">
                                                <div class="col-xs-6 bg-res">
                                                    <a href="#">2</a>
                                                </div>
                                                <div class="col-xs-6 bg-res2">
                                                    <a href="#">5</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-12" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-11" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-10" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-9" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-8" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-7" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-6" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-5" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-4" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-3" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-2" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1">
                                <div class="hvr-bounce-in nvl wow bounceInUp nvl-1" data-wow-duration="2s" data-wow-delay="1s">
                                    <div class="row blockq">
                                        <div class="bg-item">
                                            <div class="col-xs-6 bg-res">
                                                <a href="#">2</a>
                                            </div>
                                            <div class="col-xs-6 bg-res2">
                                                <a href="#">5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
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

</script>

</body>
</html>
