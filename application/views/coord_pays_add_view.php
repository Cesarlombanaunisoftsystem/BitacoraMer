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
                                        <li role="presentation"><a href="<?= base_url('Audit/auth_pay') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation" class="active"><a href="<?= base_url('Audit/pays_add') ?>" aria-controls="binnacle" role="tab" data-toggle="">Pagos Adicionales</a></li>
                                        <li role="presentation"><a href="<?= base_url('Audit/pays_process') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">                            
                            <div role="tabpanel" class="tab-pane active" id="paysAdd">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <form>
                                            <table id="data-table" class="table table-striped" style="font-size:12px">
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
                                                        <th style="color: #00B0F0">% Entregado</th>
                                                        <th style="color: #00B0F0">% Autorizado</th>
                                                    </tr>                                   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($paysAdd) && $paysAdd) {
                                                        foreach ($paysAdd as $row) {
                                                            if (isset($row->percentdo)) {
                                                                $pay = $row->percentdo;
                                                            } else {
                                                                $pay = 0;
                                                            }
                                                            ?>                                            
                                                            <tr>
                                                                <td class="details-control" id="<?= $row->id; ?>">
                                                                    <i class="fa fa-plus-square-o"></i>
                                                                </td>
                                                                <td><?= $row->dateSave ?></td>
                                                                <td><a href="<?= base_url('uploads/') . $row->picture ?>" target="ventana" onClick="window.open('', 'ventana', 'width=400,height=400,lef t=100,top=100');"><?= $row->uniquecode . '-' . $row->coi ?></a></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                                <td><?= $row->name_activitie ?></td>
                                                                <td><?= $row->count ?></td>
                                                                <td><?= $row->site ?></td>
                                                                <td><input type="hidden" name="idTech" id="idTech_<?= $row->id ?>" value="<?= $row->idTech ?>"><?= $row->name_user ?></td>                                               
                                                                <td><input type="hidden" id="costOrder" value="<?= $row->totalCost ?>"><?php
                                                                    setlocale(LC_MONETARY, 'es_CO');
                                                                    echo money_format('%.2n', $row->totalCost)
                                                                    ?></td>
                                                                <td onclick="historyPays(<?= $row->id; ?>)" data-toggle="modal" data-target="#modalHistoryPays">
                                                                    <input type="hidden" id="pay_<?= $row->id ?>" value="<?= $pay ?>"><?= $pay ?>%</td>
                                                                <td><input type="number" name="percent" id="percent_<?= $row->id ?>" class="form form-control" min="0" max="100" onchange="assignPercent('<?= $row->id ?>')">
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
                            </div>
                        </div>
                    </div>
                </section>
                <!--/.content -->
            </div>
            <!--/.content-wrapper -->
            <?php $this->load->view('templates/footer.html')
            ?>
        </div>  
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
        <!-- Modal Observaciones-->
        <!-- Modal Historial Pagos-->
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
                        '<td>' +
                        '<a class="disable photos photo' + d + '">REGISTRO FOTOGRAFICO</a>' +
                        '</td><td>' +
                        '<a class="disable pisnm' + d + '">FORMATO PISNM</a>' +
                        '</td><td>' +
                        '<a class="disable tss' + d + '">FORMATO TSS</a>' +
                        '</td><td>' +
                        '<a class="disable das' + d + '">FORMATO DAS</a>' +
                        '</td><td>' +
                        '<a href="#" onclick="materials(' + d + ')" data-toggle="modal" data-target="#modalMaterials">' +
                        'SOLICITUD DE MATERIALES/SERV</a><input type="hidden" value="' + d + '" name="idOrder">' +
                        '</td><td>' +
                        '<a href="#" onclick="getObservations(' + d + ')" data-toggle="modal" data-target="#modalObservations">' +
                        'OBSERVACIONES GENERALES</a></td></tr>' +
                        '<tr><td>FECHA DE REGISTRO:<p></p></td>' + '<td><u><label id="fecha_2_' + d + '"></u></label></td>' +
                        '<td>' +
                        '<a class="disable design' + d + '">DISEÑO</a>' +
                        '</tr></table>';
            }
            function getDocs(idOrder) {
                url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["docs"], function (i, doc) {
                        $("#fecha_" + idOrder).html(doc.dateSave);
                        $("#fecha_2_" + idOrder).html(doc.dateSave);
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

            function materials(idOrder) {
                $("#idOrder").val(idOrder);
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
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $("#obsv").html(res.observation.observations);
                });
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

            function assignPercent(idOrder) {
                var max = '100';
                var pay = $("#pay_" + idOrder).val();
                var dif = max - pay;
                var percent = $("#percent_" + idOrder).val();
                var idTech = $("#idTech_" + idOrder).val();
                if (percent > dif) {
                    alertify.error('No puedes superar el porcentaje maximo a pagar.');
                    return 0;
                }
                var cost = $("#costOrder").val();
                var value = (cost * percent) / 100;
                url = get_base_url() + "Audit/assign_percent";
                $.confirm({
                    title: 'Confirma asignar este porcentaje?',
                    content: 'Pasará a pagaduria!',
                    buttons: {
                        confirmar: function () {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {idOrder: idOrder, idTech: idTech, percent: percent, value: value},
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
                        },
                        cancelar: function () {
                            $.alert('Cancelado!');
                            $("#percent_" + idOrder).val("");
                        }
                    }
                });
            }
        </script>
    </body>
</html>

