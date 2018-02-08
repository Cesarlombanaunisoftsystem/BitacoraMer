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
                                        <li role="presentation"><a href="#pagosges" aria-controls="binnacle" role="tab" data-toggle="tab">Pagos Gestionados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/financial.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <form>
                                            <table  id="data-table" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="color: #00B0F0">No. Ordén</th>
                                                        <th style="color: #00B0F0">Centro de Costos</th>
                                                        <th style="color: #00B0F0">Actividad</th>
                                                        <th style="color: #00B0F0">Cantidad</th>
                                                        <th style="color: #00B0F0">Sitio</th>
                                                        <th style="color: #00B0F0">Técnico</th>
                                                        <th style="color: #00B0F0">Vr.Total-Orden</th>
                                                        <th style="color: #00B0F0">% Autorizado</th>
                                                        <th style="color: #00B0F0">Vr Autorizado</th>
                                                        <th style="color: #00B0F0">Pagar</th>
                                                    </tr>                                   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($pays) && $pays) {
                                                        foreach ($pays as $row) {
                                                            ?>                                            
                                                            <tr>
                                                                <td><?= $row->uniquecode ?></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                                <td><?= $row->name_activitie ?></td>
                                                                <td><?= $row->count ?></td>
                                                                <td><?= $row->site ?></td>
                                                                <td><?= $row->name_user ?></td>
                                                                <td><?= $row->totalCost ?></td>
                                                                <td><?= $row->percent_pay ?>%</td>
                                                                <td><?= $row->sumValue ?></td>
                                                                <td><input type="checkbox" class="form-check-input"></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>                                                                         
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="pagosges">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/financial.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <form>
                                            <table  id="data-table" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="color: #00B0F0">Fecha de Pago</th>
                                                        <th style="color: #00B0F0">No. Ordén</th>
                                                        <th style="color: #00B0F0">Centro de Costos</th>
                                                        <th style="color: #00B0F0">Proveedor</th>
                                                        <th style="color: #00B0F0">Vr.IVA</th>
                                                        <th style="color: #00B0F0">Valor Retenciones</th>
                                                        <th style="color: #00B0F0">Vr.Descuentos</th>
                                                        <th style="color: #00B0F0">Vr.Total Pagado</th>
                                                    </tr>                                   
                                                </thead>
                                                <tbody>
                                                    <?php /*
                                                    if (isset($pays_process) && $pays_process) {
                                                        foreach ($pays_process as $row) {
                                                            ?>                                            
                                                            <tr>
                                                                <td><?= $row->uniquecode ?></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                                <td><?= $row->name_activitie ?></td>
                                                                <td><?= $row->count ?></td>
                                                                <td><?= $row->site ?></td>
                                                                <td><?= $row->name_user ?></td>
                                                                <td><?= $row->totalCost ?></td>
                                                                <td><?= $row->percent_pay ?>%</td>
                                                                <td><?= $row->sumValue ?></td>
                                                                <td><input type="checkbox" class="form-check-input"></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } */
                                                    ?>
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
