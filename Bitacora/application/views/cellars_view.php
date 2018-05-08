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
                    
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Materials') . $link ?>"><i class="fa fa-refresh"></i></a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/materiales.png') ?>" style="width: 120px;">
                                    </div>
                                <div class="col-xs-10 nav-tabs-custom">
                                    <h1>
                                        <?= $titulo ?>
                                    </h1>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="<?= base_url('Materials/') . $link ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Materials/') . $link2 ?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row" id="table1">
                                    
                                    <div id="divCellar" hidden=""><?= $cellar ?></div>                                    
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
                                        <table  id="data-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Proceso</th>
                                                    <th style="color: #00B0F0">Fecha de Ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Técnico</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($materials) && $materials) {
                                                    foreach ($materials as $row) {
                                                        if ($row->stateMaterial === '1') {
                                                            $color = "";
                                                            $proces = 'ASIGNACIÓN';
                                                        }
                                                        if ($row->stateMaterial === '2') {
                                                            $color = "";
                                                            $proces = 'DEVOLUCIÓN';
                                                        }
                                                        if ($row->stateMaterial === '3') {
                                                            $color = "#FEAE4E";
                                                            $proces = 'DEVOLUCIÓN';
                                                        }
                                                        if ($row->stateMaterial === '4') {
                                                            $color = "";
                                                            $proces = 'ASIGNACIÓN';
                                                        }
                                                        ?>                                            
                                                        <tr>
                                                            <td><?= $proces ?></td>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><a href="#" onclick="verOrden(<?= $row->idOrder ?>,<?= $row->stateMaterial ?>);">
                                                                    <u><?= $row->uniquecode . '-' . $row->coi ?></u><input type="hidden" id="norder_<?= $row->idOrder ?>" value="<?= $row->uniquecode ?>"></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccost_<?= $row->idOrder ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                            <td><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->idOrder ?>" value="<?= $row->name_activitie ?>"></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?><input type="hidden" id="tech_<?= $row->idOrder ?>" value="<?= $row->name_user ?>"></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
                                            </tbody>
                                        </table>
                                    </div>                                        
                                </div>
                                <div id="divOrder" class="row" style="display: none">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <table>
                                                <tr>
                                                    <td>No. ORDEN: <label id="lblOrder"></label></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <table>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Centro de Costos |</td>
                                                    <td>&nbsp;<label id="lblcCost"></label></td>
                                                </tr>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Actividad &nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;|</td>
                                                    <td>&nbsp;<label id="lblActiv"></label></td>
                                                </tr>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Técnico &nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;|</td>
                                                    <td>&nbsp;<label id="lblTech"></label></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <br><br>
                                        <table class="table table-striped" style="font-size: 12px">
                                            <thead>
                                                <tr>
                                                    <td style="color: #00B0F0">Proceso</td>
                                                    <td style="color: #00B0F0">| Descripción</td>
                                                    <td style="color: #00B0F0">| Cantidad</td>
                                                    <td style="color: #00B0F0" class="cantDev" hidden="">| Cantidad Devolución</td>
                                                    <td style="color: #00B0F0">| Unidad de medida</td>
                                                    <td style="color: #00B0F0">| Observaciones</td>
                                                    <td style="color: #00B0F0" class="pend">| Pendiente</td>
                                                    <td style="color: #00B0F0" class="cantDev" hidden="">| Recibir</td>
                                                </tr>                                   
                                            </thead>
                                            <tbody id="bodyMaterials">
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <div class="row">                                                
                                            <div class="col-sm-12">
                                                <div class="col-sm-8"></div>
                                                <div class="col-sm-4">
                                                    <button id="btnIn" type="button" class="form-control btn btn-default color-blue" onclick="register_x_order();"><b>ENTREGAR</b></button>
                                                    <button id="btnReg" type="button" class="form-control btn btn-success" onclick="register_materials_back();"><b>REGISTRAR</b></button>
                                                </div>
                                            </div>
                                        </div>
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

        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            function verOrden(idOrder, process) {
                $("#divOrder").show();
                $("#table1").hide();
                $('#bodyMaterials').empty();
                var order = $("#norder_" + idOrder).val();
                var ccost = $("#ccost_" + idOrder).val();
                var activ = $("#activ_" + idOrder).val();
                var tech = $("#tech_" + idOrder).val();
                var check = "";
                $("#lblOrder").html(order);
                $("#lblActiv").html(activ);
                $("#lblcCost").html(ccost);
                $("#lblTech").html(tech);
                var stateCellar = "";
                var cellar = $('#divCellar').html(); // Tipo de bodega

                if (process === 1) {
                    process = 'ASIGNACIÓN';
                    $(".pend").show();
                    $("#btnIn").show();
                    $(".cantDev").hide();
                    $("#btnReg").hide();
                    url = get_base_url() + "Orders/get_order_materials_cellar?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder, cellar: cellar}).done(function (respuestaServer) {
                        $.each(respuestaServer["materials"], function (i, materials) {
                            stateCellar = materials.idStateCellar;
                            if (stateCellar === '0') {
                                check = '<input type="checkbox" checked onclick="register(' + materials.id + ')">';
                            }
                            if (stateCellar === '1') {
                                check = '<input type="checkbox" onclick="unregister(' + materials.id + ')">';
                            }

                            $('#bodyMaterials').append('<tr><td>' + process + '</td><td>' + materials.name_service +
                                    '</td><td>' + materials.count + '</td><td>' + materials.unit_measurement + '</td><td>'
                                    + materials.observation + '</td>' +
                                    '<td>' + check + '</td></tr>');
                        });
                    });
                } else if (process === 2) {
                    process = 'DEVOLUCIÓN';
                    $(".cantDev").show();
                    $("#btnReg").show();
                    $(".pend").hide();
                    $("#btnIn").hide();
                    url = get_base_url() + "Orders/get_order_materials_cellar_back?jsoncallback=?";
                    $.getJSON(url, {idOrder: idOrder, cellar: cellar}).done(function (respuestaServer) {
                        $.each(respuestaServer["materials"], function (i, materials) {
                            stateCellar = materials.stateBack;
                            if (stateCellar === '0') {
                                check = '<input type="checkbox" onclick="registerMaterialBack(' + materials.idBack + ',' + materials.id + ')">';
                            }

                            if (stateCellar === '1') {
                                check = '<input type="checkbox" checked onclick="unregisterMaterialBack(' + materials.idBack + ',' + materials.id + ')">';
                            }

                            $('#bodyMaterials').append('<tr><td>' + process + '</td><td>' + materials.name_service +
                                    '</td><td>' + materials.count + '</td><td class="cantDev">' + materials.count_back +
                                    '</td><td>' + materials.unit_measurement + '</td><td>'
                                    + materials.observation + '</td>' +
                                    '<td>' + check + '</td></tr>');
                        });
                    });
                }

            }
            function registerMaterialBack(id, idDetail) {
                url = get_base_url() + "Materials/register_back";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id: id, idDetail: idDetail},
                    success: function (resp) {
                        console.log(resp);
                    }
                });
            }

            function unregisterMaterialBack(id, idDetail) {
                url = get_base_url() + "Materials/unregister_back";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id: id, idDetail: idDetail},
                    success: function (resp) {
                        console.log(resp);
                    }
                });
            }

            function register(id) {
                url = get_base_url() + "Materials/assign_state";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id: id, state: 1},
                    success: function (resp) {
                        console.log(resp);
                    }
                });
            }

            function unregister(id) {
                url = get_base_url() + "Materials/assign_state";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id: id, state: 0},
                    success: function (resp) {
                        console.log(resp);
                    }
                });
            }

            function register_x_order() {
                url = get_base_url() + "Materials/assign_materials_x_order";
                var idOrder = $("#lblcCost").html();
                var state = <?= $state ?>;
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder, state: state},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Orden de entrega de materiales generada exitosamente');
                            location.reload();
                            generatePdf(idOrder);
                        }
                    }
                });
            }

            function register_materials_back() {
                url = get_base_url() + "Materials/register_materials_back";
                var idOrder = $("#lblcCost").html();
                var state = <?= $state ?>;
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder, state: state},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Devolución registrada exitosamente');
                            location.reload();
                        }
                    }
                });
            }

            function register_x_order_process() {
                var idOrder = $("#lblcCostProcess").html();
                alertify.success('Orden de entrega de materiales generada exitosamente');
                location.reload();
                generatePdf(idOrder);
            }

            function generatePdf(idOrder) {
                var cellar = $('#divCellar').html(); // Tipo de bodega
                url = get_base_url() + "Materials/pdf_order_materials/" + idOrder + "/" + cellar;
                var a = document.createElement('a');
                a.href = url;
                a.target = '_blank';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                alertify.success('Orden de mercancia generada exitosamente.');
            }
        </script>
    </body>
</html>
