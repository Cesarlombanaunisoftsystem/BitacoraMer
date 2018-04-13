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
        <div class="container">
            <div class="row login-b">

                 <div class="login-logo col-md-4 col-md-offset-2" style="padding:0;background: rgba(255,255,255,0.5); border-radius: 10px 0 0 10px">
                    <a href="#"><img src="<?= base_url('dist/img/logo.png') ?>" class="img-responsive center-block" style="height: 250px"></a>
                </div>
                <div class="login-box-body col-md-4 " style="height: 250px;border-radius: 0 10px 10px 0;padding: 10px;">
                    <div class="text-center">
                    <p class="login-box-msg text-uppercase" style="font-weight: bold;margin-top: 15px;" >Ingresa utilizando tu usuario y contraseña</p>
                    
                     <?php
                    if ($this->session->flashdata('usuario_incorrecto')) {
                        ?>
                        <p class="text-danger"><strong><?= $this->session->flashdata('usuario_incorrecto') ?></strong></p>
                        <?php
                    }
                    ?>
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
                                <input type="submit" class="btn text-white btn-block btn-primary" value="Ingresar"/>
                            </div>
                        </div>
                    </form>
                   
                </div>
                </div>

            </div>
        </div>

        <div class="login-box">
           
            
        </div>
        <?php $this->load->view('templates/login/libs') ?>
        <?php $this->load->view('templates/login/js') ?>
    </body>
</html>
