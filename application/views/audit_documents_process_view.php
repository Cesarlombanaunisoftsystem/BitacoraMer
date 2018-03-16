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
                        <li><a href="<?= base_url('Documents/audit') ?>"><i class="fa fa-refresh"></i></a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation"><a href="<?= base_url('Documents/audit') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation" class="active"><a href="<?= base_url('Documents/audit_process') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registro de Actividad</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div id="spinner"></div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/docs.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table class="table table-striped" style="font-size: 12px">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Fecha de Asignación</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>
                                                    <th style="color: #00B0F0">Servicio</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Observaciones</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($orders) && $orders) {
                                                    foreach ($orders as $row) {
                                                        if ($row->historybackState === '1') {
                                                            $trcolor = '#FCF8E5';
                                                        } else {
                                                            $trcolor = '';
                                                        }
                                                        ?>                                            
                                                        <tr style="background-color:<?= $trcolor ?>">
                                                            <td><?= $row->dateAssign ?></td>
                                                            <td><a href="#" onclick="verPanelInferior(<?= $row->id ?>);"><u><?= $row->uniquecode ?></u></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>                                                
                                                            <td><?= $row->observations ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                      
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" id="panelinferior" hidden="">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#" style="color: #00B0F0"><b>DOCUMENTACIÓN</b></a></li>                                          
                                        </ul>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td style="color: #00B0F0">Fecha de cargue</td>
                                                    <td style="color: #00B0F0">Tipo de documento</td>
                                                    <td style="color: #00B0F0"></td>
                                                    <td style="color: #00B0F0">Observaciones</td>
                                                    <td style="color: #00B0F0">Acción</td>
                                                </tr>                                   
                                            </thead>
                                            <tbody id="bodyPanelDoc">  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                          
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

            function verPanelInferior(idOrder) {
                $('#bodyPanelDoc').empty();
                var state = "";
                $("#panelinferior").show();
                url = get_base_url() + "Documents/get_documents_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (response) {
                    $.each(response["res"], function (i, res) {
                        if (res.file === "") {
                            state = 'SIN DOCUMENTO';
                        } else {
                            state = 'CARGADO';
                        }
                        $('#bodyPanelDoc').append('<tr><td>' + res.dateSave +
                                '</td><td>' + res.name_type +
                                '</td><td>' +
                                '<a href="' + get_base_url() + "uploads/" +
                                res.file + '" target="blank" style="color:#00B0F0">Descargar</a>' +
                                '</td><td>' + res.observation + '</td><td>' +
                                '<a href="#"><img src="' + get_base_url() + 'dist/img/upfile.png"></a>' +
                                ' <a href="#">' + '<img src="' + get_base_url() + 'dist/img/editfile.png"></a>' +
                                ' <a href="#">' + '<img src="' + get_base_url() + 'dist/img/deletefile.png"></a>' +
                                '</td></tr>'
                                );
                        
                    });
                }
                );
            }
        </script>
    </body>
</html>
