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
                        <li><a href="<?= base_url('Parametrization'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#add-tax">Añadir Estado</button></h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="data-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr><th>Nombre</th><th>Descripción</th><th>Días</th><th>Acciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($times as $time) { ?>                                            
                                        <tr>
                                            <td><?= $time->name_order_state ?></td>
                                            <td><?= $time->descripcion ?></td>
                                            <td><?= $time->days ?></td>
                                            <td><a href="<?= base_url('Parametrization/get_time/') . $time->id ?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="javascript:deleteTime(<?= $time->id ?>)"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
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
        <div id="add-tax" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 30%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLongTitle">Añadir Estado</h3>
                    </div>
                    <form id="frmAddState" action="javascript:addState()" method="post">
                        <div class="modal-body">                        
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre Estado">                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control" name="desc" placeholder="Descripción">
                        </div>
                        <div class="form-group">
                            <label for="state">Días en estado</label>
                            <input type="text" class="form-control" name="days" placeholder="Días en estado">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function addArea() {
                url = get_base_url() + "Parametrization/add_state";
                $.ajax({
                    url: url,
                    type: $("#frmAddState").attr("method"),
                    data: $("#frmAddState").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Estado agregado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
            function deleteState(id) {
                alertify.confirm('Esta seguro de eliminar este estado?, esta acción no podra ser removida.', function () {
                    url = get_base_url() + "Parametrization/delete_state";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {id: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en bbdd');
                            }
                            if (resp === "ok") {
                                alertify.success('Estado eliminado correctamente');
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
