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
                        <li><a href="<?= base_url('Parametrization'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#add-activitie">Añadir Actividad</button></h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="data-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr><th>Nombre</th><th>Observaciones</th><th>Creado por</th><th>Categoria</th><th>Estado</th><th>Fecha Creación</th><th>Acciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($activities as $celda) { ?>                                            
                                        <tr>
                                            <td><?= $celda->name ?></td>
                                            <td><?= $celda->observations ?></td>
                                            <td><?= $celda->idUser ?></td>
                                            <td><?= $celda->idOrderCategory ?></td>
                                            <td><?= $celda->active ?></td>
                                            <td><?= $celda->dateSave ?></td>
                                            <td><a href="<?= base_url('Parametrization/get_activitie/') . $celda->id ?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="<?= base_url() ?>"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
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
                    <form>
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
                                <select class="form-control" id="category" required="">
                                    <option value="1">BTS</option>
                                    <option value="2">DAS</option>
                                    <option value="3">Mantenimiento</option>
                                    <option value="5">Venta de producto</option>
                                    <option value="6">QMC</option>
                                    <option value="7">Registros procesados</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Añadir Actividad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>