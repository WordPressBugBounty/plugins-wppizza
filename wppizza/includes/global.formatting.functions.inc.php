<?php if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/ ?>
<?php
/*******************************************************************
*
*	[round natural - $precision => no of decimals]
*	expects float / dec as input
*******************************************************************/
function wppizza_round($value){
	$precision = wppizza_currency_precision();
    $rounded = round((float)$value, $precision);
return $rounded;
}
/*******************************************************************
*
*	[round up - $precision => no of decimals]
*
*******************************************************************/
function wppizza_round_up( $value, $fractions = false){
		
	//allow for override of setting of precision when calling the function
	if($fractions !== false && is_int($fractions)){
		$precision = (int)$fractions;
	}else{
		$precision = wppizza_currency_precision();
	}
  
    $pow = pow ( 10, $precision );
    /*
    	lets start by rounding things somewhat sensibly
    	to check if we indeed need to round anything at all
    	casting to string first
    	or we might end up with this issue http://floating-point-gui.de/
    	in some cases
    */
   	$value = (string)($value * $pow)/$pow ;
   	$format_precision = ($precision + 5);
   	$value = number_format($value, $format_precision,'.', '');
   	
	//$powXvalue = round($pow * $value);//round again or ceil(2.4900000*100) will actually return 250 for example
	
	
	//since php 8. something this powXvalue issue above does not appear to be the case anymore, so lets do a simple ceil here
	$powXvalue = ceil($pow * $value);
	
	//error_log('wppizza_round_up FN ['.$precision.' / '.$pow.']: ' .$powXvalue .'| '.$r.'') ; 

    $rounded = ( ceil ( $powXvalue ) + ceil ( $powXvalue - ceil ( $powXvalue ) ) ) / $pow;

    return $rounded;
}
/*****************************************************************
	forma to non-i18n number with/out decimals, rounded etc
	in some places $type is set to 'percent' if we want to do
	something with it at some point ..
*****************************************************************/
	function wppizza_output_format_float($str, $type='price', $decimals=0){
		if($type=='price'){
			$str=sprintf('%01.2f',$str);
		}
		/**when hiding decimals **/
		if($type=='hidedecimals'){
			$str=sprintf('%01.0f',$str);
		}
		/**round **/
		if($type=='round'){
			$str=round($str, $decimals);
		}

		return $str;
	}
/*****************************************************************
	localize percent values including % sign
*****************************************************************/
//function wppizza_format_percent($value){

//	$decimals = strlen(substr(strrchr($value, "."), 1));

//	$value=number_format_i18n($value,$decimals).' %';

//return $value;
//}
/*****************************************************************
	localize percent values with or without % sign
*****************************************************************/
function wppizza_output_format_percent($value, $add_percent_sign = false){

	$decimals = strlen(substr(strrchr($value, "."), 1));

	$value=number_format_i18n($value,$decimals);

	if($add_percent_sign){
		$value.='%';
	}

return $value;
}
/****************************************************************************
*	[decode entities]
****************************************************************************/
function wppizza_decode_entities($str, $decodeNCRs = true){

		//ignore anything that's an array here
		if(is_array($str)){
			return $str;
		}

		//avoid some potential php notices/warning
		if($str === null || $str === false  || $str === ''){
			$str = '';
		return $str;
		}

		$supportedCharsets=array('iso-8859-1','iso-8859-5','iso-8859-15','utf-8','cp866','cp1251','cp1252','koi8-r','big5','gb2312','big5-hkscs','shift_jis','euc-jp','macroman');
		if(in_array(strtolower(WPPIZZA_CHARSET),$supportedCharsets)){
			$charset=WPPIZZA_CHARSET;
		}else{
			$charset='UTF-8';
		}
		if($decodeNCRs){
   			$str= html_entity_decode($str,ENT_QUOTES,"".$charset."");
    		$str= preg_replace('/&#(\d+);/m',"chr(\\1)",$str); //#decimal notation /*php 5.5 e modifier deleted*/
	    	$str= preg_replace('/&#x([a-f0-9]+);/mi',"chr(0x\\1)",$str);  //#hex notation/*php 5.5 e modifier deleted*/
	    	/**the below is - i think - an error as to how &amp; is stored in the db in the first place. ought to check that at some point*/
	    	$str= str_replace('&amp;','&',$str);/*let's deal with &amp too quotes have already been dealt with in html_entity_decode. not using htmlspecialchars_decode as that would also convert back &lt; and &gt; which we (probably) dont want. lt's be safe.*/
		}

	return $str;
}
/****************************************************************************
	[alias of wppizza_email_decode_entities above with added trim]
****************************************************************************/
function wppizza_decode_entities_trim($str,$decodeNCRs=true){

	//avoid some potential php notices/warning
	if($str === null || $str === false  || $str === ''){
		$str = '';
	return $str;
	}

	$str = wppizza_decode_entities($str,$decodeNCRs);
	$str = trim($str);
return $str;
}


