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
                                            <tr onclick="details(<?= $row->id ?>)">
                                                <td><?= $row->dateSave ?></td>
                                                <td><a href="#"><?= $row->uniquecode ?><img id="pdforder" src="<?= base_url('uploads/').$row->picture?>"></a></td>
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
                                                                                        
                                            <tr id="details_<?= $row->id ?>"></tr>
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
                $('#details_' + idOrder).empty();
                url = get_base_url() + "Orders/get_details_order?jsoncallback=?";
                var contenido = $('#details_' + idOrder);
                if (contenido.css("display") === "none") { //open
                    $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                        $.each(respuestaServer["details"], function (i, details) {
                            $('#details_' + idOrder).append('<tr><td>FECHA REGISTRO:</td><td>' + details.dateSave + '</td><td><a href="#">' + details.name_type + '</a></td><td>Solicitud de Materiales</td></tr>');
                        });
                    });
                    contenido.slideDown(500);
                    $(this).addClass("open");
                } else { //close		
                    contenido.slideUp(500);
                    $(this).removeClass("open");
                }
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
    </body>
</html>
