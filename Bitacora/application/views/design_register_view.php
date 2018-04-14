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
                                        <li role="presentation" class="active"><a href="<?= base_url('Design/register') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Design/proccess') ?>" role="tab" data-toggle="">Registros Procesados</a></li>
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
                            <div id="spinner"></div>
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
                <!-- Modal Galery-->
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
                <!-- Modal Observaciones-->
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
            function getFileName(elm) {
                var fn = $(elm).val();
                $(".myfilename").html(fn);
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
                    getRegPhoto(order_id);
                    getObservations(order_id);
                    closeOpenedRows(dt, tr);
                    $(this).html('<i class="fa fa-minus-square-o"></i>');
                    row.child(format(order_id)).show();
                    tr.addClass('shown');
                    openRows.push(tr);
                }
            });
            function format(d) {
                return '<form id="form-design" method="POST" action="javascript:registerOrder()" enctype="multipart/form-data">' +
                        '<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<tr>' +
                        '<td>FECHA DE REGISTRO: <p id="date' + d + '"></td>' +
                        '<td><a class="disable photos photo' + d + '">REGISTRO FOTOGRAFICO</a></td>' +
                        '<td><a class="disable pisnm' + d + '">FORMATO PISNM</a></td>' +
                        '<td><a class="disable tss' + d + '">FORMATO TSS</a></td>' +
                        '<td><a class="disable das' + d + '">FORMATO DAS</a></td>' +
                        '<td><a href="#" data-toggle="modal" data-target="#modalObservations">OBSERVACIONES GENERALES</a></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design" for="file' + d + '">ADJUNTAR</label>' +
                        '<p class="myfilename"></p><input style="display: none;" onchange="getFileName(this)" type="file" name="file" id="file' + d + '"></input></td>' +
                        '<td colspan="4"><input name="observacion" id="obsvgen" style="width:100%" type="text"></td>' +
                        '<td colspan="4"><input type="hidden" value="' + d + '" name="idOrder"></input>' +
                        '<input type="submit" class="blue bold" value="REGISTRAR DISEÑO" style="margin-right:18px"> <a class="orange bold" href="javascript:return_order(' + d + ')">RECHAZAR ORDEN</a></td>' +
                        '</tr>' +
                        '</table></form>';
            }

            function getObservations(idOrder) {
                $("#obsv").html("");
                url = get_base_url() + "Orders/get_observation_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $("#obsvgen").val(res.observation.obsvLog);
                    $("#obsv").html(res.observation.obsvLog);
                });
            }

            function registerOrder() {
                var url = "";
                var formData = new FormData(document.getElementById("form-design"));
                url = get_base_url() + "Design/register_order_design";
                $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function (res) {
                    $('#spinner').html("");
                    if (res === "ko") {
                        alertify.error('Debes adjuntar documento de diseño!');
                    }
                    if (res === "error") {
                        alertify.error('Error en base de datos!');
                    }
                    if (res === "ok") {
                        alertify.success('Diseño registrado exitosamente');
                        location.reload();
                    }
                });
            }

            function return_order(idOrder) {
                url = get_base_url() + "Design/return_order_design";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder, state: 2},
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
        </script>
    </body>
</html>
