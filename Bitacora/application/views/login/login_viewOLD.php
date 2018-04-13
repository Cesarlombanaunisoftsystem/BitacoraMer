<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('templates/head') ?>
        <style type="text/css">
            html{
                background-image: url('dist/img/bg.jpg');
                background-size: cover;
                z-index: 1000;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                overflow-y: hidden;
            }
            body{
                background: transparent !important;
            }
        </style>
    </head>
    <body>
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><img src="<?= base_url('dist/img/logo.png') ?>" style="width: 200px;"></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Ingresa para iniciar su sesión lorem</p>
                <?php
                if (isset($logout_message)) {
                    echo "<div class='message'>";
                    echo $logout_message;
                    echo "</div>";
                }
                ?>
                <form action="<?= base_url('login/new_user') ?>" method="post" id="form-login" style="margin-bottom: 20px;">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" required />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <p><?= form_error('email') ?></p>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Contraseña" name="password" minlength="7" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <p><?= form_error('password') ?></p>
                        <input type="hidden" name="token" value="<?= $token ?>"/>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="submit" class="btn text-white color-default btn-block btn-flat" value="Ingresar"/>
                        </div>
                    </div>
                </form>
                <?php
                if ($this->session->flashdata('usuario_incorrecto')) {
                    ?>
                    <p><?= $this->session->flashdata('usuario_incorrecto') ?></p>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php $this->load->view('templates/login/libs') ?>
        <?php $this->load->view('templates/login/js') ?>
    </body>
</html>
