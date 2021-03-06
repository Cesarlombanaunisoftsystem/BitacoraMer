<!DOCTYPE html>
<html lang="es">
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
                <div id="load_menu"></div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">

                        <div id="spinner"></div>
                        <div class="tab-content">                            
                            <div role="tabpanel" class="tab-pane active" id="process">
                                <div class="row" id="panelsup">

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#" style="color: #00B0F0"><b>PROYECTOS</b></a></li>                                            
                                        </ul>
                                        <div style="border:2px solid #c1bdbd;height: 300px; overflow-y: scroll;padding:15px;">
                                            <table id="data-table" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <td style="color: #00B0F0">Fecha de asignación</td>
                                                        <td style="color: #00B0F0">No. Ordén</td>
                                                        <td style="color: #00B0F0">Centro de Costos</td>
                                                        <td style="color: #00B0F0">Actividad</td>
                                                        <td style="color: #00B0F0">Servicio</td>
                                                        <td style="color: #00B0F0">Cantidad</td>
                                                        <td style="color: #00B0F0">Sitio</td>
                                                        <td style="color: #00B0F0">Gestión</td>
                                                    </tr>                                   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($registers) && $registers) {
                                                        foreach ($registers as $row) {
                                                            ?>                                            
                                                            <tr>
                                                                <td><?= $row->dateAssign ?></td>
                                                                <td><a href="#" onclick="getPanelBotton(<?= $row->id ?>);"><?= $row->uniquecode . '-' . $row->coi ?><input type="hidden" id="norder_<?= $row->id ?>" value="<?= $row->uniquecode . '-' . $row->coi ?>"></a></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccost_<?= $row->id ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                                <td><a href="#" data-toggle="modal" data-target="#modalActivities" onclick="getActivities(<?= $row->id ?>)"><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->id ?>" value="<?= $row->name_activitie ?>"></a></td>
                                                                <td><?= $row->name_service ?></td>
                                                                <td><?= $row->count ?></td>
                                                                <td><?= $row->site ?><input type="hidden" id="site_<?= $row->id ?>" value="<?= $row->site ?>"></td>                                                
                                                                <td><div class="progress">
                                                                        <div class="progress-bar progress-bar-warning" style="width: <?= $row->gestion ?>%">
                                                                            <?= $row->gestion ?>%
                                                                        </div>
                                                                    </div>
                                                                </td>
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
                                <div class="row" id="panelinferior" hidden="">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1 container">
                                        <ul class="nav nav-tabs">
                                            <li class="active" id="ligestion"><a data-toggle="tab" href="#management" style="color: #00B0F0"><b>GESTIÓN</b> <i class="fa fa-plus-circle fa-2x" style="cursor: pointer;" onclick="management()" style="color: #00B0F0"></i></a>  </li>
                                            <li id="lidoc"><a data-toggle="tab" href="#documents" style="color: #00B0F0"><b>DOCUMENTACIÓN</b></a></li>
                                            <li id="lidoc"><a data-toggle="tab" href="#app" style="color: #00B0F0"><b>MATERIALES</b></a></li>

                                        </ul>
                                        <div class="tab-content">
                                            <div id="management" class="tab-pane fade in active">
                                                <table id="tblgestion" class="table table-striped" style="font-size:12pt">
                                                    <thead>
                                                        <tr>
                                                            <td style="color: #00B0F0">Fecha de Gestión</td>
                                                            <td style="color: #00B0F0">Tipo de Gestión</td>
                                                            <td style="color: #00B0F0">Avance Ejecución</td>
                                                            <td style="color: #00B0F0">Consumo de Materiales</td>
                                                            <td style="color: #00B0F0">Gestión</td>
                                                        </tr>                                   
                                                    </thead>
                                                    <tbody id="bodyPanelGestion">  
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="documents" class="tab-pane fade">

                                                <div class="col-sm-4" id="tree" style="display: block;overflow:auto;width:255px;height: 300px;border: 2px;border-style: solid;border-color: gainsboro">                                                    
                                                    <ul>
                                                        <li id="liorder">

                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-1"></div>
                                                <div id="display" class="col-sm-7" style="display: block;overflow:auto;width:700PX;height: 250px;border: 2px;border-style: solid;border-color: gainsboro;background-color: #D0D0D0;"></div>
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-7" style="width:700PX;height: 50px;border: 1px;border-style: solid;border-color: gainsboro">
                                                    <form id="frmUploadDocuments" enctype="multipart/form-data">
                                                        <div class="col-sm-5"><input type="text" id="obsvdocs" name="obsvdocs" class="form-control" placeholder="Observaciones" disabled></div>
                                                        <div class="col-sm-1">
                                                            <label class="control-label" for="files"><div style="background-color: #777;border-radius: 50%;width: 40px;height: 40px;"><img src="<?= base_url('dist/img/clip.png') ?>" style="width: 25px;margin-top: 10px;margin-right: 1px;margin-left: 7px;"></div></label>   
                                                            <p id="datofile"></p>
                                                            <input type="file"  name="files[]" id="files" style="display: none" onchange="getFileName(this)" accept="*" size="2048" multiple disabled>                                                            
                                                            <input type="hidden" id="idOrderDoc" name="idOrder">
                                                            <input type="hidden" id="filesel" name="filesel">
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="submit" id="btnSubmitDocs" class="btn btn-default" disabled>SUBIR ARCHIVOS</button>
                                                        </div>
                                                    </form>                                                    
                                                </div>
                                                <div class="col-sm-12">
                                                    <h3>VISUALIZADOR DE EVENTOS</h3>
                                                    <table class="table table-bordered" style="display: block;height:140px;width: 950px;overflow:auto;">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Detalles</th>
                                                                <th>Usuario</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tblevents">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>    
                                            <div id="app" class="tab-pane fade">
                                                <div class="col-md-12 col-sm-12 col-lg-12" style="padding: 15px;">
                                                    <p id="material_paking"><a href="http://www.bitacoramer.unisoftsystem.com.co/uploads/221.pdf" target="_blank"><i class="fa fa-file-pdf-o fa-2x"></i> Verificar Packing List</a></p>
                                                    <br>
                                                    <p><a><i class="fa fa-camera fa-2x"></i> Fotografias</a></p>
                                                    <div class="col-md-12 col-sm-12 col-lg-12" id="material_photos">

                                                    </div>
                                                    <br>
                                                    <br>
                                                    <p><strong><a><i class="fa fa-search fa-2x"></i> Observaciones de la orden: </a></strong></p><p id="material_obser"></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="gestiondeavance" hidden="">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li><a href="#" style="color: white">.</a></li>
                                            <li class="active">
                                                <a href="#" style="color: #00B0F0">
                                                    <b>GESTIÓN DE AVANCE</b></a></li>
                                            <li><a href="#" style="color: white">.</a></li>
                                        </ul>
                                        <br><br>
                                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <table>
                                                <tr>
                                                    <td>No. ORDEN: <label id="lblOrder"></label></td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                        <form id="frmRegisterDaily" enctype="multipart/form-data">
                                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
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
                                                </table>                                            
                                            </div>
                                            <br>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <p style="color: #00B0F0">TIPO DE GESTIÓN</p>
                                                </div>
                                                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                    <select class="form form-control" name="typegest" id="typegest">
                                                        <?php foreach ($types as $value) { ?>
                                                            <option value="<?= $value->id ?>"><?= $value->type ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="divdetailgest">
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <p style="color: #00B0F0">DETALLE DE GESTIÓN</p>
                                                </div>                                            
                                                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                    <textarea class="form form-control" name="detailgest" id="detailgest" required="">                                                        
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="divExecute">
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <p style="color: #00B0F0">% AVANCE EJECUCIÓN</p>
                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div class="progress">
                                                        <div id="percentexe" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%">

                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="valpercentexe" id="valpercentexe">
                                                </div>
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">                                                
                                                    <i class="fa fa-sort-up" onclick="upexe();"></i><i class="fa fa-sort-down" onclick="downexe();"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="divMaterials">
                                                    <p style="color: #00B0F0">% CONSUMO DE MATERIALES</p>
                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" id="divMaterials2">
                                                    <div class="progress">
                                                        <div id="percentmat" class="progress-bar progress-bar-warning" style="width: 0%"> 
                                                            0%
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="valpercentmat" id="valpercentmat">
                                                </div>
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" id="divMaterials3">                                                
                                                    <i class="fa fa-sort-up" onclick="upmat();"></i><i class="fa fa-sort-down" onclick="downmat();"></i>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="divadjimg">
                                                    <label for="userfile"><img src="<?= base_url('dist/img/camera.png') ?>">
                                                        ADJUNTAR IMAGEN</label>   
                                                    <p id="datofile2"></p>
                                                    <input type="file"  name="userfile[]" id="userfile" style="display: none" onchange="getFileName2(this)" accept=".jpg,.png" size="2048" multiple>
                                                </div>
                                            </div>                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="divAttendant">
                                                <p style="color: #00B0F0">
                                                    REQUIERE ATENCIÓN INMEDIATA DE COORDINADOR
                                                    <input type="checkbox" name="chkattendant" id="chkattendant">
                                                </p>                                                
                                            </div><br><br><br>
                                            <div class="col-sm-7"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="form-control btn btn-success" id="btnavance"><b>REGISTRAR AVANCE</b></button>
                                            </div>                                            
                                        </form>
                                        <form id="frmdevmaterials" method="post" action="return_materials" style="display: none">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr style="color: #00B0F0">
                                                            <th>Descripción</th>
                                                            <th>| Unidad de Medida</th>
                                                            <th>| Cantidad Base</th>
                                                            <th>| Cantidad Devolución</th>
                                                            <th>| Observaciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="materialsback"></tbody>
                                                </table>
                                            </div>

                                            <div class="col-sm-7"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="form-control btn btn-success"><b>REGISTRAR</b></button>
                                            </div>  
                                        </form>                                        
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($this->session->flashdata('item')) {
                        $message = $this->session->flashdata('item');
                        echo '<div class="' . $message['class'] . '"><h3 style="color:green">' . $message['message'] . '</h3></div>';
                    }
                    ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- Modal Galery -->
        <div id="modalshow" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <ul class="slides"></ul> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Registers -->
        <div id="modalRegisters" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="bodyRegisters">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Detail-->
        <div id="modalDetail" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 40%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div style="clear: inherit;
                                 height: 600px;
                                 width: 510px;
                                 margin-right: 0px;
                                 padding: 0px;
                                 border-width: 4px;
                                 border-color: blue;
                                 border-style: solid;
                                 border-radius: 20px;">
                                <div style="height: 300px;
                                     width: 430px; margin-left: 30px;">
                                    <p style="text-align:left;">
                                        <img src="<?= base_url('dist/img/logo_mail.png') ?>"
                                             alt="logo Mer">
                                        <img src="<?= base_url('dist/img/titulo_mail.png') ?>"
                                             height="90px" width="250px" alt="titulo"/></p>
                                    <p>
                                        <img src="<?= base_url('dist/img/hr_mail.png') ?>" alt="hr">
                                    </p>
                                    <div id="detailsModal">
                                    </div>
                                </div>
                            </div> 
                        </div>                                              
                    </div>
                </div>
            </div>
        </div>  
        <!-- Modal Detalles-->
        <!-- modal activities -->
        <div id="modalActivities" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 60%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title title-modals-visit"><b>ACTIVIDADES RELACIONADAS</b></h5>                                
                    </div>
                    <div class="modal-body">                                 
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="th-head-modals">Categoria</th>
                                    <th class="th-head-modals">Producto</th>
                                    <th class="th-head-modals">Cantidad</th>
                                    <th class="th-head-modals">Unidad de medida</th>
                                </tr>                                            
                            </thead>
                            <tbody id="activities">
                            </tbody>
                        </table> 
                    </div>
                    <div class="modal-footer">
                        <button class="btn color-btn-modal" data-dismiss="modal">Cerrar </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal activities -->
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
        <script type="text/javascript">
                                                        $(function () {
                                                            $(document).on("click", ".photos", function () {
                                                                if (galery)
                                                                    $('#modalshow').modal('show');
                                                            });
                                                            $("#frmRegisterDaily").on("submit", function (e) {
                                                                console.log(formData);
                                                                return;
                                                                e.preventDefault();
                                                                var formData = new FormData(document.getElementById("frmRegisterDaily"));
                                                                url = get_base_url() + "Projects/register_daily_management";
                                                                $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                                                                $.ajax({
                                                                    url: url,
                                                                    type: "post",
                                                                    dataType: "html",
                                                                    data: formData,
                                                                    cache: false,
                                                                    contentType: false,
                                                                    processData: false
                                                                }).done(function (res) {
                                                                    $('#spinner').html("");
                                                                    if (res === "error") {
                                                                        alertify.error('Error en BBDD');
                                                                    }
                                                                    if (res === "ok") {
                                                                        alertify.success('Gestión registrada exitosamente');
                                                                        location.reload();
                                                                    }
                                                                });
                                                            });
                                                        });

                                                        $("#frmUploadDocuments").on("submit", function (e) {
                                                            e.preventDefault();
                                                            $.confirm({
                                                                title: '',
                                                                content: 'En realidad desea realizar este registro?',
                                                                buttons: {
                                                                    si: function () {
                                                                        var formData = new FormData(document.getElementById("frmUploadDocuments"));
                                                                        var url = get_base_url() + "Projects/register_docs";
                                                                        $.ajax({
                                                                            url: url,
                                                                            type: "post",
                                                                            dataType: "html",
                                                                            data: formData,
                                                                            cache: false,
                                                                            contentType: false,
                                                                            processData: false
                                                                        })
                                                                                .done(function (res) {
                                                                                    if (res === "error") {
                                                                                        $.alert('Error en BBDD');
                                                                                    }
                                                                                    if (res === "ok") {
                                                                                        $.alert('Documento cargado exitosamente');
                                                                                    }

                                                                                });
                                                                    },
                                                                    no: function () {
                                                                        $.alert('Cancelado!');
                                                                    }
                                                                }
                                                            });
                                                        });

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

                                                        $("#typegest").change(function () {
                                                            var gest = $("#typegest").val();
                                                            if (gest === '1') {
                                                                $("#divMaterials").show();
                                                                $("#divMaterials2").show();
                                                                $("#divMaterials3").show();
                                                                $("#divExecute").show();
                                                                $("#divdetailgest").show();
                                                                $("#divadjimg").show();
                                                                $("#btnavance").show();
                                                                $("#frmdevmaterials").hide();
                                                                $("#chkattendant").prop("checked", false);
                                                                $("#chkattendant").prop("disabled", false);
                                                                $("#chkattendant").val(0);
                                                                $("#attendant").val(0);
                                                            }
                                                            if (gest === '2') {
                                                                $("#chkattendant").prop("checked", true);
                                                                $("#chkattendant").prop("disabled", true);
                                                                $("#chkattendant").val(1);
                                                                $("#attendant").val(1);
                                                                $("#frmdevmaterials").hide();
                                                                $("#divMaterials").hide();
                                                                $("#divMaterials2").hide();
                                                                $("#divMaterials3").hide();
                                                                $("#divExecute").hide();
                                                                $("#divdetailgest").show();
                                                                $("#divadjimg").show();
                                                                $("#btnavance").show();
                                                            }
                                                            if (gest === '3') {
                                                                $("#btnavance").show();
                                                                $("#divdetailgest").show();
                                                                $("#divadjimg").show();
                                                                $("#divAttendant").hide();
                                                                $("#divExecute").hide();
                                                                $("#divMaterials").hide();
                                                                $("#divMaterials2").hide();
                                                                $("#divMaterials3").hide();
                                                                $("#frmdevmaterials").hide();
                                                            }
                                                            if (gest === '6') {
                                                                $("#divdetailgest").hide();
                                                                $("#divadjimg").hide();
                                                                $("#divAttendant").hide();
                                                                $("#divExecute").hide();
                                                                $("#divMaterials").hide();
                                                                $("#divMaterials2").hide();
                                                                $("#divMaterials3").hide();
                                                                $("#btnavance").hide();
                                                                $("#frmdevmaterials").show();
                                                            }
                                                        }
                                                        );
                                                        $("#chkattendant").change(function () {
                                                            var val = $("#chkattendant").prop("checked");
                                                            if (val === true) {
                                                                $("#chkattendant").val(1);
                                                                $("#attendant").val(1);
                                                            } else {
                                                                $("#chkattendant").val(0);
                                                                $("#attendant").val(0);
                                                            }
                                                        }
                                                        );
                                                        function upexe()
                                                        {
                                                            var valor = parseInt($("#percentexe").html());
                                                            if (isNaN(valor)) {
                                                                valor = 0;
                                                            }
                                                            if (valor < 100) {
                                                                valor++;
                                                                // Modificamos el valor de la variable value del progressbar
                                                                $("#percentexe").html(valor + "%");
                                                                $("#percentexe").width(valor + "%");
                                                                $("#valpercentexe").val(valor);
                                                            }
                                                        }

                                                        function downexe()
                                                        {
                                                            var valor = parseInt($("#percentexe").html());
                                                            if (valor > 0) {
                                                                valor--;
                                                                // Modificamos el valor de la variable value del progressbar
                                                                $("#percentexe").html(valor + "%");
                                                                $("#percentexe").width(valor + "%");
                                                                $("#valpercentexe").val(valor);
                                                            }
                                                        }

                                                        function upmat()
                                                        {
                                                            var valor = parseInt($("#percentmat").html());
                                                            if (isNaN(valor)) {
                                                                valor = 0;
                                                            }
                                                            if (valor < 100) {
                                                                valor++;
                                                                // Modificamos el valor de la variable value del progressbar
                                                                $("#percentmat").html(valor + "%");
                                                                $("#percentmat").width(valor + "%");
                                                                $("#valpercentmat").val(valor);
                                                            }
                                                        }

                                                        function downmat()
                                                        {
                                                            var valor = parseInt($("#percentmat").html());
                                                            if (valor > 0) {
                                                                valor--;
                                                                // Modificamos el valor de la variable value del progressbar
                                                                $("#percentmat").html(valor + "%");
                                                                $("#percentmat").width(valor + "%");
                                                                $("#valpercentmat").val(valor);
                                                            }
                                                        }

                                                        function getFileName(elm) {
                                                            var fn = $(elm).val();
                                                            $("#datofile").html(fn);
                                                        }

                                                        function getFileName2(elm) {
                                                            var fn = $(elm).val();
                                                            $("#datofile2").html(fn);
                                                        }

                                                        function management() {
                                                            var idOrder = $("#lblcCost").val();
                                                            $("#gestiondeavance").show();
                                                            $("#panelinferior").hide();
                                                            $("#panelsup").hide();
                                                            var url = get_base_url() + "Projects/get_accum_management?jsoncallback=?";
                                                            $.getJSON(url, {idOrder: idOrder}).done(function (response) {
                                                                var percentExecute = parseInt(response.accums.percent_execute);
                                                                var percentMaterials = parseInt(response.accums.percent_materials);
                                                                $("#percentexe").html(percentExecute + "%");
                                                                $("#percentexe").width(percentExecute + "%");
                                                                $("#valpercentexe").val(percentExecute);
                                                                $("#percentmat").html(percentMaterials + "%");
                                                                $("#percentmat").width(percentMaterials + "%");
                                                                $("#valpercentmat").val(percentMaterials);
                                                            }
                                                            );
                                                        }

                                                        /*function getDocuments() {
                                                         var order = $("#uniquecode").val();
                                                         $("#liorder").html(order + "<ul><li>GSM</li></ul>");
                                                         $('#tree').on('changed.jstree', function (e, data) {
                                                         var sel = data.instance.get_path(data.selected);
                                                         getContent(sel);
                                                         }).jstree();
                                                         }*/

                                                        function getDocuments(idOrder) {
                                                            $("#liorder").empty();
                                                            var order = $("#uniquecode").val();
                                                            $("#idOrderDoc").val(idOrder);
                                                            //$("#liorder").append(order);
                                                            var url = get_base_url() + "Orders/get_services_order?jsoncallback=?";
                                                            var url2 = get_base_url() + "Services/get_model_tree?jsoncallback=?";
                                                            $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                                                                $.each(res["serv"], function (i, serv) {
                                                                    $.getJSON(url2, {idService: serv.idServices}).done(function (resp) {
                                                                        console.log(serv.idServices);
                                                                        //$("#liorder").append(order + "<ul><li>" + resp.tree.name_service + resp.tree.model_tree + "</li></ul>");
                                                                        $("#liorder").append(order + "<ul><li>" + resp.tree.name_service + resp.tree.model_tree + "</li></ul>");
                                                                        $('#tree').on('changed.jstree', function (e, data) {
                                                                         var sel = data.instance.get_path(data.selected);
                                                                         getContent(sel);
                                                                         }).jstree();
                                                                    }).fail(function (data) {
                                                                        console.log("error");
                                                                        console.log(data);
                                                                    });
                                                                });
                                                            });
                                                            
                                                            getObsvDocCenter(idOrder);
                                                        }

                                                        function getContent(filesel) {
                                                            var idOrder = $("#lblcCost").val();
                                                            $("#display").html('');
                                                            $("#files").prop('disabled', false);
                                                            $("#btnSubmitDocs").prop('disabled', false);
                                                            $("#obsvdocs").prop('disabled', false);
                                                            $("#filesel").val(filesel);
                                                            $.get("content", {filesel: filesel}).done(function (response) {
                                                                $("#display").html(response);
                                                            });
                                                            getObsvDocCenter(idOrder);
                                                        }

                                                        function getObsvDocCenter(idOrder) {
                                                            $("#tblevents").empty();
                                                            $.getJSON("getObsvDocCenter?jsoncallback=?", {idOrder: idOrder}).done(function (res) {
                                                                $.each(res["obsv"], function (i, obsv) {
                                                                    $("#tblevents").append('<tr><td>' + obsv.dateSaveDoc + '</td><td>' + obsv.obsvDocs + '</td><td>' + obsv.name_user + '</td></tr>');
                                                                });
                                                            });
                                                        }

                                                        function getPanelBotton(idOrder) {
                                                            $("#bodyPanelGestion").empty();
                                                            $("#display").html('');
                                                            $("#panelinferior").show();
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
                                                            url = get_base_url() + "Projects/get_daily_management?jsoncallback=?";
                                                            $.getJSON(url, {idOrder: idOrder}).done(function (response) {
                                                                $.each(response["res"], function (i, res) {

                                                                    if (res.id_type_management === '1' || res.id_type_management === '2' || res.id_type_management === '3') {
                                                                        var percentExecute = '<div class="progress">' +
                                                                                '<div class="progress-bar progress-bar-warning" style="width: '
                                                                                + res.percent_execute + '%">' + res.percent_execute + '</div></div>';
                                                                        var percentMaterials = '<div class="progress"><div class="progress-bar progress-bar-warning" style="width: '
                                                                                + res.percent_materials + '%">' + res.percent_materials +
                                                                                '</div></div>';
                                                                        var detail = '<a data-toggle="modal" data-target="#modalshow" onclick="show(' + res.id + ')"><img src="' + get_base_url() + 'dist/img/camera.png"></a>';
                                                                        var obsv = '<input type="text" data-toggle="modal" data-target="#modalDetail" value="' + res.detail + '" id="detail_' + res.id + '" onclick="detail(' + res.id + ')" readonly>';
                                                                    }
                                                                    if (res.id_type_management === '4') {
                                                                        percentExecute = '<div class="progress"><div class="progress-bar progress-bar-warning"></div></div>';
                                                                        percentMaterials = '<div class="progress"><div class="progress-bar progress-bar-warning"></div></div>';
                                                                        detail = '<a data-toggle="modal" data-target="#modalRegisters" onclick="showRegisters(' + idOrder + ')">Detalle</a>';
                                                                        obsv = '';
                                                                    }
                                                                    if (res.id_type_management === '5' || res.id_type_management === '6' || res.id_type_management === '7') {
                                                                        percentExecute = '<div class="progress"><div class="progress-bar progress-bar-warning"></div></div>';
                                                                        percentMaterials = '<div class="progress"><div class="progress-bar progress-bar-warning"></div></div>';
                                                                        detail = '';
                                                                        obsv = '';
                                                                    }
                                                                    $('#bodyPanelGestion').append('<tr><td>' + res.dateSave + '</td><td>' + res.type + '</td><td>' + percentExecute + '</td><td>' + percentMaterials + '<td>' + obsv + '</td><td>' + detail + '</td></tr>');
                                                                });
                                                            }
                                                            );
                                                            getMaterials(idOrder);
                                                            getDocuments(idOrder);
                                                            loadMaterialTab(idOrder);
                                                        }

                                                        function loadMaterialTab(id) {
                                                            $("#material_paking a").attr("href", "http://www.bitacoramer.unisoftsystem.com.co/uploads/".concat(id, ".pdf"));
                                                            $("#material_photos").empty();
                                                            var urlPhoto = "http://www.bitacoramer.unisoftsystem.com.co/reportes/material_fotos/".concat(id);
                                                            $.ajax({
                                                                url: "/Projects/getMaterials",
                                                                type: "post",
                                                                data: {idOrder: id},
                                                                success: function (data) {
                                                                    $.each(JSON.parse(data), function (i, material) {
                                                                        var text = '<div class="col-md-3 col-lg-3 col-sm-3 text-center">';
                                                                        text += '<strong>' + material.name_service.substring(0, 18) + '..</strong>';
                                                                        text += '<a href="' + urlPhoto + '_' + material.id_material + '.png" target="_blank">';
                                                                        text += '<img src="' + urlPhoto + '_' + material.id_material + '.png" class="img-thumbnail" style="width: 200px">';
                                                                        text += '</a>';
                                                                        text += '</div>';
                                                                        $("#material_photos").append(text);
                                                                        console.log(text);
                                                                    });
                                                                },
                                                                error: function (data) {
                                                                    console.log(data);
                                                                }
                                                            });
                                                        }

                                                        function detail(id) {
                                                            var val = $("#detail_" + id).val();
                                                            $("#detailsModal").html("<p style='text-align:center; font-size: 16px'>" + val + "</p>");
                                                        }

                                                        function show(id) {
                                                            galery = false;
                                                            $(".slides").html("");
                                                            url = get_base_url() + "Projects/get_photos_daily_xid?jsoncallback=?";
                                                            $.get(url, {id: id}).done(function (res) {
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

                                                        function showRegisters(idOrder) {
                                                            $("#bodyRegisters").html('');
                                                            galery = false;
                                                            $(".slides").html("");
                                                            url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                                                            $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                                                                var pos = 1;
                                                                $.each(respuestaServer["docs"], function (i, doc) {
                                                                    if (doc.idTypeDocument === "2") {
                                                                        if (doc.idState2 !== '0') {
                                                                            $(".pisnm").removeClass("disable");
                                                                            $(".pisnm").addClass("pointer");
                                                                            $(".pisnm").attr('href', get_base_url() + 'uploads/' + doc.file2);
                                                                            $("#obsvPsinm").val(doc.observation2);
                                                                        } else {
                                                                            $(".pisnm" + idOrder).css("color", "red");
                                                                        }
                                                                    }
                                                                    if (doc.idTypeDocument === "3") {
                                                                        if (doc.idState2 !== '0') {
                                                                            $(".tss").removeClass("disable");
                                                                            $(".tss").addClass("pointer");
                                                                            $(".tss").attr('href', get_base_url() + 'uploads/' + doc.file2);
                                                                            $("#obsvTss").val(doc.observation2);
                                                                        } else {
                                                                            $(".tss" + idOrder).css("color", "red");
                                                                        }
                                                                    }
                                                                    if (doc.idTypeDocument === "4") {
                                                                        if (doc.idState2 !== '0') {
                                                                            $(".das").removeClass("disable");
                                                                            $(".das").addClass("pointer");
                                                                            $(".das").attr('href', get_base_url() + 'uploads/' + doc.file2);
                                                                            $("#obsvDas").val(doc.observation2);
                                                                        } else {
                                                                            $(".tss" + idOrder).css("color", "red");
                                                                        }
                                                                    }
                                                                    if (doc.idTypeDocument === "7") {
                                                                        if (doc.idState2 !== '0') {
                                                                            $(".docs").removeClass("disable");
                                                                            $(".docs").addClass("pointer");
                                                                            $(".docs").attr('href', get_base_url() + 'uploads/' + doc.file2);
                                                                            $(".docs").attr('disabled', false);
                                                                        } else {
                                                                            $(".docs" + idOrder).css("color", "red");
                                                                        }
                                                                    }
                                                                    if (doc.idTypeDocument === "1") {
                                                                        if (doc.idState2 !== '0') {
                                                                            var image = doc.file2.split(",");
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
                                                                            $(".photo").removeClass("disable");
                                                                            $(".photo").addClass("pointer");
                                                                            $("#obsvRegPic").val(doc.observation2);
                                                                        } else {
                                                                            $(".photo" + idOrder).css("color", "red");
                                                                        }
                                                                    }
                                                                });
                                                            });
                                                            getObservations(idOrder);
                                                            $("#bodyRegisters").html('<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                                                                    '<tr><td><label class="blue bold upload_design">' +
                                                                    '<a class="disable photos photo">VER REGISTRO FOTOGRAFICO</a></label>' +
                                                                    '<td>OBSERVACIONES</td>'
                                                                    + '<td><input type="text" class="form-control" size=40 id="obsvRegPic" readonly><td>' +
                                                                    '</tr><tr><td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable pisnm">' +
                                                                    'VER FORMATO PSINM</a></label><td>OBSERVACIONES</td><td><input type="text" class="form-control" size=40 id="obsvPsinm" readonly></td>' +
                                                                    '</tr><tr><td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable tss">VER FORMATO TSS</a></label>' +
                                                                    '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" size=40 id="obsvTss" readonly></td>' +
                                                                    '</tr><tr><td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable das">VER FORMATO DAS</a></label>' +
                                                                    '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" size=40 id="obsvDas" readonly></td>' +
                                                                    '</tr><tr><td>OBSERVACIONES GENERALES</td><td colspan="3"><input type="hidden" value="" name="idOrder">' +
                                                                    '<input type="text" class="form-control" id="obsvgen" readonly></td></tr>' +
                                                                    '<tr><td></td><td><a target="_blank" class="disable docs" disabeld>' +
                                                                    '<button type="button" class="btn btn-default">Ver Adjuntos</button></a></td></tr>' +
                                                                    '</table>');
                                                        }

                                                        function getObservations(idOrder) {
                                                            $("#obsvgen").val("");
                                                            url = get_base_url() + "Projects/get_observation_close?jsoncallback=?";
                                                            $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                                                                $("#obsvgen").val(res.observation.detail);
                                                            });
                                                        }

                                                        function getMaterials(idOrder) {
                                                            $('#materialsback').empty();
                                                            var url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                                                            $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                                                                $.each(respuestaServer["materials"], function (i, materials) {
                                                                    $('#materialsback').append('<tr><td>' + materials.name_service +
                                                                            '</td><td>' + materials.unit_measurement + '</td><td>'
                                                                            + materials.count + '</td>' +
                                                                            '<td><input type="hidden" name="idOrder" value="'
                                                                            + idOrder + '"><input type="hidden" name="idCellar[]" value="'
                                                                            + materials.idCellar + '"><input type="hidden" name="idDetail[]" value="'
                                                                            + materials.id + '"><input type="number" class="form-control" name="countback[]" max="'
                                                                            + materials.count + '" min="0"></td>' + '<td>'
                                                                            + materials.observation + '</td></tr>');
                                                                });
                                                            });
                                                        }

                                                        function trush() {
                                                            $.confirm({
                                                                title: 'Confirmación!',
                                                                content: 'En realidad deseas borrar?',
                                                                buttons: {
                                                                    si: function () {
                                                                        $.alert('Confirmado!');
                                                                    },
                                                                    no: function () {
                                                                        $.alert('Cancelado!');
                                                                    }
                                                                }
                                                            });
                                                        }
                                                        cargar_menu("mis_proyectos", 'REGISTROS PROCESADOS');
        </script>
    </body>
</html>
