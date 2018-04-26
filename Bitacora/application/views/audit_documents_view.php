<html>
    <head>
        <?php $this->load->view('templates/head') ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
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
                        <li><a href="<?= base_url('Documents/audit') ?>"><i class="fa fa-refresh"></i></a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="<?= base_url('Documents/audit') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Documents/audit_process') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registro de Actividad</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div id="spinner"></div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/docs.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table id="data-table" class="table table-striped" style="font-size: 12px">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Fecha de Asignación</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>
                                                    <th style="color: #00B0F0">Servicio</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Observaciones</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($orders) && $orders) {
                                                    foreach ($orders as $row) {
                                                        if ($row->historybackState === '1') {
                                                            $trcolor = '#FCF8E5';
                                                        } else {
                                                            $trcolor = '';
                                                        }
                                                        ?>                                            
                                                        <tr style="background-color:<?= $trcolor ?>">
                                                            <td><?= $row->dateAssign ?></td>
                                                            <td><a href="#" onclick="verPanelInferior(<?= $row->id ?>);"><input type="hidden" id="norder_<?= $row->id ?>" value="<?= $row->uniquecode . '-' . $row->coi ?>"><u><?= $row->uniquecode . '-' . $row->coi ?></u></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccost_<?= $row->id ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                            <td><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->id ?>" value="<?= $row->name_activitie ?>"></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?><input type="hidden" id="site_<?= $row->id ?>" value="<?= $row->site ?>"></td>                                                
                                                            <td><?= $row->observations ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                      
                                            </tbody>
                                        </table>
                                        <div id="panelinfo" style="display:none">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <table>
                                                    <tr>
                                                        <td>No. ORDEN: <label id="lblOrder"></label></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <table>
                                                    <tr style="font-size: 12px;">
                                                        <td style="color: #00B0F0">| Centro de Costos |</td>
                                                        <td>&nbsp;
                                                            <label id="lblCost"></label>
                                                            <input type="hidden" name="idOrderDaily" id="lblcCost">
                                                            <input type="hidden" name="uniquecode" id="uniquecode">
                                                            <input type="hidden" name="attendant" id="attendant">                                                            
                                                        </td>
                                                    </tr>
                                                    <tr style="font-size: 12px;">
                                                        <td style="color: #00B0F0">| Actividad &nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;|</td>
                                                        <td>&nbsp;<label id="lblActiv"></label></td>
                                                    </tr>
                                                    <tr style="font-size: 12px;">
                                                        <td style="color: #00B0F0">| Sitio &nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;|</td>
                                                        <td>&nbsp;<label id="lblSite"></label></td>
                                                    </tr>
                                                </table><br><br>                                            
                                            </div>
                                            <div id="documents">
                                                <div class="col-sm-4" id="tree" style="display: block;overflow:auto;width:255px;height: 300px;border: 2px;border-style: solid;border-color: gainsboro">                                                    
                                                    <ul>
                                                        <li id="liorder">

                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-1"></div>
                                                <div id="display" class="col-sm-7" style="display: block;overflow:auto;width:700PX;height: 300px;border: 2px;border-style: solid;border-color: gainsboro;background-color: #D0D0D0;"></div>                                                
                                                <div class="col-sm-12">
                                                    <h3>Observaciones del proceso</h3>
                                                    <textarea class="form-control" id="obsv"></textarea><br><br>                                                 
                                                </div>                                                
                                                <div class="col-sm-12">
                                                    <div class="col-sm-7"><a href="#" onclick="rejectDocs()"><u style="color:blue">RECHAZO PROCESO DE DOCUMENTACIÓN</u></a></div>
                                                    <div class="col-sm-5">
                                                        <button type="button" id="btnAcept" class="btn btn-success" onclick="aceptDocs()">ACEPTACIÓN DE DOCUMENTACIÓN COMPLETA</button>
                                                    </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
        <script type="text/javascript">

                                                            function verPanelInferior(idOrder) {
                                                                $("#data-table").hide();
                                                                $("#panelinfo").show();
                                                                var order = $("#norder_" + idOrder).val();
                                                                var ccost = $("#ccost_" + idOrder).val();
                                                                var activ = $("#activ_" + idOrder).val();
                                                                var site = $("#site_" + idOrder).val();
                                                                $("#lblOrder").html(order);
                                                                $("#lblActiv").html(activ);
                                                                $("#lblCost").html(ccost);
                                                                $("#lblcCost").val(ccost);
                                                                $("#uniquecode").val(order);
                                                                $("#lblSite").html(site);
                                                                getDocuments();
                                                            }

                                                            function getDocuments() {
                                                                $("#liorder").empty();
                                                                var idOrder = $("#lblcCost").val();
                                                                var order = $("#uniquecode").val();
                                                                $("#idOrderDoc").val(idOrder);
                                                                var url = get_base_url() + "Orders/get_services_order?jsoncallback=?";
                                                                var url2 = get_base_url() + "Services/get_model_tree?jsoncallback=?";

                                                                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                                                                    $.each(res["serv"], function (i, serv) {
                                                                        $.getJSON(url2, {idService: serv.idServices}).done(function (resp) {
                                                                            $("#liorder").html(order + "<ul><li>" + resp.serv.name_service + resp.serv.model_tree + "</li></ul>");
                                                                            $('#tree').on('changed.jstree', function (e, data) {
                                                                                var sel = data.instance.get_path(data.selected);
                                                                                getContent(sel);
                                                                            }).jstree();
                                                                        });

                                                                    });
                                                                });
                                                            }

                                                            function getContent(filesel) {
                                                                var idOrder = $("#lblcCost").val();
                                                                $("#display").html('');
                                                                $("#files").prop('disabled', false);
                                                                $("#btnSubmitDocs").prop('disabled', false);
                                                                $("#obsvdocs").prop('disabled', false);
                                                                $("#filesel").val(filesel);
                                                                $.get(get_base_url() + "Projects/content", {filesel: filesel}).done(function (response) {
                                                                    $("#display").html(response);
                                                                });
                                                                getObsvDocCenter(idOrder);
                                                            }

                                                            function aceptDocs() {
                                                                var idOrder = $("#lblcCost").val();
                                                                var obsv = $("#obsv").val();
                                                                var url = get_base_url() + "Documents/assign";
                                                                $.ajax({
                                                                    url: url,
                                                                    type: "post",
                                                                    data: {idOrder: idOrder, state: 25, obsv: obsv}
                                                                }).done(function (res) {
                                                                    if (res === "error") {
                                                                        $.alert('Error en BBDD');
                                                                    }
                                                                    if (res === "ok") {
                                                                        $.alert('Documentos aceptados exitosamente.');
                                                                        location.reload();
                                                                    }

                                                                });
                                                            }

                                                            function rejectDocs() {
                                                                var idOrder = $("#lblcCost").val();
                                                                var obsv = $("#obsv").val();
                                                                var url = get_base_url() + "Documents/return_order";
                                                                $.ajax({
                                                                    url: url,
                                                                    type: "post",
                                                                    data: {idOrder: idOrder, state: 23, obsv: obsv}
                                                                }).done(function (res) {
                                                                    if (res === "error") {
                                                                        $.alert('Error en BBDD');
                                                                    }
                                                                    if (res === "ok") {
                                                                        $.alert('Proceso rechazado exitosamente.');
                                                                        location.reload();
                                                                    }

                                                                });
                                                            }
        </script>
    </body>
</html>
