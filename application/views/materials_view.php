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
                                        <li role="presentation"><a href="#pagosges" aria-controls="binnacle" role="tab" data-toggle="tab">Registros Procesados</a></li>
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
                                            <label class="radio-inline" style="color: #00B0F0;"><input type="radio" id="chk1">
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
                                                <option value="1">Bogota</option>
                                                <option value="2">Cali</option>
                                            </select>
                                        </div> 
                                        <br><br>
                                        <form>
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
                                                        <button id="btnAplicar" type="button" class="form-control btn btn-default color-blue" onclick="register();">REGISTRAR</button>
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
                                                            <td><a href="#" onclick="verOrden(<?= $row->id?>);">
                                                                    <u><?= $row->uniquecode ?></u><input type="hidden" id="norder_<?= $row->id?>" value="<?= $row->uniquecode?>"></a></td>
                                                                    <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccost_<?= $row->id?>" value="<?= $row->uniqueCodeCentralCost?>"></td>
                                                                    <td><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->id?>" value="<?= $row->name_activitie?>"></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?><input type="hidden" id="tech_<?= $row->id?>" value="<?= $row->name_user ?>"></td>
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
                            <div role="tabpanel" class="tab-pane" id="pagosges">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/materiales.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table id="table-paysges" class="table table-striped">
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
                                                    <td>ASIGNACION</td>
                                                    <td><?= $row->dateSave ?></td>
                                                    <td><?= $row->uniquecode ?></td>
                                                    <td><?= $row->uniqueCodeCentralCost ?></td>
                                                    <td><?= $row->name_activitie ?></td>
                                                    <td><?= $row->count ?></td>
                                                    <td><?= $row->site ?></td>
                                                    <td><?= $row->name_user ?></td>
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

        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            $(function () {
                $("#divOrder").hide();
                if ($("#chk1").prop("checked") === false && $("#chk2").prop("checked") === false) {
                    $("#selectasign").hide();
                    $(".bodega").hide();
                }
                if($("#selectasign").val()!==""){
                    var valor = $("#selectasign").val();
                    $("#selBodega").val(valor);
                }
            });
            
            $("#chk1").click(function () {
                $("#chk2").prop("checked", false);
                $("#selectasign").hide();
                $(".bodega").show();
            });

            $("#chk2").click(function () {
                $("#chk1").prop("checked", false);
                $("#selectasign").show();
                $(".bodega").hide();
            });

            function verOrden(idOrder) {
                $("#divOrder").show();
                $("#table1").hide();
                $('#bodyMaterials').empty();
                var order = $("#norder_"+idOrder).val();
                var ccost = $("#ccost_"+idOrder).val();
                var activ = $("#activ_"+idOrder).val();
                var tech = $("#tech_"+idOrder).val();
                $("#lblOrder").html(order);
                $("#lblActiv").html(activ);
                $("#lblcCost").html(ccost);
                $("#lblTech").html(tech);
                url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#bodyMaterials').append('<tr><td>' + materials.name_service +
                                '</td><td>' + materials.count +
                                '</td><td>' + materials.unit_measurement + '</td><td>'
                                + materials.observation + '</td>' +
                                '<td class="bodega"><select class="form-control" name="selBodega_'+materials.id+'" id="selBodega"></select></td></tr>');
                    });
                });
            }

            function aplicar() {
                url = get_base_url() + "Audit/pdf_pays";
                var a = document.createElement('a');
                a.href = url;
                a.target = '_blank';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                alertify.success('Pagos realizados exitosamente.');
                alertify.success('PDF generado exitosamente');
                location.reload();
            }

            function register() {
                alertify.success('Registro de material exitoso.');
                location.reload();
            }
        </script>
    </body>
</html>
