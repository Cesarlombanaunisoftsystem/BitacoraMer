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
                                        <li role="presentation" class="active"><a href="<?= base_url('Audit/pl_1') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Audit/pl_1_process_registers') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                        </div>
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <table class="table table-responsive" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="color: #00B0F0">Fecha de ordén</th>
                                        <th style="color: #00B0F0">No. Ordén</th>
                                        <th style="color: #00B0F0">Centro de Costos</th>
                                        <th style="color: #00B0F0">Actividad</th>
                                        <th style="color: #00B0F0">Cantidad</th>
                                        <th style="color: #00B0F0">Sitio</th>
                                        <th style="color: #00B0F0">Técnico</th>
                                        <th style="color: #00B0F0">Costo de Orden</th>
                                        <th style="color: #00B0F0">% Utilidad</th>
                                        <th style="color: #00B0F0">Aprobar</th>
                                    </tr>                                   
                                </thead>
                                <tbody>
                                    <?php
                                    if ($pl_1) {
                                        foreach ($pl_1 as $row) {
                                            ?>                                            
                                            <tr onclick="details(<?= $row->id ?>)" data-toggle="modal" data-target="#modalPl1">
                                                <td><?= $row->dateSave ?></td>
                                                <td><a href="#"><?= $row->uniquecode ?><img id="pdforder" src="<?= base_url('uploads/') . $row->picture ?>"></a></td>
                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                <td><?= $row->name_activitie ?></td>
                                                <td><?= $row->count ?></td>
                                                <td><?= $row->site ?></td>
                                                <td><?= $row->name_user ?></td>                                                
                                                <td><?= $row->totalCost ?></td>
                                                <td><?php
                                                    $dif = $row->totalCost - $row->total;
                                                    $util = ($dif * 100) / $row->total;
                                                    echo $util . ' %';
                                                    ?></td>
                                                <td><a href="#"><i class="fa fa-check-square" style="color: green"></i></a> <a href="#"><i class="fa fa-window-close" aria-hidden="true" style="color: red"></i></a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>                                                                         
                                </tbody>
                            </table>
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
            function details(idOrder) {
                $('#frmPl1').empty();
                url = get_base_url() + "Orders/get_details_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["docs"], function (i, docs) {
                        $('#frmPl1').append('<tr><td>FECHA REGISTRO:</td><td>' + docs.dateSave + '</td><td><a href="#"><u>' + docs.name_type + '</u></a></td><td onclick="materials('+docs.idOrder+')" data-toggle="modal" data-target="#modalMaterials"><a href="#"><u>SOLICITUD DE MATERIALES</u></a></td><td><u>OBSERVACIONES GENERALES</u></td></tr>');
                    });
                });
            }
            function materials(idOrder) {
                $('#bodyMaterials').empty();
                url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#bodyMaterials').append('<tr><td>' + materials.description + '</td><td>' + materials.count + '</td><td>' + materials.observations + '</td></tr>');
                    });
                });
            }
            function assign(idOrder) {
                var idTech = $("#idTech_" + idOrder).val();
                var date = $("#date_" + idOrder).val();
                if (date === "") {
                    alertify.error('Debes indicar fecha de visita');
                } else {
                    url = get_base_url() + "Visit/assign";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, idTech: idTech, date: date},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Erro en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Visita asignada al técnico exitosamente, correo de aviso enviado.');
                                location.reload();
                            }
                        }
                    });
                }
            }
            function return_order(idOrder) {
                url = get_base_url() + "Visit/return_order_register";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Orden devuelta a registro exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>
        <!-- Modal Detalles-->
        <div id="modalPl1" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row" style="text-align: center; margin-right: 5px; margin-left: 5px; padding: 8px; border-width: 1px; border-color: black;
                             border-style: solid;
                             border-radius: 10px;">
                            <form class="form-horizontal">
                                <table  id="frmPl1" class="table table-responsive"></table>                              
                            </form>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Materiales-->
        <div id="modalMaterials" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <form class="form-horizontal">
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th style="background-color: blue; color: white">Descripción</th>
                                        <th style="background-color: blue; color: white">Cantidad</th>
                                        <th style="background-color: blue; color: white">Observaciones</th>
                                    </tr>                                   
                                </thead>
                                <tbody  id="bodyMaterials"></tbody>
                                </table>                                
                            </form>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
