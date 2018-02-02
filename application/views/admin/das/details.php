<table id="orders-items-table" class="table table-responsive">
    <thead>
        <tr>
            <th class="color-blue" width="50">ACTIVIDAD</th>
            <th class="color-blue" width="50">SERVICIO</th>  
            <th class="color-blue" width="10">CANTIDAD</th>
            <th class="color-blue" width="30">SITIO</th>
            <th class="color-blue" width="10">VR.UNITARIO</th>
            <th class="color-blue" width="20">VR.TOTAL</th>
            <th class="color-blue"></th>
        </tr>
    </thead>

    <tr>
        <td width="200">
            <div class="input-group">
                <select class="form-control activities" name="idActivities" id="idActivities"> 
                    <option></option>          
                    <?php if (isset($activities)) { ?>
                        <?php foreach ($activities as $activitie) { ?>
                            <option value="<?= $activitie->id ?>"><?= $activitie->name_activitie ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>          
            </div>
        </td>
        <td width="200">
            <select class="form-control" name="idServices" id="idServices">
            </select>        
        </td>
        <td width="10">
            <input type="number" class="form-control" name="count" id="count"  min="1" />        
        </td>
        <td width="100">
            <input type="text" class="form-control" name="site" id="site" autocomplete="off" />
        </td>
        <td width="10">
            <div id="price"></div>      
        </td>
        <td width="115">
            <input type="number" class="form-control" name="total" id="vrTotal" readonly />
            <input type="hidden" id="vrTotalCost"/>
        </td>
        <td>
            <button type="submit" class="btn-transparent" onclick="addDetail();"><i class="fa fa-check" aria-hidden="true"></i></button>        
        </td>
    </tr>

    <tbody id="orders-items-data">
        <?php
        if ($details) {
            $subtotal = 0;
            $totalCost = 0;
            foreach ($details as $detail) {
                ?>
                <?php
                $subtotal = $subtotal + $detail->total;
                $totalCost = $totalCost + $detail->total_cost;
                ?>
                <tr><td><?= $detail->name_activitie ?></td>
                    <td><?= $detail->name_service ?></td>
                    <td><?= $detail->count ?></td><td><?= $detail->site ?></td>
                    <td><?= $detail->price ?></td><td><?= $detail->total ?></td>
                    <td><button type="button" class="btn-transparent" onclick="removeDetailOrder(<?= $detail->id ?>);"><i class="fa fa-minus" aria-hidden="true" style="color:red"></i></button></td>
                </tr>
            <?php } ?>
        <input type="hidden" name="sumSubtotal" id="sumSubtotal" value="<?= $subtotal ?>"/>
        <input type="hidden" name="sumTotalCost" id="sumTotalCost" value="<?= $totalCost ?>"/>
    <?php } ?>
</tbody>      
</table>
<div id="spinner"></div>