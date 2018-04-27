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
                        Administración Actividades
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/prices'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#add-activitie">Añadir Actividad</button></h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="data-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr><th>Nombre</th><th>Observaciones</th><th>Creada por</th><th>Categoria</th><th>Estado</th><th>Fecha creación</th><th>Acciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($activities as $activitie) { ?>                                            
                                        <tr>
                                            <td><?= $activitie->name_activitie ?></td>
                                            <td><?= $activitie->observations ?></td>
                                            <td><?= $activitie->name_user ?></td>
                                            <td><?= $activitie->name_category ?></td>
                                            <td><?= $activitie->name_state ?></td>
                                            <td><?= $activitie->dateSave ?></td>
                                            <td><a href="<?= base_url('Parametrization/get_activitie/') . $activitie->id ?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="javascript:deleteActivitie(<?= $activitie->id?>)"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
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
        <div id="add-activitie" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 30%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLongTitle">Añadir Actividad</h3>
                    </div>
                    <form id="frmAddActivitie" action="javascript:addActivitie()" method="post">
                        <div class="modal-body">                        
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre Actividad" required="">                                
                            </div>
                            <div class="form-group">
                                <label for="email">observaciones</label>
                                <textarea class="form-control" name="obsv" placeholder="Observaciones"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Categoria</label>
                                <select class="form-control" name="category" required="">
                                    <?php foreach ($categories as $categorie) { ?>
                                        <option value="<?= $categorie->id ?>"><?= $categorie->name_category ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <small id="categoryHelp" class="form-text text-muted"><a href="<?= base_url('Parametrization/get_categories')?>"> + Crear Categoria</a></small>
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
            function addActivitie() {
                url = get_base_url() + "Parametrization/add_activitie";
                $.ajax({
                    url: url,
                    type: $("#frmAddActivitie").attr("method"),
                    data: $("#frmAddActivitie").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                            location.reload();
                        }
                        if (resp === "ok") {
                            alertify.success('Actividad agregada exitosamente');
                            location.reload();
                        }
                    }
                });
            }
            function deleteActivitie(id) {
                alertify.confirm('Esta seguro de eliminar esta actividad?, esta acción no podra ser removida.', function () {
                    url = get_base_url() + "Parametrization/delete_activitie";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idActivitie: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en bbdd');
                            }
                            if (resp === "ok") {
                                alertify.success('Actividad eliminada');
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
