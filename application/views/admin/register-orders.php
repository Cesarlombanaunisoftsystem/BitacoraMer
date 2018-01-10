<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('templates/head') ?>
</head>
<body  class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  <?php $this->load->view('templates/header') ?>
  <?php $this->load->view('templates/menu-right') ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Registro de orden de servicio</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Registro de orden de servicio</li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-12 nav-tabs-custom">
               <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#binnacle" onclick="loadPreOrder(1)" aria-controls="binnacle" role="tab" data-toggle="tab">BTS</a></li>
                <li role="presentation"><a href="#binnacle" onclick="loadPreOrder(2)" aria-controls="binnacle" role="tab" data-toggle="tab">DAS</a></li>
                <li role="presentation"><a href="#binnacle" onclick="loadPreOrder(3)" aria-controls="binnacle" role="tab" data-toggle="tab">Mantenimiento</a></li>
                <li role="presentation"><a href="#binnacle" onclick="loadPreOrder(4)" aria-controls="binnacle" role="tab" data-toggle="tab">Venta de producto</a></li>
                <li role="presentation"><a href="#binnacle" onclick="loadPreOrder(5)" aria-controls="binnacle" role="tab" data-toggle="tab">QMC</a></li>
                <li role="presentation"><a href="#Bandeja" aria-controls="binnacle" role="tab" data-toggle="tab" onclick="orders()">Registros procesados</a></li>
              </ul>
            </div>
          </div>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="binnacle">
            <?php $this->load->view('admin/order-registration-binnacle') ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="das">

            </div>
            <div role="tabpanel" class="tab-pane" id="Mantenimiento">

            </div>
            <div role="tabpanel" class="tab-pane" id="Venta">

            </div>
            <div role="tabpanel" class="tab-pane" id="QMC">

            </div>
            <div role="tabpanel" class="tab-pane" id="Bandeja">
            <?php $this->load->view('admin/order-registration-bandeja') ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<div class="control-sidebar-bg"></div>
<?php $this->load->view('templates/footer.html') ?>
</div>
<?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
</body>
</html>
