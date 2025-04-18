<?php
if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/
 /****************************************************************************************
 *
 * filters available: wppizza_filter_order_summary_markup
 *	
 *
 ****************************************************************************************/
?>
<?php

	/* table */
	$markup['summary_table_'] = '<table class="'. $class_table .'">';

		/* tbody */
		$markup['summary_row_group_'] = '<tbody class="'. $class_tbody .'">';

			/* table (summary) rows | cells */
			foreach($summary as $key => $values){

				$markup['summary_row_'.$key.'_']= '<tr class="'.$class_tr[$key].'">';
					
					/* 
						single row if defined as fullwidth
						typically the label / values will then be defined as their one-off or so elements
						(an example would be the "tips" section on the order page)
					*/
					if(!empty($values['fullwidth'])){
					
						$markup['label_value_'.$key.''] = '<td colspan="2">' . $label[$key] . $value[$key] . '</td>';
					
					}
					/*
						standard label / value columns
					*/
					else{
						
						$markup['label_'.$key.''] = '<td>' . $label[$key] . '</td>';

						$markup['value_'.$key.''] = '<td>' . $value[$key] . '</td>';
					}

				$markup['_summary_row_'.$key.'']= '</tr>';
			}

		/* close tbody */
		$markup['_summary_row_group'] = '</tbody>';

	/* close table */
	$markup['_summary_table'] = '</table>';

?>