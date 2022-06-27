jQuery(document).ready(function($){

	$(document.body).on('click', 'button[name="tr_grabber_activation_bt"]' ,function(){
        var $this = this;
        $(this).text(cnArgs.loading);
		$.post(cnArgs.ajaxurl, { 'action': 'tr_grabber_activation_action', 'nonce': cnArgs.nonce, 'txt': $('input[name="tr_grabber_activation_text"]').val() }, function(html){
            if(html==1){ location.reload(); }else{ $('#tr_grabber_activation_bt').text(cnArgs.txt); $('#tr_grabber_activation').html(cnArgs.fail); }
		});
    });
    
});