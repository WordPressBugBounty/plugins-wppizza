jQuery(document).ready(function($){
	/*******************************************
	*	category edit page,
	*	make it sortable and update on new sort
	*******************************************/
	if(pagenow=='edit-wppizza_menu'){
		var WPPizzaCategories = $('#the-list');
		var nonce  = $('#wppizza_ajax_nonce').val();
		WPPizzaCategories.sortable({
			update: function(event, ui) {
				jQuery.post(ajaxurl , {action :'wppizza_admin_categories_ajax',vars:{'field':'save_categories_sort', 'order': WPPizzaCategories.sortable('toArray').toString(), 'nonce': nonce}}, function(response) {
					//console.log(response);
				},'html').fail(function(jqXHR, textStatus, errorThrown) {alert("error : " + errorThrown);});
			}
		});
	}
});