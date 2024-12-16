<?php
/**
* WPPIZZA_I18N Class
*
* @package     WPPIZZA
* @subpackage  WPPIZZA_I18N
* @copyright   Copyright (c) 2024, Oliver Bach
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       4
*
*/
if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/


/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*
*#
*#
*#
*#	[LOAD TEXT DOMAINS / TRANSLATIONS]
*#	
*#
*#
*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*/
class WPPIZZA_I18N{

	function __construct() {
		
		/**
			load text domain - must not run before init 
		**/
		add_action('init',     array($this, 'load_plugin_textdomain'));
	}

    /*************************************************************************************
    * load text domain on init.
	* @since 4.0
	* @return void
    *************************************************************************************/
  	public function load_plugin_textdomain(){
  		/*
  		NOTE: BOTH only required on admin as frontend strings get added to wppizza->localization (options table) on intall
  		and are subsequently used from there.
  		localization is split for convenience to enable frontend localization into more languages
  		without having to translate the whole backend too (although that would be ideal of course)
  		Filterable since 3.19.1
  		*/
  		$plugin_text_domain_path =  apply_filters('wppizza_filter_textdomain_path', dirname(plugin_basename( __DIR__ ) ) . '/lang');
  		if(is_admin()){
        	// admin localization strings
        	load_plugin_textdomain('wppizza-admin', false, $plugin_text_domain_path );
        	// load after admin to insert default localization strings
        	load_plugin_textdomain('wppizza', false, $plugin_text_domain_path );
  		}else{
        	// frontend dev constants - not loaded by default (but can be enabled by constant) as it's kind of overkill loading these for very little benefit,
        	if(WPPIZZA_DEV_LOAD_TEXTDOMAIN){
        		load_plugin_textdomain('wppizza_dev', false, $plugin_text_domain_path );
        	}
  		}
    return;
    }
}
/***************************************************************
*
*	[ini]
*
***************************************************************/
$WPPIZZA_I18N = new WPPIZZA_I18N();
?>