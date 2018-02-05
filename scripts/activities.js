/**
 * bitacora 1.0.0
 * software
 * Copyright 2017, Unisoft
 * https://www.unisoftsystem.com.co/
 * Auhor: Jhon Jairo Valdés Aristizabal
 * Email jhon.valdes@unisoftsystem.com.co
 * Licensed Apache License
 * Released on: Octuber 25, 2017
 * Updated on: Octuber 25, 2017
 */


/*========================================================================*/
$(document).ready(function () {
  $("#idActivities").change(function () {
    url = get_base_url() + "Activities/get_services";
    $("#idActivities option:selected").each(function () {
      idActivities = $('#idActivities').val();
      $.post(url, {
        idActivities: idActivities
      }, function (data) {
        $("#idServices").html(data);
      });
    });
  });
});
/*========================================================================*/