/**format time output**/
function wppizza_format_time($time, $timeFormat){
	/*defaults*/
	if(!isset($timeFormat) || !is_array($timeFormat)){
		$fHour='G';
		$fSeparator=':';
		$fMinute='i';
		$fAMPM='';
	}else{
		$fHour=$timeFormat['hour'];
		$fSeparator=$timeFormat['separator'];
		$fMinute=$timeFormat['minute'];
		$fAMPM=$timeFormat['ampm'];
	}
	$hm=explode(":",$time);
	$t=mktime($hm[0],$hm[1],0,0,0,0);
	$time=date(''.$fHour.''.$fSeparator.''.$fMinute.''.$fAMPM.'',$t);

return $time;
}

/**
	format weekday
	makes a text representation out of int
**/
function wppizza_format_weekday($int, $format){
	/*let's use static timestamps, no need to use the overhead of a function to generate really **/
	$day[1]=946900800;//mon (3rd jan 2000 12:00)
	$day[2]=946987200;//tue (4th jan 2000 12:00)
	$day[3]=947073600;//wed (5th jan 2000 12:00)
	$day[4]=947160000;//thu (6th jan 2000 12:00)
	$day[5]=947246400;//fri (7th jan 2000 12:00)
	$day[6]=947332800;//sat (8th jan 2000 12:00)
	$day[7]=947419200;//sun (9th jan 2000 12:00) if using 7 as sunday
	$day[0]=947419200;//sun (9th jan 2000 12:00) if using 0 as sunday

	$wDayFormatted=date_i18n($format,$day[$int]);

	return $wDayFormatted;
}
/***
	takes 01:45, 3:45 format, no seconds as currently not needed
**/
function wpizza_get_opening_times($starttime, $endtime, $d, $m, $Y, $day='today'){

	//$openingtime=false;//initialize

	$start=explode(':',$starttime);
	$end=explode(':',$endtime);
	/* casting to integer for some strange and very fickle php versions */
	$start[0] = (int)$start[0];
	$start[1] = (int)$start[1];
	$end[0] = (int)$end[0];
	$end[1] = (int)$end[1];

	/***if both times are the same , we are closed**/
	if($starttime==$endtime) {
		//$openingtime=false;
		return false;
	}


	/* initiallize var */
	$start_end_time = array();

	/*
	changed in 2.10.4.5 for an easier way to check if opening/closing times cross midnight.
	uses gmmktime to make it dst agnostic (as we are only dealing with hours and minutes)
	*/
	$calcStart=gmmktime((int)$start[0], (int)$start[1], 0 , 1 ,1 ,2000);
	$calcEnd=gmmktime((int)$end[0], (int)$end[1], 0 , 1 ,1 ,2000);
	if($calcEnd<$calcStart) {
		$openingTimesCrossMidnight=1;
	}

	if(isset($openingTimesCrossMidnight)){
		if($day=='today'){
		$start_end_time['start']=mktime($start[0],$start[1],0,$m,$d,$Y);
		$start_end_time['end']=mktime(23,59,59,$m,$d,$Y);
		}

		if($day=='yesterday'){
		$start_end_time['start']=mktime(0,0,0,$m,$d,$Y);
		$start_end_time['end']=mktime($end[0],$end[1],0,$m,$d,$Y);
		}
	}else{
		if($day=='today'){
		$start_end_time['start']=mktime($start[0],$start[1],0,$m,$d,$Y);
		$start_end_time['end']=mktime($end[0],$end[1],0,$m,$d,$Y);
		}
		/*won't happen...well, shouldn't**/
		// 	if($day=='yesterday'){
		// 		$openingtime['start']=mktime(23,0,0,$m,$d,$Y);
		// 		$openingtime['end']=mktime(23,0,0,$m,$d,$Y);
		// 	}
	}

	if(!empty($start_end_time)){
		return $start_end_time;
	}else{
		return false;
	}
}

