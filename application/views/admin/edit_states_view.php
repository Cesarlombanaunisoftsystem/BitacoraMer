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
                        <li><a href="<?= base_url('Parametrization/times'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditState" action="javascript:editState()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $time->name_order_state ?>" required=""> 
                            <input type="hidden" name="id" value="<?= $time->id ?>">                            
                        </div>  
                        <div class="form-group">
                            <label for="state">Descripción</label>
                            <input type="text" class="form-control" name="desc" value="<?= $time->descripcion ?>" required="">
                        </div> 
                        <div class="form-group">
                            <label for="state">Días</label>
                            <input type="number" class="form-control" name="days" value="<?= $time->days ?>" required="">
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
            function editState() {
                url = get_base_url() + "Parametrization/edit_state";
                $.ajax({
                    url: url,
                    type: $("#frmEditState").attr("method"),
                    data: $("#frmEditState").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Estado actualizado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>
