<?php if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/ ?>
<?php
/* 
	Identify (and escape) the default frontend text used on first plugin installation
	, depending on site language, that can then be found in WPPizza->Localisation,
	[ lang/wppizza.pot |  lang/wppizza-[ln_LN].file ] 
*/
function wppizza_textdomain( $text ) {
	return esc_html( translate( $text, 'wppizza' ) );
}
/* 
	Identify (and escape) frontend dev text 
	to look for in lang/wppizza-dev.pot file
	[ lang/wppizza-dev.pot |  lang/wppizza-dev-[ln_LN].file ] 
*/
function wppizza_textdomain_dev( $text ) {
	return esc_html( translate( $text, 'wppizza-dev' ) );
}
#-------------------------------------------------------------------------------------
#	Future perhaps:
#	Identify (and escape) admin text that is the same as wordpress core ('wppizza-admin')  
#	to look for in lang/wppizza-admin.pot file or similar in conjunction with class.wppizza.i18n.php 
#-------------------------------------------------------------------------------------
#function wppizza_textdomain_admin( $text) {
#	perhaps wp_kses or indeed wp_kses_allowed_html insetad of esc_attr .. to be determined
#	return esc_attr( translate( $text, 'wppizza-admin' ) );
#}
#-------------------------------------------------------------------------------------
#	Future perhaps:
#	Identify (and escape) frontend text that is the same as wordpress core ('default')  
#	to look for in lang/wp/wppizza.pot file or similar in conjunction with class.wppizza.i18n.php 
#-------------------------------------------------------------------------------------
#function wppizza_textdomain_default( $text, $domain = 'default' ) {
#	return esc_attr( translate( $text, $domain ) );
#}
?>