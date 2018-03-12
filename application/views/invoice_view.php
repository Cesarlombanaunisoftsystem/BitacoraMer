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
                                        <li role="presentation" class="active"><a href="#bandeja" aria-controls="binnacle" role="tab" data-toggle="tab">Bandeja de entrada</a></li>
                                        <li role="presentation"><a href="#process" aria-controls="binnacle" role="tab" data-toggle="tab">Registros Procesados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/invoice.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr style="font-size: 10pt">
                                                    <th style="color: #00B0F0">Fecha de ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Valor de Ordén</th>
                                                    <th style="color: #00B0F0">FDC</th>
                                                    <th style="color: #00B0F0">Fecha FDC</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($data) && $data) {
                                                    foreach ($data as $row) {
                                                        ?>                                            
                                                        <tr style="font-size: 10pt">
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><a href="#" onclick="register(<?= $row->id ?>)"><u><?= $row->uniquecode ?></u></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->total ?></td>
                                                            <td><?= $row->fdc ?></td>
                                                            <td><?= $row->dateFdc ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="list" hidden>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <input type="hidden" id="idOrder">                                    
                                        <table class="table">
                                            <thead>                                       
                                                <tr style="font-size: 10pt">
                                                    <th style="color: orange">LIQUIDACIÓN</th>
                                                    <th style="color: #00B0F0">Valor Proyecto $</th>
                                                    <th id="vrVenta"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table class="table">
                                            <thead>
                                                <tr style="background-color: #0174DF; font-size: 10pt; color: white" onclick="getDetailsSale()">
                                                    <th style="border-radius: 10px" id="divVrVenta">                                                    
                                                    </th>
                                            <div hidden id="totalSale"></div>
                                            <div hidden id="bruto"></div>
                                            <div hidden id="discount">
                                                </tr>
                                                </thead>
                                        </table>
                                        <table class="table" id="tblVentaCliente" style="border-radius: 10px;" hidden>
                                            <thead>                                       
                                                <tr style="font-size: 10pt">
                                                    <th style="color: #00B0F0">ACTIVIDAD</th>
                                                    <th style="color: #00B0F0">SERVICIO</th>
                                                    <th style="color: #00B0F0">CANTIDAD</th>
                                                    <th style="color: #00B0F0">SITIO</th>
                                                    <th style="color: #00B0F0">VR.UNITARIO</th>
                                                    <th style="color: #00B0F0">VR.TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodytblcliente"></tbody>
                                        </table>
                                        <div id="foot"></div>
                                    </div><br>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table class="table">
                                            <thead>
                                                <tr style="background-color: #0174DF; font-size: 10pt; color: white" onclick="getDetailsAditionals()">
                                                    <th style="border-radius: 10px" id="divVrAditionals"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <table class="table" id="tblVrAditionals" style="border-radius: 10px;" hidden>
                                            <thead>
                                                <tr style="font-size: 10pt">
                                                    <th style="color: #00B0F0">Categoria</th>
                                                    <th style="color: #00B0F0">Producto/Servicio</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Unidad de Medida</th>
                                                    <th style="color: #00B0F0">Valor Unitario</th>
                                                    <th style="color: #00B0F0">Valor Total</th>
                                                    <th style="color: #00B0F0">Observaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodytbladds"></tbody>
                                        </table>
                                        <div id="footadds"></div>
                                    </div><br>
                                </div>
                            </div><br><br>

                            <div role="tabpanel" class="tab-pane" id="process">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/invoice.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-striped">
                                            <thead>
                                                <tr style="font-size: 10pt">
                                                    <th style="color: #00B0F0">Fecha de ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>                                                    
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Valor de Ordén</th>
                                                    <th style="color: #00B0F0">FDC</th>                                                    
                                                    <th style="color: #00B0F0">Fecha FDC</th>
                                                    <th style="color: #00B0F0">No.Factura</th>
                                                    <th style="color: #00B0F0">Fecha Factura</th>
                                                    <th style="color: #00B0F0">Estado Pago</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($process) && $process) {
                                                    foreach ($process as $row) {
                                                        if ($row->stateInvoice === '1') {
                                                            $tdstate = 'CANCELADA';
                                                        } else {
                                                            $tdstate = '<select onchange="cancel(' . $row->id . ')">'
                                                                    . '<option selected>PENDIENTE</option>'
                                                                    . '<option>CANCELADA'
                                                                    . '</option>'
                                                                    . '</select>';
                                                        }
                                                        ?>                                            
                                                        <tr  style="font-size: 10pt">
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><?= $row->uniquecode ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->total ?></td>
                                                            <td><?= $row->fdc ?></td>
                                                            <td><?= $row->dateFdc ?></td>
                                                            <td><?= $row->invoice ?></td>
                                                            <td><?= $row->dateInvoice ?></td>
                                                            <td><?= $tdstate ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
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

            function register(id) {
                $.confirm({
                    title: 'Facturar!',
                    content: '' +
                            '<form action="" class="formName">' +
                            '<div class="form-group">' +
                            '<label>Número Factura</label>' +
                            '<input type="text" placeholder="No Factura" class="fdm form-control" required />' +
                            '</div>' +
                            '</form>',
                    buttons: {
                        formSubmit: {
                            text: 'Aceptar',
                            btnClass: 'btn-blue',
                            action: function () {
                                var fdm = this.$content.find('.fdm').val();
                                if (!fdm) {
                                    $.alert('Debe ingresar número de factura');
                                    return false;
                                }
                                url = get_base_url() + "Billing/register";
                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: {idOrder: id, state: 28, fdm: fdm},
                                    success: function (resp) {
                                        if (resp === "error") {
                                            alertify.error('Error en BBDD');
                                        }
                                        if (resp === "ok") {
                                            alertify.success('Factura Procesada');
                                            location.reload();
                                        }
                                    }
                                });
                            }
                        },
                        cancelar: function () {
                            location.reload();
                        }
                    }
                });
            }

            function cancel(id) {
                url = get_base_url() + "Billing/cancel";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: id},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Factura Cancelada');
                            location.reload();
                        }
                    }
                });
            }
        </script>
    </body>
</html>
