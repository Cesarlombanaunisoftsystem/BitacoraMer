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
                                        <th style="color: #00B0F0">Fecha procesado</th>
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
                                                <td class="details-control" id="<?= $order->id ?>">
                                                    <i class="fa fa-plus-square-o"></i>
                                                </td>
                                                <td><?= $order->dateSave ?></td>
                                                <td><?= $order->dateLog ?></td>
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
    <!-- Modal Materiales-->
    <div id="modalMaterials" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 80%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" style="text-align: center; color: #00B1EB"><b>MATERIALES</b></h3>                                
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" id="frmMaterials" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color: #00B1EB; color: white">CATEGORIA</th>
                                        <th style="background-color: #00B1EB; color: white">PRODUCTO</th>
                                        <th style="background-color: #00B1EB; color: white">CANTIDAD</th>
                                        <th style="background-color: #00B1EB; color: white">Unidad de Medida</th>
                                    </tr>                                                
                                </thead>
                                <tbody id="materials">
                                </tbody>
                            </table>
                        </form>                                     
                        <hr style="border-color: #00B1EB">
                        <p>Bitácora</p>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    <!-- modal activities -->
    <div id="modalActivities" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 60%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align: center; color: #00B1EB"><b>ACTIVIDADES RELACIONADAS</b></h5>                                
                </div>
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
                            <tbody id="activities">
                            </tbody>
                        </table> 
                        <hr style="border-color: #00B1EB">
                        <p>Bitácora</p>
                    </div>                   
                </div>                            
            </div>
        </div>
    </div>
    <!-- modal activities -->
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
    <!-- Modal Observaciones-->
    <div id="modalObservations" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 50%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" style="text-align: center; color: #00B1EB"><b>OBSERVACIONES GENERALES</b></h3>                                
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="obsv"></div>
                    </div>                   
                </div>
                <hr style="border-color: #00B1EB">
                <p>Bitácora</p>
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
                '</table>';
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
                        + materials.unit_measurement + '</td></tr>');
            });
        });
    }

    function getObservations(idOrder) {
        $("#obsv").html("");
        url = get_base_url() + "Orders/get_observation_order?jsoncallback=?";
        $.getJSON(url, {idOrder: idOrder, state: 4}).done(function (res) {
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
    cargar_menu("validacion_visita", 'Registros procesados');
</script>
</body>
</html>
