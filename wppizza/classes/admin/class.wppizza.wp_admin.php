<?php
/**
* WPPIZZA_WP_ADMIN Class
*
* @package     WPPIZZA
* @subpackage  WPPIZZA_WP_ADMIN
* @copyright   Copyright (c) 2015, Oliver Bach
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       3.0
*
*/
if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/

//if (!class_exists( 'WPPizza' ) ) {return ;}
class WPPIZZA_WP_ADMIN{

	function __construct() {
		/**
			register settings
		**/
		add_action('admin_init', array( $this, 'admin_register_settings' ) );

		/**
			enqueue backend scripts and styles
		**/
		add_action('admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts_and_styles'));

		/**
			admin ajax
		**/
		add_action('wp_ajax_wppizza_admin_ajax', array($this, 'set_admin_ajax') );

		/**
			admin ajax
		**/
		add_action('wppizza_ajax_admin', array( $this, 'admin_ajax'));

	    /******************
	    	ajax nonce in footer for all admin pages

	    	Note: also needed for non-wppizza admin pages for:
	    	-	dashboard widgets,
	    	-	order notifications on non-wppizza pages,
	    	-	dismissal of install notices
	    	etc
	 	******************/
		add_action('admin_footer', array($this, 'wppizza_ajax_nonce'));

	}

	/******************
     [admin ajax call]
    *******************/
	public function set_admin_ajax($wppizza_options){
		require(WPPIZZA_PATH.'ajax/admin.ajax.wppizza.php');
		die();
	}
	/*******************************************************************************************************************************************************
	*
	* 	[admin ajax]
	*
	********************************************************************************************************************************************************/
	function admin_ajax($wppizza_options){

		/******************************************************
			[dashboard widget update - delete transient and return new output]
		******************************************************/
		if(!empty($_POST['vars']['field']) && $_POST['vars']['field']=='update-dashboard-widget'){

			/*expire transient*/
			delete_transient( WPPIZZA_TRANSIENT_REPORTS_NAME.'_'.WPPIZZA_ADMIN_DASHBOARD_TRANSIENT_REPORTS_EXPIRY.'' );

			/*get html output*/
			ob_start();
			$WPPIZZA_DASHBOARD_WIDGETS = new WPPIZZA_DASHBOARD_WIDGETS();
			$WPPIZZA_DASHBOARD_WIDGETS->wppizza_do_dashboard_widget_sales();
			$dbw = ob_get_clean();


			print wp_kses_post($dbw);
		exit();
		}

	}
/*********************************************************
*
*		[register settings]
*
*********************************************************/
	function admin_register_settings(){
		register_setting( WPPIZZA_SLUG, WPPIZZA_SLUG, array( $this, 'admin_options_validate') );
	}

/*********************************************************
*
*		[admin options validation]
*
*********************************************************/
    public function admin_options_validate($input){
    	global $wppizza_options, $pagenow;

    	/* no saving/editing alowed, just return options as they were, but ALWAYS bypass on install */
    	if(WPPIZZA_DEV_ADMIN_NO_SAVE && !empty($wppizza_options)){
    		return 	$wppizza_options;
    	}

    	/* unless we are actually saving options, skip everything else */
    	$current_screen  = get_current_screen();
    	if( ( !empty($current_screen) && $current_screen -> id != 'options' ) ){
    		return $wppizza_options ;
    	}

       	/* let's make sure user has required caps for all that he/she wants to update */
    	if(!empty($_POST[WPPIZZA_SLUG])){
   		foreach($_POST[WPPIZZA_SLUG] as $cap_id => $page_options){

   			/*
   				some exemptions where one single capability is set for multiple parts
   			*/
   			if( $cap_id == 'confirmation_form' )						{ $cap_id = 'order_form'; /* granted cap */}
   			if( $cap_id == 'sizes' )									{ $cap_id = 'meal_sizes'; /* granted cap */}
   			if( $cap_id == 'allergens' || $cap_id == 'foodtype' )		{ $cap_id = 'additives'; /* granted cap */}
   			if( $cap_id == 'opening_times_format' )						{ $cap_id = 'openingtimes'; /* granted cap */}
   			if( $cap_id == 'prices_format' )							{ $cap_id = 'layout'; /* granted cap */}
   			if( $cap_id == 'templates_apply' )							{ $cap_id = 'templates'; /* granted cap */}
   			if( $cap_id == 'access' )									{ $cap_id = 'access_rights'; /* granted cap */}
   			if( $cap_id == 'cron' )										{ $cap_id = 'tools'; /* granted cap */}



   			if( !current_user_can( 'wppizza_cap_'.$cap_id ) ) {
				#global $current_user;
				#print_r($current_user->allcaps);
				wp_die(
					'<h1>'.esc_html(WPPIZZA_NAME .' "'.$cap_id.'"').': ' . __( 'You need a higher access level to update these options.', 'wppizza-admin' ) . '</h1>' .
					'<p>' . esc_html(__( 'Sorry, you are not permitted to update these options.', 'wppizza-admin' )) . '</p>',
					403
				);
   			}
   		}}

		/**get previously saved options unless it's a new install**/
		$options=($wppizza_options==0) ? array() : $wppizza_options;

		/**lets not forget static, uneditable options **/
		$options['plugin_data']['version'] = WPPIZZA_VERSION;
		$options['plugin_data']['nag_notice'] = isset($input['plugin_data']['nag_notice']) ? $input['plugin_data']['nag_notice'] : $options['plugin_data']['nag_notice'];

		/**apply filters to validate options as required*/
		$options = apply_filters('wppizza_filter_options_validate', $options, $input);

		/*do not use require_once here as it may be used more than once .doh!**/
		//require(WPPIZZA_PATH .'includes/admin.options.validate.inc.php');

		/**register applicable/new WPML strings on options save*/
		//require(WPPIZZA_PATH .'inc/wpml.register.strings.php');

	return $options;
    }



