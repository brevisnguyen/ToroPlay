// get logs via ajax
function fvm_get_logs() {
		
	// ajax request
	jQuery( document ).ready(function() {
		var data = { 'action': 'fvm_get_logs' };
		jQuery.post(ajaxurl, data, function(resp) {
			if(resp.success == 'OK') { 

				// logs
				jQuery('.log-stats textarea').val(resp.log);
				jQuery('.log-stats textarea').scrollTop(jQuery('.log-stats textarea')[0].scrollHeight); 
			
			} else {
				// error log
				console.error(resp.success);	
			}
		});
	});
}


jQuery( document ).ready(function() {

	// help section
	jQuery( ".accordion" ).accordion({ active: false, collapsible: true, heightStyle: "content" });

});