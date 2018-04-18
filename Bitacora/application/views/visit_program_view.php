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
                <div id="load_menu" style="margin-top: 10px"></div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">                           
                            <table id="data-table" class="table table-striped">
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
                                                $date = '<input type="date" class="form form-control" id="date_' . $visit->id . '"  min="' . date("Y-m-d") . '" value="' . $visit->dateAssign . '" required>';
                                            } else {
                                                $date = '<input type="date" class="form form-control" id="date_' . $visit->id . '"  min="' . date("Y-m-d") . '" required>';
                                            }
                                            if ($visit->historybackState === '1') {
                                                $trcolor = '#FCF8E5';
                                            } else {
                                                $trcolor = '';
                                            }
                                            ?> 
                                            <tr style="background-color:<?= $trcolor ?>">
                                                <td><?php
                                                    if ($visit->idOrderState === '20') {
                                                        $text = "SOLICITUD VISITA DE CIERRE: ";
                                                        echo "";
                                                    } else {
                                                        $text = "";
                                                        ?>
                                                        <a href="javascript:return_order(<?= $visit->id ?>)">
                                                            <i class="fa fa-undo" aria-hidden="true" style="color: orange">                                                        
                                                            </i>
                                                        </a><?php } ?>
                                                </td>
                                                <td><?= $visit->dateSave ?></td>
                                                <td><?= $visit->uniquecode."-".$visit->coi ?></td>
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
                                                <td><textarea class="form form-control" id="obsv_<?= $visit->id ?>"><?= $text.$visit->observations ?></textarea></td>
                                                <td><?= $date ?></td>
                                                <td><a href="javascript:assign(<?= $visit->id . "," . $visit->idOrderState ?>)"><i class="fa fa-check" aria-hidden="true" style="color: green"></i></a></td>
                                            </tr> 
                                            <?php
                                        }
                                    }
                                    ?> 
                                </tbody>
                            </table>
                            <div id="spinner"></div>
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

            function assign(idOrder, state) {
                var idTech = $("#idTech_" + idOrder).val();
                var date = $("#date_" + idOrder).val();
                var obsv = $("#obsv_" + idOrder).val();
                if (date === "") {
                    alertify.error('Debes indicar fecha de visita');
                } else {
                    $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                    $.ajax({
                        url: "assign",
                        type: 'POST',
                        data: {idOrder: idOrder, state: state, idTech: idTech, obsv: obsv, date: date},
                        success: function (resp) {
                            $('#spinner').html("");
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Visita asignada al técnico exitosamente, correo de aviso enviado.');
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
            
            cargar_menu("programacion_visitas",'Bandeja de entrada');
        </script>
    </body>
</html>
