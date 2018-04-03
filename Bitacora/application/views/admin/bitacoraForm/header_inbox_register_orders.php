<div class="row">
    <div class="col-sm-2">
        <img src="dist/img/orden.jpg" style="width: 120px;">
    </div>
    <input type="hidden" id="id" value=""/>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">         
        <table id="data-table" class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th style="color: #00B0F0">Número de Orden</th>
                    <th style="color: #00B0F0">Centro de Costos No.</th>
                    <th style="color: #00B0F0">Coordinador Externo</th>
                    <th style="color: #00B0F0">Fecha de creación</th>
                    <th style="color: #00B0F0">VR. TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ordersTray) { ?>
                    <?php
                    foreach ($ordersTray as $orderTray) {
                        ?>
                        <tr>
                            <td class="details-control" id="<?php echo $orderTray->id; ?>">
                                <i class="fa fa-plus-square-o"></i>
                            </td>
                            <td><?= $orderTray->uniquecode."-".$orderTray->coi ?></td>
                            <td><?= $orderTray->uniqueCodeCentralCost ?></td>
                            <td><?= $orderTray->name_user ?></td>
                            <td><?= $orderTray->dateSave ?></td>
                            <td><?php
                                setlocale(LC_MONETARY, 'es_CO');
                                echo money_format('%.2n', $orderTray->total);
                                ?></td>
                        </tr>
                    <?php } ?>                        
<?php } ?>
            </tbody>
        </table>        
    </div>
</div>
<!-- Modal -->
<div id="modalDetailOrdersTray" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
        <!-- Modal content-->
        <div class="modal-content">            
            <div class="modal-body">
                <table id="orders-items-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="color-blue" width="50">ACTIVIDAD</th>
                            <th class="color-blue" width="50">SERVICIO</th>  
                            <th class="color-blue" width="10">CANTIDAD</th>
                            <th class="color-blue" width="30">SITIO</th>
                            <th class="color-blue" width="10">VR.UNITARIO</th>
                            <th class="color-blue" width="20">VR.TOTAL</th>
                        </tr>
                    </thead>
                    <tbody id="orders-items-data">

                    </tbody>      
                </table>
                <div class="row" id="orders-items-data-footer">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2">
                        <label class="color-blue">TOTAL BRUTO</label>
                        <input type="text" class="form-control bg-white"/>  
                    </div>
                    <div class="col-sm-2">
                        <label class="color-blue">DESCUENTO</label>
                        <input type="number" class="form-control bg-white"/> 
                    </div>
                    <div class="col-sm-2">
                        <label class="color-blue">IMPUESTO</label>
                        <select class="form-control">
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label class="color-blue">TOTAL</label>
                        <input type="text" class="form-control bg-white"/>
                    </div>                
                </div>
                <div class="row col-sm-12" style="margin-top:15px;">
                    <div class="form-group">
                        <label class="col-sm-4 color-blue">ÁREA DE ENVÍO SIGUIENTE PASO</label>    
                        <div class="col-sm-4">
                            <select class="form-control">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-4 color-blue">DOCUMENTOS RELACIONADOS</label>
                        <div class="col-sm-3">
                            <div class="checkbox-form">
                                <span>Registro fotográfico </span><input type="checkbox" class="sinborde">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="checkbox-form">
                                <span>PISNM </span><input type="checkbox">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="checkbox-form">
                                <span>TSS </span><input type="checkbox">
                            </div>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox-form">
                                <span>Documento DAS </span><input type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-sm-12">
                    <label class="col-sm-4 color-blue">OBSERVACIONES DE REGISTRO</label>
                    <div class="col-sm-8">
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
