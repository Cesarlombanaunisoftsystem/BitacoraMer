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
                                        <li role="presentation"><a href="#process" aria-controls="binnacle" role="tab" data-toggle="tab">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-striped" style="font-size:12px">
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
                                                            <td><a href="<?= base_url('uploads/') . $row->picture ?>"  target="ventana" onClick="window.open('', 'ventana', 'width=400,height=400,lef t=100,top=100');"><?= $row->uniquecode . '-' . $row->coi ?></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost . '-' . $row->coi ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?></td>                                                
                                                            <td><?php
                                                                setlocale(LC_MONETARY, 'es_CO');
                                                                echo money_format('%.2n', $row->totalCost)
                                                                ?></td>
                                                            <td><?php
                                                                $dif = $row->totalOrder - $row->totalCost;
                                                                $util = ($dif * 100) / $row->totalOrder;
                                                                echo round($util, 2) . ' %';
                                                                ?></td>
                                                            <td><a href="#" onclick="assign(<?= $row->id . "," . $areaAssign . "," . $stateAssign . "," . $row->idTechnicals ?>)">
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
                            </div>

                            <div role="tabpanel" class="tab-pane" id="process">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-striped" style="font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Fecha de ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Técnico</th>
                                                    <th style="color: #00B0F0">Costo de Orden</th>
                                                    <th style="color: #00B0F0">% Utilidad</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($plprocess) && $plprocess) {
                                                    foreach ($plprocess as $row) {
                                                        ?>                                            
                                                        <tr>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><a href="<?= base_url('uploads/') . $row->picture ?>"  target="ventana" onClick="window.open('', 'ventana', 'width=400,height=400,lef t=100,top=100');"><?= $row->uniquecode ?></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?></td>                                                
                                                            <td><?php
                                                                setlocale(LC_MONETARY, 'es_CO');
                                                                echo money_format('%.2n', $row->totalCost)
                                                                ?></td>
                                                            <td><?php
                                                                $dif = $row->totalOrder - $row->totalCost;
                                                                $util = ($dif * 100) / $row->totalOrder;
                                                                echo round($util, 2) . ' %';
                                                                ?></td>                                                            
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
                                            <th style="background-color: #00B1EB; color: white">OPCION</th>
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
                                            <td><a href="javascript:addMaterials()"><i class="fa fa-plus-circle fa-2x" style="color: blue"></i></a>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="materials">
                                    </tbody>
                                </table> 
                                <div class="col-xs-12">
                                    <div class="center block text-center">
                                        <button type="button" class="btn btn-lg btn-default color-blue pull-right" style="margin-top: 30px;" onclick="register()">Registrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>                  
                        <hr style="border-color: #00B1EB">
                        <p>Bitácora</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Materiales -->
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
        <!-- Modal edicion productos-->
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
        <!-- Modal Galery -->

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
                        '<td>FECHA DE REGISTRO:</td>' + '<td><label id="fecha_' + d + '"></label></td>' +
                        '<td><label class="blue bold upload_design">' +
                        '<a class="disable photos photo' + d + '"><u>REGISTRO FOTOGRAFICO</u></a></label>' +
                        '</td><td><label class="blue bold upload_design">' +
                        '<a class="disable pisnm' + d + '"><u>FORMATO PISNM</u></a></label>' +
                        '</td>' + '<td><label class="blue bold upload_design">' +
                        '<a class="disable tss' + d + '"><u>FORMATO TSS</u></a></label>' +
                        '</td>' + '<td><label class="blue bold upload_design">' +
                        '<a class="disable das' + d + '"><u>FORMATO DAS</u></a></label>' +
                        '</td>' + '<td><label class="blue bold upload_design"><a href="#" onclick="addIdOrder(' + d + ')" data-toggle="modal" data-target="#modalMaterials">' +
                        '<u>SOLICITUD DE MATERIALES/SERV</u></a></label><input type="hidden" value="' + d + '" name="idOrder">' +
                        '</td>' + '<td><label class="blue bold upload_design"><a href="#" onclick="getObservations(' + d + ')" data-toggle="modal" data-target="#modalObservations">' +
                        '<u>OBSERVACIONES GENERALES</u></a></label></td></tr></table></form>';
            }

            function getDocs(idOrder) {
                url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["docs"], function (i, doc) {
                        $("#fecha_" + idOrder).html(doc.dateSave);
                        if (doc.idTypeDocument === "2") {
                            $(".pisnm" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                            $(".pisnm" + idOrder).attr("target", "_blank");
                            $(".pisnm" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument === "3") {
                            $(".tss" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                            $(".tss" + idOrder).attr("target", "_blank");
                            $(".tss" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument === "4") {
                            $(".das" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                            $(".das" + idOrder).attr("target", "_blank");
                            $(".das" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument === "6") {
                            $(".design" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                            $(".design" + idOrder).attr("target", "_blank");
                            $(".design" + idOrder).removeClass("disable");
                        }
                        if (doc.idTypeDocument === "1") {
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

            function getMaterials(idOrder) {
                $("#materials").empty();
                url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#materials').append('<tr><td>' + materials.name_activitie +
                                '</td><td>' + materials.name_service +
                                '</td><td>' + materials.count + '</td><td>'
                                + materials.unit_measurement + '</td>' +
                                '<td><a onclick="viewService(' + materials.id + ')" data-toggle="modal" data-target="#modalEditProducts">' +
                                '<i class="fa fa-edit fa-2x" aria-hidden="true" style="color: blue">' +
                                '</i></a><a href="#"><i class="fa fa-minus-circle fa-2x" style="color: red" onclick="removeMaterial(' + materials.id + ')"></i></a></td></tr>');
                    });
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

            function getObservations(idOrder) {
                $("#obsv").html("");
                url = get_base_url() + "Orders/get_observation_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $("#obsv").html(res.observation.observations);
                });
            }

            function assign(idOrder, idArea, idState, idTech) {
                $.confirm({
                    title: 'En realidad desea aprobar la ordén?',
                    content: '',
                    buttons: {
                        confirmar: function () {
                            url = get_base_url() + "Audit/assign";
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {idOrder: idOrder, idArea: idArea, idState: idState, idTech: idTech},
                                success: function (resp) {
                                    if (resp === "error") {
                                        alertify.error('Error en BBDD');
                                    }
                                    if (resp === "ok") {
                                        alertify.success('Ordén aprovada.');
                                        location.reload();
                                    }
                                }
                            });
                        },
                        cancelar: function () {
                            $.alert('Cancelado!');
                        }
                    }
                });
            }

            function return_order(idOrder, idArea, idState) {
                $.confirm({
                    title: 'En realidad desea devolver la ordén?',
                    content: '',
                    buttons: {
                        confirmar: function () {
                            url = get_base_url() + "Audit/return_order_register_visit_site";
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {idOrder: idOrder, idArea: idArea, idState: idState},
                                success: function (resp) {
                                    if (resp === "error") {
                                        alertify.error('Error en BBDD');
                                    }
                                    if (resp === "ok") {
                                        alertify.success('Orden devuelta exitosamente');
                                        location.reload();
                                    }
                                }
                            });
                        },
                        cancelar: function () {
                            $.alert('Cancelado!');
                        }
                    }
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

            function register() {
                alertify.success('Material registrado exitosamente');
                location.reload();
            }
        </script>
    </body>
</html>
