<?php
/**
* WPPIZZA_TAGS Class
*
* @package     WPPIZZA
* @subpackage  WPPIZZA_TAGS
* @copyright   Copyright (c) 2015, Oliver Bach
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       3.15
*
*/
if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/


/************************************************************************************************************************
*
*
*	WPPIZZA_TAGS filters
*
*
************************************************************************************************************************/
class WPPIZZA_TAGS{
	/*
	* class ident
	* @var str
	* @since 3.15
	*/
	private $class_key = 'tags';/*to help consistency throughout class in various places*/
	private $submenu_caps_title ;
	private $submenu_priority = 0;
	/******************************************************************************************************************
	*
	*	[CONSTRUCTOR]
	*
	*
	*	@since 3.15
	*
	******************************************************************************************************************/
	function __construct() {

		/*titles/labels throughout class*/
		add_action('init', array( $this, 'init_admin_lables') );

		/*register capabilities for this page*/
		add_filter('wppizza_filter_define_caps', array( $this, 'wppizza_filter_define_caps'), $this->submenu_priority);

	}

	/******************
	*	@since 3.19.1
    *	[admin ajax include file]
    *******************/
	public function init_admin_lables(){
		/*titles/labels throughout class*/
		$this->submenu_caps_title	=	apply_filters('wppizza_filter_admin_label_caps_title_'.$this->class_key.'', __('Tags','wppizza-admin'));
	}

	/*********************************************************
	*
	*	[define caps]
	*	@since 3.15
	*
	*********************************************************/
	function wppizza_filter_define_caps($caps){
		/**
			add editing capability for this page
		**/
		$caps[$this->class_key]=array('name'=>$this->submenu_caps_title ,'cap'=>''.WPPIZZA_SLUG.'_cap_'.$this->class_key.'');

	return $caps;
	}
}
/***************************************************************
*
*	[ini]
*
***************************************************************/
$WPPIZZA_TAGS = new WPPIZZA_TAGS();
?>