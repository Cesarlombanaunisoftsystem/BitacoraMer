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
                <div id="load_menu"></div>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="sale">
                                    <form id="frmSale" method="POST" enctype="multipart/form-data">
                                        <div class="box box-primary">
                                            <div class="box-body">
                                                <?php $this->load->view('admin/bitacoraForm/header'); ?>
                                                <?php //$this->load->view('admin/sale/header'); ?>
                                                <div class="col-xs-12 col-md-11 col-md-offset-1">
                                                    <?php $this->load->view('admin/sale/details'); ?>
                                                </div>
                                                <div class="col-xs-12 col-md-11 col-md-offset-1">
                                                    <?php $this->load->view('admin/sale/footer'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
            $(function () {

                if ($('#idOrder').val() === "") {
                    $('#btnSubmit').prop('disabled', true);
                }
                var subtotal = $("#sumSubtotal").val();
                $('#subtotal').val(subtotal);
                var tax = $('#tax').val();
                var discount = $('#discount').val();
                var calcDiscount = (subtotal * discount) / 100;
                var subTotalDiscount = subtotal - calcDiscount;
                var taxSubtotalDiscount = (subTotalDiscount * tax) / 100;
                var total = subTotalDiscount + taxSubtotalDiscount;
                if (!total) {
                    $('#total').val();
                } else {
                    $('#total').val(total);
                }

                $("#frmSale").on("submit", function (e) {
                    e.preventDefault();

                    var formData = new FormData(document.getElementById("frmSale"));

                    var id = $('#id').val();
                    var pdf = $('#pdf').val();
                    url = get_base_url() + "Orders/get_details?jsoncallback=?";
                    $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                    $.getJSON(url, {id: id, type: '4'}).done(function (res) {
                        $('#spinner').html("");
                        if (res.res === false) {
                            alertify.error('Debes incluir al menos una actividad!');
                        } else {
                            url = get_base_url() + "Orders/register_order";
                            $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                            $.ajax({
                                url: url,
                                type: "post",
                                dataType: "html",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false
                            })
                                    .done(function (res) {
                                        $('#spinner').html("");
                                        if (res === "error") {
                                            alertify.error('Error en BBDD');
                                        }
                                        if (res === "ok") {
                                            alertify.success('Orden completa agregada y pasada a siguiente area exitosamente');
                                            location.reload();
                                        }
                                    });
                        }
                    });
                });
            });
            
            function getFileName(elm) {
                var fn = $(elm).val();
                $("#datofile").html(fn);
            }

            $('#idFormPay').bind("change keyup", function (e)
            {
                e.preventDefault();
                var id = $('#id').val();
                var idCoorExt = $("#idCoordExt").val();
                var idCoorInt = $("#idCoordInt").val();
                var idPay = $("#idFormPay").val();
                url = get_base_url() + "Orders/update_head_order";
                $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                $.ajax({
                    url: url,
                    type: "post",
                    data: {id: id, idCoorExt: idCoorExt, idCoorInt: idCoorInt, idPay: idPay},
                    success: function (resp) {
                        $('#spinner').html("");
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Cabecera generada exitosamente.');
                        }
                    }
                });
            });

            function discountOrder() {
                var subtotal = $("#sumSubtotal").val();
                var tax = $('#tax').val();
                var discount = $('#discount').val();
                var calcDiscount = (subtotal * discount) / 100;
                var subTotalDiscount = subtotal - calcDiscount;
                var taxSubtotalDiscount = (subTotalDiscount * tax) / 100;
                var total = subTotalDiscount + taxSubtotalDiscount;
                $('#total').val(total);
            }

            function addIdOrder() {
                if ($('#idOrder').val() === "" && $('#coi').val() === "") {
                    alertify.error('Debes asignar un número de ordén y coi para continuar!');
                } else {
                    generateOrder();
                }
            }

            function generateOrder() {
                var order = $('#idOrder').val();
                var coi = $('#coi').val();
                url = get_base_url() + "Orders/get_order?jsoncallback=?";
                $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                $.getJSON(url, {order: order, coi: coi}).done(function (res) {
                    $('#spinner').html("");
                    if (res.res === true) {
                        alertify.error('El número de ordén digitado ya existe.');
                        $("#idOrder").focus();
                    } else {
                        url = get_base_url() + "Orders/add_order";
                        $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {order: order, coi: coi, type:'4'},
                            success: function (resp) {
                                $('#spinner').html("");
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
                });
            }

            function addDetail() {
                var id = $('#id').val();
                var idOrder = $("#id").val();
                var idActivities = $("#idActivities").val();
                var idServices = $("#idServices").val();
                var cant = $("#count").val();
                var site = $("#site").val();
                var price = $("#vrUnit").val();
                var cost = $("#cost").val();
                var total = $("#vrTotal").val();
                var totalCost = $("#vrTotalCost").val();
                if (cant === "" || site === "") {
                    alertify.error('Debes asignar una cantidad númerica correcta y un sitio!');
                } else {
                    url = get_base_url() + "Orders/get_details_service?jsoncallback=?";
                    $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                    $.getJSON(url, {id: id, idServices: idServices}).done(function (res) {
                        $('#spinner').html("");
                        if (res.res === true) {
                            alertify.error('Esta actividad ya se encuentra registrada!');
                        } else {
                            url = get_base_url() + "Orders/add_order_detail";
                            $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {idOrder: idOrder, idActivities: idActivities, idServices: idServices, site: site, price: price, cost: cost, totalCost: totalCost, count: cant, total: total},
                                success: function (resp) {
                                    $('#spinner').html("");
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
                    });
                }
            }

            function removeDetailOrder(id) {
                url = get_base_url() + "Orders/remove_order_detail";
                $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id: id},
                    success: function (resp) {
                        $('#spinner').html("");
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
        cargar_menu("<?php echo base_url('Home/menu'); ?>","registro_ordenes",'venta de producto');

        </script>
    </body>
</html>
