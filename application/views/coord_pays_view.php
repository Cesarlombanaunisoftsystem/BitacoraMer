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
                                        <li role="presentation" class="active"><a href="<?= base_url('Audit/auth_pay') . $controller ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="#" aria-controls="binnacle" role="tab" data-toggle="">Pagos Adicionales</a></li>
                                        <li role="presentation"><a href="#" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
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
                            <form>
                                <table  id="data-table" class="table table-responsive">
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
                                        if (isset($pays) && $pays) {
                                            foreach ($pays as $row) {
                                                ?>                                            
                                                <tr>
                                                    <td class="details-control" id="<?php echo $row->id; ?>">
                                                        <i class="fa fa-plus-square-o"></i>
                                                    </td>
                                                    <td><?= $row->dateSave ?></td>
                                                    <td><a href="<?= base_url('uploads/') . $row->picture ?>"  target="ventana" onClick="window.open('', 'ventana', 'width=400,height=400,lef t=100,top=100');"><?= $row->uniquecode ?></a></td>
                                                    <td><?= $row->uniqueCodeCentralCost ?></td>
                                                    <td><?= $row->name_activitie ?></td>
                                                    <td><?= $row->count ?></td>
                                                    <td><?= $row->site ?></td>
                                                    <td><?= $row->name_user ?></td>
                                                    <td>PRESUPUESTO</td>
                                                    <td><?= $row->observations ?></td>                                                
                                                    <td><?= $row->totalCost ?></td>
                                                    <td><?= $row->percent_pay ?></td>
                                                    <td><input type="number" name="percent" id="percent_<?= $row->id ?>" class="form form-control" onchange="assignPercent('<?= $row->id ?>')"></td>
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
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- Modal Materiales-->
        <div id="modalMaterials" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color: #00B1EB; color: white">Categoria</th>
                                        <th style="background-color: #00B1EB; color: white">Producto</th>
                                        <th style="background-color: #00B1EB; color: white">Cantidad</th>
                                        <th style="background-color: #00B1EB; color: white">Unidad de medida</th>
                                    </tr>                                    
                                </thead>
                                <tbody  id="bodyMaterials">

                                </tbody>
                            </table> 
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Observaciones-->
        <div id="modalObservations" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <textarea class="form form-control" id="obsv"></textarea>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>



        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            $('#data-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                order_id = $(this).attr("id");
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).html('<i class="fa fa-plus-square-o"></i>');
                } else {
                    getDocs(order_id);
                    closeOpenedRows(dt, tr);
                    $(this).html('<i class="fa fa-minus-square-o"></i>');
                    row.child(format(order_id)).show();
                    tr.addClass('shown');
                    openRows.push(tr);
                }
            });
            function format(d) {
                return '<form enctype="multipart/form-data" method="post" name="form-audit-pl" id="form-audit-pl" action="register_docs">' +
                        '<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<tr>' +
                        '<td>FECHA DE REGISTRO:<p></p></td>' + '<td><u><label id="fecha_' + d + '"></u></label></td>' +
                        '<td><label class="blue bold upload_design" for="fileRegFoto' + d + '">' +
                        '<a class="disable photos photo' + d + '"><u>REGISTRO FOTOGRAFICO</u></a></label>' +
                        '</td><td><label class="blue bold upload_design" for="filePsinm' + d + '">' +
                        '<a class="disable pisnm' + d + '"><u>FORMATO PISNM</u></a></label>' +
                        '</td>' + '<td><label class="blue bold upload_design" for="fileTss' + d + '">' +
                        '<a class="disable tss' + d + '"><u>FORMATO TSS</u></a></label>' +
                        '</td>' + '<td><label class="blue bold upload_design"><a href="#" onclick="materials(' + d + ')" data-toggle="modal" data-target="#modalMaterials">' +
                        '<u>SOLICITUD DE MATERIALES/SERV</u></a></label><input type="hidden" value="' + d + '" name="idOrder">' +
                        '</td>' + '<td><label class="blue bold upload_design" for="fileRegFoto' + d + '"><a href="#" onclick="getObservations(' + d + ')" data-toggle="modal" data-target="#modalObservations">' +
                        '<u>OBSERVACIONES GENERALES</u></a></label></td></tr></table></form>';
            }
            function getDocs(idOrder) {
                url = get_base_url() + "Orders/get_details_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    var pos = 1;
                    $.each(respuestaServer["docs"], function (i, doc) {
                        $("#fecha_" + idOrder).html(doc.dateSave);
                        if (doc.idTypeDocument === "2") {
                            $(".pisnm" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument === "3") {
                            $(".tss" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument === "1") {
                            $(".photo" + idOrder).removeClass("disable");
                            galery = true;
                            pos++;
                        }
                    });
                });
            }

            function materials(idOrder) {
                $("#idOrder").val(idOrder);
                $('#bodyMaterials').empty();
                url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#bodyMaterials').append('<tr><td>' + materials.name_activitie +
                                '</td><td>' + materials.name_service +
                                '</td><td>' + materials.count + '</td><td>'
                                + materials.unit_measurement + '</td></tr>');
                    });
                });
            }

            function getObservations(idOrder) {
                $("#obsv").val("");
                url = get_base_url() + "Orders/get_observation_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $("#obsv").val(res.observation.observations);
                });
            }

            function assign(idOrder, idArea, idState) {
                alertify.confirm('En realidad desea pasar la ordén a siguiente auditor?', function () {
                    alertify.success('Accepted');
                    url = get_base_url() + "Audit/assign";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, idArea: idArea, idState: idState},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Ordén pasada a siguiente paso.');
                                location.reload();
                            }
                        }
                    });
                }, function () {
                    alertify.error('Acción cancelada');
                }).set({labels: {ok: 'Aceptar', cancel: 'Cancelar'}, padding: false});
            }

            function assignPercent(idOrder) {
                alertify.confirm('En realidad desea pasar la ordén a pagaduria con este porcentaje?', function () {
                    alertify.success('Aceptado');
                    var percent = $("#percent_"+idOrder).val();
                    url = get_base_url() + "Audit/assign_percent";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, percent: percent},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Porcentaje asignado, ordén pasada a pagaduria.');
                                location.reload();
                            }
                        }
                    });
                }, function () {
                    alertify.error('Acción cancelada');
                }).set({labels: {ok: 'Aceptar', cancel: 'Cancelar'}, padding: false});
            }
        </script>
    </body>
</html>
