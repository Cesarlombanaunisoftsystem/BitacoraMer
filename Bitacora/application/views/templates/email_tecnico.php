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
                <p><?= $user->name_user . ", " . $titulo ?></p>

                <p style="text-align:center">Las siguientes son las caracteristicas para el desarrollo de la presente visita.</p>
                <?php foreach ($content as $value) { ?>
                <ul>
                    <li>SERVICIO: <?= $value->name_activitie . " " . $value->name_service ?></li>
                    <li>SITIO: <?= $value->site ?></li>
                </ul>
                <?php }?>
                <ul>
                    <li>OBSERVACIÓN: <?= $order->observations ?></li>
                </ul>
                <br><p style="text-align:center">Si deseas registar un comentario o una observación Puedes escribirnos a info@bitacora.com o responder este email. Un representante se pondrá en contacto.</p>               
            </div>
        </div>
    </body>
</html>