/*********************************************************
	[days]
*********************************************************/
function wppizza_days(){
	$items['1']=__('Mondays', 'wppizza-admin');
	$items['2']=__('Tuesdays', 'wppizza-admin');
	$items['3']=__('Wednesdays', 'wppizza-admin');
	$items['4']=__('Thursdays', 'wppizza-admin');
	$items['5']=__('Fridays', 'wppizza-admin');
	$items['6']=__('Saturdays', 'wppizza-admin');
	$items['0']=__('Sundays', 'wppizza-admin');

	return $items;
}

/*********************************************************
	[format date/time according to wp settings
	but always shorten Full months (F) to short month (M) to save some space
	if used ]
*********************************************************/
function wppizza_wpdate_formatted($timestamp = WPPIZZA_WP_TIME, $components = array('date', 'time')){
	static $date_format = null, $time_format;

	if($date_format === null ){
		/* get date/time options set */
		$date_format = str_replace('F','M',get_option('date_format'));
	}

	if($time_format === null ){
		/* get date/time options set */
		$time_format = get_option('time_format');
	}

	/* format */
	$str = array();
	if(in_array('date', $components)){
		$str[] = date($date_format, $timestamp);
	}
	if(in_array('time', $components)){
		$str[] = date($time_format, $timestamp);
	}

	$str = implode(' ', $str);

return $str;
}

/*********************************************************
	[format order date / update timestamp according to wp settings]
	return formatted and timestamp
	@since 3.10.6
	@param str (timestamp - yyyy-mm-dd hh:mm:ss)
	@param array (date and/or time formatted to return)
	@return array (formatted / timestamp)
*********************************************************/
function wppizza_orderdate_formatted($str, $components = array('date', 'time')){
	//explode into components
	$date_components = wppizza_multiexplode(array('-', ':' ,' '), $str);
	//create timestamp
	$timestamp = mktime($date_components[3], $date_components[4], $date_components[5], $date_components[1], $date_components[2], $date_components[0] );
	//output
	$date = wppizza_wpdate_formatted($timestamp, $components);

	// return formatted and timestamp separately
	$order_date = array();
	$order_date['formatted'] = apply_filters('wppizza_filter_orderdate_formatted', $date , $timestamp);
	$order_date['timestamp'] = $timestamp;

return $order_date;
}
/****************************************************************************
	[decode entities in send order email plaintext]
****************************************************************************/
function wppizza_email_decode_entities($str,$decodeNCRs=true){

		$charset = WPPIZZA_CHARSET;

		$supportedCharsets=array('iso-8859-1','iso-8859-5','iso-8859-15','utf-8','cp866','cp1251','cp1252','koi8-r','big5','gb2312','big5-hkscs','shift_jis','euc-jp','macroman');
		if(in_array(strtolower($charset),$supportedCharsets)){
			$charset=$charset;
		}else{
			$charset='UTF-8';
		}
		if($decodeNCRs){
   			$str= html_entity_decode($str,ENT_QUOTES,"".$charset."");
    		$str= preg_replace('/&#(\d+);/m',"chr(\\1)",$str); //#decimal notation /*php 5.5 e modifier deleted*/
	    	$str= preg_replace('/&#x([a-f0-9]+);/mi',"chr(0x\\1)",$str);  //#hex notation/*php 5.5 e modifier deleted*/
	    	/**the below is - i think - an error as to how &amp; is stored in the db in the first place. ought to check that at some point*/
	    	$str= str_replace('&amp;','&',$str);/*let's deal with &amp too quotes have already been dealt with in html_entity_decode. not using htmlspecialchars_decode as that would also convert back &lt; and &gt; which we (probably) dont want. lt's be safe.*/
		}

	return $str;
}


