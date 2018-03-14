<!DOCTYPE html>
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
                    <div class="col-md-4">
                        <table>
                            <thead>
                                <tr>
                                    <th rowspan="4">
                                        <h2><?= $titulo ?></h2>
                                    </th>                                
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table>
                            <thead>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | NUMERO TOTAL DE ORDENES |
                                    </th>
                                    <th style="color: gray">
                                        <?= $totalorders->total ?>
                                    </th>                                     
                                </tr>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | ORDENES FUERA DE TIEMPO | 
                                    </th>
                                    <th style="color: gray">

                                    </th>                                     
                                </tr>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | ORDENES DENTRO DE TIEMPO | 
                                    </th>
                                    <th style="color: gray">

                                    </th>                                     
                                </tr>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | % ORDENES FUERA DE TIEMPO | 
                                    </th>
                                    <th style="color: gray">

                                    </th>                                     
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table>
                            <thead>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | VALOR TOTAL VENTA |
                                    </th>
                                    <th style="color: gray">
                                        <?php
                                        setlocale(LC_MONETARY, 'es_CO');
                                        echo money_format('%.2n', $totalsale->total) . "\n";
                                        ?>
                                    </th>                                     
                                </tr>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | VALOR TOTAL COSTOS | 
                                    </th>
                                    <th style="color: gray">
                                        <?php
                                        setlocale(LC_MONETARY, 'es_CO');
                                        echo money_format('%.2n', $totalcost->total) . "\n";
                                        ?>
                                    </th>                                     
                                </tr>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | % UTILIDAD TOTAL | 
                                    </th>
                                    <th style="color: gray">
                                        <?php
                                        $dif = ($totalcost->total *100)/$totalsale->total;
                                        echo round($dif, 2).'%';
                                        ?>
                                    </th>                                     
                                </tr>
                                <tr>
                                    <th style="color: #00B0F0">
                                        | VALOR UTILIDAD TOTAL | 
                                    </th>
                                    <th  style="color: gray">
                                        <?php
                                        $util = $totalsale->total - $totalcost->total;
                                        setlocale(LC_MONETARY, 'es_CO');
                                        echo money_format('%.2n', $util) . "\n";
                                        ?>
                                    </th>                                     
                                </tr>
                            </thead>
                        </table><br>
                    </div>
                </section>
                <section class="content">
                    <table class="table" style="background-color: black">
                        <thead>
                            <tr style="color: whitesmoke; text-align: center">
                                <th>Registro Inicial</th>
                                <th>Asignación visita inicial</th>
                                <th>Registro visita inicial</th>
                                <th>Auditoria visita inicial</th>
                                <th>Registro de diseño</th>
                                <th>Auditoria de diseño</th>
                                <th>Presupuesto 1</th>
                                <th>Presupuesto 2</th>
                                <th>Aprobación presupuesto</th>
                                <th>Autorización de pagos</th>
                                <th>Area financiera</th>
                                <th>Iniciao actividad</th>
                                <th>Gestión de materiales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="background-color: black">
                        <thead>
                            <tr style="color: whitesmoke; text-align: center">
                                <th>Facturación</th>
                                <th>Auditoria liquidación</th>
                                <th>Centro de liquidación</th>
                                <th>Area financiera</th>
                                <th>Autorización de pagos</th>
                                <th>Auditoria de documentación</th>
                                <th>Centro de documentación</th>
                                <th>Devolución de materiales</th>
                                <th>Registro visita de cierre</th>
                                <th>Programación visita de cierre</th>
                                <th>Actividad en proceso</th>
                                <th>Bodega externa</th>
                                <th>Bodega interna</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>

    </body>
</html>
