<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('templates/head') ?>
        <script src="https://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
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
                        <?= $titulo ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <textarea name="descripcion"></textarea>
                            <script>CKEDITOR.replace('descripcion');</script>                           
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="frmTree">
                                <div class="form-group">
                                    <label for="selService">Seleccione servicio a configurar:</label>
                                    <select class="form-control" id="selService" name="selService">
                                        <option>Seleccionar</option>
                                        <?php foreach ($services as $value) { ?>
                                            <option value="<?= $value->id ?>"><?= $value->name_service ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtTree">Pegue el html generado en el editor para el arbol de archivos:</label>
                                    <input type="text" class="form-control" id="txtTree" name="txtTree" placeholder="Ej: <li>GSM<ul>Registro Fotográfico</ul><ul>Registro Operativo</ul></li><li>LTE<ul>Registro Fotográfico</ul><ul>Registro Operativo</ul></li>...">
                                </div>
                                <div class="form-group">
                                    <label for="txtPath">Indique directorios separados por comas con los nombres creados en la lista de arbol:</label>
                                    <input type="text" class="form-control" id="txtPath" name="txtPath" placeholder="Ej: GSM/Registro Fotográfico,GSM/Registro Operativo,LTE/Registro Fotográfico,LTE/Registro Operativo,..">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </form>                           
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
        <script type="text/javascript">
            $(function () {
                $("#frmTree").on("submit", function (e) {
                    e.preventDefault();
                    var url = get_base_url() + "Parametrization/register_path_tree";
                    if ($("#txtPath").val() !== " ") {
                        url = get_base_url() + "Parametrization/update_path_tree";
                    }
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $("#frmTree").serialize()
                    }).done(function (res) {
                        if (res === "error") {
                            $.alert({
                                title: 'Alerta!',
                                content: 'Error en bbdd!',
                            });
                        }
                        if (res === "ok") {
                            $.alert({
                                title: 'Exito!',
                                content: 'Configuración registrada exitosamente!',
                                location.reload();
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>
