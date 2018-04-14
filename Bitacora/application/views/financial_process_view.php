<html>
    <head>
        <?php $this->load->view('templates/head') ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <input type="hidden" id="state">
        <div class="wrapper">
            <?php $this->load->view('templates/header') ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('templates/menu-right') ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class = "active">Panel de control</li>
                    </ol>
                </section>
                <div id="load_menu"></div>

                <!--Main content -->
                <section class = "content">
                    <div class = "row">
                        <div class = "tab-content">                            
                            <div role="tabpanel" class="tab-pane active" id="pagosges">
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-md-offset-1 col-lg-10">
                                        <form>
                                            <table id="data-table" class="table table-striped" style="font-size:12px">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th style="color: #00B0F0">Fecha de Pago</th>
                                                        <th style="color: #00B0F0">No. Ordén</th>
                                                        <th style="color: #00B0F0">Centro de Costos</th>
                                                        <th style="color: #00B0F0">Proveedor</th>
                                                        <th style="color: #00B0F0">Vr.IVA</th>
                                                        <th style="color: #00B0F0">Valor Retenciones</th>
                                                        <th style="color: #00B0F0">Vr.Descuentos</th>
                                                        <th style="color: #00B0F0">Vr.Total Pagado</th>
                                                    </tr>                                   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($pays_process) && $pays_process) {
                                                        foreach ($pays_process as $row) {
                                                            ?>
                                                            <tr>
                                                                <td class="details-control" id="<?= $row->uniqueCodeCentralCost ?>">
                                                                    <i class="fa fa-plus-square-o"></i>
                                                                </td>
                                                                <td><?= $row->dateSave ?></td>
                                                                <td><?= $row->uniquecode . '-' . $row->coi ?></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                                <td><?= $row->name_user ?></td>
                                                                <td><?php
                                                                    $iva = $row->sumdo * 0.19;
                                                                    setlocale(LC_MONETARY, 'es_CO');
                                                                    echo money_format('%.2n', $iva);
                                                                    ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><?php
                                                                    setlocale(LC_MONETARY, 'es_CO');
                                                                    echo money_format('%.2n', $row->sumdo);
                                                                    ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
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
            $('#data-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                order_id = $(this).attr("id");
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).html('<i class="fa fa-plus-square-o"></i>');
                } else {
                    getPays(order_id);
                    closeOpenedRows(dt, tr);
                    $(this).html('<i class="fa fa-minus-square-o"></i>');
                    row.child(format(order_id)).show();
                    tr.addClass('shown');
                    openRows.push(tr);
                }
            });
            function format(d) {
                return '<div style=""><table cellpadding="5" class="table table-hover tbl-detail" cellspacing="0" border="0" style="padding-left:50px;">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Fecha de pago</th>' +
                        '<th>Valor</th>' +
                        '<th>Porcentaje</th><th>PDF</th></tr><thead>' +
                        '<tbody id="tbody_' + d + '"></tbody>' +
                        '</table></div>';
            }

            function getPays(idOrder) {
                $("#tbody_" + idOrder).empty();
                url = get_base_url() + "Audit/history_assign_percent?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $.each(res["pays"], function (i, pay) {
                        $("#tbody_" + idOrder).append('<tr>' +
                                '<td>' + pay.dateSave + '</td>' +
                                '<td>' + formatNumber(pay.value) + '</td>' +
                                '<td>' + pay.percent + '%</td>'+
                                '<td><a href="<?= base_url('reportes/pdf/') ?>orden_'+pay.idPay+'.pdf" target="_blank"><i class="fa fa-2x fa-file-pdf-o" aria-hidden="true"></i><a></td></tr>'
                                        );
                    });
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
                return (((sign) ? '' : '') + '$ ' + num);
            }
            
            cargar_menu("financiero",'Pagos Gestionados');
            
            function validar_existe(idPay){
                $.ajax({
                    url:'/reportes/pdf/orden_'+idPay+'.pdf',
                    type:'HEAD',
                    error: function()
                    {
                        return false
                    },
                    success: function()
                    {
                        return true;
                    }
                });
                
            }
            
        </script>
    </body>
</html>

