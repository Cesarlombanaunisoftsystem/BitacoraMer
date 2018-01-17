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
                        Administración Usuarios
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#add-user">Añadir Usuario</button></h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="data-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr><th>Nombre</th><th>Perfil</th><th>Permisos</th><th>Acciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios as $usuario) { ?>                                            
                                        <tr>
                                            <td><?= $usuario->name_user ?></td>
                                            <td><?= $usuario->name_profile ?></td>
                                            <td><a href="<?= base_url('Users/get_user_permits/') . $usuario->id ?>"><i class="fa fa-magic fa-2x"  style="color:green" aria-hidden="true"></i></a></td>
                                            <td><a href="<?= base_url('Users/get_user/') . $usuario->id ?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="javascript:deleteUser(<?= $usuario->id ?>)"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
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
        <div id="add-user" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 30%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLongTitle">Añadir Usuario</h3>
                    </div>
                    <form id="frmAddUser" action="javascript:addUser()" method="post">
                        <div class="modal-body">                        
                            <div class="form-group">
                                <label for="name">Nombre Completo</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre Completo" required="">                                
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Ingresa email" required="">
                                <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.</small>
                            </div>
                            <div class="form-group">
                                <label for="passw">Contraseña</label>
                                <input type="password" class="form-control" name="passw" placeholder="Ingresa contraseña" required="">
                            </div>
                            <div class="form-group">
                                <label for="cel">Celular</label>
                                <input type="tel" class="form-control" name="cel" placeholder="Ingresa número">
                            </div>
                            <div class="form-group">
                                <label for="tel">Telefono Fijo</label>
                                <input type="tel" class="form-control" name="tel" placeholder="Ingresa número">
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select class="form-control" name="rol" required="">
                                    <?php foreach ($roles as $rol) { ?>
                                        <option value="<?= $rol->id ?>"><?= $rol->name_profile ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-primary" value="Añadir Usuario">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function addUser() {
                url = get_base_url() + "Users/add_user";
                $.ajax({
                    url: url,
                    type: $("#frmAddUser").attr("method"),
                    data: $("#frmAddUser").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                            location.reload();
                        }
                        if (resp === "ok") {
                            alertify.success('Usuario agregado exitosamente');
                            location.reload();
                        }
                        if (resp === "ko") {
                            alertify.error('Error! el email ya existe, ingrese uno valido diferente');
                        }
                    }
                });
            }
            function deleteUser(id) {
                alertify.confirm('Esta seguro de eliminar este usuario?, esta acción no podra ser removida.', function () {
                    url = get_base_url() + "Users/delete_user";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idUser: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en bbdd');
                            }
                            if (resp === "ok") {
                                alertify.success('Usuario eliminado');
                                location.reload();
                            }
                        }
                    })
                }, function () {
                    alertify.error('Acción cancelada');
                    location.reload();
                });
            }
        </script>
    </body>
</html>