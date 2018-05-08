<div class="row">
    <input type="hidden" id="id" value=""/>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">         
        <table id="data-table" class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th style="color: #00B0F0">Número de Orden</th>
                    <th style="color: #00B0F0">Centro de Costos No.</th>
                    <th style="color: #00B0F0">Coordinador Externo</th>
                    <th style="color: #00B0F0">Fecha de creación</th>
                    <th style="color: #00B0F0">Fecha procesado</th>
                    <th style="color: #00B0F0">VR. TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ordersTray) { ?>
                    <?php
                    foreach ($ordersTray as $orderTray) {
                        if ($orderTray->stateLog === '1') {
                            $color = '#FCF8E5';
                        } else {
                            $color = '';
                        }
                        ?>
                        <tr style="background-color:<?= $color ?>">
                            <td class="details-control" id="<?php echo $orderTray->id; ?>">
                                <i class="fa fa-plus-square-o"></i>
                            </td>
                            <td><?= $orderTray->uniquecode . "-" . $orderTray->coi ?></td>
                            <td><?= $orderTray->uniqueCodeCentralCost ?></td>
                            <td><?= $orderTray->name_user ?></td>
                            <td><?= $orderTray->dateSave ?></td>
                            <td><?= $orderTray->dateLog ?></td>
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

