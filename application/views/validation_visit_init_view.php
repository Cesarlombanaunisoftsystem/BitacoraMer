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
                                        <li role="presentation" class="active"><a href="#bandeja" aria-controls="binnacle" role="tab" data-toggle="tab">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="#regprocess" aria-controls="binnacle" role="tab" data-toggle="tab">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="bandeja">
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <img src="<?= base_url('dist/img/visitini.png') ?>" style="width: 120px;">
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
                                            if (isset($orders) && $orders) {
                                                foreach ($orders as $order) {
                                                    ?> 
                                                    <tr>
                                                        <td class="details-control" id="<?php echo $order->id; ?>">
                                                            <i class="fa fa-plus-square-o"></i>
                                                        </td>
                                                        <td><?= $order->dateSave ?></td>
                                                        <td><?= $order->uniquecode ?></td>
                                                        <td><?= $order->uniqueCodeCentralCost ?></td>
                                                        <td><?= $order->name_activitie ?></td>
                                                        <td><?= $order->name_service ?></td>
                                                        <td><?= $order->count ?></td>
                                                        <td><?= $order->site ?></td>
                                                        <td><?= $order->name_user ?></td>
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
                        <div role="tabpanel" class="tab-pane" id="regprocess">
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <img src="<?= base_url('dist/img/visitini.png') ?>" style="width: 120px;">
                                </div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">        
                                    <table id="data-table" class="table table-striped">
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
                                                foreach ($process as $order) {
                                                    ?> 
                                                    <tr>
                                                        <td><?= $order->dateSave ?></td>
                                                        <td><?= $order->uniquecode ?></td>
                                                        <td><?= $order->uniqueCodeCentralCost ?></td>
                                                        <td><?= $order->name_activitie ?></td>
                                                        <td><?= $order->name_service ?></td>
                                                        <td><?= $order->count ?></td>
                                                        <td><?= $order->site ?></td>
                                                        <td><?= $order->name_user ?></td>
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

                </section>
                <!-- /.content -->
                <!-- Modal Galery -->
                <div id="modalGalery" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <ul class="slides"></ul> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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
            $(function () {
                $(document).on("click", ".photos", function () {
                    if (galery)
                        $('#modalGalery').modal('show');
                });
            });

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
                    getRegPhoto(order_id);
                    getMaterials(order_id);
                    getObservations(order_id);
                    closeOpenedRows(dt, tr);
                    $(this).html('<i class="fa fa-minus-square-o"></i>');
                    row.child(format(order_id)).show();
                    tr.addClass('shown');
                    openRows.push(tr);
                }
            });
            function format(d) {
                return '<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<tr>' +
                        '<td>FECHA DE REGISTRO: <u id="date' + d + '"></u></td>' +
                        '<td><a class="disable photos photo' + d + '"><u>REGISTRO FOTOGRAFICO</u></a></td>' +
                        '<td><a class="disable pisnm' + d + '"><u>FORMATO PISNM</u></a></td>' +
                        '<td><a class="disable tss' + d + '"><u>FORMATO TSS</u></a></td>' +
                        '<td><a href="#" data-toggle="modal" data-target="#modalMaterials"><u>SOLICITUD DE MATERIALES</u></a></td>' +
                        '<td><a href="#" data-toggle="modal" data-target="#modalObservations"><u>OBSERVACIONES GENERALES</u></a></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td colspan="3"></td>' +
                        '<td><u style="color:#00B0F0">ACEPTA VISITA Y ENVIA A:</u></td>' +
                        '<td><select name="state" id="state_' + d + '" onchange="assign(' + d + ')">' +
                        '<option></option>' +
                        '<option value="7">CENTRO DE DISEÑO</option>' +
                        '<option value="9">CENTRO DE COSTOS</option>' +
                        '<option value="16">GESTIÓN MATERIAL</option>' +
                        '<option value="23">FACTURACIÓN</option>' +
                        '</select></td>' +
                        '<td><a href="javascript:return_order(' + d + ')"><u style="color:#00B0F0">RECHAZAR VISITA</u></a></td>' +
                        '</tr>' +
                        '</table>';
            }

            function assign(idOrder) {
                var idArea = 0;
                var idState = $("#state_" + idOrder).val();
                if (idState === '7') {
                    idArea = 2;
                } else {
                    idArea = 3;
                }
                url = get_base_url() + "Visit/validation_register_visit_initial";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder, idArea: idArea, idState: idState},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Registro procesado exitosamente.');
                            location.reload();
                        }
                    }
                });
            }

            function return_order(idOrder) {
                var obsv = prompt('Observaciones');
                if (obsv !== "") {
                    url = get_base_url() + "Visit/return_register_visit_init";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, idArea: 1, idState: 3, obsv: obsv},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Orden devuelta a contratista exitosamente');
                                location.reload();
                            }
                        }
                    });
                } else {
                    alertify.error('Debes digitar observaciones');
                }
            }

            function getDocs(idOrder) {
                url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["docs"], function (i, doc) {
                        $("#date"+idOrder).html(doc.dateSave);
                        if (doc.idTypeDocument == "2") {
                            $(".pisnm" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file)
                            $(".pisnm" + idOrder).attr("target", "_blank");
                            $(".pisnm" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument == "3") {
                            $(".tss" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file)
                            $(".tss" + idOrder).attr("target", "_blank");
                            $(".tss" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument == "1") {
                            $(".photo" + idOrder).removeClass("disable");
                            $(".photo" + idOrder).addClass("pointer");
                        }
                    });
                });
            }

            function getRegPhoto(id) {
                galery = false;
                $(".slides").html("");
                url = get_base_url() + "Orders/get_reg_photos_xid?jsoncallback=?";
                $.getJSON(url, {id: id}).done(function (res) {
                    var pos = 1;
                    var image = res.split(",");
                    for (var i = 0; i < image.length; i++) {
                        var html = '<input type="radio" name="radio-btn" id="img-' + pos + '" ' + (pos === 1 ? 'checked' : '') + ' />';
                        html += '<li class="slide-container"><div class="slide">';
                        html += '<img src="' + get_base_url() + "uploads/" + image[i] + '" /></div> ';
                        html += '<div class="nav"><label for="img-' + (pos === 1 ? 1 : pos - 1) + '" class="prev">&#x2039;</label>';
                        html += '<label for="img-' + (pos + 1) + '" class="next">&#x203a;</label></div></li>';
                        $(".slides").prepend(html);
                        galery = true;
                        pos++;
                    }
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

            function getMaterials(idOrder) {
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
