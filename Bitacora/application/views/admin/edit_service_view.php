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
                        Edición de servicio
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization/get_services'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <form id="frmEditService" action="javascript:editService()" method="post">                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" value="<?= $service->name_service ?>" required="">
                            <input type="hidden" name="id" value="<?= $service->id ?>">                                
                        </div>
                        <div class="form-group">
                            <label for="obsv">Observaciones</label>
                            <textarea class="form-control" name="obsv"><?= $service->observations ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" class="form-control" name="price" value="<?= $service->price ?>" required="">                                                           
                        </div>
                        <div class="form-group">
                                <label for="price">Unidad de medida</label>
                                <input type="text" class="form-control" name="unidadm" value="<?= $service->unit_measurement ?>" required=""/>
                            </div>
                        <div class="form-group">
                            <label for="tax">Impuesto</label>
                            <select class="form-control" name="tax" required="">
                                <?php
                                foreach ($taxes as $tax) {
                                    if ($service->idTask === $tax->id) {
                                        ?>
                                        <option value="<?= $tax->id ?>" selected><?= $tax->name_tax ?> <?= $tax->percent_tax ?>%
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?= $tax->id ?>"><?= $tax->name_tax ?> <?= $tax->percent_tax ?>%
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="activitie">Actividad</label>
                            <select class="form-control" name="activitie" required="">
                                <?php
                                foreach ($activities as $activitie) {
                                    if ($service->idActivitie === $activitie->id) {
                                        ?>
                                        <option value="<?= $activitie->id ?>" selected><?= $activitie->name_activitie ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?= $activitie->id ?>"><?= $activitie->name_activitie ?>
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
                                    if ($service->idState === $state->id) {
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
            function editService() {
                url = get_base_url() + "Parametrization/edit_service";
                $.ajax({
                    url: url,
                    type: $("#frmEditService").attr("method"),
                    data: $("#frmEditService").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Servicio actualizado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>        
    </body>
</html>
