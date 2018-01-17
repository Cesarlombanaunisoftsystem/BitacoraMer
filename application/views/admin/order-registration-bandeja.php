<!-- Modal -->
<div class="modal fade" id="mdl_order" tabindex="-1" role="dialog" aria-labelledby="mdl_order" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Detalle de la orden</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="box box-primary">
                <div class="box-body">
                  <form action="javascript:updateOrderB();" id="form-order-update" class="form-horizontal">
                    <?php $this->load->view('admin/bitacoraForm/header'); ?>
                  </form>
                  <div class="col-xs-12 col-md-11 col-md-offset-1">
                  <?php $this->load->view('admin/bitacoraForm/details'); ?>
                  </div>
                  <div class="col-xs-12 col-md-11 col-md-offset-1">
                  <form action="javascript:updateOrder2()" id="form-order2-update" class="form-horizontal" style="margin-top: 120px;">
                  <?php $this->load->view('admin/bitacoraForm/footer'); ?>
                  </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>