


<div class="conetedor-menu">
    <div class="contenedor-nav">
        <div class="nav">
            <ul class="unstyled">
                <li><a href="<?=base_url('home');?>"><i class="home icon-nav" title="Home"></i> Home</a></li>
                <li><a href="<?=base_url('configuraciones');?>"><i class="setting icon-nav" title="Configuraciones"></i> Configuraciones</a></li>
                <li><a href="<?=base_url('notificaciones');?>"><i class="notificaciones icon-nav" id="unReadMessages" title="Notificaciones"></i> Notificaciones</a></li>
                    <li onclick="$('.usermenu').toggle('blind');"><a href="#"><i class="filtros icon-nav" title="Filtros"></i> Filtros</a>
                        <div class="drop-down">
                            <ul class="unstyled usermenu hide" style="padding-left: 20px;">
                                <?php if(isset($menu_filtros) && !empty($menu_filtros)):?>
                                    <?php foreach($menu_filtros as $filtro):?>
                                        <li>
                                            <a href="/filtros/see/<?=$filtro->idFiltro;?>" class="resetNotification" data-filtro="<?=$filtro->idFiltro;?>"><i class="filtros icon-nav" title="Filtros"></i> 
                                                <?=$filtro->name;?> <span id=" qfiltro_<?=$filtro->idFiltro;?>"></span>
                                            </a>                   
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <li><a href="<?=base_url('filtros/filtros');?>"><i class="filtros icon-nav" title="Filtros"></i> Ver Lista</a></li>
                                <li><a href="<?=base_url('filtros/add');?>"><i class="filtros icon-nav" title="Filtros"></i> Agregar</a></li>
                            </ul>
                        </div>
                    </li>
                <li><a href="<?=base_url('usuarios');?>"><i class="usuario icon-nav" title="Usuario"></i> Usuarios</a></a></li>
            </ul>
        </div><!-- end nav -->
    </div><!-- contenedor-nav -->

    <div class="panelabrir" onclick="$('.contenedor-nav').animate({width:'185px'}, 300);$(this).hide();$('.panelcerrar').show();">
        <div class="arrow-open" title="Desplegar Menú"></div>
    </div><!-- end panelabrir -->
    
    <div  class="panelcerrar hide" title="Ocultar Menú" onclick="$('.contenedor-nav').animate({width:'40px'}, 300);$(this).hide();$('.panelabrir').show();">
        <div class="arrow-close"></div>
    </div><!-- end panelcarrar -->

</div><!-- end contenedor-menu-->

