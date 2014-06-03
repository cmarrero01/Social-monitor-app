<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Gestión de Social Media Televia (SMTV)</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?=base_url('media/css/bootstrap.css');?>" rel="stylesheet">
	<link href="<?=base_url('media/css/bootstrap-responsive.css');?>" rel="stylesheet">
	<link href="<?=base_url('media/css/style.css');?>" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,latin-ext,greek-ext,greek' rel='stylesheet' type='text/css'> 
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=latin,cyrillic-ext,greek-ext,greek,latin-ext' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="<?=base_url('media/js/jquery-1.8.2.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('media/js/bootstrap.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('media/js/jquery.validate.js');?>"></script>

	<!-- Controllers -->
	<script type="text/javascript" src="<?=base_url('media/js/navigation.controller.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('media/js/configuration.controller.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('media/js/notification.controller.js');?>"></script>
	<!-- end controllers -->
</head>
<body>
<!-- start login -->
<div class="loadingPage"><div class="imgLoading"><img src="<?=base_url('/media/img/blue_loading.gif'); ?>" /></div></div>
<!-- Start Container of all sistem -->

<div class="container-fluid">
    <div class="row-fluid">
		<div id="body" class="">

			<div class="login-container">
				<div class="logo-login">
					<img src="<?=base_url('/media/img/logo-login.png');?>" alt="Logo Televía" title="Bienvenido a Televía">
				</div>
				<div class="title-yellow">
					<h3>Acceso a Usuarios</h3>
				</div>
				<div class="login">
                    <?php if($this->functions->checkTwitterUser() && $step != 1):?>
                        <?php if(!$this->facebook->getUser() && $step == 2):?>
                            <div class="alert alert-success">
                                <p>
                                    Perfecto, ya te has logeado con twitter, ahora falta ingresar con facebook y listo.
                                </p>
                            </div>
                            <a href="<?=$this->facebook->getLoginUrl();?>&step=3" class="btn btn-large btn-block btn-warning">Facebook Login</a>
                        <?php endif; ?>
                    <?php else:?>
                        <div class="alert alert-warning">
                        <p>
                            Para hacer uso del sistema, necesitamos que ingrese a su cuenta de twitter y facebook,
                            Pinche en el boton de abajo para loguearse al sistema con su usuario de twiiter.
                        </p>
                        </div>
                        <a href="<?=site_url('login/twitterLogin');?>" class="btn btn-large btn-block btn-warning">Twitter Login</a>
                    <?php endif;?>
                    <?php if($this->functions->checkTwitterUser() && $this->facebook->getUser()):?>
                        <div class="alert alert-success">
                            <p>
                                Excelente, ya tenemos tu cuenta de twitter y facebook, ahora ingresa con tus cuentas
                                del sistema. Y comienza a utilizar Social Monitor App.
                            </p>
                        </div>
                        <form action="<?=base_url('/login/access');?>" method="post">
                            <label>Usuario</label>
                            <input type="text" class="span12" name="email" value="" placeholder="Usuario"/>
                            <label>Contraseña</label>
                            <input type="password" class="span12" name="password" value="" placeholder="Contraseña"/>
                            <label class="checkbox check-login">
                            <input type="checkbox">Recordar mis datos
                              <a href="" class="forgot-pass">¿Olvidó su Contraseña?</a>
                            </label>
                            <input type="submit" class="btn btn-large btn-block btn-warning" name="Login" value="Login"/>
                        </form>
                    <?php endif; ?>
				</div><!-- end login -->
			</div><!-- end login-container -->
		</div><!-- /body -->
	</div><!-- /.row-fluid -->
</div><!-- /.container-fluid-->

</body>
</html>