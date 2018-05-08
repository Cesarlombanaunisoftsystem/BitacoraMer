<div style="height:<?php echo (count($details)>1? "245px":"auto");?>;
   overflow:auto;
    background:#fff;
    border: 2px solid #b1adad71;
    font-size: 11px;
    margin-bottom: 15px;">
<table id="orders-items-table" class="table table-striped" style="border-top: 15px">
    <thead>
        <tr>
            <th class="color-blue" >ACTIVIDAD</th>
            <th class="color-blue" >SERVICIO</th>  
            <th class="color-blue" >CANTIDAD</th>
            <th class="color-blue" >SITIO</th>
            <th class="color-blue" >VR.UNITARIO</th>
            <th class="color-blue" >VR.TOTAL</th>
            <th class="color-blue"></th>
        </tr>
    </thead>

    <tr>
        <td >
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
        <td >
            <select class="form-control" name="idServices" id="idServices">
            </select>        
        </td>
        <td >
            <input type="number" class="form-control" name="count" id="count"  min="1" />        
        </td>
        <td >
            <input type="text" class="form-control" name="site" id="site" autocomplete="off" />
            <div id="suggesstion-box" style="display: none;">
                <ul style="list-style-type: none;">
                    
                </ul>
            </div>
        </td>
        <td >
            <div id="price"></div>      
        </td>
        <td >
            <input type="number" class="form-control" name="total" id="vrTotal" readonly />
            <input type="hidden" id="vrTotalCost"/>
        </td>
        <td>
            <button type="submit" id="btnDetail" class="btn-transparent" onclick="addDetail();"><i class="fa fa-check" aria-hidden="true"></i></button>        
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
                    <td><?= $detail->count ?></td>
                    <td><?= $detail->site ?></td>
                    <td><?php setlocale(LC_MONETARY, 'es_CO');
        echo money_format('%.2n', $detail->price);
                ?></td>
                    <td><?php setlocale(LC_MONETARY, 'es_CO');
                echo money_format('%.2n', $detail->total);
                ?></td>
                    <td><button type="button" class="btn-transparent" onclick="removeDetailOrder(<?= $detail->id ?>);"><i class="fa fa-minus" aria-hidden="true" style="color:red"></i></button></td>
                </tr>
        <?php } ?>
        <input type="hidden" name="sumSubtotal" id="sumSubtotal" value="<?= $subtotal ?>"/>
<?php } ?>
</tbody>      
</table>
    </div>
<div id="spinner"></div>