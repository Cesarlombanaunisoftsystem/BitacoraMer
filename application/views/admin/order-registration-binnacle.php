<div class="box box-primary">
  <div class="box-body">
    <form action="#" id="form-order" class="form-horizontal">
      <input type="hidden" name="idOrderState" value="2"/>
      <?php $this->load->view('admin/bitacoraForm/header'); ?>
    </form>
    <div class="col-xs-12 col-md-11 col-md-offset-1">
    <?php $this->load->view('admin/bitacoraForm/details'); ?>
    </div>
    <div class="col-xs-12 col-md-11 col-md-offset-1">
    <form action="#" id="form-order2" class="form-horizontal" style="margin-top: 120px;">
    <?php $this->load->view('admin/bitacoraForm/footer'); ?>
    </form>
    </div>
  </div>
</div>