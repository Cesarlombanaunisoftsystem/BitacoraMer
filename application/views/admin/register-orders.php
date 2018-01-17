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
                    <h1>Registro ordenes de servicio</h1>        
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
        <script type="text/javascript">
            $( document ).ready(function() {
            $( "#idOrder" ).focus();
            var subtotal = $("#sumSubtotal").val();
            $('#subtotal').val(subtotal);
            });

            function discountOrder(){
                var subtotal = $("#sumSubtotal").val();
                var tax = $('#tax').val();
                var discount = $('#discount').val();
                var calcDiscount = (subtotal * discount) / 100;
                var subTotalDiscount = subtotal - calcDiscount;
                var taxSubtotalDiscount = (subTotalDiscount * tax) / 100;
                var total = subTotalDiscount + taxSubtotalDiscount;
                $('#total').val(total);
            }

            function addIdOrder(){
                if($('#idOrder').val() == ""){
                    alertify.error('Debes asignar un número de ordén para continuar!');
                    location.reload();
                } else {
                    var uniqueCentCost = Math.round(Math.random()*100000);
                    $('#idCentCost').val(uniqueCentCost);
                }
            }

            function generateOrder(){
                var order = $('#idOrder').val();
                var centCost = $('#idCentCost').val();
                url = get_base_url() + "Orders/add_order";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {order:order,centCost:centCost},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Orden generada, puede continuar');
                            location.reload();
                        }
                    }
                });
            }

            function addDetail() {
                var idOrder = $("#id").val();
                var idActivities = $("#idActivities").val();
                var act = $("#idActivities option:selected").text();
                var idServices = $("#idServices").val();
                var serv = $("#idServices option:selected").text();
                var cant = $("#count").val();
                var site = $("#site").val();
                var price = $("#vrUnit").val();
                var total = $("#vrTotal").val();
                url = get_base_url() + "Orders/add_order_detail";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {idOrder:idOrder, idActivities:idActivities, idServices:idServices, site:site, price:price, count:cant, total:total},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Detalle agregado exitosamente');
                            location.reload();
                        }
                    }
                });
            }

            function removeDetailOrder(id) {
                url = get_base_url() + "Orders/remove_order_detail";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id:id},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            location.reload();
                            alertify.success('Detalle eliminado exitosamente');
                        }
                    }
                });
            }

            function registerOrder() {
                var id = $("#id").val();
                var idOrder = $('#idOrder').val();
                var idCentCost = $('#idCentCost').val();
                var idCoordExt = $('#idCoordExt').val();
                var idCoordInt = $('#idCoordInt').val();
                var idFormPay = $('#idFormPay').val();
                var subtotal = $('#subtotal').val();
                var discount = $('#discount').val();
                var tax = $('#tax').val();
                var total = $('#total').val();
                var idArea = $('#idArea').val();
                var doc1 = $('#idTypeDocument1').val();
                var doc2 = $('#idTypeDocument2').val();
                var doc3 = $('#idTypeDocument3').val();
                var doc4 = $('#idTypeDocument4').val();
                var obsv = $('#obsv').val();
                
                url = get_base_url() + "Orders/register_order";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id:id, idOrder:idOrder, idCentCost:idCentCost, idCoordExt:idCoordExt, idCoordInt:idCoordInt, idFormPay:idFormPay, subtotal:subtotal, discount:discount, tax:tax, total:total, idArea:idArea, doc1:doc1, doc2:doc2, doc3:doc3, doc4:doc4, obsv:obsv},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Orden completa agregada y pasada a siguiente area exitosamente');
                            location.reload();
                        }
                    }
                });
            }
        </script>
    </body>
</html>
