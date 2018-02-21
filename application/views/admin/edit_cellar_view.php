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
                        <?= $titulo?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/cellars'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditCellar" action="javascript:editCellar()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $cellar->name_cellar ?>" required=""> 
                            <input type="hidden" name="id" value="<?= $cellar->id ?>">                            
                        </div>  
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <select class="form-control" name="state" required="">
                                <?php
                                foreach ($states as $state) {
                                    if ($area->idState === $state->id) {
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
            function editArea() {
                url = get_base_url() + "Parametrization/edit_cellar";
                $.ajax({
                    url: url,
                    type: $("#frmEditCellar").attr("method"),
                    data: $("#frmEditCellar").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Bodega actualizada exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>
