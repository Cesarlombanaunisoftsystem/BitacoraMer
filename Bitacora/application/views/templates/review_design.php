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
             border-color: red;
             border-style: solid;
             border-radius: 20px;">
            <div style="height: 450px;width: 430px; margin-left: 30px;">
                <p style="text-align:left;"><img src="http://bitacoramer.unisoftsystem.com.co/dist/img/logo_mail.png" alt="logo Mer">
                    <img src="http://bitacoramer.unisoftsystem.com.co/dist/img/titulo_mail.png"  height="90px" width="250px" alt="titulo"/></p>
                <p><img src="http://bitacoramer.unisoftsystem.com.co/dist/img/hr_mail.png" alt="hr"></p>
                <p><?= $titulo?></p>
                <p style="text-align:center">Ha querido compartir material resultante del proceso de creación de diseño.</p>
                <ul>
                    <li>SERVICIO: <?= $content->name_activitie . ' - ' . $content->name_service ?></li>
                    <li>SITIO: <?= $content->site ?></li>
                </ul>
                <br>
                <p style="text-align:center">El siguiente link le permitirá visualizar la información Compartida: http://bitacora/4500176909 </p>
                <br>
                <p style="text-align:center">Si deseas registrar un comentario o una observación Puedes escribirnos a info@bitacora.com o responder este email. Un representante se pondrá en contacto</p>               
            </div>
        </div>
    </body>
</html>
