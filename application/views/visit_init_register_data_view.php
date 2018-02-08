<!DOCTYPE html>
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
                                        <li role="presentation" class="active"><a href="<?= base_url('Visit/site_init') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>                                        
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <img src="<?= base_url('dist/img/design.jpg') ?>" style="width: 120px;">
                        </div>
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">        

                            <table id="data-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
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
                                    if (isset($visits) && $visits) {
                                        foreach ($visits as $visit) {
                                            ?> 
                                            <tr>
                                                <td class="details-control" id="<?php echo $visit->id; ?>">
                                                    <i class="fa fa-plus-square-o"></i>
                                                </td>
                                                <td><?= $visit->dateSave ?></td>
                                                <td><?= $visit->uniquecode ?></td>
                                                <td><?= $visit->uniqueCodeCentralCost ?></td>
                                                <td><?= $visit->name_activitie ?></td>
                                                <td><?= $visit->name_service ?></td>
                                                <td><?= $visit->count ?></td>
                                                <td><?= $visit->site ?></td>
                                                <td><?= $visit->name_user ?></td>
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
                <!-- Modal Materiales-->
                <div id="modalMaterials" class="modal fade" role="dialog">
                    <div class="modal-dialog" style="width: 80%;">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <form class="form-horizontal" id="frmMaterials" method="post">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="background-color: #00B1EB; color: white">Categoria</th>
                                                    <th style="background-color: #00B1EB; color: white">Producto</th>
                                                    <th style="background-color: #00B1EB; color: white">Cantidad</th>
                                                    <th style="background-color: #00B1EB; color: white">Unidad de medida</th>
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
                                            <tbody id="materials">
                                                

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
                <!-- /.content-wrapper -->
                <?php $this->load->view('templates/footer.html') ?>
            </div>
            <!-- ./wrapper -->
            <?php $this->load->view('templates/libs') ?>
            <?php $this->load->view('templates/js') ?>
            <script type="text/javascript">
                function getFileNameRegFoto(elm) {
                    var fn = $(elm).val();
                    $("#p_1").html(fn);
                }
                function getFileNamePsinm(elm) {
                    var fn = $(elm).val();
                    $("#p_2").html(fn);
                }
                function getFileNameTss(elm) {
                    var fn = $(elm).val();
                    $("#p_3").html(fn);
                }
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
                    return '<form enctype="multipart/form-data" method="post" name="form-register-visit" id="form-register-visit" action="register_docs">' +
                            '<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design" for="fileregfoto"><a class="disable photos photo' + d + '">ADJUNTAR REGISTRO FOTOGRAFICO</a></label>' +
                            '<p id="p_1"></p><input type="hidden" value="1" name="idTypeRegFoto"><input style="display: none;" onchange="getFileNameRegFoto(this)" type="file" name="fileregfoto" id="fileregfoto"></input></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" name="obsvRegPic"><td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design" for="filepisnm"><a class="disable pisnm' + d + '">ADJUNTAR FORMATO PISNM</a></label>' +
                            '<p id="p_2"></p><input type="hidden" value="2" name="idTypePsinm"><input style="display: none;" onchange="getFileNamePsinm(this)" type="file" name="filepisnm" id="filepisnm"></input></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" name="obsvPsinm"></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design" for="filetss"><a class="disable tss' + d + '">ADJUNTAR FORMATO TSS</a></label>' +
                            '<p id="p_3"></p><input type="hidden" value="3" name="idTypeTss"><input style="display: none;" onchange="getFileNameTss(this)" type="file" name="filetss" id="filetss"></input></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" name="obsvTss"></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design"><a href="#" data-toggle="modal" data-target="#modalMaterials" onclick="addIdOrder(' + d + ')">ADJUNTAR SOLICITUD DE MATERIALES</a></label></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" name="obsvTss"></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td>OBSERVACIONES GENERALES</td>' +
                            '<td><input type="hidden" value="' + d + '" name="idOrder"><input type="text" class="form-control" name="obsvgen" id="obsvgen"></td>' +
                            '<td><button type="submit" class="blue bold">REGISTRAR</button></td>' +
                            '<td><a class="orange bold" href="javascript:return_order(' + d + ')"><i class="fa fa-undo fa-2x" aria-hidden="true" style="color: orange"></i></a></td>' +
                            '</tr>' +
                            '</table></form>';
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
                    var obsvgen = $("#obsvgen").val();
                    url = get_base_url() + "Visit/return_order_assign";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, obsvgen: obsvgen},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Erro en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Orden devuelta a programación de visitas exitosamente');
                                location.reload();
                            }
                        }
                    });
                }
                function getDocs(idOrder) {
                    galery = false;
                    $(".slides").html("");
                    url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                        var pos = 1;
                        $.each(respuestaServer["docs"], function (i, doc) {
                            if (doc.idTypeDocument === "2") {
                                $(".pisnm" + idOrder).removeClass("disable");
                                $(".pisnm" + idOrder).addClass("pointer");
                            }
                            if (doc.idTypeDocument === "3") {
                                $(".tss" + idOrder).removeClass("disable");
                                $(".tss" + idOrder).addClass("pointer");
                            }
                            if (doc.idTypeDocument === "1") {
                                $(".photo" + idOrder).removeClass("disable");
                                $(".photo" + idOrder).addClass("pointer");
                                galery = true;
                                pos++;
                            }
                        });
                    });
                }

                function addIdOrder(d) {
                    $("#idOrder").val(d);
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
                $("#frmMaterials").submit(function (e) {
                    e.preventDefault();
                    var categoria = $("#idActivities option:selected").text();
                    var producto = $("#idServices option:selected").text();
                    var cantidad = $("#count").val();
                    var unidadm = $("#unidadm").val();
                    url = get_base_url() + "Orders/add_order_detail";
                    $.ajax({
                        url: url,
                        type: $("#frmMaterials").attr("method"),
                        data: $("#frmMaterials").serialize(),
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                $("#materials").append("<tr><td>" + producto + "</td>" +
                                        "<td>" + cantidad + "</td>" +
                                        "<td>" + unidadm + "</td></tr>");
                                alertify.success('Material agregado exitosamente');
                            }
                        }
                    });
                });
            </script>
    </body>
</html>
