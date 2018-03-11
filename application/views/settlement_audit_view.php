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
                                        <img src="<?= base_url('dist/img/auditsetlement.png') ?>" style="width: 120px;">
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
                                                    <th></th><th></th>
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
                                                            <td><a href="#"><i class="fa fa-check-square" style="color: green"></i></a></td>
                                                            <td><a href="#"><i class="fa fa-undo" style="color: red"></i></a></td>
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
                                        <img src="<?= base_url('dist/img/auditsetlement.png') ?>" style="width: 120px;">
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
                                                    <th style="color: #00B0F0">FECHA LIQ</th>                                                    
                                                    <th style="color: #00B0F0">ACCIÓN</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($process) && $process) {
                                                    foreach ($process as $row) {
                                                        ?>                                            
                                                        <tr  style="font-size: 10pt">
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><?= $row->uniquecode ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->name_service ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->dateSettlement ?></td>
                                                            <td><?= $row->historybackState ?></td>                                                           
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
                    var vrVentaMil = formatNumber(vrVenta);
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
                $("#tblVrAditionals").hide();
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

            function getDetailsAditionals() {
                $("#bodytbladds").empty();
                var idOrder = $("#idOrder").val();
                $("#tblVentaCliente").hide();
                $("#foot").hide();
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
                                res.count + '" disabled>' + '</td><td>' +
                                res.unit_measurement + '</td><td>' +
                                '<input id="cost_' + res.id + '" type="number" value="' + res.cost + '" disabled>' +
                                '</td><td>' +
                                '<input id="total_' + res.id + '" type="number" value="' + res.total_cost + '" disabled>' + '</td><td>' +
                                '<input id="obsv_' + res.id + '" type="text" value="' + res.observation +
                                '" disabled>'
                                + '</td></tr>');
                    });
                    $("#footadds").html('<table class="table"><tr style="font-size: 8pt"><td style="color: #00B0F0;">TOTAL</td>' +
                            '<td>' + vrAdd + '</td></tr></table>');

                });
            }
        </script>
    </body>
</html>
