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
                        <li><a href="<?= base_url('Materials') ?>"><i class="fa fa-dashboard"></i> Volver</a></li>
                        <li class="active"></li>
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
                                        <li role="presentation"><a href="#regprocess" aria-controls="binnacle" role="tab" data-toggle="tab">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/materiales.png') ?>" style="width: 120px;">
                                    </div>

                                    <div id="divOrder" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
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
                                        <br><br><br>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <label class="radio-inline" style="color: #00B0F0;"><input type="radio" id="chk1" checked>
                                                Asignación de Bodega por producto
                                            </label>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <label class="radio-inline" style="color: #00B0F0;"><input type="radio" id="chk2">
                                                Asignación de Bodega por Ordén
                                            </label>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                            <select id="selectasign" class="form-control">
                                                <option></option>
                                                <?php
                                                if (isset($cellars) && $cellars) {
                                                    foreach ($cellars as $cellar) {
                                                        ?>
                                                        <option value="<?= $cellar->id ?>"><?= $cellar->name_cellar ?></option>
                                                        }
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                        <br><br>
                                        <form id="frmCellar" action="javascript:register_x_order();" method="post">
                                            <table class="table table-striped" style="font-size: 12px">
                                                <thead>
                                                    <tr>
                                                        <td style="color: #00B0F0">Descripción</td>
                                                        <td style="color: #00B0F0">| Cantidad</td>
                                                        <td style="color: #00B0F0">| Unidad de medida</td>
                                                        <td style="color: #00B0F0">| Observaciones</td>
                                                        <td class="bodega" style="color: #00B0F0">| Bodega</td>
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
                                                        <button id="btnAplicar" type="submit" class="form-control btn btn-default color-blue">REGISTRAR</button>
                                                        <button id="btnAplicarProduct" type="button" class="form-control btn btn-default color-blue" onclick="confirmAssignProducts();">REGISTRAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="table1" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
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
                                                        ?>                                            
                                                        <tr>
                                                            <td>ASIGNACION</td>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><a href="#" onclick="verOrden(<?= $row->id ?>);">
                                                                    <u><?= $row->uniquecode . '-' . $row->coi ?></u><input type="hidden" id="norder_<?= $row->id ?>" value="<?= $row->uniquecode . '-' . $row->coi ?>"></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccost_<?= $row->id ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                            <td><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->id ?>" value="<?= $row->name_activitie ?>"></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?><input type="hidden" id="tech_<?= $row->id ?>" value="<?= $row->name_user ?>"></td>
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
                            <div role="tabpanel" class="tab-pane" id="regprocess">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/materiales.png') ?>" style="width: 120px;">
                                    </div>
                                    <div id="tableProcess" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table id="table-regprocess" class="table table-striped">
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
                                                        ?>
                                                        <tr>
                                                            <td>ASIGNACION</td>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><a href="#" onclick="verOrdenProcess(<?= $row->id ?>);">
                                                                    <u><?= $row->uniquecode . '-' . $row->coi ?></u><input type="hidden" id="norderProcess_<?= $row->id ?>" value="<?= $row->uniquecode . '-' . $row->coi ?>"></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccostProcess_<?= $row->id ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                            <td><?= $row->name_activitie ?><input type="hidden" id="activProcess_<?= $row->id ?>" value="<?= $row->name_activitie ?>"></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?><input type="hidden" id="techProcess_<?= $row->id ?>" value="<?= $row->name_user ?>"></td>
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
                                                    <td>&nbsp;&nbsp;<i class="fa fa-file-pdf-o fa-2x" style="color: red" id="pdf" onclick="generatePdf();"></i></td>
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
                                                    <td style="color: #00B0F0">| Bodega</td>
                                                </tr>                                   
                                            </thead>
                                            <tbody id="bodyMaterialsProcess">                                                                      
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

        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            $(function () {
                $("#selectasign").hide();
                $(".bodega").hide();
                $("#divOrder").hide();
                $("#divOrderProcess").hide();
                if ($("#chk1").prop("checked") === false && $("#chk2").prop("checked") === false) {
                    $("#selectasign").hide();
                    $(".bodega").hide();
                }
                $("#selectasign").change(function () {
                    var valor = $("#selectasign").val();
                    $(".selcellar").val(valor);
                });
                $("#btnAplicar").hide();
                $("#btnAplicarProduct").hide();
                $('#table-regprocess').DataTable({
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });

            $("#chk1").click(function () {
                $("#chk2").prop("checked", false);
                $("#selectasign").hide();
                $("#btnAplicar").hide();
                $("#btnAplicarProduct").show();
                $(".bodega").show();
            });

            $("#chk2").click(function () {
                $("#chk1").prop("checked", false);
                $("#selectasign").show();
                $("#btnAplicar").show();
                $("#btnAplicarProduct").hide();
                $(".bodega").hide();
            });

            function verOrden(idOrder) {
                $("#divOrder").show();
                $("#table1").hide();
                $('#bodyMaterials').empty();
                var order = $("#norder_" + idOrder).val();
                var ccost = $("#ccost_" + idOrder).val();
                var activ = $("#activ_" + idOrder).val();
                var tech = $("#tech_" + idOrder).val();
                $("#lblOrder").html(order);
                $("#lblActiv").html(activ);
                $("#lblcCost").html(ccost);
                $("#lblTech").html(tech);
                url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#bodyMaterials').append('<tr><td>' + '<input type="hidden" value=' + materials.id + ' name="id_' + materials.id + '"><input type="hidden" value=' + materials.idOrder + ' name="idOrder" id="idOrder">' + materials.name_service +
                                '</td><td>' + materials.count +
                                '</td><td>' + materials.unit_measurement + '</td><td>'
                                + materials.observation + '</td>' +
                                '<td class="bodega"><select class="selcellar form-control" name="selcellar" id="selcellar_' + materials.id + '" onchange="register_x_product(' + materials.id + ')" required><option></option></select></td></tr>');
                    });
                    $.each(respuestaServer["cellars"], function (i, cellars) {
                        $('.selcellar').append('<option value=' + cellars.id + '>' + cellars.name_cellar + '</option>');
                    });
                });
            }

            function verOrdenProcess(idOrder) {
                $("#divOrderProcess").show();
                $("#tableProcess").hide();
                $('#bodyMaterialsProcess').empty();
                var order = $("#norderProcess_" + idOrder).val();
                var ccost = $("#ccostProcess_" + idOrder).val();
                var activ = $("#activProcess_" + idOrder).val();
                var tech = $("#techProcess_" + idOrder).val();
                $("#lblOrderProcess").html(order);
                $("#lblActivProcess").html(activ);
                $("#lblcCostProcess").html(ccost);
                $("#lblTechProcess").html(tech);
                url = get_base_url() + "Materials/get_materials_cellar?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#bodyMaterialsProcess').append('<tr><td>' + '<input type="hidden" value=' + materials.id + ' name="id_' + materials.id + '"><input type="hidden" value=' + materials.idOrder + ' name="idOrder" id="idOrder">' + materials.name_service +
                                '</td><td>' + materials.count +
                                '</td><td>' + materials.unit_measurement + '</td><td>'
                                + materials.observation + '</td>' +
                                '<td>' + materials.name_cellar + '</td></tr>');
                    });
                });
            }

            function register_x_product(id) {
                var idOrder = $("#idOrder").val();
                var idCellar = $("#selcellar_" + id).val();
                url = get_base_url() + "Materials/assign";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id: id, idOrder: idOrder, idCellar: idCellar},
                    success: function (resp) {
                        console.log(resp);
                    }
                });
            }
            function register_x_order() {
                url = get_base_url() + "Materials/assign_x_order";
                $.ajax({
                    url: url,
                    type: $("#frmCellar").attr("method"),
                    data: $("#frmCellar").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Materiales asignados a bodega exitosamente');
                            location.href = get_base_url() + "Materials";
                        }
                    }
                });
            }

            function confirmAssignProducts() {
                alertify.success('Materiales asignados a bodega exitosamente');
                location.href = get_base_url() + "Materials";
            }

            function generatePdf() {
                var ccost = $("#lblcCostProcess").html();
                url = get_base_url() + "Materials/pdf_materials_sql/" + ccost;
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
