<table id="orders-items-table" class="table " style="margin-left: 17px;">
  <thead>
    <tr>
      <th class="color-blue">Actividad</th>
      <th class="color-blue">Servicio</th>
      <th class="color-blue">Sitio</th>
      <th class="color-blue">Cantidad</th>
      <th class="color-blue">Precio unitario</th>
      <th class="color-blue">Total</th>
      <th class="color-blue">Acción</th>
    </tr>
  </thead>
  <form action="javascript:orderAddItem(0);" id="form-addItem">
    <tr>
      <td>
        <div class="input-group">
          <select class="form-control activities" name="idActivities" required></select>
        </div>
      </td>
      <td>
        <div class="input-group">
          <select class="form-control services" name="idServices" onchange="getServicePrice(this.value)" required></select>
        </div>
      </td>
      <td>
        <div class="input-group">
          <input type="text" class="form-control" name="site" autocomplete="off" required/>
        </div>
      </td>
      <td>
        <div class="input-group">
          <input type="number" class="form-control" name="count" min="1" onkeyup="priceForCount(this.value)" required/>
        </div>
      </td>
      <td>
        <div class="input-group">
          <input type="text" class="form-control set-service-price" name="price" readonly required/>
        </div>
      </td>
      <td>
        <div class="input-group">
          <input type="text" class="form-control set-total" name="total" readonly required/>
        </div>
      </td>
      <td>
        <div class="center block">
          <button type="submit" class="btn-transparent"><i class="fa fa-check" aria-hidden="true"></i></button>
        </div>
      </td>
    </tr>
  </form>
  <tbody id="orders-items-data">

  </tbody>
</table>