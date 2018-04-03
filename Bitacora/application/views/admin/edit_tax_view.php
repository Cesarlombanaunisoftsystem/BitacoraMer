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
                        Edición de impuesto
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/taxes'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditTax" action="javascript:editTax()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $tax->name_tax ?>" required=""> 
                            <input type="hidden" name="id" value="<?= $tax->id ?>">                            
                        </div>  
                        <div class="form-group">
                            <label for="name">Porcentaje</label>
                            <input type="number" class="form-control" name="percent" value="<?= $tax->percent_tax ?>" required="">
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
            function editTax() {
                url = get_base_url() + "Parametrization/edit_tax";
                $.ajax({
                    url: url,
                    type: $("#frmEditTax").attr("method"),
                    data: $("#frmEditTax").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Impuesto actualizado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>

