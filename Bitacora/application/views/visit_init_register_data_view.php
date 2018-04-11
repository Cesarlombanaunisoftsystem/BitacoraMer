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
                                        <li role="presentation"><a href="<?= base_url('Visit/site_init_process') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="bandeja">
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <img src="<?= base_url('dist/img/visitini.png') ?>" style="width: 100%;">
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
                                                        <td><?= $visit->uniquecode . "-" . $visit->coi ?></td>
                                                        <td><?= $visit->uniqueCodeCentralCost ?></td>
                                                        <td><a href="#" data-toggle="modal" data-target="#modalActivities" onclick="getActivities(<?= $visit->id ?>)"><?= $visit->name_activitie ?></a></td>
                                                        <td><?= $visit->name_service ?></td>
                                                        <td class="text-center"><?= $visit->count ?></td>
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
                        </div>                        
                    </div>
                </section>
                <!-- /.content -->  
                <!-- Modal Materiales-->
                <div id="modalMaterials" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content modal-lg">
                            <div class="modal-header">        
                                <a class="pull-right" data-dismiss="modal" style="cursor: pointer;">
                                    <i class="fa fa-close"></i>
                                </a>

                                <h3 class="modal-title title-modals-visit" ><b>MATERIALES</b></h3>                                
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="frmMaterials" method="post">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th class="th-head-modals">CATEGORIA</th>
                                                <th  class="th-head-modals">PRODUCTO</th>
                                                <th  class="th-head-modals">CANTIDAD</th>
                                                <th  class="th-head-modals">Unidad de Medida</th>
                                                <th  class="th-head-modals">OPCION</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="idOrder" id="idOrder">
                                                    <div id="selactivities"></div>
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

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-lg btn-default pull-right color-btn-modal"  onclick="register()">Registrar</button>      
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
                function getFileNameDas(elm) {
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
                        getObsvGen(order_id);
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
                            '<p id="p_1"></p><input type="hidden" value="1" name="idTypeRegFoto"><input class="photo' + d + '" style="display: none;" onchange="getFileNameRegFoto(this)" type="file" name="fileregfoto[]" id="fileregfoto" multiple disabled></input></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable photos photo' + d + ' form-control" name="obsvRegPic" disabled><td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design" for="filepisnm"><a class="disable pisnm' + d + '">ADJUNTAR FORMATO PISNM</a></label>' +
                            '<p id="p_2"></p><input type="hidden" value="2" name="idTypePsinm"><input class="pisnm' + d + '" style="display: none;" onchange="getFileNamePsinm(this)" type="file" name="filepisnm" id="filepisnm" disabled></input></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable pisnm' + d + ' form-control" name="obsvPsinm" disabled></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design" for="filetss"><a class="disable tss' + d + '">ADJUNTAR FORMATO TSS</a></label>' +
                            '<p id="p_3"></p><input type="hidden" value="3" name="idTypeTss"><input class="tss' + d + '" style="display: none;" onchange="getFileNameTss(this)" type="file" name="filetss" id="filetss" disabled></input></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable tss' + d + ' form-control" name="obsvTss" disabled></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design" for="filedas"><a class="disable das' + d + '">ADJUNTAR FORMATO DAS</a></label>' +
                            '<p id="p_4"></p><input type="hidden" value="4" name="idTypeDas"><input class="das' + d + '" style="display: none;" onchange="getFileNameDas(this)" type="file" name="filedas" id="filedas" disabled></input></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="disable das' + d + ' form-control" name="obsvDas" disabled></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><label class="blue bold upload_design"><a href="#" data-toggle="modal" data-target="#modalMaterials" onclick="addIdOrder(' + d + ')">ADJUNTAR SOLICITUD DE MATERIALES</a></label></td>' +
                            '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" name="obsvMat" disabled></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td>OBSERVACIONES GENERALES</td>' +
                            '<td><input type="hidden" value="' + d + '" name="idOrder"><input type="text" class="form-control" name="obsvgen" id="obsvgen"></td>' +
                            '<td><button type="submit" class="blue bold">REGISTRAR</button></td>' +
                            '<td><a class="orange bold" href="javascript:return_order(' + d + ')"><i class="fa fa-undo fa-2x" aria-hidden="true" style="color: orange"></i></a></td>' +
                            '</tr>' +
                            '</table></form>';
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
                                    $(".pisnm" + idOrder).attr("disabled",false);
                                    $("#pisnm" + idOrder).attr("disabled",false);
                            }
                            if (doc.idTypeDocument === "3") {
                                    $(".tss" + idOrder).removeClass("disable");
                                    $(".tss" + idOrder).addClass("pointer");
                                    $(".tss" + idOrder).attr("disabled",false);
                                    $("#tss" + idOrder).attr("disabled",false);
                            }
                            if (doc.idTypeDocument === "1") {
                                    $(".photo" + idOrder).removeClass("disable");
                                    $(".photo" + idOrder).addClass("pointer");
                                    $("#photo" + idOrder).attr("disabled",false);
                                    $(".photo" + idOrder).attr("disabled",false);
                                    galery = true;
                                    pos++;
                            }
                            if (doc.idTypeDocument === "4") {
                                    $(".das" + idOrder).removeClass("disable");
                                    $(".das" + idOrder).addClass("pointer");
                                    $(".das" + idOrder).attr("disabled",false);
                                    $("#das" + idOrder).attr("disabled",false);
                            }
                        });
                    });
                }

                function getObsvGen(idOrder) {
                    var url = get_base_url() + "Orders/get_order_xid?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                        $("#obsvgen").val(res.res.observations);
                    });
                }

                function getActivities(idOrder) {
                    $("#activities").empty();
                    url = get_base_url() + "Visit/get_activities_x_order?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                        $.each(respuestaServer["act"], function (i, act) {
                            $("#activities").append("<tr><td>" + act.name_activitie +
                                    "</td><td>" + act.name_service + "</td><td>" +
                                    act.count + "</td><td>" + act.unit_measurement + "</td></tr>");
                        });
                    });
                }

                function addIdOrder(d) {
                    $("#idOrder").val(d);
                    getMaterials(d);
                    getServicesMaterials(d);
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

                function getServicesMaterials(idOrder) {
                    url = get_base_url() + "Activities/get_activities_materials?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                        $("#selactivities").html("<select name='idActivities' id='idActivities' class='form form-control' onchange='getServices(this.value)'>" +
                                "<option>Seleccionar</option><option value='" + res.activitie.id + "'>" +
                                res.activitie.name_activitie + "</option>" + "</select>");
                    });
                }

                function getServices(idActivitie) {
                    url = get_base_url() + "Activities/get_services";
                    $.post(url, {
                        idActivities: idActivitie
                    }, function (data) {
                        $("#idServices").html(data);
                    });
                }
                function getMaterials(idOrder) {
                    $("#materials").empty();
                    url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                        $.each(respuestaServer["materials"], function (i, materials) {
                            $("#materials").append("<tr><td>" + materials.name_activitie + "</td><td>" +
                                    materials.name_service + "</td>" +
                                    "<td>" + materials.count + "</td>" +
                                    "<td>" + materials.unit_measurement + "</td><td>" +
                                    "<a href='#'><i class='fa fa-minus-circle fa-2x' style='color: #a70101' onclick='removeMaterial(" + materials.id + ")'></i></a>" +
                                    "</td></tr>");
                        });
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
                    alertify.success('Material agregado exitosamente');
                    $('#modalMaterials').modal('hide');
                }
            </script>
    </body>
</html>
