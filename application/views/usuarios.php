<?=$header;?>


<div id="container-smtv">
	<h3>Consulta de Usuarios</h3>
    <div class="add-new">
        <a class="btn btn-info" href="<?=site_url('/usuarios/newUser');?>">Agregar Nuevo</a>
    </div>
	<div class="filtros-tabla clearfix">
		<div class="filtros-thead">
            <div class="span1">
                <div class="titles-tabla-users"></div>
            </div>
            <div class="span4">
                <div class="titles-tabla-users">Nombre y Apellido</div>
            </div>
            <div class="span4">
                <div class="titles-tabla-users">Email</div>
            </div>
            <div class="span2">
                <div class="titles-tabla-users">Editar</div>
            </div>
            <div class="span1">
                <div class="titles-tabla-users">Eliminar</div>
            </div>
        </div><!-- end filtros-thead -->
<?php if(isset($users) and !empty($users)):?>
    <?php foreach($users as $user):?>
        <div class="filtros-tbody">
            <div class="span1">
            	<div class="user-icon">
            		<i class="icon-user" title="Usuario"></i>
            	</div>
            </div>
            <div class="span4">
            	<?=$user->full_name;?>
            </div>
            <div class="span4">
            	<div class="usermail">
            		<a href="mailto:<?=$user->email;?>"><?=$user->email;?></a>
            	</div>
            </div>
            <div class="span2">
            	<a href="<?=site_url('/usuarios/newUser/'.$user->idUser);?>">
            		<div class="editar" title="Editar Usuario">
            		</div>
            	</a>
            </div>
            <div class="span1">
            	<a href="#">
	            	<div class="eliminar" title="Eliminar Usuario">
	            	</div>
            	</a>
            </div>
        </div><!-- end filtros-tbody -->
        <?php endforeach;?>
<?php endif; ?>
	</div><!-- end filtros-tabla -->
</div><!-- end container-smtv -->
<?=$footer;?>