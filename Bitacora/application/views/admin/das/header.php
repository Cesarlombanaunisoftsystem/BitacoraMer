<div class="row">
    <div class="col-sm-2 col-md-2">
        <img src="dist/img/orden.jpg" class="img-responsive">
    </div>
    <input type="hidden" name="id" id="id" value="<?php if ($order) {echo $order->id;}?>"/>
    <div class="head1 text-center">
    <div class="col-sm-1">Número de Orden</div>
    <div class="col-sm-1 bordesOut" ><input type="text" class="form-control sinborde" name="uniquecode" id="idOrder" value="<?php
        if ($order) {
            echo $order->uniquecode;
        }
        ?>" required/>
    </div>
    <div class="col-sm-1">POI:</div>
    <div class="col-sm-1 bordesOut" ><input type="text" class="form-control sinborde" name="coi" id="coi" value="<?php
        if ($order) {
            echo $order->coi;
        }
        ?>" onfocusout="addIdOrder();" required/>
    </div>
    <div class="col-sm-1">Centro de Costos No.</div>
    <div class="col-sm-1 bordesOut" ><input type="number" class="form-control sinborde" name="uniqueCodeCentralCost" id="idCentCost" value="<?php
        if ($order) {
            echo $order->id;
        }
        ?>" required/>
    </div>
    <div class="col-sm-1">Fecha de Creación</div>
    <div class="col-sm-2 bordesOut" ><input type="text" class="form-control sinborde" name="date" id="dateSave" value="<?php
        if ($order) {
            echo $order->dateSave;
        }
        ?>" readonly required/></div>
</div>
    <div class="col-sm-2">Coordinador Externo</div>
    <div class="col-sm-2 bordesOut" >
        <select class="form-control sinborde" name="idCoordinatorExt" id="idCoordExt" required>
            <option></option>
            <?php
            foreach ($coordinators_ext as $coordext) {
                if ($order->idCoordinatorExt === $coordext->id) {
                    ?>
                    <option value="<?= $coordext->id ?>" selected><?= $coordext->name_user ?>
                    </option>
                <?php } else { ?>
                    <option value="<?= $coordext->id ?>"><?= $coordext->name_user ?>
                    </option>
                    <?php
                }
            }
            ?>

        </select></div>
    <div class="col-sm-2">Coordinador Interno</div>
    <div class="col-sm-1 bordesOut" >
        <select class="form-control sinborde" name="idCoordinatorInt" id="idCoordInt" required>
            <option></option>                
            <?php
            foreach ($coordinators_int as $coordint) {
                if ($order->idCoordinatorInt === $coordint->id) {
                    ?>
                    <option value="<?= $coordint->id ?>" selected><?= $coordint->name_user ?>
                    </option>
                <?php } else { ?>
                    <option value="<?= $coordint->id ?>"><?= $coordint->name_user ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select></div>
    <div class="col-sm-2">Forma de Pago</div>
    <div class="col-sm-1 bordesOut" >
        <select class="form-control sinborde" name="idFormPay" id="idFormPay" required>
            <option></option>
            <option>Seleccione</option>
            <?php
            foreach ($formspay as $pay) {
                if ($order->idFormPay === $pay->id) {
                    ?>
                    <option value="<?= $pay->id ?>" selected><?= $pay->name_pay ?>
                    </option>
                <?php } else { ?>
                    <option value="<?= $pay->id ?>"><?= $pay->name_pay ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select></div>
</div>

