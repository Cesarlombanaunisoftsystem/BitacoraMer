$(document).ready(function () {
    $("#idServices").change(function () {
        url = get_base_url() + "Services/get_service_price";
        $("#idServices option:selected").each(function () {
            idServices = $('#idServices').val();
            $.post(url, {
                idServices: idServices
            }, function (data) {
                $("#price").html(data);
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
