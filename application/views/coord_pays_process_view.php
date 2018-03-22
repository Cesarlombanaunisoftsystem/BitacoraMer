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
                                        <li role="presentation"><a href="<?= base_url('Audit/pays_add')?>" aria-controls="binnacle" role="tab" data-toggle="">Pagos Adicionales</a></li>
                                        <li role="presentation" class="active"><a href="<?= base_url('Audit/pays_process')?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="regProcess">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <form>
                                            <table  id="data-table" class="table table-striped" style="font-size:12px">
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
                                                    <?php
                                                    if (isset($paysProcess) && $paysProcess) {
                                                        foreach ($paysProcess as $row) {
                                                            ?>                                            
                                                            <tr>
                                                                <td class="details-control" id="<?php echo $row->id; ?>">
                                                                    <i class="fa fa-plus-square-o"></i>
                                                                </td>
                                                                <td><?= $row->dateSave ?></td>
                                                                <td><a href="<?= base_url('uploads/') . $row->picture ?>"  target="ventana" onClick="window.open('', 'ventana', 'width=400,height=400,lef t=100,top=100');"><?= $row->uniquecode.'-'.$row->coi ?></a></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                                <td><?= $row->name_activitie ?></td>
                                                                <td><?= $row->count ?></td>
                                                                <td><?= $row->site ?></td>
                                                                <td><?= $row->name_user ?></td>
                                                                <td>PRESUPUESTO</td>
                                                                <td><?= $row->observations ?></td>                                                
                                                                <td><input type="hidden" id="costOrder" value="<?= $row->totalCost ?>"><?php
                                                                    setlocale(LC_MONETARY, 'es_CO');
                                                                    echo money_format('%.2n', $row->totalCost)
                                                                    ?></td>
                                                                <td onclick="historyPays(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#modalHistoryPays">
                                                                    <input type="hidden" id="pay_<?= $row->id ?>" value="<?= $row->percent_pay ?>"><?= $row->percent_pay ?>%</td>
                                                                <td><?= $row->percent_pay ?>%
                                                                </td>
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
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>        
        <!-- Modal Historial Pagos-->
        <div id="modalHistoryPays" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 40%;
                 border-color: blue;
                 border-style: solid;
                 border-radius: 20px;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div style="height: 350px;
                                 width: 550px;">
                                <p style="text-align:left;"><img src="<?= base_url('dist/img/logo_mail.png') ?>" alt="logo Mer"><img src="<?= base_url('dist/img/titulo_mail.png') ?>"  height="90px" width="250px" alt="titulo" style="text-align:right"/></p>
                                <p style="text-align:center;"><img src="<?= base_url('dist/img/hr_mail.png') ?>" width="510px" alt="hr"></p>                                
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">Fecha</u>
                                            </th>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">% Autorizado</u>
                                            </th>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">Vr. Autorizado</u>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="historyPays" style="text-align: center">

                                    </tbody>
                                </table>
                            </div>                                               
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            function historyPays(idOrder) {
                $("#historyPays").empty();
                url = get_base_url() + "Audit/history_assign_percent?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $.each(res["pays"], function (i, pay) {
                        $("#historyPays").append("<tr><td>" + pay.dateSave + "</td>" +
                                "<td>" + pay.percent + "</td>" +
                                "<td>" + pay.value + "</td>" + "</tr>");
                    });
                });
            }
        </script>
    </body>
</html>

