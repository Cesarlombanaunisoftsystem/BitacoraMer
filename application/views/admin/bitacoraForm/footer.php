<div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-4">
  <label class="color-blue">Subtotal:</label>
  <div class="input-group">
    <input type="text" class="form-control bg-white" name="subtotal" readonly/>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-2">
  <label class="color-blue">Descuento(%):</label>
  <div class="input-group">
    <input type="number" class="form-control bg-white" onkeyup="discountOrder(this.value)" name="discount"/>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-2">
  <label class="color-blue">Iva:</label>
  <div class="input-group">
    <input type="text" class="form-control bg-white iva" name="iva"  readonly/>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-2">
  <label class="color-blue">Total:</label>
  <div class="input-group">
    <input type="text" class="form-control bg-white" name="total" readonly/>
  </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-1">
  <div class="form-group">
    <label class="col-xs-4 control-label" for="file-order"><div style="background-color: #777;border-radius: 50%;width: 60px;height: 60px;"><img src="dist/img/clip.png" style="width: 35px;margin-top: 15px;margin-right: 11px;"></div></label>
    <div class="input-group col-xs-6" style="margin-top: 18px;">
      <!-- <input type="text" id="fake-file-input-name" class="form-control" name="iva" readonly/> <i class="fa fa-thumb-tack icon-upload" aria-hidden="true"></i>-->
      <input type="file" id="file-order" name="file-order" value="" style="display:none">
      <!-- <script type="text/javascript">
        document.getElementById('picture-devolucion').addEventListener('change', function() {
          $('#fake-file-input-name').val(this.value);
        });
      </script> -->
    </div>
  </div>
</div>
<div class="col-xs-12 col-md-9">
  <div class="form-group" style="margin-top:15px;">
    <label class="col-md-4 control-label color-blue">Área de Envío (Siguiente paso):</label>
    <div class="input-group col-md-6">
      <select class="form-control areas" name="idArea" required></select>
    </div>
  </div>
</div>
<div class="col-xs-12 col-md-9">
  <div class="form-group">
    <label class="col-md-4 control-label color-blue">Documentos relacionados:</label>
    <div class="input-group col-md-8">
      <div class="row">
        <div class="col-xs-4">
          <div class="checkbox-form">
            <span>Registro fotográfico</span> <input type="checkbox" id="idTypeDocument1" name="idTypeDocument1" value="1">
          </div>
        </div>
        <div class="col-xs-2">
          <div class="checkbox-form">
            <span>PISNM</span> <input type="checkbox" id="idTypeDocument2" name="idTypeDocument2" value="2">
          </div>
        </div>
        <div class="col-xs-2">
          <div class="checkbox-form">
            <span>TSS</span> <input type="checkbox" id="idTypeDocument3" name="idTypeDocument3" value="3">
          </div>
        </div>
        <div class="col-xs-4">
          <div class="checkbox-form">
            <span>Documento DAS</span> <input type="checkbox" id="idTypeDocument4" name="idTypeDocument4" value="4">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xs-12 col-md-9">
  <div class="form-group">
    <label class="col-md-4 control-label color-blue">Observaciones:</label>
    <div class="input-group col-md-8">
      <textarea class="form-control" name="observations" rows="4" cols="80"></textarea>
    </div>
  </div>
</div>
<div class="col-xs-12">
  <div class="center block text-center">
    <button type="submit" class="btn btn-lg btn-default color-blue pull-right" style="margin-top: 30px;">Registrar</button>
  </div>
</div>