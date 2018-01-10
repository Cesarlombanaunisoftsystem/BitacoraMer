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
  <form action="javascript:orderAddItem(0);" id="form-addItem">
    <tr>
      <td width="200">
        <div class="input-group">
          <select class="form-control activities" name="idActivities" id="idActivities" required>          
          <option value="">Seleccionar</option>
          <?php if(isset($activities)){ ?>
           <?php foreach($activities as $activitie){ ?>
           <option value="<?= $activitie->id ?>"><?= $activitie->name ?></option>
           <?php
              }
            }
          ?>
          </select>          
        </div>
      </td>
      <td width="200">
          <select class="form-control" name="idServices" id="idServices" required></select>        
      </td>
      <td width="10">
          <input type="number" class="form-control" name="count"  min="1" onkeyup="priceForCount(this.value)" required/>        
      </td>
      <td width="100">
          <input type="text" class="form-control" name="site" autocomplete="off" required/>
      </td>
      <td width="10">
          <input type="text" class="form-control" name="price" readonly required/>        
      </td>
      <td width="115">
          <input type="text" class="form-control" name="total" readonly required/>        
      </td>
      <td>
          <button type="submit" class="btn-transparent"><i class="fa fa-check" aria-hidden="true"></i></button>        
      </td>
    </tr>
  </form>
  <tbody id="orders-items-data">

  </tbody>
</table>