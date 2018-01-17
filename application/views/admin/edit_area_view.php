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
                        Edición de área
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/areas'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditArea" action="javascript:editArea()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $area->name_area ?>" required=""> 
                            <input type="hidden" name="id" value="<?= $area->id ?>">                            
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
                url = get_base_url() + "Parametrization/edit_area";
                $.ajax({
                    url: url,
                    type: $("#frmEditArea").attr("method"),
                    data: $("#frmEditArea").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Área actualizada exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>
