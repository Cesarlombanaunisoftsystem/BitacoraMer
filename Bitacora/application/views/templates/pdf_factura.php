
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DOCUMENTO PDF</title>



        <style>
            body{
                font-family: arial;
            }
            .header{
                background: rgba(73,155,234,1);
                background: -moz-linear-gradient(top, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(73,155,234,1)), color-stop(100%, rgba(32,124,229,1)));
                background: -webkit-linear-gradient(top, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: -o-linear-gradient(top, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: -ms-linear-gradient(top, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                background: linear-gradient(to bottom, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#499bea', endColorstr='#207ce5', GradientType=0 );
                padding: 15px;
                border-radius: 5px;
            }
            .header > h1{
                margin: 0;
                text-transform: uppercase;
                text-align: right;
                margin-right: 20px;
                color: #fff;
                
            }
            .img-head-pdf{
                width: 100%;
            }
            .content{
                width: 100%;
            }
            .body{
            	margin-top: 15px;
            }
            .column-5{
            	width:  50%;
            	float: left;
                color:#6d6a6a;
            }
            .content>.body>.table{
            	width: 100%;
            	font-size: 11px;
            }
            th {
            	padding: 5px 10px;
                background: #599de0;
            	text-transform: uppercase;
            	color: #fff;
                
            }
            .table>tbody > tr > td{
            	padding: 10px;
                text-align: center;
                color: #6d6a6a;
            }
            .table>tbody{
                border: 1px solid #ccc;
            }
            .head-table{
            	margin-top: 20px;
                margin-bottom: 5px;
                border-left: 3px solid #599de0;
                padding: 0 5px;
                color: #6d6a6a;
                text-transform: uppercase;
            }
            .notes{
                color: #6d6a6a;
                font-size: 11px;
            }
            .end_note{
                padding: 10px;
                text-align: center;
                color: #6d6a6a;                
                font-size: 11px;
            }
        </style>
</head>
<body>
    <div class="content" id="testdiv">
        <img src="<?= base_url('/dist/img/head_logo.png')?>" class="img-head-pdf">
        
        <div class="body">
            <div class="column-5">
                <strong>Fecha de solicitud</strong>
                <?=  date('d-m-Y'); ?>
            </div>
            <div class="column-5" style="text-align: right;">
            	<strong>Orden de Pago Proveedor  No:</strong>
            	<?= $pay->idTechnical ?>
            </div>
            <div><br></div>
            <div class="head-table">
                <p>Proveedor</p>
            </div>
            <table class="table">
            	<thead>
            		<tr>
            			<th >razon social</th>
            			<th>NIt</th>
            			<th>Dirección</th>
            			<th>Telefono</th>
            			<th>Email</th>
            			<th>Contacto</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<td><?= $pay->name_user; ?></td>
            			<td><?= $pay->identify_number; ?></td>
            			<td><?= $pay->address; ?></td>
            			<td><?= $pay->phone; ?></td>
            			<td><?= $pay->email; ?></td>
            			<td><?= $pay->contact; ?></td>
            		</tr>
            	</tbody>
            </table>
            <div class="head-table">
                <p>Forma de pago</p>
            </div>
            <table class="table">
            	<thead>
            		<tr>
            			<th>Tipo de pago</th>
            			<th>Tipo de cuenta</th>
            			<th>Banco</th>
            			<th>Valor pagado</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<td><?= $pay->name_pay; ?></td>
            			<td><?= $pay->number_account; ?></td>
            			<td><?= $pay->name_bank; ?></td>
            			<td><?php
                                    setlocale(LC_MONETARY, 'es_CO');
                                    echo money_format('%.2n', $pay->value);
                                    ?>
                                </td>
            		</tr>
            	</tbody>
            	
            </table>
            <div class="head-table">
                <p>Detalle de pago</p>
            </div>
            <table class="table">
            	<thead>
            		<tr>
            			<th>No. orden</th>
            			<th>Centro de costos</th>
            			<th>Actividad</th>
            			<th>Cantidad</th>
                                <th>Sitio</th>
                                <th>Valor pago</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<td><?= $pay->uniquecode ?></td>
                                <td><?= $pay->uniqueCodeCentralCost ?></td>
                                <td><?= $pay->name_activitie ?></td>
                                <td><?= $pay->count ?></td>
                                <td><?= $pay->site ?></td>
            			<td><?php
                                    setlocale(LC_MONETARY, 'es_CO');
                                    echo money_format('%.2n', $pay->value);
                                    ?>
                                </td>
            		</tr>
            	</tbody>
            </table>
            <hr>
            <div class="head-table">
                <p>Totales</p>
            </div>
            <table class="table">
            	<thead>
            		<tr>
            			<th>Subtotal</th>
            			<th>IVA</th>
            			<th>VALOR total</th>
            			<th>Retenciones</th>
                                <th>Descuentos</th>
                                <th>Valor de pago</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
                            <td><?php
                                $iva = $pay->value * 0.19;
                                $vr = $pay->value - $iva;
                                setlocale(LC_MONETARY, 'es_CO');
                                echo money_format('%.2n', $vr);
                                ?>
                            </td>
                            <td><?php
                                setlocale(LC_MONETARY, 'es_CO');
                                echo money_format('%.2n', $iva);
                                ?>
                            </td>
                            <td><?php
                                setlocale(LC_MONETARY, 'es_CO');
                                echo money_format('%.2n', $pay->value);
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td><?php
                                setlocale(LC_MONETARY, 'es_CO');
                                echo money_format('%.2n', $pay->value);
                                ?>
                            </td>
            		</tr>
            	</tbody>
            </table>
            <div class="head-table">
                <p>Notas</p>
            </div>
            <div class="notes">
                <p>Para el trámite de su factura se debe tener presente los siguientes requisitos:</p>
                <ol>
                    <li>Aprobacion por parte del area de compras para la cancelacion de la presente orden de pedido.</li>	
                    <li>Presentación de Factura en Original y copia que incluya la información tributaria completa:  (Nombre Proveedor, Nit./C.C., Dirección, Teléfono, Res. DIAN facturación, Régimen a que pertenece, Codigo ICA, Si  son Grandes Contribuyentes, Si son Autorretenedores, Nombre y Nit. Del Impresor.</li>
                </ol>
            </div>
            
            <div class="end_note">
                FORMATO DE ORDEN DE COMPRA GENERADO AUTOMATICAMENTE POR BITACORA   - Todos los derechos Reservados
            </div>
        </div>
        
    </div>    
</body>
</html>