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
                        <li><a href="<?= base_url('Projects/closing_visit_request') ?>"><i class="fa fa-refresh"></i></a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="<?= base_url('Projects/closing_visit_request') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Projects/closing_visit_request_process') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registro de Actividad</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/projects.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Fecha de Asignación</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>
                                                    <th style="color: #00B0F0">Servicio</th>
                                                    <th style="color: #00B0F0">Para Gestionar</th>
                                                    <th style="color: #00B0F0">Acción</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($projects) && $projects) {
                                                    foreach ($projects as $row) {
                                                        ?>                                            
                                                        <tr>
                                                            <td><?= $row->dateAssign ?></td>
                                                            <td><a href="#" onclick="verDetalleReg(<?= $row->id ?>);"><u><?= $row->uniquecode . '-' . $row->coi ?></u></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->type ?></td>
                                                            <?php if ($row->id_type_management === '2') { ?>                                                  
                                                                <td><select class="form form-control" id="seltype_<?= $row->id ?>" required="" onchange="register(<?= $row->id ?>)">
                                                                        <option></option>
                                                                        <option value="0">
                                                                            Asignar Visita de Cierre
                                                                        </option>
                                                                        <option value="1">
                                                                            Devolución Visita de Cierre
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                            <?php } if ($row->id_type_management === '3') { ?>                                                            
                                                                <td><select class="form form-control" id="seltype_<?= $row->id ?>" required="" onchange="registerAudit(<?= $row->id ?>)">
                                                                        <option></option>
                                                                        <option value="4">
                                                                            ACEPTACIÓN AUD. VISITA DE CIERRE
                                                                        </option>
                                                                        <option value="5">
                                                                            RECHAZO AUD. VISITA DE CIERRE
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                            <?php } if ($row->type === '6') { ?>                                                            
                                                                <td>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" id="detallereg" hidden="">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#" style="color: #00B0F0"><b>GESTIÓN</b></a></li>
                                            &nbsp;&nbsp;<a href="#" onclick="gestionReg();"><i class="fa fa-plus-circle fa-2x" style="color: #00B0F0"></i></a>                                           
                                        </ul>
                                        <table  id="" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td style="color: #00B0F0">Fecha de Gestión</td>
                                                    <td style="color: #00B0F0">Tipo de Gestión</td>
                                                    <td style="color: #00B0F0">Avance Ejecución</td>
                                                    <td style="color: #00B0F0">Consumo de Materiales</td>
                                                    <td style="color: #00B0F0">Gestión</td>
                                                </tr>                                   
                                            </thead>
                                            <tbody id="bodyDetalleReg">  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" id="gestionreg" hidden="">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">                                       
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li><a href="#" style="color: white">.</a></li>
                                            <li class="active">
                                                <a href="#" style="color: #00B0F0">
                                                    <b>GESTIÓN DE AVANCE</b></a></li>
                                            <li><a href="#" style="color: white">.</a></li>
                                        </ul>
                                        <br><br>                                                                              
                                        <form id="frmRegisterDaily" enctype="multipart/form-data"> 
                                            <input type="hidden" name="idOrderDaily" id="idOrderReg">
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <p style="color: #00B0F0">TIPO DE GESTIÓN</p>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                <select class="form form-control" name="typegest" id="typegest">
                                                    <?php foreach ($types as $value) { ?>
                                                        <?php if ($value->id > 3) { ?>
                                                            <option value="<?= $value->id ?>"><?= $value->type ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div><br><br>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <p style="color: #00B0F0">DETALLE DE GESTIÓN</p>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                <textarea class="form form-control" name="detailgest" id="detailgest" required=""></textarea>
                                            </div><br><br><br><br>  
                                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">                                                
                                            </div> 
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <label for="userfile"><img src="<?= base_url('dist/img/camera.png') ?>">
                                                    ADJUNTAR IMAGEN</label>   
                                                <p id="datofile"></p>
                                                <input type="file"  name="userfile[]" id="userfile" style="display: none" onchange="getFileName(this)" accept=".jpg,.png" size="2048" multiple>
                                            </div><br><br><br><br>                                            
                                            <div class="col-sm-7"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="form-control btn btn-success"><b>REGISTRAR AVANCE</b></button>
                                            </div>
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
            <!-- Modal-->
            <div id="modal" class="modal fade" role="dialog">
                <div class="modal-dialog" style="width: 32%;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div style="clear: inherit;
                                     height: 350px;
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
                                        <p style="text-align:center; font-size: 16px">
                                            <b>A partir de este momento se dará
                                                inicio a este proyecto, el registro de
                                                actividades podrá ser realizado a través
                                                de la opción "Registro de Actividad"</b>
                                        </p>
                                        <br> 
                                        <div class="col-xs-12">
                                            <div class="col-xs-5">
                                                <input type="hidden" id="idOrder">
                                            </div>
                                            <div class="col-xs-3">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">CANCELAR</button>
                                            </div>
                                            <div class="col-xs-1"></div>
                                            <div class="col-xs-3">
                                                <button type="button" class="btn btn-primary" onclick="init();">ACEPTAR</button>
                                            </div>                                                                                        
                                        </div>
                                    </div>

                                </div> 
                            </div>                                              
                        </div>
                    </div>
                </div>
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
            <?php $this->load->view('templates/footer.html') ?>
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
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            $(function () {
                $(document).on("click", ".photos", function () {
                    if (galery)
                        $('#modalshow').modal('show');
                });

                $("#frmRegisterDaily").on("submit", function (e) {
                    e.preventDefault();
                    var formData = new FormData(document.getElementById("frmRegisterDaily"));
                    url = get_base_url() + "Projects/register_daily_management_coord";
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

            $("#typegest").change(function () {
                var gest = $("#typegest").val();
                if (gest === '2') {
                    $("#attendant").prop("checked", true);
                    $("#attendant").val(1);
                } else {
                    $("#attendant").prop("checked", false);
                    $("#attendant").val(0);
                }
            }
            );

            $("#attendant").change(function () {
                var val = $("#attendant").prop("checked");
                if (val === true) {
                    $("#attendant").val(1);
                } else {
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
                    $("#percentexe").width(valor);
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
                    $("#percentexe").width(valor);
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
                    $("#percentmat").width(valor);
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
                    $("#percentmat").width(valor);
                    $("#valpercentmat").val(valor);
                }
            }

            function getFileName(elm) {
                var fn = $(elm).val();
                $("#datofile").html(fn);
            }

            function gestion() {
                $("#gestiondeavance").show();
                $("#panelinferior").hide();
                $("#panelsup").hide();
                var idOrder = $("#lblcCost").val();
                url = get_base_url() + "Projects/get_accum_management?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (response) {
                    var percentExecute = parseInt(response.accums.percent_execute);
                    var percentMaterials = parseInt(response.accums.percent_materials);
                    $("#percentexe").html(percentExecute + "%");
                    $("#percentexe").width(percentExecute);
                    $("#valpercentexe").val(percentExecute);
                    $("#percentmat").html(percentMaterials + "%");
                    $("#percentmat").width(percentMaterials);
                    $("#valpercentmat").val(percentMaterials);
                }
                );
            }

            function gestionReg() {
                $("#gestionreg").show();
                $("#detallereg").hide();
            }

            function generateid(idOrder) {
                $("#idOrder").val(idOrder);
            }
            function register(idOrder) {
                var typeReg = $("#seltype_" + idOrder).val();
                if (typeReg === "1") {
                    var obsv = prompt('Observaciones');
                    url = get_base_url() + "Projects/back_closing_visit";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, obsv: obsv},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Ordén enviada a asignador de visitas.');
                                location.reload();
                            }
                        }
                    });
                } else {
                    url = get_base_url() + "Projects/mark_closing_visit";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Ordén enviada a asignador de visitas.');
                                location.reload();
                            }
                        }
                    });
                }
            }

            function registerAudit(idOrder) {
                var typeReg = $("#seltype_" + idOrder).val();
                if (typeReg === "5") {
                    var obsv = prompt('Observaciones');
                    url = get_base_url() + "Projects/back_closing_visit_audit";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, obsv: obsv},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('SOLICITUD DEVUELTA.');
                                location.reload();
                            }
                        }
                    });
                } else {
                    url = get_base_url() + "Projects/mark_closing_visit_audit";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('SOLICITUD PROCESADA EXITOSAMENTE.');
                                location.reload();
                            }
                        }
                    });
                }
            }

            function verPanelInferior(idOrder) {
                $("#panelinferior").show();
                var order = $("#norder_" + idOrder).val();
                var ccost = $("#ccost_" + idOrder).val();
                var activ = $("#activ_" + idOrder).val();
                var site = $("#site_" + idOrder).val();
                $("#lblOrder").html(order);
                $("#lblActiv").html(activ);
                $("#lblCost").html(ccost);
                $("#lblcCost").val(ccost);
                $("#lblSite").html(site);
                url = get_base_url() + "Projects/get_daily_management?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (response) {
                    $.each(response["res"], function (i, res) {
                        if (res.id_type_management === '2' || res.id_type_management === '3') {
                            var percentExecute = '<div class="progress"><div class="progress-bar progress-bar-warning"></div></div>';
                            var percentMaterials = '<div class="progress"><div class="progress-bar progress-bar-warning"></div></div>';
                            var detail = '<a data-toggle="modal" data-target="#modalRegisters" onclick="showRegisters(' + idOrder + ')">Detalle</a>';
                        } else {
                            percentExecute = '<div class="progress">' +
                                    '<div class="progress-bar progress-bar-warning" style="width: '
                                    + res.percent_execute + '%">' + res.percent_execute + '</div></div>';
                            percentMaterials = '<div class="progress"><div class="progress-bar progress-bar-warning" style="width: '
                                    + res.percent_materials + '%">' + res.percent_materials +
                                    '</div></div>';
                            detail = '<a data-toggle="modal" data-target="#modalshow" onclick="show(' + res.id + ')"><img src="' + get_base_url() + 'dist/img/camera.png"></a>';
                        }
                        $('#bodyPanelGestion').append('<tr><td>' + res.dateSave +
                                '</td><td>' + res.type +
                                '</td><td>' + percentExecute + '</td><td>' + percentMaterials + '<td>' +
                                '<input type="text" data-toggle="modal" data-target="#modalDetail" value="' + res.detail + '" id="detail_' + res.id + '" onclick="detail(' + res.id + ')" readonly></td><td>'
                                + detail + '</td></tr>'
                                );
                    });
                }
                );
            }

            function verDetalleReg(idOrder) {
                $("#detallereg").show();
                $("#idOrderReg").val(idOrder);
                url = get_base_url() + "Projects/get_daily_management?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (response) {
                    $.each(response["res"], function (i, res) {
                        $('#bodyDetalleReg').append('<tr><td>' + res.dateSave +
                                '</td><td>' + res.type +
                                '</td><td>' + '<div class="progress">' +
                                '<div class="progress-bar progress-bar-warning" style="width: '
                                + res.percent_execute + '%">' + res.percent_execute + '</div>\n\
        </div></td><td><div class="progress">\n\
                        <div class="progress-bar progress-bar-warning" style="width: '
                                + res.percent_materials + '%">' + res.percent_materials +
                                '</div></div></td><td>' +
                                '<a data-toggle="modal" data-target="#modalDetail" onclick="detail(' + res.id + ')">\n\
                    <input type="text" value="' + res.detail + '" id="detail_' + res.id + '" readonly></td><td>'
                                + '<a data-toggle="modal" data-target="#modalshow" onclick="show(' + res.id + ')">\n\
<img src="' + get_base_url() + 'dist/img/camera.png"></a></td></tr>'
                                );
                    });
                }
                );
            }

            function detail(id) {
                var val = $("#detail_" + id).val();
                $("#detailsModal").html("<p style='text-align:center; font-size: 16px'>" + val + "</p>");
            }

            function show(id) {
                galery = false;
                $(".slides").html("");
                url = get_base_url() + "Projects/get_photos_daily_xid?jsoncallback=?";
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

            function showRegisters(idOrder) {
                $("#bodyRegisters").html('');
                galery = false;
                $(".slides").html("");
                url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    var pos = 1;
                    $.each(respuestaServer["docs"], function (i, doc) {
                        if (doc.idTypeDocument === "2") {
                            if (doc.idState !== '0') {
                                $(".pisnm").removeClass("disable");
                                $(".pisnm").addClass("pointer");
                                $(".pisnm").attr('href', get_base_url() + 'uploads/' + doc.file);
                                $("#obsvPsinm").val(doc.observation);
                            } else {
                                $(".pisnm" + idOrder).css("color", "red");
                            }
                        }
                        if (doc.idTypeDocument === "3") {
                            if (doc.idState !== '0') {
                                $(".tss").removeClass("disable");
                                $(".tss").addClass("pointer");
                                $(".tss").attr('href', get_base_url() + 'uploads/' + doc.file);
                                $("#obsvTss").val(doc.observation);
                            } else {
                                $(".tss" + idOrder).css("color", "red");
                            }
                        }
                        if (doc.idTypeDocument === "7") {
                            if (doc.idState !== '0') {
                                $(".docs").removeClass("disable");
                                $(".docs").addClass("pointer");
                                $(".docs").attr('href', get_base_url() + 'uploads/' + doc.file);
                            } else {
                                $(".docs" + idOrder).css("color", "red");
                            }
                        }
                        if (doc.idTypeDocument === "1" && doc.file !== "") {
                            if (doc.idState !== '0') {
                                var html = '<input type="radio" name="radio-btn" id="img-' + pos + '" ' + (pos === 1 ? 'checked' : '') + ' />';
                                html += '<li class="slide-container"><div class="slide">';
                                html += '<img src="' + get_base_url() + "/uploads/" + doc.file + '" /></div> ';
                                html += '<div class="nav"><label for="img-' + (pos === 1 ? 1 : pos - 1) + '" class="prev">&#x2039;</label>';
                                html += '<label for="img-' + (pos + 1) + '" class="next">&#x203a;</label></div></li>';
                                $(".photo").removeClass("disable");
                                $(".photo").addClass("pointer");
                                $("#obsvRegPic").val(doc.observation);
                                $(".slides").prepend(html);
                                galery = true;
                                pos++;
                            } else {
                                $(".photo" + idOrder).css("color", "red");
                            }
                        }
                    });
                });
                $("#bodyRegisters").html('<table cellpadding="5" class="tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<tr><td><label class="blue bold upload_design">' +
                        '<a class="disable photos photo">VER REGISTRO FOTOGRAFICO</a></label>' +
                        '<td>OBSERVACIONES</td>'
                        + '<td><input type="text" class="form-control" size=40 id="obsvRegPic" readonly><td>' +
                        '</tr><tr><td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable pisnm">' +
                        'VER FORMATO 1</a></label><td>OBSERVACIONES</td><td><input type="text" class="form-control" size=40 id="obsvPsinm" readonly></td>' +
                        '</tr><tr><td><label class="blue bold upload_design"><a href="#" target="_blank" class="disable tss">VER FORMATO 2</a></label>' +
                        '<td>OBSERVACIONES</td>' + '<td><input type="text" class="form-control" size=40 id="obsvTss" readonly></td>' +
                        '</tr><tr><td>OBSERVACIONES GENERALES</td><td colspan="3"><input type="hidden" value="" name="idOrder">' +
                        '<input type="text" class="form-control" id="obsvgen" readonly></td></tr>' +
                        '<tr><td></td><td><a href="#" target="_blank" class="disable docs">' +
                        '<button type="button" class="btn btn-default">Ver Adjuntos</button></a></td></tr>' +
                        '</table>');
            }
        </script>
    </body>
</html>
