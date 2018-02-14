<?php
foreach ($pays as $pay) {
    ?>
    <!DOCTYPE html>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <html>
        <head>
            <meta charset="UTF-8">
            <style>
                @page { margin: 100px 25px; }
                header { position: fixed; top: -100px; left: 0px; right: 0px; height: 10px; }
                footer { position: fixed; bottom: -50px; left: 0px; right: 0px; height: 10px; }
            </style>
        </head>
        <body>
            <header>
                <img id="logo" src="<?= base_url('dist/img/cabecera.png') ?>" width="700px" alt=""/>
            </header>
            <main>
                <table>
                    <tr>
                        <td>| Fecha de Solicitud | <?= date('d-m-Y') ?></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td>
                        <td><h3>Orden de Pago Proveedor No, <?= $pay->idTechnical ?></h3></td>
                    </tr>                       
                </table>
                <hr>
                <table>
                    <tr><td><h3>| Proveedor |</h3></td></tr> 
                </table>
                <table>
                    <tr style="color: blue">
                        <td></td><td></td><td></td>
                        <td>| Razón social</td>
                        <td>| Nit</td>
                        <td>| Dirección</td>
                        <td>| Teléfono</td>
                        <td>| email</td>
                        <td>| Contacto</td>
                    </tr>
                    <tr>
                        <td></td><td></td><td></td>
                        <td><?= $pay->name_user ?>
                        </td>
                        <td><?= $pay->identify_number ?>
                        </td>
                        <td><?= $pay->address ?>
                        </td>
                        <td><?= $pay->phone ?></td>
                        <td><?= $pay->email ?>
                        </td>
                        <td><?= $pay->contact ?>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr><td><h3>| Forma de Pago |</h3></td></tr> 
                </table>
                <table>
                    <thead>
                        <tr style="color: blue">
                            <td></td><td></td><td></td>
                            <td>| Tipo de Pago
                            </td>
                            <td>| No Cuenta
                            </td>
                            <td>| Banco
                            </td>
                            <td>| Valor de Pago</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td><td></td><td></td>
                            <td><?= $pay->name_pay ?>
                            </td>
                            <td><?= $pay->number_account ?>
                            </td>
                            <td><?= $pay->name_bank ?>
                            </td>
                            <td><?= $pay->sumValue ?></td>
                        </tr> 
                    </tbody>            
                </table>
                <hr>
                <table>
                    <tr><td><h3>| Detalle del Pago: |</h3></td></tr> 
                </table>
                <table>
                    <thead>
                        <tr style="color: blue">
                            <td></td><td></td><td></td>
                            <td>| NO DE ORDEN</td>
                            <td>| CENTRO DE COSTOS</td>
                            <td>| ACTIVIDAD</td>
                            <td>| CANTIDAD</td>
                            <td>| SITIO</td>
                            <td>| VR. DE PAGO</td>
                        </tr>  
                    </thead>            
                    <tbody>
                        <tr>
                            <td></td><td></td><td></td>
                            <td><?= $pay->uniquecode ?></td>
                            <td><?= $pay->uniqueCodeCentralCost ?></td>
                            <td><?= $pay->name_activitie ?></td>
                            <td><?= $pay->count ?></td>
                            <td><?= $pay->site ?></td>
                            <td><?= $pay->sumValue ?></td>
                        </tr>
                    </tbody>            
                </table><br><br><br><br><br><br><br><br>
                <hr>
                <table>
                    <tr><td><h3>| Totales |</h3></td></tr> 
                </table>
                <table>
                    <thead>
                        <tr style="color: blue">
                            <td></td><td></td><td></td>
                            <td>| Subtotal</td>
                            <td>| IVA</td>
                            <td>| Valor Total</td>
                            <td>| Retenciones</td>
                            <td>| Descuentos</td>
                            <td>| Valor de Pago</td>
                        </tr>  
                    </thead>            
                    <tbody>
                        <tr>
                            <td></td><td></td><td></td>
                            <td><?= $pay->sumValue ?></td>
                            <td><?php $iva = $pay->sumValue * 0.19; echo $iva; ?></td>
                            <td><?php $vr = $pay->sumValue - $iva;  echo $vr; ?></td>
                            <td></td>
                            <td></td>
                            <td><?= $vr; ?></td>
                        </tr>
                    </tbody>            
                </table>
                <hr>
                <table>
                    <tr><td><h3>| Notas |</h3></td></tr> 
                </table>
                <table>
                    <thead>
                        <tr>
                            <td></td><td></td><td></td>
                            <td>Para el trámite de su factura se debe tener presente los siguientes requisitos:<br>			
                                1.&nbsp;&nbsp;&nbsp;Aprobacion por parte del area de compras para la cancelacion de la presente orden de pedido<br>	
                                2.&nbsp;&nbsp;&nbsp;Presentación de Factura en Original y copia que incluya la información tributaria completa:  (Nombre Proveedor, Nit./C.C., Dirección, Teléfono, Res. DIAN facturación, Régimen a que pertenece, Codigo ICA, Si  son Grandes Contribuyentes, Si son Autorretenedores, Nombre y Nit. Del Impresor.		
                            </td>
                        </tr>
                    </thead>
                </table> 
            </main>
            <footer><p style="text-align: center; font-size: 8pt;">FORMATO DE ORDEN DE COMPRA GENERADO AUTOMATICAMENTE POR BITACORA
                    - Todos los derechos Reservados</p>
            </footer>        
        </body>
    </html>
<?php } ?>