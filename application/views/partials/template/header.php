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

	
	
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript" src="<?=base_url('media/js/jquery-1.8.2.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('media/js/jquery.validate.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('media/js/bootstrap.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('media/js/filtros.controller.js');?>"></script>
	<!-- Controllers -->
	<!--<script type="text/javascript" src="<?=base_url('media/js/navigation.controller.js');?>"></script>-->
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
		<div id="figure">
			<a href=""><img src="<?=base_url('/media/img/televia.png'); ?>" title="Televía"></a>
			<div class="logout-button">
				<div class="btn-logout">
					<a href="<?=site_url('/login/logout'); ?>" alt="Log Out" title="Log Out">Log Out</a>
				</div>
			</div>
		</div><!-- end figure -->

    	
        <div class="menu-right">
        <!--Sidebar content-->
            <?=$menu;?>
    	</div><!-- /.span1 -->
    <div id="body" class="">
    <!--Body content-->
