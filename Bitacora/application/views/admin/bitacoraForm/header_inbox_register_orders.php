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

