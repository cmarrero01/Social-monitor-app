// JavaScript Document
function Filtros(){
	
	var self = this;
	
	this.sendMessages = function(){
        $('#sendAnswer,#sendRetwitt').live('submit',function(){
            var $this = $(this);
            self.sendData($this);
            return false;
        });

        $('#btnCompartir').on('click',function(){
            $('#sendAnswer').submit();
        });

        $('#btnRetwitt').on('click',function(){
            $('#sendRetwitt').submit();
        });
	}

    this.sendData = function(obj){

        var data = obj.serialize();
        $.getJSON('/filtros/sendMessage',data,function(r){
        });
    }
}
var filter = new Filtros;
//var callNotification = setInterval(nots.checkMessages,10000);