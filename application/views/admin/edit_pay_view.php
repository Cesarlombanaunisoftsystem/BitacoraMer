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
                        Edición de metodo de pago
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/payment_methods'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditPay" action="javascript:editPay()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $pay->name_pay ?>" required=""> 
                            <input type="hidden" name="id" value="<?= $pay->id ?>">                            
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
            function editPay() {
                url = get_base_url() + "Parametrization/edit_pay";
                $.ajax({
                    url: url,
                    type: $("#frmEditPay").attr("method"),
                    data: $("#frmEditPay").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Metodo de pago actualizado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>

