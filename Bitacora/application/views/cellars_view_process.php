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
                        <li><a href="<?= base_url('Materials/get_materials_cellar_mer_process') . $link ?>"><i class="fa fa-refresh"></i></a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation"><a href="<?= base_url('Materials/').$link ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation" class="active"><a href="<?= base_url('Materials/').$link2 ?>" aria-controls="binnacle" role="tab" data-toggle="">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="regprocess">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/materiales.png') ?>" style="width: 120px;">
                                    </div>
                                    <div id="divCellar" hidden=""><?= $cellar ?></div>
                                    <div id="tableProcess" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table id="data-table" class="table table-striped">
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
                                                if (isset($process) && $process) {
                                                    foreach ($process as $row) {
                                                        if ($row->idStateCellar === '0') {
                                                            $color = "#FEAE4E";
                                                        } else {
                                                            $color = "";
                                                        }
                                                        if ($row->idOrderState > 16 && $row->idOrderState < 25) {
                                                            $proces = 'ASIGNACIÓN';
                                                        } else {
                                                            $proces = 'DEVOLUCIÓN';
                                                        }
                                                        ?>
                                                        <tr style="color: <?= $color ?>">
                                                            <td><?= $proces ?></td>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><a href="#" onclick="verOrdenProcess(<?= $row->idOrder ?>,<?= $row->idOrderState ?>);">
                                                                    <u style="color: <?= $color ?>"><?= $row->uniquecode.'-'.$row->coi ?></u><input type="hidden" id="norderProcess_<?= $row->idOrder ?>" value="<?= $row->uniquecode.'-'.$row->coi ?>"></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccostProcess_<?= $row->idOrder ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                            <td><?= $row->name_activitie ?><input type="hidden" id="activProcess_<?= $row->idOrder ?>" value="<?= $row->name_activitie ?>"></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?><input type="hidden" id="techProcess_<?= $row->idOrder ?>" value="<?= $row->name_user ?>"></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>                                                                                
                                    </div>
                                    <div id="divOrderProcess"  class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <table>
                                                <tr>
                                                    <td>No. ORDEN: <label id="lblOrderProcess"></label></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <table>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Centro de Costos |</td>
                                                    <td>&nbsp;<label id="lblcCostProcess"></label></td>
                                                </tr>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Actividad &nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;|</td>
                                                    <td>&nbsp;<label id="lblActivProcess"></label></td>
                                                </tr>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Técnico &nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;|</td>
                                                    <td>&nbsp;<label id="lblTechProcess"></label></td>
                                                </tr>
                                            </table>
                                        </div><br><br>
                                        <table class="table table-striped" style="font-size: 12px">
                                            <thead>
                                                <tr>
                                                    <td style="color: #00B0F0">Descripción</td>
                                                    <td style="color: #00B0F0">| Cantidad</td>
                                                    <td style="color: #00B0F0">| Unidad de medida</td>
                                                    <td style="color: #00B0F0">| Observaciones</td>
                                                    <td style="color: #00B0F0">| Entregar</td>
                                                </tr>                                   
                                            </thead>
                                            <tbody id="bodyMaterialsProcess">                                                                      
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <div class="row">                                                
                                            <div class="col-sm-12">
                                                <div class="col-sm-8"></div>
                                                <div class="col-sm-4">
                                                    <button type="button" id="btnentregar" class="form-control btn btn-default color-blue" onclick="register_x_order_process();"><b>ENTREGAR</b></button>
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
            $(function () {
                $("#btnIn").hide();
                $("#btnReg").hide();
                $("#divOrder").hide();
                $("#divOrderProcess").hide();
                $("#btnAplicarProduct").hide();
            });

            function verOrdenProcess(idOrder, process) {
                $("#divOrderProcess").show();
                $("#tableProcess").hide();
                $('#bodyMaterialsProcess').empty();
                var cellar = $('#divCellar').html(); // Tipo de bodega
                var order = $("#norderProcess_" + idOrder).val();
                var ccost = $("#ccostProcess_" + idOrder).val();
                var activ = $("#activProcess_" + idOrder).val();
                var tech = $("#techProcess_" + idOrder).val();
                var check = "";
                var color = "";
                $("#lblOrderProcess").html(order);
                $("#lblActivProcess").html(activ);
                $("#lblcCostProcess").html(ccost);
                $("#lblTechProcess").html(tech);
                var stateCellar = "";
                url = get_base_url() + "Materials/get_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder, cellar: cellar}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        stateCellar = materials.idStateCellar;
                        if (stateCellar === '1') {
                            check = '<input type="checkbox" checked onclick="unregister(' + materials.id + ')">';
                            color = '#555555';
                        } else {
                            check = '<input type="checkbox" onclick="register(' + materials.id + ')">';
                            color = '#FEAE4E';
                        }
                        $('#bodyMaterialsProcess').append('<tr style="color: ' + color + '"><td>' +
                                '<input type="hidden" value=' + materials.idOrder +
                                ' name="idOrder" id="idOrder">' + materials.name_service +
                                '</td><td>' + materials.count + '</td><td>' +
                                materials.unit_measurement + '</td><td>'
                                + materials.observation + '</td>' +
                                '<td>' + check + '</td></tr>');
                    });
                });
            }

            function registerMaterialBack(idCellar, id, count_back) {
                url = get_base_url() + "Materials/register_back";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {idCellar: idCellar, id: id, count_back: count_back},
                    success: function (resp) {
                        console.log(resp);
                    }
                });
            }

            function unregisterMaterialBack(idCellar, id) {
                url = get_base_url() + "Materials/unregister_back";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {idCellar: idCellar, id: id},
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

            function register_materials_back() {
                url = get_base_url() + "Materials/register_materials_back";
                var idOrder = $("#lblcCost").html();
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder},
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

