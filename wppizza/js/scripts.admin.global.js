/*
	js that needs to be available outside of $_GET['posty_type'] = wppizza
*/
var wppizza_dismiss_notice;
var wppizza_toggle_password;
jQuery(document).ready(function($){

	/*******************************
		set ajax url if used in frontend
	******************************/
	if(typeof ajaxurl === 'undefined'){
		ajaxurl = wppizza.ajaxurl;
	}
	/******************************
	*	[widget type has changed, show relevant option]
	******************************/
	$(document).on('change', '.wppizza-widget-select', function(e){
		var self=$(this);
		self.closest('div').find('.wppizza-selected>p').hide();
		self.closest('div').find('.wppizza-selected>.wppizza-selected-'+self.val()+'').fadeIn();
	});
	/******************************
	*	[update dashboard widget data]
	******************************/
	$(document).on('click', '.wppizza-dashboard-widget-update', function(e){
		e.preventDefault();
		e.stopPropagation();
		var elm = $('#wppizza_dashboard_widget .inside');
		elm.prepend('<div id="wppizza-dash-loading" class="wppizza-load"></div>');
		jQuery.post(ajaxurl , {action :'wppizza_admin_ajax',vars:{'field':'update-dashboard-widget'}}, function(response){
			$('#wppizza_dashboard_widget .inside').empty().html(response);
			$('#wppizza-dash-loading').remove();
		},'html').fail(function(jqXHR, textStatus, errorThrown) {alert("error : " + errorThrown);});
	});


    /*******************************
	*	[date picker - can be used by anyone, as long as scripts (and ideally hidden inputs for localization) are loaded with it]
	*******************************/
    $(document).on('click', '.wppizza-date-select', function(e){
    	e.preventDefault();
		var date_field = $(this).closest('div').find('.wppizza-date');
    	$(this).datepicker({dateFormat : 'dd M yy', altFormat: "yy-mm-dd", altField: date_field}).keyup(function(e){if(e.keyCode == 8 || e.keyCode == 46) {$.datepicker._clearDate(this);}}).datepicker( "show" );
    });
    /*******************************
	*	[date picker alternative (if there is a range of dates - can be used by anyone, as long as scripts (and ideally hidden inputs for localization) are loaded with it]
	*******************************/
    $(document).on('click', '.wppizza-date-range', function(e){
    	e.preventDefault();
		var date_field = $(this).next('input.wppizza-date');
    	$(this).datepicker({dateFormat : 'dd M yy', altFormat: "yy-mm-dd", altField: date_field}).keyup(function(e){if(e.keyCode == 8 || e.keyCode == 46) {$.datepicker._clearDate(this);}}).datepicker( "show" );
    });     
	/*******************************
	*	[time picker - can be used by anyone, as long as scripts are loaded with it]
	*******************************/
    $(document).on('click', '.wppizza-time-select', function(e){
    	e.preventDefault();
    	$(this).timepicker({
    	hourText: 'Hour',
		minuteText: 'Min',
    	amPmText: ['', ''],
		hours: {
        starts: 0,                // First displayed hour
        ends: 23                  // Last displayed hour
    	},
    	minutes: {
    		starts: 0,                // First displayed minute
    		ends: 45,                 // Last displayed minute
    		interval: 15               // Interval of displayed minutes
		}}).timepicker( "show" );
    });

	/******************************
	*	[dismiss notices]
	******************************/
	wppizza_dismiss_notice = function (e) {
		jQuery.post(ajaxurl , {action :'wppizza_admin_ajax',vars:{'field':'dismiss-notice', 'key' : e}}, function(response){
			$('#wppizza_admin_notice_'+e+'').hide('slow');
		},'html').fail(function(jqXHR, textStatus, errorThrown) {alert("error : " + errorThrown);});
	};

	/******************************
	*	[set/toggle input from text to password , onfocus (state 0) ]
	******************************/
	wppizza_toggle_password = function (id, show) {
		var input_field = $('#'+id);
		if(typeof show !== 'undefinedd' && show == 1){
			input_field.prop("type", "text");
		}else{
			input_field.prop("type", "password");
		}
	return;
	};
});