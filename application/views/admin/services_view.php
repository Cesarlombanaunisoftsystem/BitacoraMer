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
                        Administración Servicios
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#add-service">Añadir Servicio</button></h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="data-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr><th>Nombre</th><th>Actividad</th><th>Observaciones</th><th>Precio</th><th>Impuesto</th><th>Creado por</th><th>Estado</th><th>Acciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($services as $service) { ?>                                            
                                        <tr>
                                            <td><?= $service->name_service ?></td>
                                            <td><?= $service->name_activitie ?></td>
                                            <td><?= $service->observations ?></td>
                                            <td><?= $service->price ?></td>
                                            <td><?= $service->name_tax ?></td>
                                            <td><?= $service->name_user ?></td>
                                            <td><?= $service->name_state ?></td>
                                            <td><a href="<?= base_url('Parametrization/get_service/') . $service->id ?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="javascript:deleteService(<?= $service->id?>)"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
                                        </tr>                                                                                    
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                  
                </section>
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <!-- Modal -->
        <div id="add-service" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 30%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLongTitle">Añadir Servicio</h3>
                    </div>
                    <form id="frmAddService" action="javascript:addService()" method="post">
                        <div class="modal-body">                        
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre Servicio" required="">                                
                            </div>
                            <div class="form-group">
                                <label for="obsv">Observaciones</label>
                                <textarea class="form-control" name="obsv" placeholder="Observaciones"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Precio</label>
                                <input type="text" class="form-control" name="price" placeholder="Precio" required=""/>
                            </div>
                            <div class="form-group">
                                <label for="tax">Impuesto</label>
                                <select class="form-control" name="tax" required="">
                                    <?php foreach ($taxes as $tax) { ?>
                                        <option value="<?= $tax->id ?>"><?= $tax->name_tax ?> <?= $tax->percent_tax ?>%
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <small id="taxHelp" class="form-text text-muted"><a href="<?= base_url('Parametrization/get_taxes')?>"> + Crear Impuesto</a></small>
                            </div>
                            <div class="form-group">
                                <label for="activitie">Actividad</label>
                                <select class="form-control" name="activitie" required="">
                                    <?php foreach ($activities as $activitie) { ?>
                                        <option value="<?= $activitie->id ?>"><?= $activitie->name_activitie ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <small id="activitieHelp" class="form-text text-muted"><a href="<?= base_url('Parametrization/get_activities')?>"> + Crear Actividad</a></small>
                            </div>
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <select class="form-control" name="state" required="">
                                    <?php foreach ($states as $state) { ?>
                                        <option value="<?= $state->id ?>"><?= $state->name_state ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Añadir Actividad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function addService() {
                url = get_base_url() + "Parametrization/add_service";
                $.ajax({
                    url: url,
                    type: $("#frmAddService").attr("method"),
                    data: $("#frmAddService").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Servicio agregado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
            function deleteService(id) {
                alertify.confirm('Esta seguro de eliminar este servicio?, esta acción no podra ser removida.', function () {
                    url = get_base_url() + "Parametrization/delete_service";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idService: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en bbdd');
                            }
                            if (resp === "ok") {
                                alertify.success('Servicio eliminado');
                                location.reload();
                            }
                        }
                    });
                }, function () {
                    alertify.error('Acción cancelada');
                });
            }
        </script>
    </body>
</html>