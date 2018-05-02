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
                                        <li role="presentation" class="active"><a href="<?= base_url('Visit/validation_close') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Visit/validation_close_process') ?>" role="tab" data-toggle="">Registros Procesados</a></li>                                        
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
                <!-- /.content -->  
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
            function getFileNameDoc(elm) {
                var fn = $(elm).val();
                $("#p_4").html(fn);
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
                return '<form enctype="multipart/form-data" method="post" name="form-register-visit-close" id="form-register-visit-close" action="register_docs_visit_close">' +
                        '<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design" for="fileregfoto"><a class="disable photos photo' + d + '">ADJUNTAR REGISTRO FOTOGRAFICO</a></label>' +
                        '<p id="p_1"></p><input class="photo' + d + '" style="display: none;" onchange="getFileNameRegFoto(this)" type="file" name="fileregfoto[]" id="fileregfoto" multiple disabled></input></td>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable photos photo' + d + ' form-control" name="obsvRegPic" disabled><td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design" for="filepisnm"><a class="disable pisnm' + d + '">ADJUNTAR FORMATO PISNM</a></label>' +
                        '<p id="p_2"></p><input type="hidden" value="2" name="idTypePsinm"><input class="pisnm' + d + '" style="display: none;" onchange="getFileNamePsinm(this)" type="file" name="filepisnm" id="filepisnm" disabled></input></td>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable pisnm' + d + ' form-control" name="obsvPsinm" disabled></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design" for="filetss"><a class="disable tss' + d + '">ADJUNTAR FORMATO TSS</a></label>' +
                        '<p id="p_3"></p><input class="tss' + d + '" style="display: none;" onchange="getFileNameTss(this)" type="file" name="filetss" id="filetss" disabled></input></td>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable tss' + d + ' form-control" name="obsvTss" disabled></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><label class="blue bold upload_design" for="filedas"><a class="disable das' + d + '">ADJUNTAR FORMATO DAS</a></label>' +
                        '<p id="p_3"></p><input class="das' + d + '" style="display: none;" onchange="getFileNameDas(this)" type="file" name="filedas" id="filedas" disabled></input></td>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable das' + d + ' form-control" name="obsvDas" disabled></td>' +
                        '</tr>' + '<tr>' + '<td>OBSERVACIONES GENERALES</td>' +
                        '<td colspan="3"><input type="hidden" value="' + d + '" name="idOrder"><input type="text" class="form-control" name="obsvgen" id="obsvgen"></td></tr>' +
                        '<tr><td></td><td colspan="2"><label class="col-xs-4 control-label" for="userfile">' +
                        '<div style="background-color: #777;border-radius: 50%;width: 30px;height: 30px;">' +
                        '<img src="' + get_base_url() + '/dist/img/clip.png" style="width: 15px;margin-top: 10px;margin-right: 1px;margin-left: 7px;">' +
                        '</div></label><p id="datofile"></p>' +
                        '<input type="file" name="userfile" id="userfile" style="display: none" onchange="getFileNameDoc(this)"><p id="p_4"></p>' +
                        '</td><td><a href="#" class="blue bold"><input type="submit" value="REGISTRAR" class="blue bold"></a></td></tr>' +
                        '</table></form>';
            }

            function getDocs(idOrder) {
                url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["docs"], function (i, doc) {
                        if (doc.idTypeDocument === "2") {
                            $(".pisnm" + idOrder).removeClass("disable");
                            $(".pisnm" + idOrder).addClass("pointer");
                            $(".pisnm" + idOrder).attr("disabled", false);
                        }
                        if (doc.idTypeDocument === "3") {
                            $(".tss" + idOrder).removeClass("disable");
                            $(".tss" + idOrder).addClass("pointer");
                            $(".tss" + idOrder).attr("disabled", false);
                        }
                        if (doc.idTypeDocument === "1") {
                            $(".photo" + idOrder).removeClass("disable");
                            $(".photo" + idOrder).addClass("pointer");
                            $(".photo" + idOrder).attr("disabled", false);
                        }
                        if (doc.idTypeDocument === "4") {
                            $(".das" + idOrder).removeClass("disable");
                            $(".das" + idOrder).addClass("pointer");
                            $(".das" + idOrder).attr("disabled", false);
                        }
                    });
                });
            }

            function addIdOrder(d) {
                $("#idOrder").val(d);
            }


        </script>
    </body>
</html>
