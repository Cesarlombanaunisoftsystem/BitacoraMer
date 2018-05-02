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
                                        <li role="presentation"><a href="<?= base_url('Visit/validation_close') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation" class="active"><a href="<?= base_url('Visit/validation_close_process') ?>" role="tab" data-toggle="">Registros Procesados</a></li>                                        
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <img src="<?= base_url('dist/img/visitclose.png') ?>" style="width: 120px;">
                        </div>
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">        

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
                                    if (isset($visits) && $visits) {
                                        foreach ($visits as $visit) {
                                            ?> 
                                            <tr>
                                                <td class="details-control" id="<?php echo $visit->id; ?>">
                                                    <i class="fa fa-plus-square-o"></i>
                                                </td>
                                                <td><?= $visit->dateSave ?></td>
                                                <td><?= $visit->dateLog ?></td>
                                                <td><?= $visit->uniquecode . '-' . $visit->coi ?></td>
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
                <!-- Modal Galery -->
                <div class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <ul class="slides"></ul> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content -->  
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
                        $('.modal').modal('show');
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
                    getObservations(order_id);
                    closeOpenedRows(dt, tr);
                    $(this).html('<i class="fa fa-minus-square-o"></i>');
                    row.child(format(order_id)).show();
                    tr.addClass('shown');
                    openRows.push(tr);
                }
            });
            function format(d) {
                return  '<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design"><a class="disable photos photo' + d + '">VER REGISTRO FOTOGRAFICO</a></label>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" size=40 id="obsvRegPic' + d + '" readonly><td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable pisnm' + d + '">VER FORMATO PSINM</a></label>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" size=40 id="obsvPsinm' + d + '" readonly></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable tss' + d + '">VER FORMATO TSS</a></label>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" size=40 id="obsvTss' + d + '" readonly></td>' +
                        '</tr>' +
                        '<td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable das' + d + '">VER FORMATO DAS</a></label>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" size=40 id="obsvDas' + d + '" readonly></td>' +
                        '</tr>' + '<tr>' + '<td>OBSERVACIONES GENERALES</td>' +
                        '<td colspan="3"><input type="hidden" value="' + d + '" name="idOrder"><input type="text" class="form-control" id="obsvgen' + d + '" readonly></td></tr>' +
                        '<tr><td></td><td><a href="#" target="_blank" class="disable docs' + d + '">' +
                        '<button type="button" class="btn btn-default">Ver Adjuntos</button></a></td></tr>' +
                        '</table>';
            }

            function getDocs(idOrder) {
                url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["docs"], function (i, doc) {
                        $("#date" + idOrder).html(doc.dateSave2);
                        if (doc.idTypeDocument === "2") {
                            $(".pisnm" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file2);
                            $(".pisnm" + idOrder).attr("target", "_blank");
                            $(".pisnm" + idOrder).removeClass("disable");
                            $("#obsvPsinm" + idOrder).val(doc.observation2);
                        }
                        if (doc.idTypeDocument === "3") {
                            $(".tss" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file2);
                            $(".tss" + idOrder).attr("target", "_blank");
                            $(".tss" + idOrder).removeClass("disable");
                            $("#obsvTss" + idOrder).val(doc.observation2);
                        }
                        if (doc.idTypeDocument === "4") {
                            $(".das" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file2);
                            $(".das" + idOrder).attr("target", "_blank");
                            $(".das" + idOrder).removeClass("disable");
                            $("#obsvDas" + idOrder).val(doc.observation2);
                        }
                        if (doc.idTypeDocument === "1") {
                            $(".photo" + idOrder).removeClass("disable");
                            $(".photo" + idOrder).addClass("pointer");
                            $("#obsvRegPic" + idOrder).val(doc.observation2);
                        }
                        if (doc.idTypeDocument === "7") {
                            $(".docs" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file2);
                            $(".docs" + idOrder).attr("target", "_blank");
                            $(".docs" + idOrder).removeClass("disable");
                        }
                    });
                });
            }

            function getRegPhoto(id) {
                galery = false;
                $(".slides").html("");
                url = get_base_url() + "Orders/get_reg_photos_xid_stage2";
                $.get(url, {id: id}).done(function (res) {
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
            function getObservations(idOrder) {
                $("#obsvgen" + idOrder).val("");
                url = get_base_url() + "Orders/get_observation_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder,state:16}).done(function (res) {
                    $("#obsvgen" + idOrder).val(res.observation.obsvLog);
                });
            }
            function generateid(idOrder) {
                $("#idOrder").val(idOrder);
            }
            function addIdOrder(d) {
                $("#idOrder").val(d);
            }
        </script>
    </body>
</html>
