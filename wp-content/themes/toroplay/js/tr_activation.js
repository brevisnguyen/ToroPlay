jQuery(document).ready(function($){

	$(document.body).on('click', 'button[name="tr_activation_bt"]' ,function(){
        var $this = this;
        $(this).text(cnArgs.loading);
		$.post(cnArgs.ajaxurl, { 'action': 'tr_activation_action', 'nonce': cnArgs.nonce, 'txt': $('input[name="tr_themes_activation_text"]').val() }, function(html){
            if(html==1){ location.reload(); }else{ $('#tr_activation_bt').text(cnArgs.txt); $('#tr_activation').html(cnArgs.fail); }
		});
    });
    
});