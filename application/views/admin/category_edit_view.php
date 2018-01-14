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
                        Edición de Categoria
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/get_categories'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditCategory" action="javascript:editCategory()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $category->name ?>" required="">
                            <input type="hidden" name="id" value="<?= $category->id ?>">                                
                        </div>
                        <div class="form-group">
                            <label for="desc">Descripción</label>
                            <textarea class="form-control" name="desc" required=""><?= $category->description ?></textarea>
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
            function editCategory() {
                url = get_base_url() + "Parametrization/edit_category";
                $.ajax({
                    url: url,
                    type: $("#frmEditCategory").attr("method"),
                    data: $("#frmEditCategory").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                            location.reload();
                        }
                        if (resp === "ok") {
                            alertify.success('Categoria actualizada exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>

