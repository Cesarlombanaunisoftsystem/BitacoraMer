<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div style="clear: left;
             height: 400px;
             width: 500px;
             margin-right: 10px;
             padding: 5px;
             float: left;
             border-width: 4px;
             border-color: blue;
             border-style: solid;
             border-radius: 20px;">
            <div style="height: 450px;
                 width: 430px; margin-left: 30px;">
                <p style="text-align:left;"><img src="<?= base_url('dist/img/logo_mail.png') ?>" alt="logo Mer"><img src="<?= base_url('dist/img/titulo_mail.png') ?>"  height="90px" width="250px" alt="titulo"/></p>
                <p><img src="<?= base_url('dist/img/hr_mail.png') ?>" alt="hr"></p>
                <p><?= $content->name_user ?>, <?= $titulo?></p>

                <ul>
                    <li>No.Orden: <?= $content->uniquecode ?></li>
                    <li>Actividad: <?= $content->name_activitie ?></li>
                    <li>Servicio: <?= $content->name_service ?></li>
                    <li>Sitio: <?= $content->site ?></li>
                </ul>
                <br><p style="text-align:center">Para mayor información ingrese a:</p>
                <p style="text-align:center"><a href="https://bitacora.com.ap">https://bitacora.com.ap</a></p><br>
                <br><p style="text-align:center">Si deseas registar un comentario o una observación Puedes escribirnos a info@bitacora.com o responder este email.</p>               
            </div>
        </div>
    </body>
</html>