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
                                        <table class="table table-hover">
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
                                            <tbody id="bodytblpays"></tbody>
                                        </table>
                                        <div id="footpays"></div>
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
                                            <tbody id="bodytblmaterials"></tbody>
                                        </table>
                                        <div id="footmaterials"></div>
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
                                                    <th>
                                                        <select id="idActivities">
                                                            <option>Seleccionar:</option>
                                                            <?php foreach ($categories as $row) { ?>
                                                                <option value="<?= $row->id ?>"><?= $row->name_activitie ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </th>
                                                    <th><select id="idServices"></select><div id="price" hidden=""></div></th>
                                                    <th><a href="#" onclick="addAditionals();"><i class="fa fa-check-square" style="color: green"></i></a></th>
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
                                            <tbody id="bodytbladds"></tbody>
                                        </table>
                                        <div id="footadds"></div>
                                    </div><br>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10"></div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <button type="button" class="btn btn-primary" onclick="register()">Registrar</button>
                                    </div>
                                </div>
                            </div><br><br>


                            <div role="tabpanel" class="tab-pane" id="process">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/presup.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <table  id="data-table" class="table table-striped">
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
                var url, pdf = "";
                var url1, url2, url3, url4 = "";
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
                    $("#totalSale").html(vrVenta);
                    bruto = res.res.subtotal;
                    $("#bruto").html(bruto);
                    desc = res.res.discount;
                    $("#discount").html(desc);
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
                $("#bodytblcliente").empty();
                $("#tblPayContract").hide();
                $("#tblVrAditionals").hide();
                $("#tblVrMaterials").hide();
                $("#footpays").hide();
                $("#footmaterials").hide();
                $("#footadds").hide();
                $("#tblVentaCliente").show();
                $("#foot").show();
                var idOrder = $("#idOrder").val();
                var vrVenta = $("#totalSale").html();
                var vrBruto = $("#bruto").html();
                var vrVentaF = formatNumber(vrVenta);
                var vrBrutoF = formatNumber(vrBruto);
                var desc = $("#discount").html();
                var iva = vrVenta - vrBruto;
                var ivaF = formatNumber(iva);
                var url, url1, pdf = "";
                url = get_base_url() + "Settlement/getSaleHead?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    pdf = res.res.picture;
                });
                url1 = get_base_url() + "Settlement/getDetailsSale?jsoncallback=?";
                $.getJSON(url1, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["res"], function (i, res) {
                        var price = formatNumber(res.price);
                        var total = formatNumber(res.total);
                        $("#bodytblcliente").append('<tr style="font-size: 10pt;"><td>' + res.name_activitie +
                                '</td><td>' + res.name_service + '</td>\n\
                              <td>' + res.count + '</td><td>' + res.site + '</td><td>' +
                                price + '</td><td>' + total + '</td></tr>');
                    });
                    $("#foot").html('<table class="table"><tr style="font-size: 8pt"><td style="color: #00B0F0;">TOTAL BRUTO</td>' +
                            '<td>' + vrBrutoF + '</td><td style="color: #00B0F0;">DESCUENTO</td><td>' + desc + '</td>' +
                            '<td style="color: #00B0F0;">I.V.A</td><td>' + ivaF + '</td>' +
                            '<td style="color: #00B0F0;">TOTAL</td><td>' +
                            vrVentaF + '</td><td>' + '<a href="' + get_base_url() + "uploads/" + pdf + '" target="blank">' +
                            '<img src="' + get_base_url() + 'dist/img/iconoclip.png" style="width: 25px;margin-top: 10px;margin-right: 1px;margin-left: 7px;"></a></td>' +
                            '</tr></table>');

                });

            }

            function getDetailsPayContract() {
                $("#bodytblpays").empty();
                var idOrder = $("#idOrder").val();
                $("#tblVentaCliente").hide();
                $("#foot").hide();
                $("#footmaterials").hide();
                $("#footadds").hide();
                $("#tblVentaCliente").hide();
                $("#tblVrMaterials").hide();
                $("#tblVrAditionals").hide();
                $("#tblPayContract").show();
                $("#footpays").show();
                var percentEnt = 0;
                var vrpayent = 0;
                var percentAut = 0;
                var vrpayaut = 0;
                var total = 0;
                url = get_base_url() + "Settlement/getPayContract?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    total = res.res.pagoContract;
                });
                url1 = get_base_url() + "Settlement/getDetailsPays?jsoncallback=?";
                $.getJSON(url1, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["res"], function (i, res) {
                        var percent = formatNumber(res.percent);
                        var vrpay = formatNumber(res.value);
                        if (res.state === 0) {
                            percentEnt = percent;
                            vrpayent = vrpay;
                        } else {
                            percentAut = percent;
                            vrpayaut = vrpay;
                        }

                        $("#bodytblpays").append('<tr style="font-size: 10pt;"><td>' + res.dateSave +
                                '</td><td>PRESUPUESTO PL</td>\n\
                              <td>' + res.obsvpays + '</td><td>' + percentEnt + '</td><td>' +
                                vrpayent + '</td><td>' + percentAut + '</td><td>' +
                                vrpayaut + '</td></tr>');
                    });
                    $("#footpays").html('<table class="table"><tr style="font-size: 8pt"><td style="color: #00B0F0;">TOTAL</td>' +
                            '<td>' + total + '</td></tr></table>');

                });
            }

            function getDetailsMaterials() {
                $("#bodytblmaterials").empty();
                var idOrder = $("#idOrder").val();
                $("#tblVentaCliente").hide();
                $("#foot").hide();
                $("#footpays").hide();
                $("#footadds").hide();
                $("#tblPayContract").hide();
                $("#tblVrAditionals").hide();
                $("#tblVrMaterials").show();
                $("#footmaterials").show();
                var totalCount = 0;
                var totalCost = 0;
                var total = 0;
                url = get_base_url() + "Settlement/getPayMaterials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    total = res.res.vrMaterials;
                    totalF = formatNumber(total);
                });
                url = get_base_url() + "Settlement/getDetailsMaterials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["res"], function (i, res) {
                        totalCount = res.count - res.count_back;
                        totalCost = res.total_cost;
                        totalCostF = formatNumber(totalCost);
                        $("#bodytblmaterials").append('<tr style="font-size: 10pt;"><td>' + res.dateSave +
                                '</td><td>' + res.name_service + '</td>\n\
                              <td>' + res.count + '</td><td>' + res.unit_measurement + '</td><td>' +
                                res.dateInMaterial + '</td><td>' + totalCount + '</td><td>' +
                                res.observation + '</td><td>' + totalCostF + '</td></tr>');
                    });
                    $("#footmaterials").html('<table class="table"><tr style="font-size: 8pt"><td style="color: #00B0F0;">TOTAL</td>' +
                            '<td>' + totalF + '</td></tr></table>');

                });
            }

            function getDetailsAditionals() {
                $("#bodytbladds").empty();
                var idOrder = $("#idOrder").val();
                $("#tblVentaCliente").hide();
                $("#tblPayContract").hide();
                $("#tblVrMaterials").hide();
                $("#foot").hide();
                $("#footpays").hide();
                $("#footmaterials").hide();
                $("#tblVrAditionals").show();
                var vrAdds, vrAdd = 0;
                url = get_base_url() + "Settlement/getPayAditionals?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    vrAdds = res.res.vrAdds;
                    vrAdd = formatNumber(vrAdds);
                });
                url1 = get_base_url() + "Settlement/getDetailsAdd?jsoncallback=?";
                $.getJSON(url1, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["res"], function (i, res) {
                        $("#bodytbladds").append('<tr style="font-size: 10pt;"><td>' +
                                res.name_activitie + '</td><td>' + res.name_service +
                                '</td><td>' + '<input id="count_' + res.id + '" type="number" value="' +
                                res.count + '" onkeyup="updateCount(' + res.id + ')">' + '</td><td>' +
                                res.unit_measurement + '</td><td>' +
                                '<input id="cost_' + res.id + '" type="number" value="' + res.cost + '" disabled>' +
                                '</td><td>' +
                                '<input id="total_' + res.id + '" type="number" value="' + res.total_cost + '" disabled>' + '</td><td>' +
                                '<input id="obsv_' + res.id + '" type="text" value="' + res.observation +
                                '" onkeyup="updateObsv(' + res.id + ')">'
                                + '</td></tr>');
                    });
                    $("#footadds").html('<table class="table"><tr style="font-size: 8pt"><td style="color: #00B0F0;">TOTAL</td>' +
                            '<td>' + vrAdd + '</td></tr></table>');

                });
            }

            function register() {
                var idOrder = $("#idOrder").val();
                url = get_base_url() + "Settlement/register";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Liquidación registrada exitosamente.');
                            location.reload();
                        }
                    }
                });
            }

            function addAditionals() {
                var idOrder = $("#idOrder").val();
                var idActivities = $("#idActivities").val();
                var idServices = $("#idServices").val();
                var cost = $("#cost").val();
                var url = "";
                url = get_base_url() + "Settlement/addAditionals";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder: idOrder, idActivities: idActivities, idServices:
                                idServices, cost: cost},
                    success: function () {
                        location.reload();
                    }
                });
            }

            function updateCount(id) {
                var count = $("#count_" + id).val();
                var cost = $("#cost_" + id).val();
                var total_cost = count * cost;
                var url = "";
                url = get_base_url() + "Settlement/updateCount";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id: id, count: count, total_cost: total_cost},
                    success: function () {
                        location.reload();
                    }
                });
            }

            function updateObsv(id) {
                var obsv = $("#obsv_" + id).val();
                var url = "";
                url = get_base_url() + "Settlement/updateObsv";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id: id, obsv: obsv},
                    success: function () {
                        location.reload();
                    }
                });
            }
        </script>
    </body>
</html>
