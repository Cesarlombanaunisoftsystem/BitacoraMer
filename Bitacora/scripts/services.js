$(document).ready(function () {
    $("#idServices").change(function () {
        url = get_base_url() + "Services/get_service_price";
        url2 = get_base_url() + "Services/get_service_unit_measurement";
        $("#idServices option:selected").each(function () {
            idServices = $('#idServices').val();
            $.post(url, {
                idServices: idServices
            }, function (data) {
                $("#price").html(data);
            });
        });
        $("#idServices option:selected").each(function () {
            idServices = $('#idServices').val();
            $.post(url2, {
                idServices: idServices
            }, function (data) {
                $("#unit_measurement").html(data);
            });
        });
    });
    $("#count").change(function () {
        var cant = $("#count").val();
        var vrUnit = $("#vrUnit").val();
        $("#vrTotal").val(cant * vrUnit);
        var vrCostUnit = $("#cost").val();
        $("#vrTotalCost").val(cant * vrCostUnit);
    });
});
