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
                        Edición de actividad
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/get_activities'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditActivitie" action="javascript:editActivitie()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $activities->name_activitie ?>" required="">
                            <input type="hidden" name="id" value="<?= $activities->id ?>">                                
                        </div>
                        <div class="form-group">
                            <label for="obsv">Observaciones</label>
                            <textarea class="form-control" name="obvs"><?= $activities->observations ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select class="form-control" name="category" required="">
                                <?php
                                foreach ($categories as $category) {
                                    if ($activities->idOrderCategory === $category->id) {
                                        ?>
                                        <option value="<?= $category->id ?>" selected><?= $category->name_category ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?= $category->id ?>"><?= $category->name_category ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select class="form-control" name="state" required="">
                                <?php
                                foreach ($states as $state) {
                                    if ($activities->idState === $state->id) {
                                        ?>
                                        <option value="<?= $state->id ?>" selected><?= $state->name_state ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?= $state->id ?>"><?= $state->name_state ?>
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
            function editActivitie() {
                url = get_base_url() + "Parametrization/edit_activitie";
                $.ajax({
                    url: url,
                    type: $("#frmEditActivitie").attr("method"),
                    data: $("#frmEditActivitie").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
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