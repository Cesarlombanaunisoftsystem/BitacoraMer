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
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Materials') ?>"><i class="fa fa-dashboard"></i> Volver</a></li>
                        <li class="active"></li>
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
                                        <table id="data-table" class="table table-striped " style="font-size:12px">
                                            <thead>
                                                <tr>
                                                    <th style="color: #00B0F0">Proceso</th>
                                                    <th style="color: #00B0F0">Fecha de Ordén</th>
                                                    <th style="color: #00B0F0">No. Ordén</th>
                                                    <th style="color: #00B0F0">Centro de Costos</th>
                                                    <th style="color: #00B0F0">Actividad</th>
                                                    <th style="color: #00B0F0">Cantidad</th>
                                                    <th style="color: #00B0F0">Sitio</th>
                                                    <th style="color: #00B0F0">Técnico</th>
                                                </tr>                                   
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($materials) && $materials) {
                                                    foreach ($materials as $row) {
                                                        ?>                                            
                                                        <tr>
                                                            <td>ASIGNACION</td>
                                                            <td><?= $row->dateSave ?></td>
                                                            <td><a href="#" onclick="verOrden(<?= $row->id ?>);">
                                                                    <u><?= $row->uniquecode . '-' . $row->coi ?></u><input type="hidden" id="norder_<?= $row->id ?>" value="<?= $row->uniquecode . '-' . $row->coi ?>"></a></td>
                                                            <td><?= $row->uniqueCodeCentralCost ?><input type="hidden" id="ccost_<?= $row->id ?>" value="<?= $row->uniqueCodeCentralCost ?>"></td>
                                                            <td><?= $row->name_activitie ?><input type="hidden" id="activ_<?= $row->id ?>" value="<?= $row->name_activitie ?>"></td>
                                                            <td><?= $row->count ?></td>
                                                            <td><?= $row->site ?></td>
                                                            <td><?= $row->name_user ?><input type="hidden" id="tech_<?= $row->id ?>" value="<?= $row->name_user ?>"></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                         
                                            </tbody>
                                        </table>                                        
                                        <?php
                                        if ($this->session->flashdata('item')) {
                                            $message = $this->session->flashdata('item');
                                            echo '<div class="' . $message['class'] . '"><h3 style="color:green">' . $message['message'] . '</h3></div>';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-10 col-md-offset-1">
                                        <form action="Materials/assign_x_order" method="post"  enctype="multipart/form-data"> 
                                            <div id="divOrder" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                    <table>
                                                        <tr>
                                                            <td>No. ORDEN: <label id="lblOrder"></label></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                    <table>
                                                        <tr style="font-size: 12px;">
                                                            <td style="color: #00B0F0">| Centro de Costos |</td>
                                                            <td>&nbsp;<label id="lblcCost"></label></td>
                                                        </tr>
                                                        <tr style="font-size: 12px;">
                                                            <td style="color: #00B0F0">| Actividad &nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;|</td>
                                                            <td>&nbsp;<label id="lblActiv"></label></td>
                                                        </tr>
                                                        <tr style="font-size: 12px;">
                                                            <td style="color: #00B0F0">| Técnico &nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                &nbsp;&nbsp;|</td>
                                                            <td>&nbsp;<label id="lblTech"></label></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 30px 0;">
                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
                                                        <label class="radio-inline" style="color: #00B0F0;"><input type="radio" id="chk1" checked>
                                                            Asignación de Bodega por producto
                                                        </label>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center">
                                                        <label class="radio-inline" style="color: #00B0F0;"><input type="radio" id="chk2">
                                                            Asignación de Bodega por Ordén
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                    <select id="selectasign" name="selcellarorder" class="form-control" required="">
                                                        <option value="" selected="selected"></option>
                                                        <?php
                                                        if (isset($cellars) && $cellars) {
                                                            foreach ($cellars as $cellar) {
                                                                ?>
                                                                <option value="<?= $cellar->id ?>"><?= $cellar->name_cellar ?></option>
                                                                }
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <br><br>                                        
                                                <table class="table table-striped" style="font-size: 12px">
                                                    <thead>
                                                        <tr>
                                                            <td style="color: #00B0F0">Descripción</td>
                                                            <td style="color: #00B0F0">| Cantidad</td>
                                                            <td style="color: #00B0F0">| Unidad de medida</td>
                                                            <td style="color: #00B0F0">| Observaciones</td>
                                                            <td class="bodega" style="color: #00B0F0">| Bodega</td>
                                                        </tr>                                   
                                                    </thead>
                                                    <tbody id="bodyMaterials">                                                                      
                                                    </tbody>
                                                </table>
                                                <a href="#" id="filePDF" style="text-transform:uppercase; font-weight:bold;color:#4554ff;">Agregar Paking List</a>
                                                <br><label id="nameFile"></label>
                                                <input name="pdfFile" type="file" id="myPdf" style="display:none">
                                                <br><br>
                                                <div class="row">                                               
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-8"></div>
                                                        <div class="col-sm-4">
                                                            <button type="submit" class="form-control btn btn-default color-blue">REGISTRAR</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
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
            $(function () {
                $("#selectasign").hide();
                $("#selectasign").attr('disabled', true);
                $(".bodega").hide();
                $("#divOrder").hide();
                $("#btnAplicar").show();
                $("#btnAplicarProduct").hide();
                $('#table-regprocess').DataTable({
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
            
            $("#myPdf").change(function(){
                 if((this.value).toLowerCase().indexOf('.pdf') >= 0){
                      $("#nameFile").html(this.value);
                 }else{
                     alert("Por favor ingrese un formato valido ");
                     $("#myPdf").val(null);
                     $("#nameFile").html(this.value);
                 }
            });
            

            $("#chk1").click(function () {
                $("#chk2").prop("checked", false);
                $("#selectasign").hide();
                $("#selectasign").removeAttr("required");
                $("#selectasign").attr('disabled', true);                
                $(".selcellar").attr('disabled', false);                
                $(".selcellar").attr("required", true);
                $(".selcellar").show();
                $(".bodega").show();
            });
            
            $("#filePDF").click(function(){
               $("#myPdf").click();
            });

            $("#chk2").click(function () {
                $("#chk1").prop("checked", false);
                $(".selcellar").hide();
                $(".selcellar").removeAttr("required");
                $(".selcellar").attr('disabled', true);
                $("#selectasign").show();
                $("#selectasign").attr('disabled', false);
                $("#selectasign").attr('required', true);
                $(".bodega").hide();
                $(".bodega").removeAttr("required");
            });

            function verOrden(idOrder) {
                $("#divOrder").fadeIn('slow');
                $("#data-table_wrapper").fadeOut('fast');
                $('#bodyMaterials').empty();
                var order = $("#norder_" + idOrder).val();
                var ccost = $("#ccost_" + idOrder).val();
                var activ = $("#activ_" + idOrder).val();
                var tech = $("#tech_" + idOrder).val();
                $("#lblOrder").html(order);
                $("#lblActiv").html(activ);
                $("#lblcCost").html(ccost);
                $("#lblTech").html(tech);
                url = get_base_url() + "Orders/get_order_materials?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (respuestaServer) {
                    $.each(respuestaServer["materials"], function (i, materials) {
                        $('#bodyMaterials').append('<tr><td>' + '<input type="hidden" value=' + materials.id + ' name="id[]"><input type="hidden" value=' + materials.idOrder + ' name="idOrder[]" id="idOrder">' + materials.name_service +
                                '</td><td>' + materials.count +
                                '</td><td>' + materials.unit_measurement + '</td><td>'
                                + materials.observation + '</td>' +
                                '<td class="bodega"><select class="selcellar form-control" name="selcellar[]" id="selcellar_' + materials.id + '" required><option></option></select></td></tr>');
                    });
                    $.each(respuestaServer["cellars"], function (i, cellars) {
                        $('.selcellar').append('<option value=' + cellars.id + '>' + cellars.name_cellar + '</option>');
                    });
                });
            }

            function generatePdf() {
                var ccost = $("#lblcCostProcess").html();
                url = get_base_url() + "Materials/pdf_materials_sql/" + ccost;
                var a = document.createElement('a');
                a.href = url;
                a.target = '_blank';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                alertify.success('Orden de mercancia generada exitosamente.');
            }
            cargar_menu("gestion_materiales",'bandeja de entrada');
        </script>
    </body>
</html>
