<?php
/**
* WPPIZZA_ACTIONS Class
*
* @package     WPPIZZA
* @subpackage  WPPIZZA_ACTIONS
* @copyright   Copyright (c) 2015, Oliver Bach
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       3.0
*
*/
if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/


/************************************************************************************************************************
*
*
*	ALL FRONTEND ACTIONS excepts scripts and styles
*	WPPIZZA_ACTIONS
*
*
************************************************************************************************************************/
class WPPIZZA_ACTIONS{
	function __construct() {

		/**********************************************************
			[set pickup / delivery per _GET frontend only]
		***********************************************************/
		if(!is_admin()){
			add_action('init', array($this, 'set_pickup_by_get'), 10);
		}
		/**********************************************************
			[(try to make sure) to not cache order page - let's run this quite late]
			[wp is the earliest hook to get post->ID to check if we are actually on orderpage
		***********************************************************/
		if(!is_admin()){
		add_action('wp', array($this, 'wppizza_nocache_orderpage'), 1000);
		}
		/**********************************************************
			[ajax - logged in and non logged in users]
		***********************************************************/
		add_action('wp_ajax_wppizza_json', array($this, 'wppizza_ajax'));
		add_action('wp_ajax_nopriv_wppizza_json', array($this, 'wppizza_ajax') );
	}

	/**************************************************************
	*
	*
	* 	[allow setting of pickup or delivery using get parameters]
	*	@since 3.19.3
	*
	***************************************************************/
	public function set_pickup_by_get(){
		global 	$wppizza_options;
		
		#not enabled 
		if( empty($wppizza_options['order_settings']['getvar_pickup_choice'] ) ){
			return;	
		}
		
		#ignore any of this if only delivery offered or pickup is disabled
		if(
			$wppizza_options['order_settings']['delivery_selected'] == 'no_delivery' || 
			empty($wppizza_options['order_settings']['order_pickup']) 			
		){
			return;
		}
		
		# skip also, if no related get parameter or both are set for no good reason
		if( !isset($_GET[WPPIZZA_GET_DELIVERY]) && !isset($_GET[WPPIZZA_GET_PICKUP]) || (isset($_GET[WPPIZZA_GET_DELIVERY]) && isset($_GET[WPPIZZA_GET_PICKUP]) )  ){
			return;	
		}
		
		//get current url
    	$current_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    	
    	//strip pickup/delivery get var 
    	$strip_get_var = isset($_GET[WPPIZZA_GET_DELIVERY]) ? WPPIZZA_GET_DELIVERY : WPPIZZA_GET_PICKUP;
		$redirect_url = preg_replace('/(&|\?)'.$strip_get_var.'=?[^&]*&/', '$1', preg_replace('/(&|\?)'.$strip_get_var.'=?[^&]*$/', '', $current_url)) . PHP_EOL;

		if(!empty($redirect_url)){//just to be safe, 

			#skip session settings etc if nothing actually changed
			$currentIsPickup = wppizza_is_pickup();
			if(  
				( $currentIsPickup && isset($_GET[WPPIZZA_GET_DELIVERY]) ) || 
				( !$currentIsPickup && isset($_GET[WPPIZZA_GET_PICKUP]) )
			){
				//set session
				$isPickup = isset($_GET[WPPIZZA_GET_DELIVERY]) ? false : true;
				$set_pickup = WPPIZZA()->session->set_pickup($isPickup);
				
				//checkout page ?
				$isCheckout = wppizza_is_checkout();
				
				//allow to run an action before redirecting and before recalculating session data
				do_action('wppizza_on_set_pickup_by_get', $isPickup, $isCheckout);
				
				//recalc session (output unused)
				$do_cart = WPPIZZA()-> session -> sort_and_calculate_cart($isCheckout, true, __FUNCTION__);
				
				//allow to run an action before redirecting but after recalculating session data
				do_action('wppizza_on_session_set_pickup_by_get', $isPickup, $isCheckout);			
			}
			
			//but always redirect removing get var
			header("Location: ".htmlspecialchars($redirect_url)."");
			die();
		}
		
	return;
	}

	/**************************************************************
	*
	*
	* 	[ajax calls]
	*
	*
	***************************************************************/
	public function wppizza_ajax(){
		require(WPPIZZA_PATH.'ajax/ajax.wppizza.php');
		die();
	}

	/**********************************************************
		[(try to make sure) to not cache order page]
	***********************************************************/
	function wppizza_nocache_orderpage(){
		if(wppizza_is_orderpage()){
			if ( ! defined( 'DONOTCACHEPAGE' ) ){
				define( "DONOTCACHEPAGE", "true" );
			}
			if ( ! defined( 'DONOTCACHEOBJECT' ) ){
				define( "DONOTCACHEOBJECT", "true" );
			}
			if ( ! defined( 'DONOTCACHEDB' ) ){
				define( "DONOTCACHEDB", "true" );
			}
			//add WP function/headers too
			nocache_headers();
		}
	}
}
/***************************************************************
*
*	[ini]
*
***************************************************************/
$WPPIZZA_ACTIONS = new WPPIZZA_ACTIONS();
?>