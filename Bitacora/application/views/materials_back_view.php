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
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 nav-tabs-custom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation"><a href="<?= base_url('Projects/activitie_init') ?>" aria-controls="binnacle" role="tab" data-toggle="">Bandeja de entrada</a></li>
                                        <li role="presentation" class="active"><a href="<?= base_url('Projects/register_activities') ?>" aria-controls="binnacle" role="tab" data-toggle="">Registro de Actividad</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/gestion.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li><a href="#" style="color: white">.</a></li>
                                            <li class="active">
                                                <a href="#" style="color: #00B0F0">
                                                    <b>GESTIÓN DE AVANCE</b></a></li>
                                            <li><a href="#" style="color: white">.</a></li>
                                        </ul>
                                        <br><br>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                            <table>
                                                <tr>
                                                    <td>No. ORDEN: <label id="lblOrder"><?= $order->uniquecode ?></label></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <table>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Centro de Costos |</td>
                                                    <td>&nbsp;
                                                        <label id="lblCost"><?= $order->id ?></label>                                                           
                                                    </td>
                                                </tr>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Actividad &nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;|</td>
                                                    <td>&nbsp;<label id="lblActiv"><?= $order->name_activitie ?></label></td>
                                                </tr>
                                                <tr style="font-size: 12px;">
                                                    <td style="color: #00B0F0">| Sitio &nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;|</td>
                                                    <td>&nbsp;<label id="lblSite"><?= $order->site ?></label></td>
                                                </tr>
                                            </table>                                            
                                        </div><br><br><br><br><br><br>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                <p style="color: #00B0F0">TIPO DE GESTIÓN</p>
                                            </div>
                                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                                <input type="hidden" name="idOrderDaily" id="idOrderDaily" value="<?= $order->id ?>">
                                                <select class="form form-control" name="typegest" id="typegest">
                                                    <?php foreach ($types as $value) { ?>
                                                        <option value="<?= $value->id ?>"><?= $value->type ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div><br><br><br>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr style="color: #00B0F0">
                                                        <th>Descripción</th>
                                                        <th>Unidad de medida</th>
                                                        <th>Cantidad Base</th>
                                                        <th>Cantidad Devolución</th>
                                                        <th>Observaciones</th>
                                                        <th>Validar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($materials as $value) { ?>
                                                        <tr>
                                                            <td><input type="text" value="<?= $value->name_service ?>" readonly=""></td>
                                                            <td><input type="text" value="<?= $value->unit_measurement ?>" readonly=""></td>
                                                            <td><input type="number" value="<?= $value->count ?>" readonly=""></td>
                                                            <td><input type="number" name="countback" id="countback"></td>
                                                            <td><input value="<?= $value->observation ?>" readonly=""></td>
                                                            <td><a href="#" onclick="registerBack(<?= $value->id ?>)">
                                                                    <i class="fa fa-check fa-2x" style="color: green"><i>
                                                                            </a></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                        </tbody>
                                                                        </table>
                                                                        </div><br><br>
                                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <button type="button" class="btn btn-success" style="float:right;" onclick="register()">REGISTRAR AVANCE</button>
                                                                        </div>
                                                                        </div>                                    
                                                                        </div>
                                                                        </div>                          
                                                                        </div>
                                                                        </div>
                                                                        </section> 
                                                                        </div>
                                                                        <?php $this->load->view('templates/footer.html') ?>
                                                                        </div>    
                                                                        <!-- ./wrapper -->        
                                                                        <?php $this->load->view('templates/libs') ?>
                                                                        <?php $this->load->view('templates/js') ?>
                                                                        <script type="text/javascript">
                                                                            function registerBack(id) {
                                                                                var countBack = $("#countback").val();
                                                                                url = get_base_url() + "Projects/register_back_materials";
                                                                                $.ajax({
                                                                                    url: url,
                                                                                    type: 'POST',
                                                                                    data: {id: id, countBack: countBack},
                                                                                    success: function (resp) {
                                                                                        if (resp === "error") {
                                                                                            alertify.error('Error en BBDD');
                                                                                        }
                                                                                        if (resp === "ok") {
                                                                                            alertify.success('Devolución registrada.');
                                                                                        }
                                                                                    }
                                                                                });
                                                                            }

                                                                            function register() {
                                                                                var idOrderDaily = $("#idOrderDaily").val();
                                                                                var typegest = $("#typegest").val();
                                                                                url = get_base_url() + "Projects/register_daily_management";
                                                                                $.ajax({
                                                                                    url: url,
                                                                                    type: 'POST',
                                                                                    data: {idOrderDaily: idOrderDaily, typegest: typegest},
                                                                                    success: function (resp) {
                                                                                        if (resp === "error") {
                                                                                            alertify.error('Error en BBDD');
                                                                                        }
                                                                                        if (resp === "ok") {
                                                                                            alertify.success('Actividad registrada exitosamente.');
                                                                                            location.href = get_base_url() + 'Projects/register_activities';
                                                                                        }
                                                                                    }
                                                                                });
                                                                            }
                                                                        </script>
                                                                        </body>
                                                                        </html>
