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
  })
  $("#count").mouseout(function () { 
    var cant = $("#count").val();
    var vrUnit = $("#vrUnit").val();
    var vrTotal = cant * vrUnit;
    $("#vrTotal").val(vrTotal);
  });
})