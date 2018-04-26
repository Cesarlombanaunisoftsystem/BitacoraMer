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
        var url = get_base_url() + "Activities/get_services";
        $("#idActivities option:selected").each(function () {
            idActivities = $('#idActivities').val();
            $.post(url, {
                idActivities: idActivities
            }, function (data) {
                $("#idServices").html(data);
            });
        });
    });
    $("#selService").change(function () {
        var url = get_base_url() + "Services/get_service";
        $("#selService option:selected").each(function () {
            selService = $('#selService').val();
            $.post(url, {
                selService: selService
            }, function (data) {
                $("#txtTree").val(data);
            });
        });
        var url1 = get_base_url() + "Services/get_folder_service";
        $("#selService option:selected").each(function () {
            selService = $('#selService').val();
            $.post(url1, {
                selService: selService
            }, function (data) {
                $("#txtPath").val(data);
            });
        });
    });
});
/*========================================================================*/
