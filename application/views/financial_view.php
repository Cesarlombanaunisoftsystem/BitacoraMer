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
                                        <li role="presentation"><a href="#pagosges" aria-controls="binnacle" role="tab" data-toggle="tab">Pagos Gestionados</a></li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="bandeja">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/financial.png') ?>" style="width: 120px;">
                                    </div>
                                    <input type="hidden" id="id" value=""/>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <form>
                                            <table  id="data-table" class="table table-striped" style="font-size:12px">
                                                <thead>
                                                    <tr>
                                                        <th style="color: #00B0F0">No. Ordén</th>
                                                        <th style="color: #00B0F0">Centro de Costos</th>
                                                        <th style="color: #00B0F0">Actividad</th>
                                                        <th style="color: #00B0F0">Cantidad</th>
                                                        <th style="color: #00B0F0">Sitio</th>
                                                        <th style="color: #00B0F0">Técnico</th>
                                                        <th style="color: #00B0F0">Vr.Total-Orden</th>
                                                        <th style="color: #00B0F0">% Autorizado</th>
                                                        <th style="color: #00B0F0">Vr Autorizado</th>
                                                        <th style="color: #00B0F0">Pagar</th>
                                                    </tr>                                   
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($pays) && $pays) {
                                                        foreach ($pays as $row) {
                                                            ?>                                            
                                                            <tr>
                                                                <td><input type="hidden" value="<?= $row->idTechnicals ?>" name="idpay<?= $row->id ?>"><?= $row->uniquecode.'-'.$row->coi ?></td>
                                                                <td><?= $row->uniqueCodeCentralCost ?></td>
                                                                <td><?= $row->name_activitie ?></td>
                                                                <td><?= $row->count ?></td>
                                                                <td><?= $row->site ?></td>
                                                                <td><?= $row->name_user ?></td>
                                                                <td><?php setlocale(LC_MONETARY, 'es_CO');
                                                                    echo money_format('%.2n', $row->totalCost) ?></td>
                                                                <td><?= $row->percent ?>%</td>
                                                                <td><?php setlocale(LC_MONETARY, 'es_CO');
                                                                    echo money_format('%.2n', $row->value) ?></td>
                                                                <td><input type="checkbox" class="form-check-input" id="chk<?= $row->id ?>" value="<?= $row->value ?>" onclick="sumar(this.value,<?= $row->id ?>);"></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>                                                                         
                                                </tbody>
                                            </table>
                                            <div id="spinner"></div>
                                            <br><br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6"></div>
                                                    <div class="col-sm-3">
                                                        <label class="color-blue">SELECCIÓN TOTAL A PAGAR</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" style="color: red" id="total" readonly/>  
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-8"></div>
                                                    <div class="col-sm-4">
                                                        <button id="btnAplicar" type="button" class="form-control btn btn-default color-blue" onclick="aplicar();" disabled="disabled"><b>APLICAR PAGOS</b></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="pagosges">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <img src="<?= base_url('dist/img/financial.png') ?>" style="width: 120px;">
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <form>
                                            <table id="table-paysges" class="table table-striped" style="font-size:12px">
                                                <thead>
                                                    <tr>
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
                                                      <td><?= $row->dateSave ?></td>
                                                      <td><?= $row->uniquecode.'-'.$row->coi ?></td>
                                                      <td><?= $row->uniqueCodeCentralCost ?></td>
                                                      <td><?= $row->name_user ?></td>
                                                      <td><?php $iva = $row->sumValue * 0.19; echo $iva; ?></td>
                                                      <td></td>
                                                      <td></td>
                                                      <td><?= $row->sumValue ?></td>
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

            function sumar(valor, id) {
                if ($("#chk" + id).prop("checked") === true) {
                    $("#btnAplicar").prop("disabled",false);
                    var total = 0;
                    valor = parseInt(valor); // Convertir el valor a un entero (número).

                    total = $("#total").val();

                    // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
                    total = (total == null || total == undefined || total == "") ? 0 : total;

                    /* Esta es la suma. */
                    total = (parseInt(total) + parseInt(valor));

                    // Colocar el resultado de la suma en el control "span".
                    $("#total").val(total);
                    url = get_base_url() + "Audit/process_pays";
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {id: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Pago Seleccionado');
                            }
                        }
                    });
                } else {
                    $("#idPay" + id).val() = "";
                            var total = 0;
                    valor = parseInt(valor); // Convertir el valor a un entero (número).

                    total = $("#total").val();

                    // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
                    total = (total == null || total == undefined || total == "") ? 0 : total;

                    /* Esta es la suma. */
                    total = (parseInt(total) - parseInt(valor));

                    // Colocar el resultado de la suma en el control "span".
                    $("#total").val(total);
                    url = get_base_url() + "Audit/remove_process_pays";
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {id: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en BBDD');
                            }
                            if (resp === "ok") {
                                alertify.success('Pago borrado');
                            }
                        }
                    });
                }
            }

            function aplicar() {
                url = get_base_url() + "Audit/pdf_pays";
                var a = document.createElement('a');
                a.href = url;
                a.target = '_blank';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);                
                alertify.success('Pagos realizados exitosamente.');
                alertify.success('PDF generado exitosamente');
                location.reload();
            }
        </script>
    </body>
</html>
