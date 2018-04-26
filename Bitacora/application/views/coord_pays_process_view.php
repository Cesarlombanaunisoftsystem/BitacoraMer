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
                <div id="load_menu"></div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                           
                            <table id="data-table" class="table table-striped" style="font-size: 10px">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th style="color: #00B0F0">Fecha de ordén</th>
                                                        <th style="color: #00B0F0">Fecha proceso</th>
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
                                                    if (isset($paysProcess) && $paysProcess) {
                                                        foreach ($paysProcess as $row) {
                                                            if (isset($row->percentdo)) {
                                                                $pay = $row->percentdo;
                                                            } else {
                                                                $pay = 0;
                                                            }
                                                            ?>                                            
                                                            <tr>
                                                                <td class="details-control" id="<?php echo $row->id; ?>">
                                                                    <i class="fa fa-plus-square-o"></i>
                                                                </td>
                                                                <td><?= $row->dateSave ?></td>
                                                                <td><?= $row->dateProcess ?></td>
                                                                <td><a href="<?= base_url('uploads/') . $row->picture ?>"  target="ventana" onClick="window.open('', 'ventana', 'width=400,height=400,lef t=100,top=100');"><?= $row->uniquecode . '-' . $row->coi ?></a></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                                <td><?= $row->name_activitie ?></td>
                                                                <td><?= $row->count ?></td>
                                                                <td><?= $row->site ?></td>
                                                                <td><?= $row->name_user ?></td>
                                                                <td>PRESUPUESTO</td>
                                                                <td><?= $row->observations ?></td>                                                
                                                                <td><input type="hidden" id="costOrder" value="<?= $row->totalCost ?>"><?php
                                                                    setlocale(LC_MONETARY, 'es_CO');
                                                                    echo money_format('%.2n', $row->totalCost)
                                                                    ?></td>
                                                                <td><a href="#" onclick="historyPays(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#modalHistoryPays">
                                                                        <input type="hidden" id="pay_<?= $row->id ?>" value="<?= $pay ?>"><?= $pay ?>%</a></td>
                                                                <td><a href="#" onclick="historyPaysAut(<?php echo $row->id; ?>)" data-toggle="modal" data-target="#modalHistoryPaysAut"><?= $row->percent_pay ?>%</a>
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
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
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
                                 width: 550px;
                                 overflow-y: auto;">
                                <p style="text-align:left;"><img src="<?= base_url('dist/img/logo_mail.png') ?>" alt="logo Mer"><img src="<?= base_url('dist/img/titulo_mail.png') ?>"  height="90px" width="250px" alt="titulo" style="text-align:right"/></p>
                                <p style="text-align:center;"><img src="<?= base_url('dist/img/hr_mail.png') ?>" width="510px" alt="hr"></p>                                
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">Fecha</u>
                                            </th>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">% Pagado</u>
                                            </th>
                                            <th  style="text-align: center;">
                                                <u style="color: blue">Vr. Pagado</u>
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
        <!-- Modal History pagos realizados -->
        <!-- Modal Historial Pagos Autorizados-->
        <div id="modalHistoryPaysAut" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 40%;
                 border-color: blue;
                 border-style: solid;
                 border-radius: 20px;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div style="height: 350px;
                                 width: 550px;
                                 overflow-y: auto;">
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
                                    <tbody id="historyPaysAut" style="text-align: center">

                                    </tbody>
                                </table>
                            </div>                                               
                        </div>
                    </div>
                </div>
            </div>   
        </div>
        <!-- Modal Pagos Autorizados-->
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
                        if (doc.idTypeDocument === "6") {
                            if (doc.idState !== '0') {
                                $(".design" + idOrder).attr("href", get_base_url() + "uploads/" + doc.file);
                                $(".design" + idOrder).attr("target", "_blank");
                                $(".design" + idOrder).removeClass("disable");
                            } else {
                                $(".design" + idOrder).css("color", "red");
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
                $("#obsv").empty();
                url = get_base_url() + "Orders/get_observations_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $.each(res["observations"], function (i, observations) {
                        $("#obsv").append(observations.obsvLog + "<br>");
                    });
                });
            }
            
            function historyPays(idOrder) {
                $("#historyPays").empty();
                url = get_base_url() + "Audit/history_assign_percent?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $.each(res["pays"], function (i, pay) {
                        $("#historyPays").append("<tr><td>" + pay.dateSave + "</td>" +
                                "<td>" + pay.percent + "</td>" +
                                "<td>" + formatNumber(pay.value) + "</td>" + "</tr>");
                    });
                });
            }

            function historyPaysAut(idOrder) {
                $("#historyPaysAut").empty();
                url = get_base_url() + "Audit/history_assign_percent_aut?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $.each(res["pays"], function (i, pay) {
                        $("#historyPaysAut").append("<tr><td>" + pay.dateSave + "</td>" +
                                "<td>" + pay.percent + "</td>" +
                                "<td>" + formatNumber(pay.value) + "</td>" + "</tr>");
                    });
                });
            }

            function formatNumber(num) {
                if (!num || num === 'NaN')
                    return '-';
                if (num === 'Infinity')
                    return '&#x221e;';
                num = num.toString().replace(/\$|\,/g, '');
                if (isNaN(num))
                    num = "0";
                sign = (num === (num = Math.abs(num)));
                num = Math.floor(num * 100 + 0.50000000001);
                num = Math.floor(num / 100).toString();

                for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                    num = num.substring(0, num.length - (4 * i + 3)) + '.' +
                            num.substring(num.length - (4 * i + 3));
                return (((sign) ? '' : '') + '$ ' + num);
            }
            cargar_menu("coordinacion_pay",'Registros procesados');

        </script>
    </body>
</html>

