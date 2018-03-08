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
                                        <li role="presentation" class="active"><a href="#bandeja" aria-controls="binnacle" role="tab" data-toggle="tab">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="#process" aria-controls="binnacle" role="tab" data-toggle="tab">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-hover">
                                            <thead>
                                                <tr style="font-size: 10pt">
                                                    <th style="color: #00B0F0">Fecha de ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>                                                    
                                                    <th style="color: #00B0F0">Servicio</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Técnico</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($data) && $data) {
                                                    foreach ($data as $row) {
                                                        ?>                                            
                                                        <tr style="font-size: 10pt" onclick="getSettlement(<?= $row->id ?>)">
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><?= $row->uniquecode ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="list" hidden>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">                                    
                                    <table class="table">
                                        <thead>                                       
                                            <tr style="font-size: 10pt">
                                                <th style="color: orange">LIQUIDACIÓN</th>
                                                <th style="color: #00B0F0">Valor Venta $</th>
                                                <th>30.000.000</th>
                                                <th style="color: #00B0F0">Total Costos $</th>
                                                <th>30.000.000</th>
                                                <th style="color: #00B0F0">% Utilidad</th>
                                                <th>30</th>
                                                <th style="color: #00B0F0">Valor Utilidad $</th>
                                                <th>10.000.000</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #4D5F8F; color: white">
                                                <th>
                                                   VALOR TOTAL VENTA PARA CLIENTE 
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #4D5F8F; color: white">
                                                <th>
                                                   VALOR TOTAL PAGO A CONTRATISTA 
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #4D5F8F; color: white">
                                                <th>
                                                   VALOR TOTAL DE MATERIALES 
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #4D5F8F; color: white">
                                                <th>
                                                   VALOR TOTAL ADICIONALES 
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="process">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Fecha de ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>                                                    
                                                    <th style="color: #00B0F0">Servicio</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Técnico</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($process) && $process) {
                                                    foreach ($process as $row) {
                                                        ?>                                            
                                                        <tr>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><?= $row->uniquecode ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?></td>                                                           
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
                                            </tbody>
                                        </table>
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
            function getSettlement(idOrder) {
                $("#list").show();
            }
        </script>
    </body>
</html>
