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
                                        <li role="presentation" class="<?= (current_url() == base_url('Audit/auth_pay')) ? 'active' : '' ?>"><a href="<?= base_url('Audit/auth_pay') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation" class="<?= (current_url() == base_url('Audit/auth_pay_additional')) ? 'active' : '' ?>"><a href="<?= base_url('Audit/auth_pay_additional') ?>" aria-controls="binnacle" role="tab" data-toggle="">Pagos Adicionales</a></li>
                                        <li role="presentation" class="<?= (current_url() == base_url('Audit/auth_pay_process')) ? 'active' : '' ?>"><a href="<?= base_url('Audit/auth_pay_process') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
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
                            <form>
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
                                            <th style="color: #00B0F0">Area Origen</th>
                                            <th style="color: #00B0F0">Observaciones</th>
                                            <th style="color: #00B0F0">Costo de Orden</th>
                                            <th style="color: #00B0F0">% Entregado</th>
                                            <th style="color: #00B0F0">% Autorizado</th>
                                        </tr>                                   
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($pays) && $pays) {
                                            foreach ($pays as $row) {
                                                ?>                                            
                                                <tr>
                                                    <?php if ($stateInArea === '2') { ?>
                                                        <td></td>
                                                    <?php } else { ?>
                                                        <td class="details-control" id="<?php echo $row->id; ?>">
                                                            <i class="fa fa-plus-square-o"></i>
                                                        </td>
                                                    <?php } ?>
                                                    <td><?= $row->dateSave ?></td>
                                                    <td><a href="<?= base_url('uploads/') . $row->picture ?>"  target="ventana" onClick="window.open('', 'ventana', 'width=400,height=400,lef t=100,top=100');"><?= $row->uniquecode ?></a></td>
                                                    <td><?= $row->uniqueCodeCentralCost ?></td>
                                                    <td><?= $row->name_activitie ?></td>
                                                    <td><?= $row->count ?></td>
                                                    <td><?= $row->site ?></td>
                                                    <td><?= $row->name_user ?></td>
                                                    <td>PRESUPUESTO</td>
                                                    <td><?= $row->observations ?></td>                                                
                                                    <td><input type="hidden" id="costOrder" value="<?= $row->totalCost ?>"><?= $row->totalCost ?></td>
                                                    <td onclick="historyPays(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#modalHistoryPays">
                                                        <input type="hidden" id="pay_<?= $row->id ?>" value="<?= $row->percent_pay ?>"><?= $row->percent_pay ?>%</td>
                                                    <td><?php if ($stateInArea !== '3') { ?>
                                                        <input type="number" name="percent" id="percent_<?= $row->id ?>" class="form form-control" min="0" max="100" onchange="assignPercent('<?= $row->id ?>')">
                                                        <?php } else { ?><input type="number" name="percent" id="percent_<?= $row->id ?>" class="form form-control" readonly>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>                                                                         
                                    </tbody>
                                </table>
                            </form>
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color: #00B1EB; color: white">Categoria</th>
                                        <th style="background-color: #00B1EB; color: white">Producto</th>
                                        <th style="background-color: #00B1EB; color: white">Cantidad</th>
                                        <th style="background-color: #00B1EB; color: white">Unidad de medida</th>
                                    </tr>                                    
                                </thead>
                                <tbody  id="bodyMaterials">

                                </tbody>
                            </table> 
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

        <!-- Modal Histarial Pagos-->
        <div id="modalHistoryPays" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 40%;
                 border-color: blue;
                 border-style: solid;
                 border-radius: 20px;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div style="height: 350px;
                                 width: 550px;">
                                <p style="text-align:left;"><img src="<?= base_url('dist/img/logo_mail.png') ?>" alt="logo Mer"><img src="<?= base_url('dist/img/titulo_mail.png') ?>"  height="90px" width="250px" alt="titulo" style="text-align:right"/></p>
                                <p style="text-align:center;"><img src="<?= base_url('dist/img/hr_mail.png') ?>" width="510px" alt="hr"></p>                                
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">Fecha</u>
                                            </th>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">% Autorizado</u>
                                            </th>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">Vr. Autorizado</u>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="historyPays" style="text-align: center">

                                    </tbody>
                                </table>
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
                    return  '<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                            '<tr>' +
                            '<td>FECHA DE REGISTRO:<p></p></td>' + '<td><u><label id="fecha_' + d + '"></u></label></td>' +
                            '<td><label class="blue bold upload_design">' +
                            '<a class="disable photos photo' + d + '"><u>REGISTRO FOTOGRAFICO</u></a></label>' +
                            '</td><td><label class="blue bold upload_design">' +
                            '<a class="disable pisnm' + d + '"><u>FORMATO PISNM</u></a></label>' +
                            '</td>' + '<td><label class="blue bold upload_design">' +
                            '<a class="disable tss' + d + '"><u>FORMATO TSS</u></a></label>' +
                            '</td>' + '<td><label class="blue bold upload_design"><a href="#" onclick="materials(' + d + ')" data-toggle="modal" data-target="#modalMaterials">' +
                            '<u>SOLICITUD DE MATERIALES/SERV</u></a></label><input type="hidden" value="' + d + '" name="idOrder">' +
                            '</td>' + '<td><label class="blue bold upload_design"><a href="#" onclick="getObservations(' + d + ')" data-toggle="modal" data-target="#modalObservations">' +
                            '<u>OBSERVACIONES GENERALES</u></a></label></td></tr>' +
                            '<tr><td>FECHA DE REGISTRO:<p></p></td>' + '<td><u><label id="fecha_2_' + d + '"></u></label></td>' +
                            '<td><label class="blue bold upload_design">' +
                            '<a><u>DISEÑO</u></a></label>' +
                            '</tr></table>';
                }
                function getDocs(idOrder) {
                    url = get_base_url() + "Orders/get_details_order?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                        $.each(respuestaServer["docs"], function (i, doc) {
                            $("#fecha_" + idOrder).html(doc.dateSave);
                            $("#fecha_2_" + idOrder).html(doc.dateSave);
                            if (doc.idTypeDocument === "2") {
                                $(".pisnm" + idOrder).removeClass("disable");
                            }
                            if (doc.idTypeDocument === "3") {
                                $(".tss" + idOrder).removeClass("disable");
                            }
                            if (doc.idTypeDocument === "1") {
                                $(".photo" + idOrder).removeClass("disable");
                            }
                        });
                    });
                }

                function materials(idOrder) {
                    $("#idOrder").val(idOrder);
                    $('#bodyMaterials').empty();
                    url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                        $.each(respuestaServer["materials"], function (i, materials) {
                            $('#bodyMaterials').append('<tr><td>' + materials.name_activitie +
                                    '</td><td>' + materials.name_service +
                                    '</td><td>' + materials.count + '</td><td>'
                                    + materials.unit_measurement + '</td></tr>');
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

                function assignPercent(idOrder) {
                    var max = '100';
                    var pay = $("#pay_" + idOrder).val();
                    var dif = max - pay;
                    var percent = $("#percent_" + idOrder).val();
                    if (percent > dif) {
                        alertify.error('No puedes superar el porcentaje maximo a pagar.');
                        return 0;
                    }
                    var cost = $("#costOrder").val();
                    var value = cost / percent;
                    alertify.confirm('En realidad desea pasar la ordén a pagaduria con este porcentaje?', function () {
                        alertify.success('Aceptado');
                        url = get_base_url() + "Audit/assign_percent";
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {idOrder: idOrder, percent: percent, value: value},
                            success: function (resp) {
                                if (resp === "error") {
                                    alertify.error('Error en BBDD');
                                }
                                if (resp === "ok") {
                                    alertify.success('Porcentaje asignado, ordén pasada a pagaduria.');
                                    location.reload();
                                }
                            }
                        });
                    }, function () {
                        alertify.error('Acción cancelada');
                    }).set({labels: {ok: 'Aceptar', cancel: 'Cancelar'}, padding: false});
                }

                function historyPays(idOrder) {
                    $("#historyPays").empty();
                    url = get_base_url() + "Audit/history_assign_percent?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                        $.each(res["pays"], function (i, pay) {
                            $("#historyPays").append("<tr><td>" + pay.dateSave + "</td>" +
                                    "<td>" + pay.percent + "</td>" +
                                    "<td>" + pay.value + "</td>" + "</tr>");
                        });
                    });
                }
            </script>
    </body>
</html>
