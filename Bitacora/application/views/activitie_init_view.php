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
                                        <li role="presentation" class="active"><a href="<?= base_url('Projects/activitie_init') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Projects/register_activities') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registro de Actividad</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div id="spinner"></div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/projects.png') ?>" style="width: 120px;">
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
                                                    <th style="color: #00B0F0">Tipo</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($projects) && $projects) {
                                                    foreach ($projects as $row) {
                                                        ?>                                            
                                                        <tr>
                                                            <td><?= $row->dateAssign ?></td>
                                                            <?php if ($row->type > '5') { ?>
                                                                <td><a href="<?= base_url('Projects/materials_back/') . $row->id ?>"><?= $row->uniquecode . '-' . $row->coi ?></a></td>
                                                            <?php } else { ?>
                                                                <td><a href="#" data-toggle="modal" data-target="#modal" onclick="generateid(<?= $row->id ?>)"><?= $row->uniquecode . '-' . $row->coi ?></a></td>
                                                            <?php } ?>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><a href="#" data-toggle="modal" data-target="#modalActivities" onclick="getActivities(<?= $row->id ?>)"><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->id ?>" value="<?= $row->name_activitie ?>"></a></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>                                                
                                                            <td><?= $row->type ?></td>
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
            <!-- Modal -->
            <!-- modal activities -->
            <div id="modalActivities" class="modal fade" role="dialog">
                <div class="modal-dialog" style="width: 60%;">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="text-align: center; color: #00B1EB"><b>ACTIVIDADES RELACIONADAS</b></h5>                                
                        </div>
                        <div class="modal-body">
                            <div class="row">                                    
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #00B1EB; color: white">Categoria</th>
                                            <th style="background-color: #00B1EB; color: white">Producto</th>
                                            <th style="background-color: #00B1EB; color: white">Cantidad</th>
                                            <th style="background-color: #00B1EB; color: white">Unidad de medida</th>
                                        </tr>                                            
                                    </thead>
                                    <tbody id="activities">
                                    </tbody>
                                </table> 
                                <hr style="border-color: #00B1EB">
                                <p>Bitácora</p>
                            </div>                   
                        </div>                            
                    </div>
                </div>
            </div>
            <!-- modal activities -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>    
        <!-- ./wrapper -->        
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">

            function generateid(idOrder) {
                $("#idOrder").val(idOrder);
            }

            function init() {
                var idOrder = $("#idOrder").val();
                var url1 = get_base_url() + "Projects/generate_paths";
                $.post(url1, {idOrder: idOrder});
                var url = get_base_url() + "Projects/register_activitie";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Paso a registro de actividad exitoso.');
                            location.reload();
                        }
                    }
                });
            }

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
        </script>
    </body>
</html>
