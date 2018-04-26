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
                <div id="load_menu" style="margin-top: 10px"></div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                           
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
                                                <td><?= $order->uniquecode . '-' . $order->coi ?></td>
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
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h3 class="modal-title title-modals-visit"><b>MATERIALES</b></h3>                                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmMaterials" method="post">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="th-head-modals">CATEGORIA</th>
                                <th class="th-head-modals">PRODUCTO</th>
                                <th class="th-head-modals">CANTIDAD</th>
                                <th class="th-head-modals">Unidad de Medida</th>
                                <th class="th-head-modals">OPCION</th>
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
                                <td><a href="javascript:addMaterials()"><i class="fa fa-plus-circle fa-2x" style="color: #006e92"></i></a>
                                </td>
                            </tr>
                        </thead>
                        <tbody id="materials">
                        </tbody>
                    </table> 

                </form>                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-default pull-right color-btn-modal" onclick="register()">Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Observaciones-->
<div id="modalObservations" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="text-align: center; color: #006e92"><b>OBSERVACIONES GENERALES</b></h3>                                
            </div>
            <div class="modal-body">
                <div id="obsv"></div>       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-default pull-right" style="color:#006e92" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Observaciones -->
<!-- Modal edición productos-->
<div id="modalEditProducts" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 50%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="text-align: center; color: #00B1EB"><b>MODIFICACIÓN MATERIALES</b></h3>                                
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" id="frmEditDetail" action="javascript:editDetail()" method="post">
                        <div class="form-group">
                            <input type="hidden" name="idDetail" id="idDetail">
                            <label class="control-label col-sm-2" for="idServices">Producto:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="idServices" id="idServices">
                                    <option id="product"></option>
                                    <?php foreach ($services as $service) { ?>
                                        <option value="<?= $service->id ?>"><?= $service->name_service ?>
                                        </option>
                                    <?php } ?>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="quantity">Cantidad:</label>
                            <div class="col-sm-10">          
                                <input type="number" class="form-control" name="quantity" id="quantity">
                            </div>
                        </div>                                
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">REGISTRAR</button>
                            </div>
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
                '<td>FECHA DE REGISTRO: <p id="date' + d + '"></p></td>' +
                '<td><a class="disable photos photo' + d + '">REGISTRO FOTOGRAFICO</a></td>' +
                '<td><a class="disable pisnm' + d + '">FORMATO PISNM</a></td>' +
                '<td><a class="disable tss' + d + '">FORMATO TSS</a></td>' +
                '<td><a class="disable das' + d + '">FORMATO DAS</a></td>' +
                '<td><a href="#" data-toggle="modal" data-target="#modalMaterials" onclick="addIdOrder(' + d + ')">SOLICITUD DE MATERIALES</a></td>' +
                '<td><a href="#" data-toggle="modal" data-target="#modalObservations">OBSERVACIONES GENERALES</a></td>' +
                '</tr>' +
                '<tr>' +
                '<td colspan="3"></td>' +
                '<td><u style="color:#00B0F0">ACEPTA VISITA Y ENVIA A:</td>' +
                '<td><select name="state" id="state_' + d + '" onchange="assign(' + d + ')">' +
                '<option></option>' +
                '<option value="7">CENTRO DE DISEÑO</option>' +
                '<option value="9">CENTRO DE COSTOS</option>' +
                '<option value="16">GESTIÓN MATERIAL</option>' +
                '<option value="23">FACTURACIÓN</option>' +
                '</select></td>' +
                '<td><a href="javascript:return_order(' + d + ')"><u style="color:#00B0F0">RECHAZAR VISITA</a></td>' +
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
                $("#date" + idOrder).html(doc.dateSave);
                if (doc.idTypeDocument === "2") {
                    if (doc.idState !== '0') {
                        $(".pisnm" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                        $(".pisnm" + idOrder).attr("target", "_blank");
                        $(".pisnm" + idOrder).removeClass("disable");
                    } else {
                        $(".pisnm" + idOrder).css("color", "red");
                    }
                }
                if (doc.idTypeDocument === "3") {
                    if (doc.idState !== '0') {
                        $(".tss" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                        $(".tss" + idOrder).attr("target", "_blank");
                        $(".tss" + idOrder).removeClass("disable");
                    } else {
                        $(".tss" + idOrder).css("color", "red");
                    }
                }
                if (doc.idTypeDocument === "4") {
                    if (doc.idState !== '0') {
                        $(".das" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                        $(".das" + idOrder).attr("target", "_blank");
                        $(".das" + idOrder).removeClass("disable");
                    } else {
                        $(".das" + idOrder).css("color", "red");
                    }
                }
                if (doc.idTypeDocument === "1") {
                    if (doc.idState !== '0') {
                        $(".photo" + idOrder).removeClass("disable");
                        $(".photo" + idOrder).addClass("pointer");
                    } else {
                        $(".photo" + idOrder).css("color", "red");
                    }
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

    function addIdOrder(d) {
        $("#idOrder").val(d);
        getMaterials(d);
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
        $('#materials').empty();
        url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
        $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
            $.each(respuestaServer["materials"], function (i, materials) {
                $('#materials').append('<tr><td>' + materials.name_activitie +
                        '</td><td>' + materials.name_service +
                        '</td><td>' + materials.count + '</td><td>'
                        + materials.unit_measurement + '</td>' +
                        '<td><a onclick="viewService(' + materials.id + ')" data-toggle="modal" data-target="#modalEditProducts">' +
                        '<i class="fa fa-edit fa-2x" aria-hidden="true" style="color: #006e92;margin-right:5px;"><t>' +
                        '</i></a><a href="#"><i class="fa fa-minus-circle fa-2x" style="color: #a70101" onclick="removeMaterial(' + materials.id + ')"></i></a></td></tr>');
            });
        });
    }

    function getObservations(idOrder) {
        $("#obsv").html("");
        url = get_base_url() + "Orders/get_observation_order?jsoncallback=?";
        $.getJSON(url, {idOrder: idOrder, state: 3}).done(function (res) {
            $("#obsv").html(res.observation.obsvLog);
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
    function addMaterials() {
        var idOrder = $("#idOrder").val();
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
                    getMaterials(idOrder);
                    $("#idActivities").val('');
                    $("#idServices").val('');
                    $("#count").val('');
                }
            }
        });
    }
    function editDetail() {
        var idOrder = $("#idOrder").val();
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
                    getMaterials(idOrder);
                    $("#modalEditProducts").modal('hide');
                }
            }
        });
    }
    function removeMaterial(id) {
        var idOrder = $("#idOrder").val();
        $.confirm({
            title: 'Confirma eliminar este item?',
            content: '',
            buttons: {
                confirmar: function () {
                    url = get_base_url() + "Orders/remove_order_detail";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {id: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                getMaterials(idOrder);
                            }
                        }
                    });
                },
                cancelar: function () {
                    $.alert('Canceledo!');
                }
            }
        });
    }

    function register() {
        alertify.success('Material registrado exitosamente');
        location.reload();
    }
    cargar_menu("validacion_visita", 'bandeja de entrada');

</script>
</body>
</html>
