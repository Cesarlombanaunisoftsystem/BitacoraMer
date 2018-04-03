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
                                        <li role="presentation" class="active"><a href="#binnacle" aria-controls="binnacle" role="tab" data-toggle="tab">BTS</a></li>
                                        <li role="presentation"><a href="<?= base_url('Das') ?>" aria-controls="binnacle" role="tab" data-toggle="">DAS</a></li>
                                        <li role="presentation"><a href="<?= base_url('Maintenance') ?>" aria-controls="binnacle" role="tab" data-toggle="">Mantenimiento</a></li>
                                        <li role="presentation"><a href="<?= base_url('Sale') ?>" aria-controls="binnacle" role="tab" data-toggle="">Venta de producto</a></li>
                                        <li role="presentation"><a href="<?= base_url('Qmc') ?>" aria-controls="binnacle" role="tab" data-toggle="">QMC</a></li>
                                        <li role="presentation"><a href="#Bandeja" aria-controls="binnacle" role="tab" data-toggle="tab">REGISTROS PROCESADOS</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="binnacle">
                                    <form id="frmRegisterOrder" method="POST" enctype="multipart/form-data"><?php $this->load->view('admin/order-registration-binnacle') ?></form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="das">
                                </div>
                                <div role="tabpanel" class="tab-pane" id="man">
                                </div>
                                <div role="tabpanel" class="tab-pane" id="sale">
                                </div>
                                <div role="tabpanel" class="tab-pane" id="qmc">
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
                var subtotalf = formatNumber(subtotal);
                $('#subtotalshow').val(subtotalf);
                $('#subtotal').val(subtotal);
                var tax = $('#tax').val();
                var discount = $('#discount').val();
                var calcDiscount = (subtotal * discount) / 100;
                var subTotalDiscount = subtotal - calcDiscount;
                var taxSubtotalDiscount = (subTotalDiscount * tax) / 100;
                var total = subTotalDiscount + taxSubtotalDiscount;
                var totalf = formatNumber(total);
                if (!total) {
                    $('#total').val();
                    $('#totalshow').val();
                } else {
                    $('#total').val(total);
                    $('#totalshow').val(totalf);
                }

                $("#frmRegisterOrder").on("submit", function (e) {
                    e.preventDefault();
                    var formData = new FormData(document.getElementById("frmRegisterOrder"));
                    var id = $('#id').val();
                    url = get_base_url() + "Orders/get_details?jsoncallback=?";
                    $.getJSON(url, {id: id, type: '1'}).done(function (res) {
                        $('#spinner').html("");
                        if (res.res === false) {
                            alertify.error('Debes incluir al menos una actividad!');
                        } else {
                            if ($("#userfile").val() === "") {
                                alertify.error('Debes adjuntar el documento de la ordén !');
                                return false;
                            }
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
            $("#idArea").change(function () {
                var area = $("#idArea").val();
                if (area !== '1') {
                    $('#divTechnical').show();
                } else {
                    $('#divTechnical').hide();
                }
            });
            function getFileName(elm) {
                var fn = $(elm).val();
                $("#datofile").html(fn);
            }

            function genHead() {
                var id = $('#id').val();
                var idCoorExt = $("#idCoordExt").val();
                var idCoorInt = $("#idCoordInt").val();
                url = get_base_url() + "Orders/update_head_order";
                //$('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                $.ajax({
                    url: url,
                    type: "post",
                    data: {id: id, idCoorExt: idCoorExt, idCoorInt: idCoorInt},
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Error en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Coordinador seleccionado.');
                        }
                    }
                });
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
                            $("#btnSubmit").removeAttr('disabled');
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
                var totalf = formatNumber(total);
                $('#total').val(total);
                $('#totalshow').val(totalf);
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
                            data: {order: order, coi: coi, type: '1'},
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
                $("#btnDetail").prop("disabled", true);
                var id = $('#id').val();
                var idOrder = $("#id").val();
                var idActivities = $("#idActivities").val();
                var idServices = $("#idServices").val();
                var cant = $("#count").val();
                var site = $("#site").val();
                var price = $("#vrUnit").val();
                var cost = $("#cost").val();
                var total = $("#vrTotal").val();
                var totalCost = cost * cant;
                if (cant === "" || site === "") {
                    alertify.error('Debes asignar una cantidad númerica correcta y un sitio!');
                    location.reload();
                } else {
                    url = get_base_url() + "Orders/get_details_service?jsoncallback=?";
                    $('#spinner').html('<center> <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></center>');
                    $.getJSON(url, {id: id, idServices: idServices}).done(function (res) {
                        $('#spinner').html("");
                        if (res.res === true) {
                            alertify.error('Esta actividad ya se encuentra registrada!');
                            location.reload();
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
                                        $("#btnDetail").prop("disabled", false);
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

            $('#data-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dt.row(tr);
                order_id = $(this).attr("id");
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).html('<i class="fa fa-plus-square-o"></i>');
                } else {
                    getDetails(order_id);
                    getFoot(order_id);
                    getDocs(order_id);
                    closeOpenedRows(dt, tr);
                    $(this).html('<i class="fa fa-minus-square-o"></i>');
                    row.child(format(order_id)).show();
                    tr.addClass('shown');
                    openRows.push(tr);
                }
            });
            function format(d) {
                return  '<table class="table" style="font-size: 12px">' +
                        '<thead><tr style="color: #00B0F0">' +
                        '<th>ACTIVIDAD</th><th>SERVICIO</th><th>CANTIDAD</th><th>SITIO</th>' +
                        '<th>VR.UNITARIO</th><th>VR.TOTAL</th>' +
                        '</tr></thead>' +
                        '<tbody id="bodydetails_' + d + '"></tobody></table>' +
                        '<table class="table" style="font-size: 12px">' +
                        '<thead><tr style="color: #00B0F0"><th>TOTAL BRUTO</th>' +
                        '<th>DESCUENTO</th><th>I.V.A</th>' +
                        '<th>TOTAL</th><th id="pdf_' + d + '"></th></tr><thead><tbody id="bodyfoot_' + d + '">' +
                        '</tbody></table>' +
                        '<table class="table" style="font-size: 12px">' +
                        '<thead><tr><th style="color: #00B0F0">AREA DE SIGUIENTE PASO</th>' +
                        '<th><input type="text" id="txtArea_' + d + '"></th>' +
                        '</tr><tr><th style="color: #00B0F0">DOCUMENTOS RELACIONADOS</th>' +
                        '<th>REGISTRO FOTOGRAFICO <input type="checkbox" class="disable photos' + d + '"></th>' +
                        '<th>PISINM <input type="checkbox" class="disable pisnm' + d + '"></th>' +
                        '<th>TSS <input type="checkbox" class="disable tss' + d + '"></th>' +
                        '<th>DOCUMENTO DAS <input type="checkbox" class="disable das' + d + '"></th></tr>' +
                        '<tr><th style="color: #00B0F0">OBSERVACIONES DE REGISTRO</th>' +
                        '<th><input type="text" id="txtObsv_' + d + '" disabled></th></tr></table>';
            }
            function getFoot(idOrder) {
                var url = get_base_url() + "Orders/get_order_xid?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $("#bodyfoot_" + idOrder).html('<tr><td>' + formatNumber(res.res.subtotal) +
                            '</td><td>' + res.res.discount +
                            '</td><td>' + res.res.iva + '%</td><td>' + formatNumber(res.res.total) +
                            '</td></tr>');
                    $("#txtObsv_" + idOrder).val(res.res.observations);
                    $("#pdf_" + idOrder).html('<a href=' + get_base_url() + 'uploads/' + res.res.picture + ' target="blank">' +
                            '<div style="background-color: #777;border-radius: 50%;width: 40px;height: 40px;">' +
                            '<img src="' + get_base_url() + 'dist/img/clip.png" style="width: 25px;margin-top: 10px;margin-right: 1px;margin-left: 7px;">' +
                            '</div></a>');
                });
            }
            function getDetails(idOrder) {
                var url = get_base_url() + "Orders/details_orders_tray?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $.each(res["details"], function (i, details) {
                        $("#bodydetails_" + idOrder).append('<tr><td>' + details.name_activitie +
                                '</td><td>' + details.name_service +
                                '</td><td>' + details.count + '</td><td>' + details.site + '</td>' +
                                '<td>' + formatNumber(details.price) + '</td><td>' + formatNumber(details.total) + '</td></tr>');
                    });
                });
            }

            function getDocs(idOrder) {
                var url = get_base_url() + "Orders/get_details_order?jsoncallback=?";
                $.getJSON(url, {idOrder: idOrder}).done(function (res) {
                    $.each(res["docs"], function (i, doc) {
                        if (doc.idTypeDocument === "2") {
                            $(".pisnm" + idOrder).prop('checked', true);
                        }
                        if (doc.idTypeDocument === "3") {
                            $(".tss" + idOrder).prop('checked', true);
                        }
                        if (doc.idTypeDocument === "4") {
                            $(".das" + idOrder).prop('checked', true);
                        }
                        if (doc.idTypeDocument === "1") {
                            $(".photo" + idOrder).prop('checked', true);
                        }
                    });
                });
            }

            function formatNumber(num) {
                if (!num || num === 'NaN')
                    return '-';
                if (num === 'Infinity')
                    return '&#x221e;';
                num = num.toString().replace(/\$|\,/g, '');
                if (isNaN(num))
                    num = "0";
                sign = (num === (num = Math.abs(num)));
                num = Math.floor(num * 100 + 0.50000000001);
                num = Math.floor(num / 100).toString();
                for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                    num = num.substring(0, num.length - (4 * i + 3)) + '.' +
                            num.substring(num.length - (4 * i + 3));
                return (((sign) ? '' : '') + '$ ' + num);
            }
        </script>
    </body>
</html>
