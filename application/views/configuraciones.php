<?=$header;?>
<?=(isset($alert))?$alert:'';?>


<div id="container-smtv">
    <h3>Configuración del Sistema</h3>

    <div class="filtros-tabla clearfix">
        <form action="/configuraciones/save" method="post" id="configurations">
            <div class="title-config">
                <h4>Ingrese datos de la aplicación</h4>
            </div>
            <div class="config-left">
            	<div class="button-tw">
                    <img src="<?=base_url('/media/img/twitter.png'); ?>" title="Twitter">
                </div>
                <label>Usuario de Twitter</label>
                <input type="text" class="input-xlarge" name="tw_username" id="tw_username" value="<?=(isset($conf['twitter']->username))?$conf['twitter']->username:'';?>" placeholder="Usuario" />
                <label>Constraseña</label>
                <input type="text" class="input-xlarge" name="tw_password" id="tw_password" value="<?=(isset($conf['twitter']->password))?$conf['twitter']->password:'';?>" placeholder="Contraseña" />
                <label>Consumer Key</label>
                <input type="text" class="input-xlarge" name="tw_consumer_key" id="tw_consumer_key" value="<?=(isset($conf['twitter']->consumer_key))?$conf['twitter']->consumer_key:'';?>" placeholder="Consumer Key" />
                <label>Consumer Secret</label>
                <input type="text" class="input-xlarge" name="tw_consumer_secret" id="tw_consumer_secret" value="<?=(isset($conf['twitter']->consumer_secret))?$conf['twitter']->consumer_secret:'';?>" placeholder="Consumer Secret" />
                <label>Access Token</label>
                <input type="text" class="input-xlarge" name="tw_access_token" id="tw_access_token" value="<?=(isset($conf['twitter']->access_token))?$conf['twitter']->access_token:'';?>" placeholder="Access Token" />
                <label>Access Token Secret</label>
                <input type="text" class="input-xlarge" name="tw_access_token_secret" id="tw_access_token_secret" value="<?=(isset($conf['twitter']->access_token_secret))?$conf['twitter']->access_token_secret:'';?>" placeholder="Access Token Secret" />
            </div><!-- end config-left -->

            <div class="config-right">
            	<div class="button-fb">
                    <img src="<?=base_url('/media/img/facebook.png'); ?>" title="Facebook">
                </div>
                <label>Usuario de Facebook</label>
                <input type="text" class="input-xlarge" name="fa_username" id="fa_username" value="<?=(isset($conf['facebook']->username))?$conf['facebook']->username:'';?>" placeholder="Usuario" />
                <label>Contraseña</label>
                <input type="text" class="input-xlarge" name="fa_password" id="fa_password" value="<?=(isset($conf['facebook']->password))?$conf['facebook']->password:'';?>" placeholder="Contraseña" />
                <label>Api Key</label>
                <input type="text" class="input-xlarge" name="fa_api_key" id="fa_api_key" value="<?=(isset($conf['facebook']->api_key))?$conf['facebook']->api_key:'';?>" placeholder="Api Key" />
                <label>Api Secret</label>
                <input type="text" class="input-xlarge" name="fa_api_secret" id="fa_api_secret" value="<?=(isset($conf['facebook']->api_secret))?$conf['facebook']->api_secret:'';?>" placeholder="Api Secret" />

            	<h4>Datos de su Organización</h4>
                <div class="config-campo">
                    <input type="text" class="input-xlarge" name="tw_username_company" id="tw_username_company" value="<?=(isset($conf['twitter']->username_company))?$conf['twitter']->username_company:'';?>" placeholder="Twitter user" />
                </div>
                <div class="config-campo">
                    <input type="text" class="input-xlarge" name="fa_username_company" id="fa_username_company" value="<?=(isset($conf['facebook']->username_company))?$conf['facebook']->username_company:'';?>" placeholder="Facebook user" />
                </div>
            </div><!-- end config-right -->
            <div class="guardar-config">
        	   <input type="submit" class="btn btn-warning btn-guardar" name="saveConfiguration" value="Guardar" />
            </div>
        </form>
    </div><!-- end filtros-tabla -->

</div><!-- end consulta-filtros-->

<script>
$(document).ready(function(e) {
	Conf.saveConfigurations();    
});
</script>
<?=$footer;?>