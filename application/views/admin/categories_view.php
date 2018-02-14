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
                        Administración Categorias
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/prices'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#add-category">Añadir Categoria</button></h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="data-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category) { ?>                                            
                                        <tr>
                                            <td><?= $category->name_category ?></td>
                                            <td><?= $category->description ?></td>
                                            <td><a href="<?= base_url('Parametrization/get_category/') . $category->id ?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="javascript:deleteCategory(<?= $category->id?>)"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
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
        <div id="add-category" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 30%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLongTitle">Añadir Categoria</h3>
                    </div>
                    <form id="frmAddCategory" action="javascript:addCategory()" method="post">
                        <div class="modal-body">                        
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre Completo" required="">                                
                            </div>
                            <div class="form-group">
                                <label for="desc">Descripción</label>
                                <textarea class="form-control" name="desc" required=""></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-primary" value="Añadir Categoria">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function addCategory() {
                url = get_base_url() + "Parametrization/add_category";
                $.ajax({
                    url: url,
                    type: $("#frmAddCategory").attr("method"),
                    data: $("#frmAddCategory").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                            location.reload();
                        }
                        if (resp === "ok") {
                            alertify.success('Categoria agregada exitosamente');
                            location.reload();
                        }
                    }
                });
            }
            function deleteCategory(id) {
                alertify.confirm('Esta seguro de eliminar esta categoria?, esta acción no podra ser removida.', function () {
                    url = get_base_url() + "Parametrization/delete_category";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idCategory: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en bbdd');
                            }
                            if (resp === "ok") {
                                alertify.success('Categoria eliminada exitosamente');
                                location.reload();
                            }
                        }
                    })
                }, function () {
                    alertify.error('Acción cancelada');
                });
            }
        </script>
    </body>
</html>
