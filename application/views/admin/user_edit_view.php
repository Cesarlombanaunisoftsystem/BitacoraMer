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
                        Edición de Usuario
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Users'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditUser" action="javascript:editUser()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre Completo</label>
                            <input type="text" class="form-control" name="name" value="<?= $perfil->name ?>" required="">
                            <input type="hidden" name="id" value="<?= $perfil->id ?>">                                
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $perfil->email ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="cel">Celular</label>
                            <input type="tel" class="form-control" name="cel" value="<?= $perfil->mobile ?>">
                        </div>
                        <div class="form-group">
                            <label for="tel">Telefono Fijo</label>
                            <input type="tel" class="form-control" name="tel" value="<?= $perfil->phone ?>">
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control" name="rol" required="">
                                <?php
                                foreach ($roles as $rol) {
                                    if ($perfil->idUserProfile === $rol->id) {
                                        ?>
                                        <option value="<?= $rol->id ?>" selected><?= $rol->name ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?= $rol->id ?>"><?= $rol->name ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>                       
                    </form>                 
                </section>
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            function editUser() {
                url = get_base_url() + "Users/edit_user";
                $.ajax({
                    url: url,
                    type: $("#frmEditUser").attr("method"),
                    data: $("#frmEditUser").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                            location.reload();
                        }
                        if (resp === "ok") {
                            alertify.success('Usuario actualizado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>
