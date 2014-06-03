<?=$header;?>

<?=(isset($alert))?$alert:'';?>
<div id="container-smtv">
    <h3>Edición de Filtros</h3>

    <div class="filtros-tabla clearfix">
        <form action="/filtros/save" method="post">
            <div class="config-left">
            	<input type="hidden" class="input-xlarge" name="idFiltro" id="idFiltro" value="<?=(isset($filtro->idFiltro))?$filtro->idFiltro:''?>" placeholder="Nombre del filtro" />
                <label>Nombre del Nuevo Filtro</label>
            	<input type="text" class="input-xlarge" name="name" id="name" value="<?=(isset($filtro->name))?$filtro->name:''?>" placeholder="Nombre del filtro" />
                <label>Palabras Claves</label>
                <input type="text" class="input-xlarge" name="words" id="words" value="<?=(isset($filtro->words))?$filtro->words:''?>" placeholder="Palabras claves" />
                <label>Estado Inicial del Filtro</label>
                <select name="status" id="status">
                    <option value="" >Selecciones status...</option>
                    <option value="1" <?=(isset($filtro->status) and $filtro->status == 1)?'selected':''?> >Activo</option>
                    <option value="0" <?=(isset($filtro->status) and $filtro->status == 1)?'selected':''?> >Inactivo</option>
                </select>
            </div><!-- end config-left -->
            <div class="config-right line-right">
                <label>
                    <input type="checkbox" class="input-xlarge check-left" name="isAutomatic" id="isAutomatic" value="1" <?=(isset($filtro->isAutomatic))?'checked="checked"':''?>/>
                    <span class="check-margin">¿Desea habilitar mensajes automáticos para Twitter?</span>
                </label>
                <span>
                    <div class="buttons clearfix">
                        <ul class="BigButton twitter" >
                            <li><a href="#"><span class="logo-fb"></span>Twitter</a></li>
                        </ul>
                    </div><!-- end buttons -->
                    <label class="redes">Escriba un Mensaje</label>
                </span>
                <textarea name="twMessage" rows="3" class="input-xlarge" id="twMessage" placeholder="Mensaje automatico para twitter"><?=(isset($filtro->twMessage))?$filtro->twMessage:''?></textarea>
                <label>
                    <input type="checkbox" class="input-xlarge check-left" name="showInHome" id="showInHome" value="1" <?=(isset($filtro->showInHome))?'checked="checked"':''?>/>
                    <span class="check-margin">¿Desea habilitar mensajes automáticos para Facebook?</span>
                </label>
                <span>
                    <div class="buttons clearfix">
                        <ul class="BigButton facebook" >
                            <li><a href="#"><span class="logo-fb"></span>Facebook</a></li>
                        </ul>
                    </div><!-- end buttons -->
                    <label class="redes2">Escriba un Mensaje</label>
                </span>
                <textarea name="faceMessage" rows="3" class="input-xlarge" id="faceMessage" placeholder="Mensaje automatico para facebook"><?=(isset($filtro->faceMessage))?$filtro->faceMessage:''?></textarea>
            </div><!-- end config-right -->
            <div class="guardar-config">
                <input type="submit" class="btn btn-warning btn-guardar" name="crear" id="crear" value="<?=(isset($filtro->idFiltro))?'Editar Filtro':'Crear Filtro'?>" />
            </div>
        </form>
    </div><!-- end filtros-tabla -->

</div><!-- end consulta-filtros-->
<?=$footer;?>