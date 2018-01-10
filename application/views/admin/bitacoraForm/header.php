<input type="hidden" name="subtotal"/>
<input type="hidden" name="discount"/>
<input type="hidden" name="iva"/>
<input type="hidden" name="total"/>
<input type="hidden" name="idArea">
<input type="hidden" name="idTypeDocument1">
<input type="hidden" name="idTypeDocument2">
<input type="hidden" name="idTypeDocument3">
<input type="hidden" name="idTypeDocument4">
<input type="hidden" name="observations">
<input type="hidden" name="idOrderType">
<input type="hidden" name="items" id="items">

<div class="col-xs-12 col-md-1">
  <img src="dist/img/orden.jpg" style="width: 130px;margin-top: -22px;">
</div>
<div class="col-xs-12 col-md-11">
  <div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group">
      <label class="col-md-5 control-label label-form">Número de orden:</label>
      <div class="input-group col-md-7">
        <input type="text" class="form-control input-readonly get-uniquecode" name="uniquecode" value="Sin generar" readonly/>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group">
      <label class="col-md-5 control-label label-form">Centro de costos:</label>
      <div class="input-group col-md-7">
        <input type="text" class="form-control input-readonly get-uniqueCodeCentralCost" name="uniqueCodeCentralCost" value="Sin generar" readonly/>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group">
      <label class="col-md-5 control-label label-form">Fecha de creación:</label>
      <div class="input-group col-md-6">
        <input type="date" class="form-control today input-readonly" name="date" readonly/>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group">
      <label class="col-md-5 control-label label-form">Coodinador externo:</label>
      <div class="input-group col-md-7">
        <div class="input-group col-md-7">
          <select class="form-control coordinators-ext input-readonly" name="idCoordinatorExt" required></select>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group">
      <label class="col-md-5 control-label label-form">Coodinador interno:</label>
      <div class="input-group col-md-7">
        <select class="form-control coordinators-int input-readonly" name="idCoordinatorInt" required></select>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-md-6 col-md-4">
    <div class="form-group">
      <label class="col-md-5 control-label label-form">Forma de pago:</label>
      <div class="input-group col-md-6">
        <select class="form-control form-pays input-readonly" name="idFormPay" required></select>
      </div>
    </div>
  </div>
</div>