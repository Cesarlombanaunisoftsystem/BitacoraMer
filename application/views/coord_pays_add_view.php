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
                        <?= $titulo ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Panel de control</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation"><a href="<?= base_url('Audit/auth_pay')?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation" class="active"><a href="<?= base_url('Audit/pays_add')?>" aria-controls="binnacle" role="tab" data-toggle="">Pagos Adicionales</a></li>
                                        <li role="presentation"><a href="<?= base_url('Audit/pays_process')?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">                            
                            <div role="tabpanel" class="tab-pane active" id="paysAdd">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <form>
                                            <table id="data-table" class="table table-striped" style="font-size:12px">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th style="color: #00B0F0">Fecha de ordén</th>
                                                        <th style="color: #00B0F0">No. Ordén</th>
                                                        <th style="color: #00B0F0">Centro de Costos</th>
                                                        <th style="color: #00B0F0">Actividad</th>
                                                        <th style="color: #00B0F0">Cantidad</th>
                                                        <th style="color: #00B0F0">Sitio</th>
                                                        <th style="color: #00B0F0">Técnico</th>
                                                        <th style="color: #00B0F0">Area Origen</th>
                                                        <th style="color: #00B0F0">Observaciones</th>
                                                        <th style="color: #00B0F0">Costo de Orden</th>
                                                        <th style="color: #00B0F0">% Entregado</th>
                                                        <th style="color: #00B0F0">% Autorizado</th>
                                                    </tr>                                   
                                                </thead>
                                                <tbody>
                                                                                                                           
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>                            
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
        <script type="text/javascript">
            
        </script>
    </body>
</html>

