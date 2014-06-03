// JavaScript Document
function configurations(){
	
	var self = this;
	
	this.saveConfigurations = function(){
		
		$('#configurations').live('submit',function(){
			
			var $this = $(this);
			var data = $this.serialize();
			
			var validation = $this.validate({
				rules:{
					tw_username:{
						required:true
					},
					tw_password:{
						required:true
					},
					tw_consumer_key:{
						required:true
					},
					tw_consumer_secret:{
						required:true
					},
					tw_access_token:{
						required:true
					},
					tw_access_token_secret:{
						required:true
					},
					fa_username:{
						required:true
					},
					fa_password:{
						required:true
					},
					fa_api_key:{
						required:true
					},
					fa_api_secret:{
						required:true
					},
					tw_username_company:{
						required:true
					},
					fa_username_company:{
						required:true
					}
				},
				messages:{
					tw_username:{
						required:"El nombre de usuario de twitter es obligatorio"
					},
					tw_consumer_key:{
						required:"Consumer key de la aplicacion es obligatorio"
					},
					tw_consumer_secret:{
						required:"Consumer Secret de la aplicacion es obligatorio"
					},
					tw_access_token:{
						required:"El Access token de la aplicacion es obligatorio"
					},
					tw_access_token_secret:{
						required:"El Access token secret es obligatorio"
					},
					fa_username:{
						required:"El nombre de usuario de facebook es obligatorio"
					},
					fa_password:{
						required:"El password no puede ser vacio"
					},
					fa_api_key:{
						required:"La api key de facebook es obligatoria"
					},
					fa_api_secret:{
						required:"La api secret de facebook es obligatoria"
					},
					tw_username_company:{
						required:"El usuario de twitter de empresa, es obligatoria"
					},
					fa_username_company:{
						required:"El usuario de facebook de empresa, es obligatoria"
					},
				}
			}).form();
			
			return validation;
		});
		
	}
}
var Conf = new configurations();