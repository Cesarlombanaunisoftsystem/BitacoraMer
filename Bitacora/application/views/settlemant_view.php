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
                                    <input type="hidden" id="idOrder">                                    
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
                                            <tr style="background-color: #0174DF; font-size: 10pt; color: white" onclick="getDetailsSale()">
                                                <th style="border-radius: 10px" id="divVrVenta">
                                                    <div hidden id="bruto"></div><div hidden id="discount"></div>                                                    
                                                </th>
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
                                    </table>
                                    <div id="foot"></div>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #0174DF; font-size: 10pt; color: white" onclick="getDetailsPayContract()">
                                                <th style="border-radius: 10px" id="divVrContract"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table" id="tblPayContract" style="border-radius: 10px;" hidden>
                                        <thead>                                       
                                            <tr style="font-size: 10pt">
                                                <th style="color: #00B0F0">Fecha de Pago</th>
                                                <th style="color: #00B0F0">Area Origén</th>
                                                <th style="color: #00B0F0">Observaciones</th>
                                                <th style="color: #00B0F0">% Entregado</th>
                                                <th style="color: #00B0F0">Vr.Entregado</th>
                                                <th style="color: #00B0F0">% Autorizado</th>
                                                <th style="color: #00B0F0">Vr.Autorizado</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><br>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <table class="table">
                                        <thead>
                                            <tr style="background-color: #0174DF; font-size: 10pt; color: white" onclick="getDetailsMaterials()">
                                                <th style="border-radius: 10px" id="divVrMaterials"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table" id="tblVrMaterials" style="border-radius: 10px;" hidden>
                                        <thead>                                       
                                            <tr style="font-size: 10pt">
                                                <th style="color: #00B0F0">Fecha de Solicitud</th>
                                                <th style="color: #00B0F0">Descripción</th>
                                                <th style="color: #00B0F0">Cantidad</th>
                                                <th style="color: #00B0F0">Unidad de Medida</th>
                                                <th style="color: #00B0F0">Fecha Entrega</th>
                                                <th style="color: #00B0F0">Cantidad Entregada</th>
                                                <th style="color: #00B0F0">Observaciones</th>
                                                <th style="color: #00B0F0">Vr.Material</th>
                                            </tr>
                                        </thead>
                                    </table>
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
                                            <tr>
                                                <th><input type="text"></th>
                                                <th><input type="text"></th>
                                            </tr>
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
                var vrVenta = 0;
                var bruto = 0;
                var desc = 0;
                var url = "";
                var url1 = "";
                $("#tblVentaCliente").hide();
                $("#tblPayContract").hide();
                $("#idOrder").val(idOrder);
                $("#vrVenta").html("");
                $("#tltCostos").html("");
                $("#utilidad").html("");
                $("#vrUtilidad").html("");
                $("#divVrVenta").html("");
                $("#divVrContract").html("");
                $("#divVrMaterials").html("");
                $("#divVrAditionals").html("");
                $("#list").show();
                url = get_base_url() + "Settlement/getSaleHead?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    vrVenta = res.res.total;
                    bruto = res.res.subtotal;
                    desc = res.res.discount;
                });
                url1 = get_base_url() + "Settlement/getSettlement?jsoncallback=?";
                $.getJSON(url1, {idOrder: idOrder}).done(function (res) {
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

                $("#bruto").html(bruto);
                $("#discount").html(desc);
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

            function getDetailsSale() {
                $("#tblVentaCliente").empty();
                var idOrder = $("#idOrder").val();
                var vrVenta = $("#vrVenta").html();
                var vrBruto = $("#bruto").val();
                var desc = $("#discount").val();
                url = get_base_url() + "Settlement/getDetailsSale?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["res"], function (i, res) {
                        var price = formatNumber(res.price);
                        var total = formatNumber(res.total);
                        $("#tblVentaCliente").append('<tbody><tr style="font-size: 10pt;"><td>' + res.name_activitie +
                                '</td><td>' + res.name_service + '</td>\n\
                              <td>' + res.count + '</td><td>' + res.site + '</td><td>' +
                                price + '</td><td>' + total + '</td></tr></tbody>');
                    });
                    $("#foot").html('<table class="table"><tr><td style="color: #00B0F0; font-size: 8pt;">TOTAL BRUTO</td>' +
                            '<td>' + vrBruto + '</td><td style="color: #00B0F0; font-size: 8pt;">DESCUENTO</td><td>' + desc + '</td>' +
                            '<td style="color: #00B0F0; font-size: 8pt;">I.V.A</td><td></td>' +
                            '<td style="color: #00B0F0; font-size: 8pt;">TOTAL</td><td>' +
                            vrVenta + '</td><td>file</td>' +
                            '</tr></table>');

                });
                $("#tblPayContract").hide();
                $("#tblVentaCliente").hide();
                $("#tblVrAditionals").hide();
                $("#tblVentaCliente").show();

            }

            function getDetailsPayContract() {
                var idOrder = $("#idOrder").val();
                $("#tblVentaCliente").hide();
                $("#tblVentaCliente").hide();
                $("#tblVrAditionals").hide();
                $("#tblPayContract").show();
            }

            function getDetailsMaterials() {
                var idOrder = $("#idOrder").val();
                $("#tblVentaCliente").hide();
                $("#tblPayContract").hide();
                $("#tblVrAditionals").hide();
                $("#tblVrMaterials").show();
            }

            function getDetailsAditionals() {
                var idOrder = $("#idOrder").val();
                $("#tblVentaCliente").hide();
                $("#tblPayContract").hide();
                $("#tblVrMaterials").hide();
                $("#tblVrAditionals").show();
            }
        </script>
    </body>
</html>
