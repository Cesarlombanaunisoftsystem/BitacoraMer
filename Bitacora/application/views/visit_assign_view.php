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
                <div id="load_menu"></div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <input type="hidden" id="id" value=""/>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                           
                            <table id="data-table" class="table table-striped" style="font-size:12pt">
                                <thead>
                                    <tr>
                                        <th style="color: #00B0F0">Fecha de ordén</th>
                                        <th style="color: #00B0F0">Fecha procesado</th>
                                        <th style="color: #00B0F0">No. Ordén</th>
                                        <th style="color: #00B0F0">Servicio</th>
                                        <th style="color: #00B0F0">Tecnología</th>
                                        <th style="color: #00B0F0">Banda</th>
                                        <th style="color: #00B0F0">Sitio</th>
                                        <th style="color: #00B0F0">Observaciones</th>
                                        <th style="color: #00B0F0">Técnico</th>
                                        <th style="color: #00B0F0">Fecha Visita</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($visits) {
                                        foreach ($visits as $visit) {
                                            if ($visit->stateLog === '1') {
                                                $color = '#FCF8E5';
                                            } else {
                                                $color = '';
                                            }
                                            ?>                                            
                                            <tr style="background-color:<?= $color ?>">
                                                <td><?= $visit->dateSave ?></td>
                                                <td><?= $visit->dateLog ?></td>
                                                <td><?= $visit->uniquecode . "-" . $visit->coi ?></td>
                                                <td><?= $visit->name_activitie . " " . $visit->name_service ?></td>
                                                <td><?= $visit->name_service ?></td>
                                                <td><?= $visit->name_service ?></td>
                                                <td><?= $visit->site ?></td>
                                                <td><?= $visit->obsvLog ?></td>
                                                <td><?= $visit->name_user ?></td>
                                                <td><?= $visit->date ?></td>
                                            </tr>                                                                                    
                                        <?php }
                                    }
                                    ?>                                                                         
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

        <script>
            cargar_menu("programacion_visitas", 'Visitas asignadas');
        </script>
    </body>
</html>
