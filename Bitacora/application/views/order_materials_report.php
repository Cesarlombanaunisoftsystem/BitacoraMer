<?php
foreach ($materials as $cellar) {
    $image = $cellar->image;
}
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
            <!--<img id="logo" src="<?= base_url('uploads/') . $image ?>" width="700px" alt=""/>-->
        </header>
        <main>
            <table>
                <tr>
                    <td>| Fecha de Documento | <?= date('d-m-Y') ?></td><td></td>
                    <td></td><td></td></td><td></td><td></td></td><td></td><td></td>
                </td><td></td><td></td></td><td></td><td></td></td><td></td><td></td>
            <td><h3>Orden de Entrega de Materiales No, <?= 'OM-' . $datos->id; ?></h3></td>
        </tr>                       
    </table>
    <hr>
    <table>
        <thead>
            <tr><td><h3>| Proveedor |</h3></td>
                <td style="color: #00b0f0">| Razón social</td>
                <td style="color: #00b0f0">| Nit</td>
                <td style="color: #00b0f0">| Dirección</td>
                <td style="color: #00b0f0">| Teléfono</td>
                <td style="color: #00b0f0">| email</td>
                <td style="color: #00b0f0">| Contacto</td>
            </tr> 
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><?= $datos->name_user; ?></td>
                <td><?= $datos->identify_number; ?></td> 
                <td><?= $datos->address; ?>
                </td>
                <td><?= $datos->phone; ?></td>
                <td><?= $datos->email; ?>
                </td>
                <td><?= $datos->contact; ?>
                </td>
            </tr>                    
        </tbody>
    </table>
    <table>
        <thead>
            <tr><td><h3>| Actividad |</h3></td>
                <td style="color: #00b0f0">| Centro de Costos</td>
                <td style="color: #00b0f0">| Actividad</td>
            </tr> 
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><?= $datos->uniqueCodeCentralCost ?></td>
                <td><?= $datos->name_activitie ?></td> 
            </tr>                    
        </tbody>
    </table>            
    <hr>
    <table>
        <tr><td><h3>| Detalle de Entrega: |</h3></td></tr> 
    </table>
    <table>
        <thead>
            <tr style="color: #00b0f0">
                <td>Descripción</td>
                <td>| Cantidad</td>
                <td>| Unidad de Medida </td>
                <td>| Observaciones</td>
                <td>| Pendiente</td>
            </tr>  
        </thead>            
        <tbody>
            <?php
            foreach ($materials as $value) {
                $entregado = $value->idStateCellar;
                if ($entregado === '0') {
                    $check = '<input type="checkbox" checked>';
                } else {
                    $check = '<input type="checkbox">';
                }
                ?>
                <tr>                        
                    <td><?= $value->name_service ?></td>
                    <td><?= $value->count ?></td>
                    <td><?= $value->unit_measurement ?></td>
                    <td><?= $value->observation ?></td>
                    <td><?= $check ?></td>                                                       
                </tr>
            <?php }
            ?>
        </tbody>            
    </table><br><br><br><br><br><br><br><br>
    <hr>
    <table>
        <tr>
            <td><h3>| Firmas de Recibido |</h3></td>
            <td style="color: #00b0f0">________________&nbsp;</td>
            <td style="color: #00b0f0">________________&nbsp;</td>
            <td style="color: #00b0f0">________________&nbsp;</td>
            <td style="color: #00b0f0">________________&nbsp;</td>
        </tr>
        <tbody>
            <tr style="color: #00b0f0">
                <td></td>
                <td>Nombre</td>
                <td>| No.Identificación</td>
                <td>| Firma</td>
                <td>| Sello</td>
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
<footer><p style="text-align: center; font-size: 8pt;">FORMATO DE ORDEN DE ENTREGA DE MERCANCIA GENERADO AUTOMATICAMENTE POR BITACORA
        - Todos los derechos Reservados</p>
</footer>        
</body>
</html>
