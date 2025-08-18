jQuery(document).ready(function($){
	/*******************************
		[opening times - add new]
	*******************************/
	$(document).on('click', '#wppizza_add_opening_times_custom', function(e){
		e.preventDefault();
		var getKeys=$('.wppizza-opening_times_custom-getkey');
		var nonce  = $('#wppizza_ajax_nonce').val();
		if(getKeys.length>0){
			var setKeys = getKeys.serializeArray();
		}else{
			var setKeys = '';
		}		

		jQuery.post(ajaxurl , {action :'wppizza_admin_openingtimes_ajax',vars:{'field':'opening_times_custom', 'setKeys': setKeys, 'nonce': nonce }}, function(response) {
			$('#wppizza_opening_times_custom_options').append(response);
		},'html').fail(function(jqXHR, textStatus, errorThrown) {alert("error : " + errorThrown);});
	});
	/*******************************
		[times closed - add new]
	*******************************/
	$(document).on('click', '#wppizza_add_times_closed_standard', function(e){
		e.preventDefault();
		var nonce  = $('#wppizza_ajax_nonce').val();
		jQuery.post(ajaxurl , {action :'wppizza_admin_openingtimes_ajax',vars:{'field':'times_closed_standard', 'nonce': nonce}}, function(response) {
			$('#wppizza_times_closed_standard_options').append(response);
		},'html').fail(function(jqXHR, textStatus, errorThrown) {alert("error : " + errorThrown);});
	});     
	/*******************************
		[holidays - add new]
	*******************************/
	$(document).on('click', '#wppizza_add_opening_times_holidays', function(e){
		e.preventDefault();
		var nonce  = $('#wppizza_ajax_nonce').val();
		jQuery.post(ajaxurl , {action :'wppizza_admin_openingtimes_ajax',vars:{'field':'opening_times_holidays', 'nonce': nonce}}, function(response) {
			$('#wppizza_opening_times_holidays_options').append(response);
		},'html').fail(function(jqXHR, textStatus, errorThrown) {alert("error : " + errorThrown);});
	});	
	/*****************************
	*	[remove an option]
	*****************************/
	$(document).on('click', '.wppizza-delete', function(e){
		e.preventDefault();
		var self=$(this);
		$(this).closest('div').empty().remove();
	});	
});