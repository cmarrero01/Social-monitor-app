<?=$header;?>

<div id="container-smtv">
    <div class="top">
        <h3>Consulta de Filtros</h3>
        <div class="add-new">
            <a href="<?=base_url('/filtros/add'); ?>" class="btn btn-info">Agregar Nuevo</a>
        </div>
    </div><!-- end top -->

    <div class="filtros-tabla clearfix">
        <div class="filtros-thead">
            <div class="span3">
                <div class="titles-tabla">Nombre del Filtro</div>
            </div>
            <div class="span2">
                <div class="titles-tabla">Notificaciones</div>
            </div>
            <div class="span3">
                <div class="titles-tabla">Palabras Claves</div>
            </div>
            <div class="span1">
                <div class="titles-tabla">Estado</div>
            </div>
            <div class="span1">
                <div class="titles-tabla">Ver</div>
            </div>
            <div class="span1">
                <div class="titles-tabla">Editar</div>
            </div>
            <div class="span1">
                <div class="titles-tabla">Eliminar</div>
            </div>
        </div><!-- end filtros-thead -->

            <?php 
            if(!empty($filtros)):
            foreach($filtros as $filtro):?>
        <div class="filtros-tbody">

            <div class="span3">
                <?=$filtro->name;?>
            </div>
            <div class="span2">
                <a href="" class="notific-filtros">
                    <span><div class="notif-on" title="Tiene Notificaciones"></div>(150 sin leer)</span>
                </a>
            </div>
            <div class="span3">
                <div class="tags">
                    <a href="">
                        <?=$filtro->words;?>
                    </a>
                </div>
            </div>
            <div class="span1">
                <?=$filtro->status;?>
            </div>
            <div class="span1">
                <a href="/filtros/see/<?=$filtro->idFiltro;?>" alt="Ver Filtro">
                    <div class="ver" title="Ver Filtro">
                    </div>
                </a>
            </div>
            <div class="span1">
                <a href="/filtros/edit/<?=$filtro->idFiltro;?>" alt="Editar Filtro">
                    <div class="editar" title="Editar Filtro">
                    </div>
                </a>
            </div>
            <div class="span1">
                <a href="/filtros/delete/<?=$filtro->idFiltro;?>" alt="Eliminar Filtro">
                    <div class="eliminar" title="Eliminar Filtro">
                    </div>
                </a>
            </div>

        </div><!-- end filtros-tbody -->
            <?php endforeach; ?>
            <?php else:?>
                <tr style="margin-top: 5px;"><td colspan="7">No hay filtros cargados</td></tr>
            <?php endif; ?>

    </div><!-- end filtro-tabla -->

</div><!-- end consulta de filtros -->
<?=$footer;?>