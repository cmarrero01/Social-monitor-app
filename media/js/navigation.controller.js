// JavaScript Document
/*
function navigation(){
	
	var self = this;
	
	this.showLoading = function(){
		$('.loadingPage').show();
	}
	
	this.hideLoading = function(){
		$('.loadingPage').hide();
	}
	
	this.navigationAjax = function(){

	$(document).on('click','a',function(){
				var $this = $(this);
				var page = $this.attr('href');
				if(self.checkPage(page)){
					self.showLoading();
					var data = {
						ajax:true
					}
					$.get(page,data,function(r){
						$('#body').html(r);
						self.hideLoading();
					});
					return false;
				}else if(page.indexOf('login/logout') != -1){
					return true;
				}else{
					return false;
				}
				
	});
}
	
	this.checkPage = function(page){
		
		if(page != '' && page.indexOf('#') == -1){
			return true;
		}else{
			return false;
		}

	}
}
$(document).ready(function(e) {
    var nav = new navigation;
	nav.navigationAjax();
});
*/
