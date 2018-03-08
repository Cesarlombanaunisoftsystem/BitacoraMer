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
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-hover">
                                            <thead>
                                                <tr style="font-size: 10pt">
                                                    <th style="color: #00B0F0">Fecha de ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>                                                    
                                                    <th style="color: #00B0F0">Servicio</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Técnico</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($data) && $data) {
                                                    foreach ($data as $row) {
                                                        ?>                                            
                                                        <tr style="font-size: 10pt" onclick="getSettlement(<?= $row->id ?>)">
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><?= $row->uniquecode ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="list" hidden>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">                                    
                                    <table class="table">
                                        <thead>                                       
                                            <tr style="font-size: 10pt">
                                                <th style="color: orange">LIQUIDACIÓN</th>
                                                <th style="color: #00B0F0">Valor Venta $</th>
                                                <th id="vrVenta"></th>
                                                <th style="color: #00B0F0">Total Costos $</th>
                                                <th id="tltCostos"></th>
                                                <th style="color: #00B0F0">% Utilidad</th>
                                                <th id="utilidad"></th>
                                                <th style="color: #00B0F0">Valor Utilidad $</th>
                                                <th id="vrUtilidad"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #0174DF; font-size: 10pt; color: white">
                                                <th style="border-radius: 10px" id="divVrVenta"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #0174DF; font-size: 10pt; color: white">
                                                <th style="border-radius: 10px" id="divVrContract"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #0174DF; font-size: 10pt; color: white">
                                                <th style="border-radius: 10px" id="divVrMaterials"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #0174DF; font-size: 10pt; color: white">
                                                <th style="border-radius: 10px" id="divVrAditionals"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="process">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Fecha de ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>                                                    
                                                    <th style="color: #00B0F0">Servicio</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Técnico</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($process) && $process) {
                                                    foreach ($process as $row) {
                                                        ?>                                            
                                                        <tr>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><?= $row->uniquecode ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?></td>                                                           
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
            function getSettlement(idOrder) {
                $("#vrVenta").html("");
                $("#tltCostos").html("");
                $("#utilidad").html("");
                $("#vrUtilidad").html("");
                $("#divVrVenta").html("");
                $("#divVrContract").html("");
                $("#divVrMaterials").html("");
                $("#divVrAditionals").html("");
                $("#list").show();
                url = get_base_url() + "Settlement/getSettlement?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    var vrVenta = res.res.vrVenta;
                    var vrCostos = res.res.vrCostos;
                    var rest = vrVenta - vrCostos;
                    var percent = (rest * 100) / vrVenta;
                    var percent2deci = percent.toFixed(2);
                    var vrVentaMil = formatNumber(vrVenta);
                    var vrCostosMil = formatNumber(vrCostos);
                    var restMil = formatNumber(rest);
                    $("#divVrVenta").html("VALOR TOTAL VENTA PARA CLIENTE\n\
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ " + vrVentaMil);
                    $("#vrVenta").html(vrVentaMil);
                    $("#tltCostos").html(vrCostosMil);
                    $("#utilidad").html(percent2deci);
                    $("#vrUtilidad").html(restMil);
                });
                url2 = get_base_url() + "Settlement/getPayContract?jsoncallback=?";
                $.getJSON(url2, {idOrder: idOrder}).done(function (res) {
                    var vrPays = res.res.pagoContract;
                    var vrPay = formatNumber(vrPays);
                    $("#divVrContract").html("VALOR TOTAL PAGO A CONTRATISTA\n\
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ " + vrPay);
                });
                url3 = get_base_url() + "Settlement/getPayMaterials?jsoncallback=?";
                $.getJSON(url3, {idOrder: idOrder}).done(function (res) {
                    var vrMaterials = res.res.vrMaterials;
                    var vrMaterial = formatNumber(vrMaterials);
                    $("#divVrMaterials").html("VALOR TOTAL DE MATERIALES\n\
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;$ " + vrMaterial);
                });
                url4 = get_base_url() + "Settlement/getPayAditionals?jsoncallback=?";
                $.getJSON(url4, {idOrder: idOrder}).done(function (res) {
                    var vrAdds = res.res.vrAdds;
                    var vrAdd = formatNumber(vrAdds);
                    $("#divVrAditionals").html("VALOR TOTAL ADICIONALES\n\
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ " + vrAdd);
                });
            }

            function formatNumber(num) {
                if (!num || num === 'NaN')
                    return '-';
                if (num === 'Infinity')
                    return '&#x221e;';
                num = num.toString().replace(/\$|\,/g, '');
                if (isNaN(num))
                    num = "0";
                sign = (num === (num = Math.abs(num)));
                num = Math.floor(num * 100 + 0.50000000001);
                num = Math.floor(num / 100).toString();

                for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                    num = num.substring(0, num.length - (4 * i + 3)) + '.' +
                        num.substring(num.length - (4 * i + 3));
                return (((sign) ? '' : '') + num);
            }
        </script>
    </body>
</html>
