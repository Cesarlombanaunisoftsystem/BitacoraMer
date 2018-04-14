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
                            <div role = "tabpanel" class = "tab-pane active" id = "bandeja">
                                <div class = "row">
                                    <input type = "hidden" id = "id" value = ""/>
                                    <div class = "col-xs-10 col-sm-10 col-md-10 col-md-offset-1 col-lg-10">
                                        <table id = "data-table" class = "table table-striped" style = "font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th style = "color: #00B0F0">No. Ordén</th>
                                                    <th style = "color: #00B0F0">Centro de Costos</th>
                                                    <th style = "color: #00B0F0">Actividad</th>
                                                    <th style = "color: #00B0F0">Cantidad</th>
                                                    <th style = "color: #00B0F0">Sitio</th>
                                                    <th style = "color: #00B0F0">Técnico</th>
                                                    <th style = "color: #00B0F0">Vr.Total-Orden</th>
                                                    <th style = "color: #00B0F0">% Autorizado</th>
                                                    <th style = "color: #00B0F0">Vr Autorizado</th>
                                                    <th style = "color: #00B0F0">Pagar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($pays) && $pays) {
                                                    foreach ($pays as $row) {
                                                        ?>                                            
                                                        <tr>
                                                            <td><input type="hidden" value="<?= $row->idTechnicals ?>" name="idpay<?= $row->id ?>"><?= $row->uniquecode . '-' . $row->coi ?></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?></td>
                                                            <td><?= $row->name_activitie ?></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?></td>
                                                            <td><?php
                                                                setlocale(LC_MONETARY, 'es_CO');
                                                                echo money_format('%.2n', $row->totalCost)
                                                                ?></td>
                                                            <td><?= $row->percent ?>%</td>
                                                            <td><?php
                                                                setlocale(LC_MONETARY, 'es_CO');
                                                                echo money_format('%.2n', $row->value)
                                                                ?></td>
                                                            <td><input type="checkbox" class="form-check-input" id="chk<?= $row->uniqueCodeCentralCost ?>" value="<?= $row->value ?>" onclick="if (this.checked)
                                                                                sumar(this.value,<?= $row->percent ?>,<?= $row->uniqueCodeCentralCost ?>,<?= $row->idTechnicals ?>,<?= $row->id ?>);
                                                                            else
                                                                                restar(this.value,<?= $row->uniqueCodeCentralCost ?>)"></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-3">
                                                <label class="color-blue">SELECCIÓN TOTAL A PAGAR</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="hidden" id="totalhidden">  
                                                <input type="text" class="form-control" style="color: red; text-align: center" id="total" readonly/>  
                                            </div>
                                        </div>
                                        <br><br>
                                        <form id="miform" method="post" action="process_pays">
                                            <div class="col-sm-12">
                                                <div class="col-sm-8"></div>
                                                <div class="col-sm-4">
                                                    <button type="submit" class="form-control btn btn-default color-blue"><b>APLICAR PAGOS</b></button>
                                                </div>
                                            </div>
                                            <?php
                                            if ($this->session->flashdata('item')) {
                                                $message = $this->session->flashdata('item');
                                                echo '<div class="' . $message['class'] . '"><h3 style="color:green">' . $message['message'] . '</h3></div>';
                                            }
                                            ?>
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
            $(document).ready(function () {
                $('#table-paysges').DataTable({
                    language: {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });

            function sumar(valor, percent, id, idTech, idpay) {
                var total = 0;
                $("#miform").append('<input type="hidden" id="idorder' + id + '" name=" idorder[]" value="' + id + '"/>' +
                        '<input type="hidden" id="idtech' + id + '" name=" idtech[]" value="' + idTech + '"/>' +
                        '<input type="hidden" id="valor' + id + '" name=" valor[]" value="' + valor + '"/>' +
                        '<input type="hidden" id="percent' + id + '" name=" percent[]" value="' + percent + '"/>' +
                        '<input type="hidden" id="idpay' + id + '" name=" idpay[]" value="' + idpay + '"/>');
                valor = parseInt(valor); // Convertir el valor a un entero (número).

                total = $("#totalhidden").val();

                // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
                total = (total === null || total === undefined || total === "") ? 0 : total;

                /* Esta es la suma. */
                total = (parseInt(total) + valor);

                // Colocar el resultado de la suma en el control "span".
                $("#totalhidden").val(total);
                $("#total").val(formatNumber(total));
            }

            function restar(valor, id) {
                var total = 0;
                $("#idorder" + id).remove();
                $("#idtech" + id).remove();
                $("#valor" + id).remove();
                $("#percent" + id).remove();
                $("#idpay" + id).remove();
                valor = parseInt(valor);
                total = $("#totalhidden").val();

                // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
                total = (total === null || total === undefined || total === "") ? 0 : total;

                /* Esta es la suma. */
                total = (parseInt(total) - valor);

                // Colocar el resultado de la suma en el control "span".
                $("#totalhidden").val(total);
                $("#total").val(formatNumber(total));

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
            cargar_menu("financiero",'Bandeja de entrada');

        </script>
    </body>
</html>
