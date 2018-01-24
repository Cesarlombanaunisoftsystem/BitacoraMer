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
                        <?= $titulo ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Panel de control</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="<?= base_url('Visit/program') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="<?= base_url('Visit/assigns') ?>" role="tab" data-toggle="">Visitas asignadas</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <img src="<?= base_url('dist/img/dates.jpg') ?>" style="width: 120px;">
                        </div>
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">                           
                            <table id="data-table" class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th style="color: #00B0F0"></th>
                                        <th style="color: #00B0F0">Fecha de ordén</th>
                                        <th style="color: #00B0F0">No. Ordén</th>
                                        <th style="color: #00B0F0">Actividad</th>
                                        <th style="color: #00B0F0">Servicio</th>
                                        <th style="color: #00B0F0">Técnico</th>
                                        <th style="color: #00B0F0">Observaciones</th>
                                        <th style="color: #00B0F0">Fecha Visita</th>
                                        <th style="color: #00B0F0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($visits) {
                                        foreach ($visits as $visit) {
                                            if ($visit->date != NULL) {
                                                $date = $visit->date;
                                            } else {
                                                $date = '<input type="date" id="date_' . $visit->id . '" size="15" required>';
                                            }
                                            ?> 
                                            <tr>
                                                <td><a href="javascript:return_order(<?= $visit->id ?>)"><i class="fa fa-undo" aria-hidden="true" style="color: orange"></i></a></td>
                                                <td><?= $visit->dateSave ?></td>
                                                <td><?= $visit->uniquecode ?></td>
                                                <td><?= $visit->name_activitie ?></td>
                                                <td><?= $visit->name_service ?></td>
                                                <td><select class="form-control" id="idTech_<?= $visit->id ?>">
                                                        <?php
                                                        foreach ($tecs as $tec) {
                                                            if ($visit->idTechnicals === $tec->id) {
                                                                ?>
                                                                <option value="<?= $tec->id ?>" selected><?= $tec->name_user ?>
                                                                </option>
                                                            <?php } else { ?>
                                                                <option value="<?= $tec->id ?>"><?= $tec->name_user ?>
                                                                </option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select></td>
                                                <td><?= $visit->observations ?></td>
                                                <td><?= $date ?></td>
                                                <td><a href="javascript:assign(<?= $visit->id ?>)"><i class="fa fa-check" aria-hidden="true" style="color: green"></i></a></td>
                                            </tr> 
                                        <?php }
                                    } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
<?php $this->load->view('templates/js') ?>
        <script type="text/javascript">
            $(function () {
                $("input").datepicker({dateFormat: 'yy-mm-dd'});
            });
            function assign(idOrder) {
                var idTech = $("#idTech_" + idOrder).val();
                var date = $("#date_" + idOrder).val();
                if (date === "") {
                    alertify.error('Debes indicar fecha de visita');
                } else {
                    url = get_base_url() + "Visit/assign";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idOrder: idOrder, idTech: idTech, date: date},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Erro en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Visita asignada al técnico exitosamente');
                                location.reload();
                            }
                        }
                    });
                }
            }
            function return_order(idOrder) {
                url = get_base_url() + "Visit/return_order_register";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Orden devuelta a registro exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>
    </body>
</html>