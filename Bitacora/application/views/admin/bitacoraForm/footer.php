<div style="font-size: 11px">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-2">
            <label class="color-blue">TOTAL BRUTO</label>
            <input type="hidden" name="subtotal" id="subtotal"/>
            <input type="text" class="form-control bg-white" id="subtotalshow" readonly/>  
        </div>
        <div class="col-sm-2">
            <label class="color-blue">DESCUENTO</label>
            <input type="number" class="form-control bg-white" name="discount" onkeyup="discountOrder();" id="discount"/> 
        </div>
        <div class="col-sm-2">
            <label class="color-blue">IMPUESTO</label>
            <select class="form-control" name="idTax" id="tax">
                <?php foreach ($taxes as $tax) { ?>
                    <option value="<?= $tax->percent_tax ?>"><?= $tax->name_tax ?> <?= $tax->percent_tax ?> %</option>
                <?php } ?>
            </select>
        </div>
        <div class="col-sm-2">
            <label class="color-blue">TOTAL</label>

            <input type="hidden" name="total" id="total"/>
            <input type="text" class="form-control bg-white" id="totalshow" readonly/>
        </div>
        <div class="col-sm-1">
            <div class="form-group">  
                <label class="col-xs-4 control-label" for="userfile"><div style="background-color: #777;border-radius: 50%;width: 40px;height: 40px;"><img src="<?= base_url('dist/img/clip.png') ?>" style="width: 25px;margin-top: 10px;margin-right: 1px;margin-left: 7px;"></div></label>   
                <p id="datofile"></p>
                <input type="file"  name="userfile" id="userfile" style="display: none" onchange="getFileName(this)" accept=".pdf" size="2048">
            </div>
        </div>
    </div>
    <div class="row col-sm-12" style="margin-top:15px;">
        <div class="form-group">
            <label class="col-sm-4 color-blue">ÁREA DE ENVÍO SIGUIENTE PASO</label>    
            <div class="col-sm-4">
                <select class="form-control" name="idArea" id="idArea" required>
                    <?php foreach ($areas as $area) { ?>
                        <option value="<?= $area->id ?>"><?= $area->name_area ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div id="divTechnical" class="row col-sm-12" style="display: none; margin-top: 4px;">
        <div class="form-group">
            <label class="col-sm-4 color-blue">SELECCIONAR TÉCNICO</label>    
            <div class="col-sm-4">
                <select class="form-control" name="idTech" id="idTech">
                    <option></option>
                    <?php foreach ($tecs as $tec) { ?>
                        <option value="<?= $tec->id ?>"><?= $tec->name_user ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row col-sm-12" style="margin-top: 10px;">
        <label class="col-sm-4 color-blue">DOCUMENTOS RELACIONADOS</label>
        <div class="form-group col-md-8 footer1">
            <div class="col-sm-5">
                <div class="checkbox-form">
                    <span>Registro fotográfico </span><input type="checkbox" class="sinborde" id="idTypeDocument1" name="idTypeDocument1" value="1">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="checkbox-form">
                    <span>PISNM </span><input type="checkbox" id="idTypeDocument2" name="idTypeDocument2" value="2">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="checkbox-form">
                    <span>TSS </span><input type="checkbox" id="idTypeDocument3" name="idTypeDocument3" value="3">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="checkbox-form">
                    <span>Documento DAS </span><input type="checkbox" id="idTypeDocument4" name="idTypeDocument4" value="4">
                </div>
            </div>
        </div>
    </div>
    <div class="row col-sm-12">
        <label class="col-sm-4 color-blue">OBSERVACIONES DE REGISTRO</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="observations" id="obsv" rows="2" cols="80"></textarea>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="center block text-center">
            <button id="btnSubmit" type="submit" class="btn btn-lg btn-default color-blue pull-right" style="margin-top: 30px;">Registrar</button>
        </div>
    </div>
</div>
