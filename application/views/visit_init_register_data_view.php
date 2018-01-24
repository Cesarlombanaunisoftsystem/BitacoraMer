<!DOCTYPE html>
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
                                        <li role="tray" class="active"><a href="#" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <img src="<?= base_url('dist/img/visitini.png') ?>" style="width: 120px;">
                        </div>
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">                           
                            <table id="data-table" class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="color: #00B0F0">Fecha de ordén</th>
                                        <th style="color: #00B0F0">No. Ordén</th>
                                        <th style="color: #00B0F0">Centro de Costos</th>
                                        <th style="color: #00B0F0">Actividad</th>
                                        <th style="color: #00B0F0">Servicio</th>
                                        <th style="color: #00B0F0">Cantidad</th>
                                        <th style="color: #00B0F0">Sitio</th>
                                        <th style="color: #00B0F0">Técnico</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($visits) {
                                        foreach ($visits as $visit) {
                                            ?> 
                                            <tr onclick="docsVisitInit(<?= $visit->id ?>)" data-toggle="modal" data-target="#modalRegisterVisitInit">
                                                <td><?= $visit->date ?></td>
                                                <td><?= $visit->uniquecode ?></td>
                                                <td><?= $visit->uniqueCodeCentralCost ?></td>
                                                <td><?= $visit->name_activitie ?></td>
                                                <td><?= $visit->name_service ?></td>
                                                <td><?= $visit->count ?></td>
                                                <td><?= $visit->site ?></td>
                                                <td><?= $visit->name_user ?></td>
                                            </tr> 
                                            <?php
                                        }
                                    }
                                    ?> 
                                </tbody>
                            </table>
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
            function docsVisitInit(idOrder) {
                $("#frmDocsRegVisitInit").empty();
                url = get_base_url() + "Visit/get_docs_visit_init_register?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["docs"], function (i, docs) {
                        $("#frmDocsRegVisitInit").append('<div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4"><u>ADJUNTAR ' + docs.name_type + '</u></div><div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">OBSERVACIONES:</div><div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-6"><input type="text" id="obsvRegPic" name="obsvRegPic" class="form-control"></div>');                       
                        $("#return").html('<a href="javascript:return_order('+docs.idOrder+')" title="devolver a asignación de visita inicial"><i class="fa fa-undo" aria-hidden="true" style="color: orange"></i></a>');
                    });
                });
            }
            
            function return_order(idOrder) {
            var obsvGen = $('#obsvGen').val();
                url = get_base_url() + "Visit/return_order_assign";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder, obsvGen:obsvGen},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Orden devuelta a asignación visita inicial exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>
        <!-- Modal -->
        <div id="modalRegisterVisitInit" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 80%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row" style="text-align: center; margin-right: 5px; margin-left: 5px; padding: 8px; border-width: 1px; border-color: black;
                             border-style: solid;
                             border-radius: 10px;">
                            <form class="form-horizontal" id="frmDocsRegVisitInit">                                
                                
                            </form>
                            <form class="form-horizontal" id="frmRegVisitInit">                                
                                <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <u>OBSERVACIONES GENERALES</u>
                                </div>
                                <div class="form-group col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                    <input type="text" id="obsvGen" name="obsvGen" class="form-control">
                                </div>
                                <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <a href="#" style="color: #00B1EC">REGISTRAR</a>                                    
                                </div>
                                <div class="form-group col-xs-1 col-sm-1 col-md-1 col-lg-1" id="return">
                                    
                                </div>
                            </form>
                        </div>                   
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
