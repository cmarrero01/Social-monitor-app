// JavaScript Document
function Notifications(){
	
	var self = this;
	
	this.checkMessages = function(){
		$.getJSON('/notificaciones/messages',function(r){
			
			var unReadMessages = $('#unReadMessages');
			
			if(unReadMessages.hasClass('icon-comment')){		
				$('#unReadMessages').removeClass('icon-comment');
				$('#unReadMessages').addClass('icon-flag');
			}
			
			$.each(r.not,function(k,v){
				$('#filtro_'+k).html(' ('+v.messages+') ');
			});

		});
	}
	
	this.resetNotification = function(){
		$('.resetNotification').live('click',function(){
			var $this = $(this);
			var idFiltro = $this.data('filtro');
			$('#filtro_'+idFiltro).html('(0)');
		});
	}
}
var nots = new Notifications;
//var callNotification = setInterval(nots.checkMessages,10000);