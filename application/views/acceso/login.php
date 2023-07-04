<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php
            if (isset($title)) {
                echo $title;
            } else {
                echo 'Sistema Contravencional';
            }
            ?></title>

        <!-- Bootstrap 3.3.6 -->
        <?php echo link_tag('template/bootstrap/css/bootstrap.css'); ?>

        <!-- Font Awesome -->
        <?php echo link_tag('template/bootstrap/css/font-awesome.css'); ?>
        <!-- NProgress -->
        <?php echo link_tag('template/plugins/nprogress/nprogress.css'); ?>
        <!-- Animate.css -->
        <?php echo link_tag('template/plugins/animate.css/animate.min.css'); ?>
        <!-- Custom Theme Style -->
        <?php echo link_tag('template/dist/css/custom.css'); ?>
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <div style="padding-bottom: 50px">
                            <img src="<?php echo base_url('template/dist/img/logo-gobierno-policia.png'); ?>" style="width: 350px; height: 80px;" alt="User Image">
                        </div>
                        <?php echo form_open('login', 'autocomplete="off" id="loginForm"'); ?>
                        <h1>Ingreso al Sistema</h1>
                        <div>
                            <input name="identity" type="text" class="form-control" placeholder="Nombre de Usuario" required ="true"/>
                        </div>
                        <div>
                            <input name="password" type="password" class="form-control" placeholder="Contrase&ntilde;a" required="required" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit"> <i class="fa fa-sign-in"></i> Ingresar</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <?php if (isset($message)) { ?>
                            <div style="color: red; font-style: italic"><?php echo $message; ?></div>
                                <br>
                            <?php } ?>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa  fa-steam-square"></i> Sistema Vial</h1>
                                <p>©2017 Divisi&oacute;n Inform&aacute;tica <br> Ministerio de Seguridad de Jujuy</p>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </section>
                </div>
            </div>
    </body>
</html>
