<?php
/**
* WPPIZZA_TIPS Class - UNDER DEVELOPMENT / NOT IN USE YET
*
* @package     WPPIZZA
* @subpackage  Tips
* @copyright   Copyright (c) 2024, Oliver Bach
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       --
*
*/
if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/


/************************************************************************************************************************
*
*
*	WPPIZZA_TIPS
*
*
************************************************************************************************************************/
class WPPIZZA_TIPS{

	function __construct() {
	}

	/*******************************************************************
	*	[ TIPS OPTIONS MARKUP - TIPS OPTIONS BASED ON SUBTOTAL BEFORE TIPS ]
	*	@since --
	*	@param array
	*	@param array
	*	@param int - maximum automatic tip round up options
	*	@param any non decimal character to distinguish between % and monitary option selected (as the value could be the same)
	*	@return array
	*******************************************************************/
	function markup($orderData = array(), $event = '' , $maxSteps = 10, $optionIdent = '#'){
		global $wppizza_options;

		$ctips_key = 'ctips';
		$maxSteps = apply_filters(WPPIZZA_SLUG.'_filter_tips_maxsteps', $maxSteps, $orderData, $event );

		/*********************************************************
			parameters for percentag / total calculations
		*********************************************************/
		$payment_amount_subtotal = !empty($orderData['summary']['total_before_tips']) ? $orderData['summary']['total_before_tips'] : 0 ; //for percentage option calculations
		//dropdown selected
		$tips_dropdown_select = isset($orderData['user']['tips']['selected']) ? $orderData['user']['tips']['selected'] : '' ;
		//value tips - but empty if select was set to ''
		//$tips_value = 		isset($orderData['user']['tips']['value']) && $tips_dropdown_select !='' ? wppizza_format_price_float($orderData['user']['tips']['value']) : '';
		//not set or still set to empty string (i.e not ever set yet) , l;eave as empty string
		$tips_value = 		!isset($orderData['user']['tips']['value']) || $orderData['user']['tips']['value'] == '' ? '' : wppizza_format_price_float($orderData['user']['tips']['value']);

		/***********************************************************************************************************************

			tips percentage options	, if enabled

		***********************************************************************************************************************/
		$tips_percentage_options = array();
		if(!empty($wppizza_options['order_settings']['tips_percentage_options']) && $wppizza_options['order_settings']['tips_display'] > 1 ){

			/* get all set percentage options , removing zero here */
			$percentage_options = array_filter($wppizza_options['order_settings']['tips_percentage_options']);//remove any zero option that was set

			/* sort */
			asort($percentage_options);

			/* loop */
			foreach($percentage_options as $pc){
				$pcTips = ($payment_amount_subtotal / 100) * $pc;
				$pcTips = wppizza_format_price_float($pcTips);
				$tips_percentage_options[] = array('label' => $pc.'%', 'tip' => $pcTips . $optionIdent, 'pc' => $pc );
			}
		}

		/***********************************************************************************************************************
			tips round up options
			depending on value
		***********************************************************************************************************************/
		$tips_roundup_options = array();

		//get base value (integer, without decimals)
		$amountInteger = (int)$payment_amount_subtotal;

		//set steps increase
		if($payment_amount_subtotal <= 10 ){
			$steps = 0.5 ;//0.50 $ steps
		}
		elseif($payment_amount_subtotal <= 100 ){
			$steps = 1 ;//1 $ steps
		}
		elseif($payment_amount_subtotal <= 250 ){
			$steps = 5 ;//5 $ steps
		}
		elseif($payment_amount_subtotal <= 500 ){
			$steps = 10 ;//10 $ steps
		}
		elseif($payment_amount_subtotal <= 1000 ){
			$steps = 25 ;//25 $ steps
		}
		elseif($payment_amount_subtotal <= 2000 ){
			$steps = 50 ;//50 $ steps
		}
		elseif($payment_amount_subtotal <= 5000 ){
			$steps = 100 ;//100 $ steps
		}
		elseif($payment_amount_subtotal <= 10000 ){
			$steps = 250 ;//250 $ steps
		}
		else{
			$steps = 500 ;//500 $ steps, I guess this will do ...
		}
		$steps = apply_filters(WPPIZZA_SLUG.'_filter_tips_steps', $steps, $payment_amount_subtotal, $orderData);

		/***************************
			calculate the options
		***************************/
		// find the first sensible depending on steps (so we use 125,130, 135 etc for a 122 bill and not 127, 132 etc)
		$loopCount = $steps < 10 ? 10 : abs((int)$steps);
		for($i = 1; $i <= $loopCount ; $i++){
			//if steps are not integers, the is_int check wont work, so will simply set the next one that's > current amount
			if(!is_int($steps)){
				$nextStep = $amountInteger + ($i * $steps);
				if($nextStep > $payment_amount_subtotal){
					$firstTipOption = $nextStep;
					break;
				}
			}else{
				$nextStep = $amountInteger + $i;
				if(is_int($nextStep / $steps)){
					$firstTipOption = $nextStep;
					break;
				}
			}
		}
		//get all options starting from first determined
		for($i = 0; $i < $maxSteps ; $i++){
			$tipStep = $firstTipOption + ($i * $steps);
			$stepsTips = $tipStep - $payment_amount_subtotal ;
			$tips_roundup_options[] = array('label' => wppizza_format_price($tipStep), 'tip' => $stepsTips);
		}

		/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*
		#
		#	generate markup
		#
		*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*/

		//set 'amount' to be selected - overwritten as required
		$select_amount_option = true;

		/*************************
			select markup
		*************************/
		$markup_select = '';

		$markup_select .= '<select id="'.WPPIZZA_SLUG.'-'.$ctips_key.'-select">';//data-total="'.$payment_amount.'" data-fractions="'.wppizza_currency_precision().'"

			//option markup - amount
			$sel_markup = (string)$tips_dropdown_select == 'amount'  ? ' selected="selected"' : '' ;
			$markup_select .= '<option value="amount" '.$sel_markup.'>'.$wppizza_options['localization']['tips'].'</option>';

			//option markup - no tip
			$sel_markup = (string)$tips_dropdown_select == '0' ? ' selected="selected"' : '' ;
			$markup_select .= '<option value="0" '.$sel_markup.'>-- '.$wppizza_options['localization']['no_tip'].' --</option>';

			//options - percentages
			foreach($tips_percentage_options as $value){
				//option markup
				$sel_markup = (string)$tips_dropdown_select == (string)$value['tip']  ? ' selected="selected"' : '' ;
				$markup_select .= '<option data-pc="'.$value['pc'].'" value="'.$value['tip'].'" '.$sel_markup.'>'.sprintf(wppizza_sanitise_forsprintf($wppizza_options['localization']['tip_value'], 1), $value['label']).'</option>';
			}

			//options - roundup
			foreach($tips_roundup_options as $value){
				//option markup
				$sel_markup = (string)$tips_dropdown_select == (string)$value['tip']  ? ' selected="selected"' : '' ;
				$markup_select .= '<option value="'.$value['tip'].'" '.$sel_markup.' >'.sprintf(wppizza_sanitise_forsprintf($wppizza_options['localization']['roundup_value'], 1) , $value['label']).'</option>';
			}

		//end select markup
		$markup_select .= '</select>';

		/**************************
			direct input
		**************************/
		$required_attribute = '';
		/* is pickup */
		if(!empty($orderData['summary']['self_pickup']) && !empty($wppizza_options['order_form'][$ctips_key]['required_on_pickup']) ){
			$required_attribute = 'required = "required" ';
		}
		/* is delivery */
		if(empty($orderData['summary']['self_pickup']) && !empty($wppizza_options['order_form'][$ctips_key]['required']) ){
			$required_attribute = 'required = "required" ';
		}
		//adding - unused - subtotal before tips as data-subtotal just for info if we want to doublecheck tip percentage calculations for example
		$markup_input = '<input type="text" id="' . WPPIZZA_SLUG . '-'.$ctips_key.'" data-subtotal="'.esc_attr($payment_amount_subtotal).'" class="' . WPPIZZA_SLUG . '-'.$ctips_key.'" name="'.$ctips_key.'" autocomplete="off" size="20" placeholder="' .$wppizza_options['order_form'][$ctips_key]['placeholder'] . '" value="'.wppizza_format_price($tips_value, null).'" '.$required_attribute.' />';

		/**************************
			label in div, before
		**************************/
		$markup_label = '';
		//currently not using a lable as it's added to dropdown as first option
		#$markup_label = !empty($wppizza_options['localization']['tips']) ? '<div id="' . WPPIZZA_SLUG . '-'.$ctips_key.'-label" class="' . WPPIZZA_SLUG . '-'.$ctips_key.'-label" >'.$wppizza_options['localization']['tips'] . '</div>' : '' ;

		/*----------------------------------------------------------------------------------------------

			ORDERPAGE ONLY - DROPDOWN AND INPUT TEXT FIELD

			input and select inverted here as we are floating:right
			wrap in div for possible error messages (if set to be required for example)
		----------------------------------------------------------------------------------------------*/
		if($event == 'orderpage'){
			$markup = array(
				'sort' => 170,
				'class_ident' => 'tips',
				'label' => '<div>'.$markup_label. $markup_input,//html td  +wrapper div
				'value_formatted' => $markup_select.'</div>',//html /td + wrapper div
				'value' => $tips_value,
				'fullwidth' => true,
			);
		}
		else{

			$markup = array();
			//only return a filled array - outside order page - if tips > 0
			if(is_numeric($tips_value) && !empty($tips_value) ){
				$markup = array(
					'sort' => 170,
					'class_ident' => 'tips',
					'label' => !empty($wppizza_options['localization']['tips']) ? $wppizza_options['localization']['tips'] : '',
					'value_formatted' => wppizza_format_price($tips_value),
					'value' => $tips_value,
					'fullwidth' => false,
				);
			}
		}


		/*
			make filterable and return as array
		*/
		$markup = apply_filters( strtolower(__CLASS__ .'_'.__method__) , $markup, $event);

	return $markup;
	}

}
?>