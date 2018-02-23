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
                        <li><a href="<?= base_url('Projects/activitie_init') ?>"><i class="fa fa-refresh"></i></a></li>
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
                                        <li role="presentation"><a href="#process" aria-controls="binnacle" role="tab" data-toggle="tab">Registro de Actividad</a></li>
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
                                                            <td><?= $row->uniquecode ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->type ?></td>
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

                            <div role="tabpanel" class="tab-pane" id="process">
                                <div class="row" id="panelsup">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/gestion.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#" style="color: #00B0F0"><b>PROYECTOS</b></a></li>                                            
                                        </ul>
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
                                                            <td><a href="#" onclick="verPanelInferior(<?= $row->id ?>);"><?= $row->dateAssign ?></a></td>
                                                            <td><?= $row->uniquecode ?><input type="hidden" id="norder_<?= $row->id ?>" value="<?= $row->uniquecode ?>"></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccost_<?= $row->id ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                            <td><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->id ?>" value="<?= $row->name_activitie ?>"></td>
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
                                <div class="row" id="panelinferior" hidden="">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#" style="color: #00B0F0"><b>GESTIÓN</b></a></li>
                                            &nbsp;&nbsp;<a href="#" onclick="gestion();"><i class="fa fa-plus-circle fa-2x" style="color: #00B0F0"></i></a>                                           
                                        </ul>
                                        <table  id="data-table" class="table table-striped">
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
                                </div>
                                <div class="row" id="gestiondeavance" hidden="">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/gestion.png') ?>" style="width: 120px;">
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
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <table>
                                                <tr>
                                                    <td>No. ORDEN: <label id="lblOrder"></label></td>
                                                </tr>
                                            </table>
                                        </div>                                        
                                        <form id="frmRegisterDaily" enctype="multipart/form-data">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <table>
                                                    <tr style="font-size: 12px;">
                                                        <td style="color: #00B0F0">| Centro de Costos |</td>
                                                        <td>&nbsp;
                                                            <label id="lblCost"></label>
                                                            <input type="hidden" name="idOrderDaily" id="lblcCost">                                                            
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
                                            </div><br><br><br><br>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <p style="color: #00B0F0">TIPO DE GESTIÓN</p>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                <select class="form form-control" name="typegest" id="typegest">
                                                    <?php foreach ($types as $value) { ?>
                                                        <option value="<?= $value->id ?>"><?= $value->type ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div><br><br>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <p style="color: #00B0F0">DETALLE DE GESTIÓN</p>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                <textarea class="form form-control" name="detailgest" id="detailgest" required=""></textarea>
                                            </div><br><br><br>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <p style="color: #00B0F0">% AVANCE EJECUCIÓN</p>
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <div class="progress">
                                                    <div id="percentexe" class="progress-bar progress-bar-warning" style="width: 0%">
                                                        0%
                                                    </div>
                                                </div>
                                                <input type="hidden" name="valpercentexe" id="valpercentexe">
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">                                                
                                                <i class="fa fa-sort-up" onclick="upexe();"></i><i class="fa fa-sort-down" onclick="downexe();"></i>
                                            </div><br><br>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <p style="color: #00B0F0">% CONSUMO DE MATERIALES</p>
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <div class="progress">
                                                    <div id="percentmat" class="progress-bar progress-bar-warning" style="width: 0%"> 
                                                        0%
                                                    </div>
                                                </div>
                                                <input type="hidden" name="valpercentmat" id="valpercentmat">
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">                                                
                                                <i class="fa fa-sort-up" onclick="upmat();"></i><i class="fa fa-sort-down" onclick="downmat();"></i>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <label for="userfile"><img src="<?= base_url('dist/img/camera.png') ?>">
                                                    ADJUNTAR IMAGEN</label>   
                                                <p id="datofile"></p>
                                                <input type="file"  name="userfile" id="userfile" style="display: none" onchange="getFileName(this)" accept=".jpg,.png" size="2048">
                                            </div><br><br><br>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <p style="color: #00B0F0">
                                                    REQUIERE ATENCIÓN INMEDIATA DE COORDINADOR
                                                    <input type="checkbox" name="attendant" id="attendant">
                                                </p>                                                
                                            </div>                                            
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
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- Modal Fotos-->
        <div id="modalshow" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 70%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="photo"></div>                
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
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            $(function () {
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
            function generateid(idOrder) {
                $("#idOrder").val(idOrder);
            }
            function register(idOrder) {
                var typeReg = $("#seltype_" + idOrder).val();
                if (typeReg === "1") {
                    alertify.prompt('Devolución Visita de Cierre',
                            'Observaciones', 'Debes poner observaciones',
                            function (evt, value) {
                                url = get_base_url() + "Projects/back_closing_visit";
                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {idOrder: idOrder, obsv: value},
                                    success: function (resp) {
                                        if (resp === "error") {
                                            alertify.error('Error en BBDD');
                                        }
                                        if (resp === "ok") {
                                            alertify.success('Ordén enviada a asignador de visitas.');
                                            location.reload();
                                        }
                                    }
                                })
                            }, function () {
                        alertify.error('Cancelar');
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
                        $('#bodyPanelGestion').append('<tr><td>' + res.dateSave +
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
                url = get_base_url() + "Projects/get_daily_management_xid?jsoncallback=?";
                var pos = 1;
                $.getJSON(url, {id: id}).done(function (response) {
                    $.each(response["res"], function (i, res) {
                        $("#photo").html("<img src='" + get_base_url() + "uploads/" + res.image + "' width='800px' heigth='600px'>");
                    }
                    );
                });
            }
        </script>
    </body>
</html>