/****************************************************************************
	[decode entities, strip html , string length]
****************************************************************************/
function wppizza_decode_strip_length($str, $count = true){

	/*
		decode any entities
		and strip html
	*/
	$str = wppizza_email_decode_entities($str);
	$str = trim(wp_kses($str,array()));
	$str = str_replace('&amp;','&', $str);// allow &amp; to be &

	/*spare us the overhead if only decoding and stripping*/
	if($count){
		/*
			length of str

			Note:
			utf8_decode() converts characters that are not in ISO-8859-1 to '?',
			which, for the purpose of counting, is quite alright.
		*/
		#$utf8_decode_str=utf8_decode($str);//utf8_decode deprecated since php 8.2
		//utf8_decode replacement
		$utf8_decode_str = mb_convert_encoding($str, 'ISO-8859-2', 'UTF-8');// UTF-8 -> ISO-8859-2
		$strLength = strlen($utf8_decode_str);


		$arr=array();
	 	$arr['string'] = $str;
	 	$arr['length'] = $strLength;

 	return $arr;
	}

	if(!$count){
		return $str;
	}
}
/*******************************************************************************************************************************************************
*
*
* 	[EARSE/ANONYMISE HELPERS]
*
*
********************************************************************************************************************************************************/
	/*
	* Return anonymised data depending on type
	* based on wp_privacy_anonymize_data and a couple of ideas borrowed from
	* easy-digital-downloads (https://easydigitaldownloads.com/) but with some more granularity
	* especially if purchase/customer records (notably emails)
	* are still needed for legal and regulatory reasons.
	*
	* @since 3.6
	*
	* @param string $type
	* @param string $data
	*
	* @return string
	*/
	function wppizza_anonymize_data( $type = false , $data = '' , $timestamp = '' ) {
		/* skip empty data strings */
		if($data === '' ){
			return '';
		}

		switch ( $type ) {

			case 'email_mask':// mask email
				$email_parts = explode( '@', $data );
				$name        = wppizza_mask_string( $email_parts[0] );
				$domain      = wppizza_mask_domain( $email_parts[1] );
				$anonymised = $name . '@' . $domain;
				break;
			case 'email_erase': //erase email
				$email_address    = strtolower( $data );
				$email_parts      = explode( '@', $email_address );
				$anonymized_email = wp_hash( uniqid( get_option( 'site_url' ), true ) . $email_parts[0] . WPPIZZA_WP_TIME, 'nonce' );
				$anonymised = ''.$anonymized_email.'@site.invalid';
				break;
			case 'ip_address':
				$anonymised = function_exists('wp_privacy_anonymize_ip') ? wp_privacy_anonymize_ip( $data ) : '0.0.0.0' ;
				break;
			case 'text':
				$anonymised = '***** deleted *****';
				break;
			case 'session_id':
				$anonymised = '***** deleted *****';
				break;
			case 'transaction_id':
				$anonymised = wppizza_mask_string( $data );
				break;
			case 'anonymised_note':
				$orig_notes = maybe_unserialize($data);
				$anonymised = '';
				if(!empty($orig_notes)){
					if(is_array($orig_notes)){
						$anonymised .= implode(PHP_EOL, $orig_notes).PHP_EOL;
					}else{
						$anonymised .= $orig_notes.PHP_EOL;
					}
				}
				$anonymised .= '***** Record Anonymised on  '.$timestamp.' *****';
				break;
			case 'anonymised_customer_data':
				$data = maybe_unserialize($data);
				if(is_array($data)){
					foreach($data as $k => $v){
						if($k == 'cemail' && !empty($v)){
							$data[$k] = wppizza_anonymize_data('email_mask', $v);
						}
						elseif(is_bool($v)){
							$data[$k] = $v;
						}
						else{
							$data[$k] = empty($v) ? '' : '***';
						}
					}
				}
				$anonymised = maybe_serialize($data);
				break;
			case 'anonymised_order_data':
				$data = maybe_unserialize($data);
				if(!empty($data['info']['session_id'])){
					$data['info']['session_id'] = wppizza_anonymize_data('session_id');
				}
				if(!empty($data['info']['unique_id'])){
					$data['info']['unique_id'] = wppizza_anonymize_data('text');
				}
				$anonymised = maybe_serialize($data);
				break;

			case 'longtext':/* currently unused internally but could be used if needed */
				$anonymised = '***** deleted *****';
				break;
			case 'url':/* currently unused internally but could be used if needed */
				$anonymised = '*****url deleted*****';
				break;
			case 'date':/* currently unused internally but could be used if needed */
				$anonymised = '0000-00-00 00:00:00';
				break;
			case 'timestamp':/* currently unused internally but could be used if needed */
				$anonymised = '0';
				break;

			default:
				$anonymised = '';
		}

	return $anonymised;
	}

	/**************
	* borrowed from easy-digital-downloads (https://easydigitaldownloads.com/)
	*
	* Given a string, mask it with the * character.
	*
	* First and last character will remain with the filling characters being changed to *. One Character will
	* be left in tact as is. Two character strings will have the first character remain and the second be a *.
	*
	* @since 3.6
	* @param string $string
	*
	* @return string
	**************/
	function wppizza_mask_string( $string = '' ) {

		if ( empty( $string ) ) {
			return '';
		}

		$first_char  = substr( $string, 0, 1 );
		$last_char   = substr( $string, -1, 1 );

		$masked_string = $string;

		if ( strlen( $string ) > 2 ) {

			$total_stars = strlen( $string ) - 2;
			$masked_string = $first_char . str_repeat( '*', $total_stars ) . $last_char;

		} elseif ( strlen( $string ) === 2 ) {

			$masked_string = $first_char . '*';

		}

	return $masked_string;
	}

	/**************
	* borrowed from easy-digital-downloads (https://easydigitaldownloads.com/)
	*
	* Given a domain, mask it with the * character.
	*
	* TLD parts will remain intact (.com, .co.uk, etc). All subdomains will be masked t**t.e*****e.co.uk.
	*
	* @since 3.6
	* @param string $domain
	*
	* @return string
	**************/
	function wppizza_mask_domain( $domain = '' ) {

		if ( empty( $domain ) ) {
			return '';
		}

		$domain_parts = explode( '.', $domain );

		if ( count( $domain_parts ) === 2 ) {

			// We have a single entry tld like .org or .com
			$domain_parts[0] = wppizza_mask_string( $domain_parts[0] );

		} else {

			$part_count     = count( $domain_parts );
			$possible_cctld = strlen( $domain_parts[ $part_count - 2 ] ) <= 3 ? true : false;

			$mask_parts = $possible_cctld ? array_slice( $domain_parts, 0, $part_count - 2 ) : array_slice( $domain_parts, 0, $part_count - 1 );

			$i = 0;
			while ( $i < count( $mask_parts ) ) {
				$domain_parts[ $i ] = wppizza_mask_string( $domain_parts[ $i ]);
				$i++;
			}

		}

	return implode( '.', $domain_parts );
	}
?>