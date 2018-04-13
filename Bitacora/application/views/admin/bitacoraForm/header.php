<div class="row" style="margin-bottom: 15px;">
    
    <input type="hidden" name="id" id="id" value="<?php if ($order) {echo $order->id;}?>"/>
    <div class="head1 text-center">
        
        <div class="col-sm-2 col-md-2"><strong>Número de Orden:</strong></div>
    <div class="col-sm-2 col-md-2 bordesOut">
        <input type="text" class="form-control sinborde" name="uniquecode" id="idOrder" value="<?php
        if ($order) {
            echo $order->uniquecode;
        }
        ?>" required/>
    </div>
        <div class="col-sm-1"><strong>COI:</strong></div>
     <div class="col-sm-1 col-md-1 bordesOut"><input type="text" class="form-control sinborde" name="coi" id="coi" value="<?php
        if ($order) {
            echo $order->coi;
        }
        ?>" onfocusout="addIdOrder();" required/>
    </div>
        <div class="col-sm-1"><strong>Centro de Costos No.</strong></div>
     <div class="col-sm-2 col-md-2 bordesOut"><input type="number" class="form-control sinborde" name="uniqueCodeCentralCost" id="idCentCost" value="<?php
        if ($order) {
            echo $order->id;
        }
        ?>" required/>
    </div>
        <div class="col-sm-1"><strong>Fecha de Creación:</strong></div>
    <div class="col-sm-2 col-md-2 " style=" border-left : 1pt ridge gray; border-right : 1pt ridge gray; "><input type="text" class="form-control sinborde" name="date" id="dateSave" value="<?php
        if ($order) {
            echo $order->dateSave;
        }
        ?>" readonly required/></div>
    </div>


    <div class="head1 text-center">
        <div class="col-sm-2"><strong>Coordinador Externo:</strong></div>
    <div class="col-sm-2" style=" border-left : 1pt ridge gray; border-right : 1pt ridge gray; ">
        <select class="form-control sinborde" name="idCoordinatorExt" id="idCoordExt" required onchange="genHead()">
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
        <div class="col-sm-2"><strong>Coordinador Interno:</strong></div>
     <div class="col-sm-2 col-md-2 bordesOut">
        <select class="form-control sinborde" name="idCoordinatorInt" id="idCoordInt" required onchange="genHead()">
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
        <div class="col-sm-2"><strong>Forma de Pago:</strong></div>
     <div class="col-sm-2 col-md-2 bordesOut">
        <select class="form-control sinborde" name="idFormPay" id="idFormPay" required>
            <option></option>
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
        </select></div></div>
</div>