/***********************************************************************************************
*
*
*	[Register and Enqueue wppizza admin scripts and styles]
*
*
************************************************************************************************/
    public function admin_enqueue_scripts_and_styles($hook) {
    	global $current_screen, $wp_styles;

    	/******************
    		css
    	******************/
       	if (file_exists( WPPIZZA_TEMPLATE_DIR . '/css/styles-admin.css')){
		/**stylesheet copied to template directory to keep settings**/
			wp_register_style(WPPIZZA_SLUG.'-admin', WPPIZZA_TEMPLATE_URI.'/css/styles-admin.css', array(), WPPIZZA_VERSION);
		}else{
			wp_register_style(WPPIZZA_SLUG.'-admin', plugins_url( 'css/styles-admin.css',WPPIZZA_PLUGIN_PATH), array(), WPPIZZA_VERSION);
		}
    	wp_enqueue_style(WPPIZZA_SLUG.'-admin');

		/* just some custom overwrites */
       	if (file_exists( WPPIZZA_TEMPLATE_DIR . '/css/styles-admin-custom.css')){
		/**stylesheet copied to template directory to keep settings**/
			wp_register_style(WPPIZZA_SLUG.'-admin-custom', WPPIZZA_TEMPLATE_URI.'/css/styles-admin-custom.css', array(), WPPIZZA_VERSION);
    		wp_enqueue_style(WPPIZZA_SLUG.'-admin-custom');
		}

    	/******************
    		js
    	******************/
        add_thickbox(); /* thickbox , used in various places and on install*/


		if($current_screen->post_type == WPPIZZA_POST_TYPE){
			wp_register_script(WPPIZZA_SLUG, plugins_url( 'js/scripts.admin.common.js', WPPIZZA_PLUGIN_PATH ), array('jquery'), WPPIZZA_VERSION ,true);
			wp_enqueue_script(WPPIZZA_SLUG);
		}

		/**include everywhere (expecially widget pages)*/
		wp_register_script(WPPIZZA_SLUG.'-global', plugins_url( 'js/scripts.admin.global.js', WPPIZZA_PLUGIN_PATH ), array('jquery'), WPPIZZA_VERSION ,true);
		wp_enqueue_script(WPPIZZA_SLUG.'-global');


		/*****************************************************************************


			localize admin variables


		*****************************************************************************/
		$localize = array();

		/** functions that can be added to hook into after polling for new orders in order history */
		$fnGetOrders = array();
		$fnGetOrders = apply_filters('wppizza_filter_admin_js_get_orders_function', $fnGetOrders);
		$fnGetOrders = array_keys(array_flip($fnGetOrders));/*flip to make unique, keys to just get the function name to sanitise things*/
		$localize['fnGetOrders'] = $fnGetOrders; /* add to localized script */

		/** functions that can be added to hook after change of order status in order history */
		$fnStatusChanged = array();
		$fnStatusChanged = apply_filters('wppizza_filter_admin_js_status_changed_function', $fnStatusChanged);
		$fnStatusChanged = array_keys(array_flip($fnStatusChanged));/*flip to make unique, keys to just get the function name to sanitise things*/
		$localize['fnStatusChanged'] = $fnStatusChanged; /* add to localized script */
		/* filterable */
		$localize = apply_filters('wppizza_filter_admin_js_localize', $localize);

		/** analogous with wppizza_filter_js_extend in frontend **/
		$localize['extend'] = apply_filters('wppizza_filter_js_extend_admin', array() );//

		wp_localize_script( WPPIZZA_SLUG.'-global', WPPIZZA_SLUG, $localize );
	}

/*********************************************************
*
*		[ adding wppizza_ajax_nonce to footer ]
*
*********************************************************/
	function wppizza_ajax_nonce(){
		wp_nonce_field( '' . WPPIZZA_PREFIX . '_ajax_nonce','' . WPPIZZA_PREFIX . '_ajax_nonce', true, true);
	return;
	}

}
$WPPIZZA_WP_ADMIN=new WPPIZZA_WP_ADMIN();
?>