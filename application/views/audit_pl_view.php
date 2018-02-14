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
                                        <li role="presentation" class="active"><a href="<?= base_url('Audit/pl') . $controller ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Audit/pl_process_registers') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
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
                            <table  id="data-table" class="table table-striped">
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
                                        <th style="color: #00B0F0">Costo de Orden</th>
                                        <th style="color: #00B0F0">% Utilidad</th>
                                        <th style="color: #00B0F0">Aprobar</th>
                                    </tr>                                   
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($pl) && $pl) {
                                        foreach ($pl as $row) {
                                            if ($row->historybackState === '1') {
                                                $trcolor = '#FCF8E5';
                                            } else {
                                                $trcolor = '';
                                            }
                                            ?>                                            
                                            <tr style="background-color:<?= $trcolor ?>">
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
                                                <td><?= $row->totalCost ?></td>
                                                <td><?php
                                                    $dif = $row->totalOrder - $row->totalCost;
                                                    $util = ($dif * 100) / $row->totalCost;
                                                    echo round($util, 2) . ' %';
                                                    ?></td>
                                                <td><a href="#" onclick="assign(<?= $row->id . "," . $areaAssign . "," . $stateAssign ?>)">
                                                        <i class="fa fa-check-square" style="color: green"></i>
                                                    </a>
                                                    <a href="#" onclick="return_order(<?= $row->id . "," . $areaReturn . "," . $stateReturn ?>)">
                                                        <i class="fa fa-window-close" aria-hidden="true" style="color: red"></i>
                                                    </a></td>
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
        <!-- Modal Materiales-->
        <div id="modalMaterials" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <form action="javascript:addDetail()" class="form-horizontal" id="frmAddDetail" method="post">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #00B1EB; color: white">Categoria</th>
                                            <th style="background-color: #00B1EB; color: white">Producto</th>
                                            <th style="background-color: #00B1EB; color: white">Cantidad</th>
                                            <th style="background-color: #00B1EB; color: white">Unidad de medida</th>
                                            <th style="background-color: #00B1EB; color: white">Editar</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="idOrder" id="idOrder">
                                                <select name="idActivities" id="idActivities" class="form form-control">
                                                    <option></option>
                                                    <?php if (isset($activities)) { ?>
                                                        <?php foreach ($activities as $activitie) { ?>
                                                            <option value="<?= $activitie->id ?>"><?= $activitie->name_activitie ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="idServices" id="idServices" class="form form-control">
                                                </select>
                                            </td>
                                            <td><input type="number" name="count" id="count" class="form form-control"></td>
                                            <td><div id="unit_measurement"></div>
                                                <div id="price" style="display:none"></div>
                                                <input type="hidden" name="total" id="vrTotal"/>
                                                <input type="hidden" name="totalCost" id="vrTotalCost"/>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody  id="bodyMaterials">

                                    </tbody>
                                </table>                                  
                                <div class="col-xs-12">
                                    <div class="center block text-center">
                                        <button type="submit" class="btn btn-lg btn-default color-blue pull-right" style="margin-top: 30px;">Registrar</button>
                                    </div>
                                </div>
                            </form>
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

        <!-- Modal edición productos-->
        <div id="modalEditProducts" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <form id="frmEditDetail" action="javascript:editDetail()" method="post">                                                                                
                                <div class="form-group">
                                    <input type="hidden" name="idDetail" id="idDetail">
                                    <label for="idServices">Producto</label>
                                    <select name="idServices" id="idServices" class="form form-control">
                                        <option id="product"></option>
                                        <?php foreach ($services as $service) { ?>
                                            <option value="<?= $service->id ?>"><?= $service->name_service ?>
                                            </option>
                                        <?php } ?>
                                    </select>                              
                                </div>
                                <div class="form-group">
                                    <label for="idServices">Cantidad</label>
                                    <input type="number" name="quantity" id="quantity" class="form form-control">                             
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>                       
                                </div>                                
                            </form>  
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


            $("#count").change(function () {
                var price = $("#vrTotal").val();
                var cost = $("#cost").val();
                var cantidad = $("#count").val();
                var total = price * cantidad;
                var totalCost = cost * cantidad;
                $("#vrTotal").val(total);
                $("#vrTotalCost").val(totalCost);
            });

            function materials(idOrder) {
                $("#idOrder").val(idOrder);
                $('#bodyMaterials').empty();
                url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#bodyMaterials').append('<tr><td>' + materials.name_activitie +
                                '</td><td>' + materials.name_service +
                                '</td><td>' + materials.count + '</td><td>'
                                + materials.unit_measurement + '</td>' +
                                '<td><a onclick="viewService(' + materials.id + ')" data-toggle="modal" data-target="#modalEditProducts">' +
                                '<i class="fa fa-edit" aria-hidden="true" style="color: blue">' +
                                '</i></a></td></tr>');
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
                                alertify.success('Ordén pasada a siguiente auditoria.');
                                location.reload();
                            }
                        }
                    });
                }, function () {
                    alertify.error('Acción cancelada');
                }).set({labels: {ok: 'Aceptar', cancel: 'Cancelar'}, padding: false});
            }

            function return_order(idOrder, idArea, idState) {
                alertify.confirm('En realidad desea devolver la ordén?', function () {
                    alertify.success('Accepted');
                    url = get_base_url() + "Audit/return_order_register_visit_site";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, idArea: idArea, idState: idState},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Erro en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Orden devuelta exitosamente');
                                location.reload();
                            }
                        }
                    });
                }, function () {
                    alertify.error('Acción cancelada');
                }).set({labels: {ok: 'Aceptar', cancel: 'Cancelar'}, padding: false});
            }

            function viewService(id) {
                url = get_base_url() + "Audit/get_details_service?jsoncallback=?";
                $.getJSON(url, {id: id}).done(function (res) {
                    $("#idDetail").val(id);
                    $("#category").html(res.res.name_activitie);
                    $("#product").val(res.res.idServices);
                    $("#product").html(res.res.name_service);
                    $("#quantity").val(res.res.count);
                });
            }
            function addDetail() {
                var categoria = $("#idActivities option:selected").text();
                var producto = $("#idServices option:selected").text();
                var cantidad = $("#count").val();
                var unidadm = $("#unidadm").val();
                url = get_base_url() + "Orders/add_order_detail";
                $.ajax({
                    url: url,
                    type: $("#frmAddDetail").attr("method"),
                    data: $("#frmAddDetail").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Producto agregado exitosamente');
                            $("#bodyMaterials").append('<tr><td>' + categoria +
                                    '</td><td>' + producto +
                                    '</td><td>' + cantidad + '</td><td>'
                                    + unidadm + '</td>' +
                                    '<td></td></tr>');
                        }
                    }
                });
            }
            function editDetail() {
                url = get_base_url() + "Audit/edit_detail";
                $.ajax({
                    url: url,
                    type: $("#frmEditDetail").attr("method"),
                    data: $("#frmEditDetail").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Producto actualizado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>
    </body>
</html>
