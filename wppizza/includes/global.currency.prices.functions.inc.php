<?php if ( ! defined( 'ABSPATH' ) ) exit;/*Exit if accessed directly*/ ?>
<?php
/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*
*
*	currency and currency formatting
*	@since 4.x	
*
*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\*/
/***********************************************************
*	[selectable currencies ]
*	@since forever
*	@return mixed	
***********************************************************/
function wppizza_currencies($selected='',$returnValue=null){
	$items['---none---']='';
	$items['USD']='$';
	$items['GBP']='£';
	$items['EUR']='€';
	$items['CAD']='$';
	$items['CHF']='CHF';
	$items['ALL']='Lek';
	$items['AFN']='&#1547;';
	$items['ARS']='$';
	$items['AWG']='ƒ';
	$items['AUD']='$';
	$items['AZN']='&#1084;';
	$items['BSD']='$';
	$items['BBD']='$';
	$items['BYR']='p.';
	$items['BZD']='BZ$';
	$items['BMD']='$';
	$items['BOB']='$b';
	$items['BAM']='KM';
	$items['BWP']='P';
	$items['BGN']='&#1083;&#1074;';
	$items['BRL']='R$';
	$items['BND']='$';
	$items['KHR']='&#6107;';
	$items['KYD']='$';
	$items['CLP']='$';
	$items['CNY']='¥';
	$items['RMB']='¥';
	$items['COP']='$';
	$items['CRC']='¢';
	$items['HRK']='kn';
	$items['CUP']='&#8369;';
	$items['CZK']='K&#269;';
	$items['DKK']='kr';
	$items['DOP']='RD$';
	$items['XCD']='$';
	$items['EGP']='£';
	$items['SVC']='$';
	$items['EEK']='kr';
	$items['FKP']='£';
	$items['FJD']='$';
	$items['GHC']='¢';
	$items['GIP']='£';
	$items['GTQ']='Q';
	$items['GGP']='£';
	$items['GYD']='$';
	$items['HNL']='L';
	$items['HKD']='$';
	$items['HUF']='Ft';
	$items['ISK']='kr';
	$items['IDR']='Rp';
	$items['INR']='&#8377;';
	$items['IRR']='&#65020;';
	$items['IMP']='£';
	$items['ILS']='&#8362;';
	$items['JMD']='J$';
	$items['JPY']='¥';
	$items['JEP']='£';
	$items['KZT']='&#8376;';
	$items['KGS']='&#1083;';
	$items['LAK']='&#8365;';
	$items['LVL']='Ls';
	$items['LBP']='£';
	$items['LRD']='$';
	$items['LTL']='Lt';
	$items['MKD']='&#1076;';
	$items['MYR']='&#82;';
	$items['MUR']='&#8360;';
	$items['MXN']='$';
	$items['MNT']='&#8366;';
	$items['MZN']='MT';
	$items['NAD']='$';
	$items['NPR']='&#8360;';
	$items['ANG']='ƒ';
	$items['NZD']='$';
	$items['NIO']='C$';
	$items['NGN']='&#8358;';
	$items['KPW']='&#8361;';
	$items['NOK']='kr';
	$items['OMR']='&#65020;';
	$items['PKR']='&#8360;';
	$items['PAB']='B/.';
	$items['PYG']='Gs';
	$items['PEN']='S/.';
	$items['PHP']='&#8369;';
	$items['PLN']='&#122;&#322;';
	$items['QAR']='&#65020;';
	$items['RON']='lei';
	$items['RUB']='&#1088;';
	$items['SHP']='£';
	$items['SAR']='&#65020;';
	$items['RSD']='&#1056;&#1057;&#1044;';
	$items['RSD-ALT']='RSD';//hyphens and anything thereafter will be stripped to get the right ISO in frontend
	$items['SCR']='&#8360;';
	$items['SGD']='$';
	$items['SBD']='$';
	$items['SOS']='S';
	$items['ZAR']='R';
	$items['KRW']='&#8361;';
	$items['LKR']='&#8360;';
	$items['SEK']='kr';
	$items['SRD']='$';
	$items['SYP']='£';
	$items['TWD']='NT$';
	$items['THB']='&#3647;';
	$items['TTD']='TT$';
	$items['TRL']='£';
	$items['TVD']='$';
	$items['UAH']='&#8372;';
	$items['UYU']='$U';
	$items['UZS']='&#1083;';
	$items['VEF']='Bs';
	$items['VND']='&#8363;';
	$items['YER']='&#65020;';
	$items['ZWD']='Z$';
	$items['TRY']='&#8378;';
	$items['TND']='&#1583;&#46;&#1578;';
	$items['TND-ALT']='DT';
	$items['AED']='&#1583;&#46;&#1573;';
	$items['AOA']='Kz';
	$items['BDT']='Tk';
	$items['BHD']='BD';
	$items['CVE']='$';
	$items['DZD']='&#1583;&#1580;';
	$items['DZD-ALT']='DA';
	$items['ERN']='Nfk';
	$items['ERN-ALT']='&#4755;&#4693;&#4939;';
	$items['ETB']='Br';
	$items['GNF']='FG';
	$items['KWD']='&#1603;';
	$items['LYD']='LD';
	$items['MAD']='&#1583;&#46;&#1605;&#46;';
	$items['MDL']='leu';
	$items['MGA']='Ar';
	$items['MMK']='K';
	$items['MOP']='MOP$';
	$items['MRO']='UM';
	$items['MVR']='Rf';
	$items['MVR-ALT']='&#1923;';
	$items['MWK']='MK';
	$items['PGK']='K';
	$items['SDG']='&#1580;&#46;&#1587;&#46;';
	$items['SLL']='Le';
	$items['STD']='Db';
	$items['XPF']='F';
	$items['CFP']='F';
	$items['ZMW']='ZK';
	
	$items = apply_filters('wppizza_filter_currencies',$items);

	if(!$returnValue){
	ksort($items);
    foreach($items as $key=>$val){
    	if($key==$selected){$d=' selected="selected"';}else{$d='';}
		$options[]=array('selected'=>''.$d.'','value'=>''.$val.'','id'=>''.$key.'');
    }}
    if($selected!='' && $returnValue){
    	$options=array('key'=>$selected,'val'=>$items[$selected]);
    }
	return $options;
}

/******************************************************************
*	[create an instance of the NumberFormatter according to WP/WPPizza settings]
*	@since @since v 4.0.0-Beta
*	@param 3 letter str
*	@return obj
******************************************************************/
function wppizza_currency_formatter($isocurrency = false ){
	global $wppizza_options;
	
	//set as per plugin settings or as passed on to function - 3 letter iso currency
	if( empty($isocurrency) ){
		$isocurrency = $wppizza_options['order_settings']['currency'];
	} 
	else{
		$validated_iso = wppizza_validate_iso_currency($isocurrency);
		$isocurrency = empty($validated_iso) ? $wppizza_options['order_settings']['currency'] : $validated_iso;	
	}
	
	//locale and currency selected
	$locale = WPPIZZA_LANGUAGE_CODE; //smth like 'en-US' - browser or user locale

	//instance
	$formatter = new NumberFormatter( $locale."@currency=".$isocurrency."", NumberFormatter::CURRENCY );
	
	//force remove decimals - prices will have been rounded already
	if($wppizza_options['prices_format']['hide_decimals']){ 
		$formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 0);
	}

return $formatter;
}
/******************************************************************
*	[currency elements iso code / currency symbol / number of decimals ]
*	@since @since v 4.0.0-Beta
*	@param str 
*	@return str/array
******************************************************************/
function wppizza_currency_formatting($selected = false){
	static $format = null;
	if($format === null){
		
		global $wppizza_options;
		
		$formatter = wppizza_currency_formatter();	
				
		//extract formatting parts
		$format = array(
			'symbol' => $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL),
			'iso' => $wppizza_options['order_settings']['currency'],
			'decimals' => $formatter->getAttribute(NumberFormatter::FRACTION_DIGITS),
			'fraction_min' => $formatter->getAttribute(NumberFormatter::MIN_FRACTION_DIGITS),
			'fraction_max' => $formatter->getAttribute(NumberFormatter::MAX_FRACTION_DIGITS),
			'display' => 'symbol', //could be changed to "narrowSymbol" for example to force $ instead of US$ for example - all depends on locale and currency set though (should be made settable I guess....) - see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat/NumberFormat#currencydisplay
							
			# legacy pre 4.x - for info , in case they are needed again at some point
			#'pos' =>$wppizza_options['prices_format']['currency_symbol_position'],
			#'spc' =>$wppizza_options['prices_format']['currency_symbol_spacing'],
			#'decimals' =>( defined('WPPIZZA_DECIMALS') ? (int)WPPIZZA_DECIMALS : (empty($wppizza_options['prices_format']['hide_decimals']) ?  2 : 0 )),			
		);
	}
	/*	return a single element */
	if(!empty($selected) && isset($format[$selected])){
		return $format[$selected];
	}
	
return $format;
}
/***********************************************************
	wppizza currency options
	@since >3.19
***********************************************************/
function wppizza_currency($selected =''){
	global $wppizza_options;
	$c = array(
		'symbol' => $wppizza_options['order_settings']['currency_symbol'],
		'iso' =>$wppizza_options['order_settings']['currency'],
		'pos' =>$wppizza_options['prices_format']['currency_symbol_position'],
		'spc' =>$wppizza_options['prices_format']['currency_symbol_spacing'],
		'decimals' =>( defined('WPPIZZA_DECIMALS') ? (int)WPPIZZA_DECIMALS : (empty($wppizza_options['prices_format']['hide_decimals']) ?  2 : 0 )),
	);
	if(!empty($selected) && isset($c[$selected])){
		//only return selected val if wanted	
		return $c[$selected];
	}
return $c;
}
/*******************************************************************
*	[currency rounding precisions]
*	@since unknown
*******************************************************************/
function wppizza_currency_precision(){
	global $wppizza_options;
	$precision = (!empty($wppizza_options['prices_format']['hide_decimals'])) ? 0 : 2;
	if(defined('WPPIZZA_DECIMALS')){
		$precision=(int)WPPIZZA_DECIMALS;
	}
return $precision;
}
/****************************************************
	get currency info
	@since 4-Beta
	@return array
******************************************************/
function wppizza_currency_info($isoselected = false){
	# References
	# https://codeshack.io/html-currency-symbols-reference/
	# https://www.toptal.com/designers/htmlarrows/currency/
	# https://gist.github.com/Gibbs/3920259

	$currencies = array( 
		"AED" => array("name" => "United Arab Emirates Dirham", "demonym" => "UAE", "majorSingle" => "Dirham", "majorPlural" => "Dirhams", "ISOnum" => 784, "symbol" => "DH", "minorSingle" => "Fils", "minorPlural" => "Fils", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"AFN" => array("name" => "Afghan Afghani", "demonym" => "Afghan", "majorSingle" => "Afghani", "majorPlural" => "Afghani", "ISOnum" => 971, "symbol" => "Af", "minorSingle" => "Pul", "minorPlural" => "Pul", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ALL" => array("name" => "Albanian Lek", "demonym" => "Albanian", "majorSingle" => "Lek", "majorPlural" => "Lekë", "ISOnum" => 8, "symbol" => "L", "minorSingle" => "Qindarka", "minorPlural" => "Qindarka", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"AMD" => array("name" => "Armenian Dram", "demonym" => "Armenian", "majorSingle" => "Dram", "majorPlural" => "Dram", "ISOnum" => 51, "symbol" => "&#1423;", "minorSingle" => "Luma", "minorPlural" => "Luma", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ANG" => array("name" => "Netherlands Antillean Guilder", "demonym" => "Netherlands Antillean", "majorSingle" => "Guilder", "majorPlural" => "Guilders", "ISOnum" => 532, "symbol" => "ƒ", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"AOA" => array("name" => "Angolan Kwanza", "demonym" => "Angolan", "majorSingle" => "Kwanza", "majorPlural" => "Kwanza", "ISOnum" => 973, "symbol" => "Kz", "minorSingle" => "Centimo", "minorPlural" => "Centimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ARS" => array("name" => "Argentine Peso", "demonym" => "Argentine", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 32, "symbol" => "AR$", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"AUD" => array("name" => "Australian Dollar", "demonym" => "Australian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 36, "symbol" => "AU$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"AWG" => array("name" => "Aruban Florin", "demonym" => "Aruban", "majorSingle" => "Florin", "majorPlural" => "Florin", "ISOnum" => 533, "symbol" => "ƒ", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"AZN" => array("name" => "Azerbaijani Manat", "demonym" => "Azerbaijani", "majorSingle" => "Manat", "majorPlural" => "Manat", "ISOnum" => 944, "symbol" => "&#8380;", "minorSingle" => "Qapik", "minorPlural" => "Qapik", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BAM" => array("name" => "Bosnia and Herzegovina Convertible Mark", "demonym" => "Bosnia-Herzegovina", "majorSingle" => "Convertible Mark", "majorPlural" => "Marks", "ISOnum" => 977, "symbol" => "KM", "minorSingle" => "Fening", "minorPlural" => "Fening", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BBD" => array("name" => "Barbadian Dollar", "demonym" => "Barbadian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 52, "symbol" => "BBD$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BDT" => array("name" => "Bangladeshi Taka", "demonym" => "Bangladeshi", "majorSingle" => "Taka", "majorPlural" => "Taka", "ISOnum" => 50, "symbol" => "&#2547;", "minorSingle" => "Poisha", "minorPlural" => "Poisha", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BGN" => array("name" => "Bulgarian Lev", "demonym" => "Bulgarian", "majorSingle" => "Lev", "majorPlural" => "Leva", "ISOnum" => 975, "symbol" => "&#1083;&#1074;", "minorSingle" => "Stotinka", "minorPlural" => "Stotinki", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BHD" => array("name" => "Bahraini Dinar", "demonym" => "Bahraini", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 48, "symbol" => "BD", "minorSingle" => "Fils", "minorPlural" => "Fils", "ISOdigits" => 3, "decimals" => 3, "numToBasic" => 1000), 
		"BIF" => array("name" => "Burundian Franc", "demonym" => "Burundian", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 108, "symbol" => "FBu", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"BMD" => array("name" => "Bermudian Dollar", "demonym" => "Bermudian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 60, "symbol" => "$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BND" => array("name" => "Brunei Dollar", "demonym" => "Brunei", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 96, "symbol" => "B$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BOB" => array("name" => "Bolivian Boliviano", "demonym" => "Bolivian", "majorSingle" => "Boliviano", "majorPlural" => "Bolivianos", "ISOnum" => 68, "symbol" => "Bs.", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BRL" => array("name" => "Brazilian Real", "demonym" => "Brazilian", "majorSingle" => "Real", "majorPlural" => "Reais", "ISOnum" => 986, "symbol" => "R$", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BSD" => array("name" => "Bahamian Dollar", "demonym" => "Bahamian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 44, "symbol" => "$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BTN" => array("name" => "Bhutanese Ngultrum", "demonym" => "Bhutanese", "majorSingle" => "Ngultrum", "majorPlural" => "Ngultrums", "ISOnum" => 64, "symbol" => "Nu.", "minorSingle" => "Chetrum", "minorPlural" => "Chetrums", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BWP" => array("name" => "Botswana Pula", "demonym" => "Botswana", "majorSingle" => "Pula", "majorPlural" => "Pula", "ISOnum" => 72, "symbol" => "P", "minorSingle" => "Thebe", "minorPlural" => "Thebe", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BYN" => array("name" => "Belarusian Ruble", "demonym" => "Belarusian", "majorSingle" => "Ruble", "majorPlural" => "Rubles", "ISOnum" => 933, "symbol" => "Br", "minorSingle" => "Kapiejka", "minorPlural" => "Kapiejka", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"BZD" => array("name" => "Belize Dollar", "demonym" => "Belize", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 84, "symbol" => "BZ$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CAD" => array("name" => "Canadian Dollar", "demonym" => "Canadian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 124, "symbol" => "CA$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CDF" => array("name" => "Congolese Franc", "demonym" => "Congolese", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 976, "symbol" => "FC", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CHF" => array("name" => "Swiss Franc", "demonym" => "Swiss", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 756, "symbol" => "Fr.", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CKD" => array("name" => "Cook Islands Dollar", "demonym" => "Cook Islands", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => null, "symbol" => "$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CLP" => array("name" => "Chilean Peso", "demonym" => "Chilean", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 152, "symbol" => "CL$", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 0, "decimals" => 0, "numToBasic" => 100), 
		"CNY" => array("name" => "Chinese Yuan", "demonym" => "Chinese", "majorSingle" => "Yuan", "majorPlural" => "Yuan", "ISOnum" => 156, "symbol" => "CN¥", "minorSingle" => "Fen", "minorPlural" => "Fen", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"COP" => array("name" => "Colombian Peso", "demonym" => "Colombian", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 170, "symbol" => "CO$", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CRC" => array("name" => "Costa Rican Colon", "demonym" => "Costa Rican", "majorSingle" => "Colón", "majorPlural" => "Colones", "ISOnum" => 188, "symbol" => "¢", "minorSingle" => "Centimo", "minorPlural" => "Centimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CUC" => array("name" => "Cuban convertible Peso", "demonym" => "Cuban Convertible", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 931, "symbol" => "CUC$", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CUP" => array("name" => "Cuban Peso", "demonym" => "Cuban", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 192, "symbol" => "$MN", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CVE" => array("name" => "Cabo Verdean Escudo", "demonym" => "Cabo Verdean", "majorSingle" => "Escudo", "majorPlural" => "Escudo", "ISOnum" => 132, "symbol" => "CV$", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"CZK" => array("name" => "Czech Koruna", "demonym" => "Czech", "majorSingle" => "Koruna", "majorPlural" => "Koruny", "ISOnum" => 203, "symbol" => "Kc", "minorSingle" => "Halér", "minorPlural" => "Halér", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"DJF" => array("name" => "Djiboutian Franc", "demonym" => "Djiboutian", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 262, "symbol" => "Fdj", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"DKK" => array("name" => "Danish Krone", "demonym" => "Danish", "majorSingle" => "Krone", "majorPlural" => "Kroner", "ISOnum" => 208, "symbol" => "kr.", "minorSingle" => "Øre", "minorPlural" => "Øre", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"DOP" => array("name" => "Dominican Peso", "demonym" => "Dominican", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 214, "symbol" => "RD$", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"DZD" => array("name" => "Algerian Dinar", "demonym" => "Algerian", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 12, "symbol" => "DA", "minorSingle" => "Santeem", "minorPlural" => "Santeems", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"EGP" => array("name" => "Egyptian Pound", "demonym" => "Egyptian", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 818, "symbol" => "E£", "minorSingle" => "Qirsh", "minorPlural" => "Qirsh", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"EHP" => array("name" => "Sahrawi Peseta", "demonym" => "Sahrawi", "majorSingle" => "Peseta", "majorPlural" => "Pesetas", "ISOnum" => null, "symbol" => "Ptas.", "minorSingle" => "Céntimo", "minorPlural" => "Céntimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ERN" => array("name" => "Eritrean Nakfa", "demonym" => "Eritrean", "majorSingle" => "Nakfa", "majorPlural" => "Nakfa", "ISOnum" => 232, "symbol" => "Nkf", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ETB" => array("name" => "Ethiopian Birr", "demonym" => "Ethiopian", "majorSingle" => "Birr", "majorPlural" => "Birr", "ISOnum" => 230, "symbol" => "Br", "minorSingle" => "Santim", "minorPlural" => "Santim", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"EUR" => array("name" => "Euro", "demonym" => "", "majorSingle" => "Euro", "majorPlural" => "Euros", "ISOnum" => 978, "symbol" => "€", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"FJD" => array("name" => "Fijian Dollar", "demonym" => "Fijian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 242, "symbol" => "FJ$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"FKP" => array("name" => "Falkland Islands Pound", "demonym" => "Falkland Islands", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 238, "symbol" => "FK£", "minorSingle" => "Penny", "minorPlural" => "Pence", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"FOK" => array("name" => "Faroese Króna", "demonym" => "Faroese", "majorSingle" => "Króna", "majorPlural" => "Krónas", "ISOnum" => null, "symbol" => "kr", "minorSingle" => "Oyra", "minorPlural" => "Oyra", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GBP" => array("name" => "Pound Sterling", "demonym" => "Pound Sterling", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 826, "symbol" => "£", "minorSingle" => "Penny", "minorPlural" => "Pence", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GEL" => array("name" => "Georgian Lari", "demonym" => "Georgian", "majorSingle" => "Lari", "majorPlural" => "Lari", "ISOnum" => 981, "symbol" => "&#8382;", "minorSingle" => "Tetri", "minorPlural" => "Tetri", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GGP" => array("name" => "Guernsey Pound", "demonym" => "Guernsey", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => null, "symbol" => "£", "minorSingle" => "Penny", "minorPlural" => "Pence", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GHS" => array("name" => "Ghanaian Cedi", "demonym" => "Ghanaian", "majorSingle" => "Cedi", "majorPlural" => "Cedis", "ISOnum" => 936, "symbol" => "&#8373;", "minorSingle" => "Pesewa", "minorPlural" => "Pesewas", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GIP" => array("name" => "Gibraltar Pound", "demonym" => "Gibraltar", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 292, "symbol" => "£", "minorSingle" => "Penny", "minorPlural" => "Pence", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GMD" => array("name" => "Gambian Dalasi", "demonym" => "Gambian", "majorSingle" => "Dalasi", "majorPlural" => "Dalasis", "ISOnum" => 270, "symbol" => "D", "minorSingle" => "Butut", "minorPlural" => "Bututs", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GNF" => array("name" => "Guinean Franc", "demonym" => "Guinean", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 324, "symbol" => "FG", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"GTQ" => array("name" => "Guatemalan Quetzal", "demonym" => "Guatemalan", "majorSingle" => "Quetzal", "majorPlural" => "Quetzales", "ISOnum" => 320, "symbol" => "Q", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"GYD" => array("name" => "Guyanese Dollar", "demonym" => "Guyanese", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 328, "symbol" => "G$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"HKD" => array("name" => "Hong Kong Dollar", "demonym" => "Hong Kong", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 344, "symbol" => "HK$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"HNL" => array("name" => "Honduran Lempira", "demonym" => "Honduran", "majorSingle" => "Lempira", "majorPlural" => "Lempiras", "ISOnum" => 340, "symbol" => "L", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"HRK" => array("name" => "Croatian Kuna", "demonym" => "Croatian", "majorSingle" => "Kuna", "majorPlural" => "Kuna", "ISOnum" => 191, "symbol" => "kn", "minorSingle" => "Lipa", "minorPlural" => "Lipa", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"HTG" => array("name" => "Haitian Gourde", "demonym" => "Haitian", "majorSingle" => "Gourde", "majorPlural" => "Gourdes", "ISOnum" => 332, "symbol" => "G", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"HUF" => array("name" => "Hungarian Forint", "demonym" => "Hungarian", "majorSingle" => "Forint", "majorPlural" => "Forint", "ISOnum" => 348, "symbol" => "Ft", "minorSingle" => "fillér", "minorPlural" => "fillér", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"IDR" => array("name" => "Indonesian Rupiah", "demonym" => "Indonesian", "majorSingle" => "Rupiah", "majorPlural" => "Rupiah", "ISOnum" => 360, "symbol" => "Rp", "minorSingle" => "Sen", "minorPlural" => "Sen", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ILS" => array("name" => "Israeli new Shekel", "demonym" => "Israeli", "majorSingle" => "Shekel", "majorPlural" => "Shekels", "ISOnum" => 376, "symbol" => "&#8362;", "minorSingle" => "Agora", "minorPlural" => "Agoras", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"IMP" => array("name" => "Manx Pound", "demonym" => "Manx", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => null, "symbol" => "£", "minorSingle" => "Penny", "minorPlural" => "Pence", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"INR" => array("name" => "Indian Rupee", "demonym" => "Indian", "majorSingle" => "Rupee", "majorPlural" => "Rupees", "ISOnum" => 356, "symbol" => "Rs.", "minorSingle" => "Paisa", "minorPlural" => "Paise", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"IQD" => array("name" => "Iraqi Dinar", "demonym" => "Iraqi", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 368, "symbol" => "&#1593;.&#1583;", "minorSingle" => "Fils", "minorPlural" => "Fils", "ISOdigits" => 3, "decimals" => 3, "numToBasic" => 1000), 
		"IRR" => array("name" => "Iranian Rial", "demonym" => "Iranian", "majorSingle" => "Rial", "majorPlural" => "Rials", "ISOnum" => 364, "symbol" => "&#65020;", "minorSingle" => "Dinar", "minorPlural" => "Dinars", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ISK" => array("name" => "Icelandic Krona", "demonym" => "Icelandic", "majorSingle" => "Krona", "majorPlural" => "Krónur", "ISOnum" => 352, "symbol" => "kr", "minorSingle" => "Aurar", "minorPlural" => "Aurar", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"JEP" => array("name" => "Jersey Pound", "demonym" => "Jersey", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => null, "symbol" => "£", "minorSingle" => "Penny", "minorPlural" => "Pence", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"JMD" => array("name" => "Jamaican Dollar", "demonym" => "Jamaican", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 388, "symbol" => "J$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"JOD" => array("name" => "Jordanian Dinar", "demonym" => "Jordanian", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 400, "symbol" => "JD", "minorSingle" => "Fils", "minorPlural" => "Fils", "ISOdigits" => 3, "decimals" => 3, "numToBasic" => 1000), 
		"JPY" => array("name" => "Japanese Yen", "demonym" => "Japanese", "majorSingle" => "Yen", "majorPlural" => "Yen", "ISOnum" => 392, "symbol" => "¥", "minorSingle" => "Sen", "minorPlural" => "Sen", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"KES" => array("name" => "Kenyan Shilling", "demonym" => "Kenyan", "majorSingle" => "Shilling", "majorPlural" => "Shillings", "ISOnum" => 404, "symbol" => "KSh", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"KGS" => array("name" => "Kyrgyzstani Som", "demonym" => "Kyrgyzstani", "majorSingle" => "Som", "majorPlural" => "Som", "ISOnum" => 417, "symbol" => "&#1089;&#1086;&#1084;", "minorSingle" => "Tyiyn", "minorPlural" => "Tyiyn", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"KHR" => array("name" => "Cambodian Riel", "demonym" => "Cambodian", "majorSingle" => "Riel", "majorPlural" => "Riels", "ISOnum" => 116, "symbol" => "&#6107;", "minorSingle" => "Sen", "minorPlural" => "Sen", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"KID" => array("name" => "Kiribati Dollar", "demonym" => "Kiribati", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => null, "symbol" => "$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"KMF" => array("name" => "Comorian Franc", "demonym" => "Comorian", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 174, "symbol" => "CF", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"KPW" => array("name" => "North Korean Won", "demonym" => "North Korean", "majorSingle" => "Won", "majorPlural" => "Won", "ISOnum" => 408, "symbol" => "&#8361;", "minorSingle" => "Chon", "minorPlural" => "Chon", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"KRW" => array("name" => "South Korean Won", "demonym" => "South Korean", "majorSingle" => "Won", "majorPlural" => "Won", "ISOnum" => 410, "symbol" => "&#8361;", "minorSingle" => "Jeon", "minorPlural" => "Jeon", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"KWD" => array("name" => "Kuwaiti Dinar", "demonym" => "Kuwaiti", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 414, "symbol" => "KD", "minorSingle" => "Fils", "minorPlural" => "Fils", "ISOdigits" => 3, "decimals" => 3, "numToBasic" => 1000), 
		"KYD" => array("name" => "Cayman Islands Dollar", "demonym" => "Cayman Islands", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 136, "symbol" => "CI$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"KZT" => array("name" => "Kazakhstani Tenge", "demonym" => "Kazakhstani", "majorSingle" => "Tenge", "majorPlural" => "Tenge", "ISOnum" => 398, "symbol" => "&#1083;&#1074;", "minorSingle" => "Tiyn", "minorPlural" => "Tiyn", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"LAK" => array("name" => "Lao Kip", "demonym" => "Lao", "majorSingle" => "Kip", "majorPlural" => "Kip", "ISOnum" => 418, "symbol" => "&#8365;", "minorSingle" => "Att", "minorPlural" => "Att", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"LBP" => array("name" => "Lebanese Pound", "demonym" => "Lebanese", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 422, "symbol" => "LL.", "minorSingle" => "Qirsh", "minorPlural" => "Qirsh", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"LKR" => array("name" => "Sri Lankan Rupee", "demonym" => "Sri Lankan", "majorSingle" => "Rupee", "majorPlural" => "Rupees", "ISOnum" => 144, "symbol" => "Rs.", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"LRD" => array("name" => "Liberian Dollar", "demonym" => "Liberian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 430, "symbol" => "L$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"LSL" => array("name" => "Lesotho Loti", "demonym" => "Lesotho", "majorSingle" => "Loti", "majorPlural" => "maLoti", "ISOnum" => 426, "symbol" => "L", "minorSingle" => "Sente", "minorPlural" => "Lisente", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"LYD" => array("name" => "Libyan Dinar", "demonym" => "Libyan", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 434, "symbol" => "LD", "minorSingle" => "Dirham", "minorPlural" => "Dirhams", "ISOdigits" => 3, "decimals" => 3, "numToBasic" => 1000), 
		"LTL" => array("name" => "Lithuanian litas", "demonym" => "Lithuanian", "majorSingle" => "Lita", "majorPlural" => "Litai", "ISOnum" => 000, "symbol" => "Lt", "minorSingle" => "centa", "minorPlural" => "centas", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"LVL" => array("name" => "Latvian lats", "demonym" => "Latvian", "majorSingle" => "Lats", "majorPlural" => "Lati", "ISOnum" => 000, "symbol" => "Ls", "minorSingle" => "santimi", "minorPlural" => "santims", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MAD" => array("name" => "Moroccan Dirham", "demonym" => "Moroccan", "majorSingle" => "Dirham", "majorPlural" => "Dirhams", "ISOnum" => 504, "symbol" => "DH", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MDL" => array("name" => "Moldovan Leu", "demonym" => "Moldovan", "majorSingle" => "Leu", "majorPlural" => "Lei", "ISOnum" => 498, "symbol" => "L", "minorSingle" => "Iraimbilanja", "minorPlural" => "Iraimbilanja", "ISOdigits" => 2, "decimals" => 0, "numToBasic" => 5), 
		"MGA" => array("name" => "Malagasy Ariary", "demonym" => "Malagasy", "majorSingle" => "Ariary", "majorPlural" => "Ariary", "ISOnum" => 969, "symbol" => "Ar", "minorSingle" => "Deni", "minorPlural" => "Deni", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MKD" => array("name" => "Macedonian Denar", "demonym" => "Macedonian", "majorSingle" => "Denar", "majorPlural" => "Denars", "ISOnum" => 807, "symbol" => "den", "minorSingle" => "Pya", "minorPlural" => "Pya", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MMK" => array("name" => "Myanmar Kyat", "demonym" => "Myanmar", "majorSingle" => "Kyat", "majorPlural" => "Kyat", "ISOnum" => 104, "symbol" => "Ks", "minorSingle" => "möngö", "minorPlural" => "möngö", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MNT" => array("name" => "Mongolian Tögrög", "demonym" => "Mongolian", "majorSingle" => "Tögrög", "majorPlural" => "Tögrög", "ISOnum" => 496, "symbol" => "&#8366;", "minorSingle" => "Avo", "minorPlural" => "Avos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MOP" => array("name" => "Macanese Pataca", "demonym" => "Macanese", "majorSingle" => "Pataca", "majorPlural" => "Patacas", "ISOnum" => 446, "symbol" => "MOP$", "minorSingle" => "Khoums", "minorPlural" => "Khoums", "ISOdigits" => 2, "decimals" => 0, "numToBasic" => 5), 
		"MRU" => array("name" => "Mauritanian Ouguiya", "demonym" => "Mauritanian", "majorSingle" => "Ouguiya", "majorPlural" => "Ouguiya", "ISOnum" => 929, "symbol" => "UM", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MRO" => array("name" => "Mauritanian Ouguiya", "demonym" => "Mauritanian", "majorSingle" => "Ouguiya", "majorPlural" => "Ouguiya", "ISOnum" => 929, "symbol" => "UM", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MUR" => array("name" => "Mauritian Rupee", "demonym" => "Mauritian", "majorSingle" => "Rupee", "majorPlural" => "Rupees", "ISOnum" => 480, "symbol" => "Rs.", "minorSingle" => "laari", "minorPlural" => "laari", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MVR" => array("name" => "Maldivian Rufiyaa", "demonym" => "Maldivian", "majorSingle" => "Rufiyaa", "majorPlural" => "Rufiyaa", "ISOnum" => 462, "symbol" => "MRf", "minorSingle" => "Tambala", "minorPlural" => "Tambala", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MWK" => array("name" => "Malawian Kwacha", "demonym" => "Malawian", "majorSingle" => "Kwacha", "majorPlural" => "Kwacha", "ISOnum" => 454, "symbol" => "MK", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MXN" => array("name" => "Mexican Peso", "demonym" => "Mexican", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 484, "symbol" => "MX$", "minorSingle" => "Sen", "minorPlural" => "Sen", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MYR" => array("name" => "Malaysian Ringgit", "demonym" => "Malaysian", "majorSingle" => "Ringgit", "majorPlural" => "Ringgit", "ISOnum" => 458, "symbol" => "RM", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"MZN" => array("name" => "Mozambican Metical", "demonym" => "Mozambican", "majorSingle" => "Metical", "majorPlural" => "Meticais", "ISOnum" => 943, "symbol" => "MTn", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"NAD" => array("name" => "Namibian Dollar", "demonym" => "Namibian", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 516, "symbol" => "N$", "minorSingle" => "Kobo", "minorPlural" => "Kobo", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"NGN" => array("name" => "Nigerian Naira", "demonym" => "Nigerian", "majorSingle" => "Naira", "majorPlural" => "Naira", "ISOnum" => 566, "symbol" => "&#8358;", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"NIO" => array("name" => "Nicaraguan Córdoba", "demonym" => "Nicaraguan", "majorSingle" => "Córdoba Oro", "majorPlural" => "Córdoba Oro", "ISOnum" => 558, "symbol" => "C$", "minorSingle" => "øre", "minorPlural" => "øre", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"NOK" => array("name" => "Norwegian Krone", "demonym" => "Norwegian", "majorSingle" => "Krone", "majorPlural" => "Kroner", "ISOnum" => 578, "symbol" => "kr", "minorSingle" => "Paisa", "minorPlural" => "Paise", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"NPR" => array("name" => "Nepalese Rupee", "demonym" => "Nepalese", "majorSingle" => "Rupee", "majorPlural" => "Rupees", "ISOnum" => 524, "symbol" => "Rs.", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"NZD" => array("name" => "New Zealand Dollar", "demonym" => "New Zealand", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 554, "symbol" => "NZ$", "minorSingle" => "Baisa", "minorPlural" => "Baisa", "ISOdigits" => 3, "decimals" => 3, "numToBasic" => 1000), 
		"OMR" => array("name" => "Omani Rial", "demonym" => "Omani", "majorSingle" => "Rial", "majorPlural" => "Rials", "ISOnum" => 512, "symbol" => "OR", "minorSingle" => "Centésimo", "minorPlural" => "Centésimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PAB" => array("name" => "Panamanian Balboa", "demonym" => "Panamanian", "majorSingle" => "Balboa", "majorPlural" => "Balboa", "ISOnum" => 590, "symbol" => "B/.", "minorSingle" => "Céntimo", "minorPlural" => "Céntimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PEN" => array("name" => "Peruvian Sol", "demonym" => "Peruvian", "majorSingle" => "Sol", "majorPlural" => "Soles", "ISOnum" => 604, "symbol" => "S/.", "minorSingle" => "Toea", "minorPlural" => "Toea", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PGK" => array("name" => "Papua New Guinean Kina", "demonym" => "Papua New Guinean", "majorSingle" => "Kina", "majorPlural" => "Kina", "ISOnum" => 598, "symbol" => "K", "minorSingle" => "Sentimo", "minorPlural" => "Sentimo", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PHP" => array("name" => "Philippine Peso", "demonym" => "Philippine", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 608, "symbol" => "&#8369;", "minorSingle" => "Paisa", "minorPlural" => "Paise", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PKR" => array("name" => "Pakistani Rupee", "demonym" => "Pakistani", "majorSingle" => "Rupee", "majorPlural" => "Rupees", "ISOnum" => 586, "symbol" => "Rs.", "minorSingle" => "Grosz", "minorPlural" => "Groszy", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PLN" => array("name" => "Polish Zloty", "demonym" => "Polish", "majorSingle" => "Zloty", "majorPlural" => "Zlotys", "ISOnum" => 985, "symbol" => "zl", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PND" => array("name" => "Pitcairn Islands Dollar", "demonym" => "Pitcairn Islands", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => null, "symbol" => "$", "minorSingle" => "Kopek", "minorPlural" => "Kopeks", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"PRB" => array("name" => "Transnistrian Ruble", "demonym" => "Transnistrian", "majorSingle" => "Ruble", "majorPlural" => "Rubles", "ISOnum" => null, "symbol" => "&#1088;&#46;", "minorSingle" => "Centimo", "minorPlural" => "Centimos", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"PYG" => array("name" => "Paraguayan Guaraní", "demonym" => "Paraguayan", "majorSingle" => "Guaraní", "majorPlural" => "Guaraníes", "ISOnum" => 600, "symbol" => "&#8370;", "minorSingle" => "Dirham", "minorPlural" => "Dirhams", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"QAR" => array("name" => "Qatari Riyal", "demonym" => "Qatari", "majorSingle" => "Riyal", "majorPlural" => "Riyals", "ISOnum" => 634, "symbol" => "QR", "minorSingle" => "Ban", "minorPlural" => "Bani", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"RON" => array("name" => "Romanian Leu", "demonym" => "Romanian", "majorSingle" => "Leu", "majorPlural" => "Lei", "ISOnum" => 946, "symbol" => "L", "minorSingle" => "Para", "minorPlural" => "Para", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"RSD" => array("name" => "Serbian Dinar", "demonym" => "Serbian", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 941, "symbol" => "din", "minorSingle" => "Kopek", "minorPlural" => "Kopeks", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"RUB" => array("name" => "Russian Ruble", "demonym" => "Russian", "majorSingle" => "Ruble", "majorPlural" => "Rubles", "ISOnum" => 643, "symbol" => "&#8381;", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"RWF" => array("name" => "Rwandan Franc", "demonym" => "Rwandan", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 646, "symbol" => "FRw", "minorSingle" => "Halalah", "minorPlural" => "Halalahs", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SAR" => array("name" => "Saudi Riyal", "demonym" => "Saudi", "majorSingle" => "Riyal", "majorPlural" => "Riyals", "ISOnum" => 682, "symbol" => "SR", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SBD" => array("name" => "Solomon Islands Dollar", "demonym" => "Solomon Islands", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 90, "symbol" => "SI$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SCR" => array("name" => "Seychellois Rupee", "demonym" => "Seychellois", "majorSingle" => "Rupee", "majorPlural" => "Rupees", "ISOnum" => 690, "symbol" => "Rs.", "minorSingle" => "Qirsh", "minorPlural" => "Qirsh", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SDG" => array("name" => "Sudanese Pound", "demonym" => "Sudanese", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 938, "symbol" => "£SD", "minorSingle" => "Öre", "minorPlural" => "Öre", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SEK" => array("name" => "Swedish Krona", "demonym" => "Swedish", "majorSingle" => "Krona", "majorPlural" => "Kronor", "ISOnum" => 752, "symbol" => "kr", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SGD" => array("name" => "Singapore Dollar", "demonym" => "Singapore", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 702, "symbol" => "S$", "minorSingle" => "Penny", "minorPlural" => "Pence", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SHP" => array("name" => "Saint Helena Pound", "demonym" => "Saint Helena", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 654, "symbol" => "£", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SLL" => array("name" => "Sierra Leonean Leone", "demonym" => "Sierra Leonean", "majorSingle" => "Leone", "majorPlural" => "Leones", "ISOnum" => 694, "symbol" => "Le", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SLS" => array("name" => "Somaliland Shilling", "demonym" => "Somaliland", "majorSingle" => "Shilling", "majorPlural" => "Shillings", "ISOnum" => null, "symbol" => "Sl", "minorSingle" => "Senti", "minorPlural" => "Senti", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SOS" => array("name" => "Somali Shilling", "demonym" => "Somali", "majorSingle" => "Shilling", "majorPlural" => "Shillings", "ISOnum" => 706, "symbol" => "Sh.So.", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SRD" => array("name" => "Surinamese Dollar", "demonym" => "Surinamese", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 968, "symbol" => "Sr$", "minorSingle" => "Qirsh", "minorPlural" => "Qirsh", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SSP" => array("name" => "South Sudanese Pound", "demonym" => "South Sudanese", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 728, "symbol" => "SS£", "minorSingle" => "Piaster", "minorPlural" => "Piaster", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"STN" => array("name" => "Sao Tome and Príncipe Dobra", "demonym" => "Sao Tome", "majorSingle" => "Dobra", "majorPlural" => "Dobras", "ISOnum" => 930, "symbol" => "Db", "minorSingle" => "Centavo", "minorPlural" => "Centavos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SVC" => array("name" => "Salvadoran Colón", "demonym" => "Salvadoran", "majorSingle" => "Colón", "majorPlural" => "Colones", "ISOnum" => 222, "symbol" => "¢", "minorSingle" => "Qirsh", "minorPlural" => "Qirsh", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SYP" => array("name" => "Syrian Pound", "demonym" => "Syrian", "majorSingle" => "Pound", "majorPlural" => "Pounds", "ISOnum" => 760, "symbol" => "LS", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"SZL" => array("name" => "Swazi Lilangeni", "demonym" => "Swazi", "majorSingle" => "Lilangeni", "majorPlural" => "Emalangeni", "ISOnum" => 748, "symbol" => "L", "minorSingle" => "Satang", "minorPlural" => "Satang", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"THB" => array("name" => "Thai Baht", "demonym" => "Thai", "majorSingle" => "Baht", "majorPlural" => "Baht", "ISOnum" => 764, "symbol" => "&#3647;", "minorSingle" => "Diram", "minorPlural" => "Diram", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"TJS" => array("name" => "Tajikistani Somoni", "demonym" => "Tajikistani", "majorSingle" => "Somoni", "majorPlural" => "Somoni", "ISOnum" => 972, "symbol" => "SM", "minorSingle" => "Millime", "minorPlural" => "Millime", "ISOdigits" => 3, "decimals" => 3, "numToBasic" => 1000), 
		"TMT" => array("name" => "Turkmenistan Manat", "demonym" => "Turkmenistan", "majorSingle" => "Manat", "majorPlural" => "Manat", "ISOnum" => 934, "symbol" => "m.", "minorSingle" => "Seniti", "minorPlural" => "Seniti", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"TND" => array("name" => "Tunisian Dinar", "demonym" => "Tunisian", "majorSingle" => "Dinar", "majorPlural" => "Dinars", "ISOnum" => 788, "symbol" => "DT", "minorSingle" => "Kurus", "minorPlural" => "Kurus", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"TOP" => array("name" => "Tongan Pa?anga", "demonym" => "Tongan", "majorSingle" => "Pa'anga", "majorPlural" => "Pa'anga", "ISOnum" => 776, "symbol" => "T$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"TRY" => array("name" => "Turkish Lira", "demonym" => "Turkish", "majorSingle" => "Lira", "majorPlural" => "Lira", "ISOnum" => 949, "symbol" => "TL", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"TTD" => array("name" => "Trinidad and Tobago Dollar", "demonym" => "Trinidad and Tobago", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 780, "symbol" => "TT$", "minorSingle" => "Senti", "minorPlural" => "Senti", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"TVD" => array("name" => "Tuvaluan Dollar", "demonym" => "Tuvaluan", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => null, "symbol" => "$", "minorSingle" => "Kopiyka", "minorPlural" => "kopiyky", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"TWD" => array("name" => "New Taiwan Dollar", "demonym" => "New Taiwan", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 901, "symbol" => "NT$", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"TZS" => array("name" => "Tanzanian Shilling", "demonym" => "Tanzanian", "majorSingle" => "Shilling", "majorPlural" => "Shillings", "ISOnum" => 834, "symbol" => "TSh", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"UAH" => array("name" => "Ukrainian Hryvnia", "demonym" => "Ukrainian", "majorSingle" => "Hryvnia", "majorPlural" => "Hryvnias", "ISOnum" => 980, "symbol" => "&#8372;", "minorSingle" => "Centésimo", "minorPlural" => "Centésimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"UGX" => array("name" => "Ugandan Shilling", "demonym" => "Ugandan", "majorSingle" => "Shilling", "majorPlural" => "Shillings", "ISOnum" => 800, "symbol" => "USh", "minorSingle" => "Tiyin", "minorPlural" => "Tiyin", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"USD" => array("name" => "United States Dollar", "demonym" => "US", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 840, "symbol" => "$", "minorSingle" => "Céntimo", "minorPlural" => "Céntimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"UYU" => array("name" => "Uruguayan Peso", "demonym" => "Uruguayan", "majorSingle" => "Peso", "majorPlural" => "Pesos", "ISOnum" => 858, "symbol" => "$U", "minorSingle" => "Centesimo", "minorPlural" => "Centesimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"UZS" => array("name" => "Uzbekistani Som", "demonym" => "Uzbekistani", "majorSingle" => "Som", "majorPlural" => "Som", "ISOnum" => 860, "symbol" => "&#85;&#90;&#83;", "minorSingle" => "Centimo", "minorPlural" => "Centimos", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"VEF" => array("name" => "Venezuelan bolívar", "demonym" => "Venezuelan", "majorSingle" => "Bolívar Digital", "majorPlural" => "Bolívars Digital", "ISOnum" => null, "symbol" => "Bs.", "minorSingle" => "Hào", "minorPlural" => "Hào", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 10), 
		"VES" => array("name" => "Venezuelan Bolívar Soberano", "demonym" => "Venezuelan", "majorSingle" => "Bolívar", "majorPlural" => "Bolívares", "ISOnum" => 928, "symbol" => "Bs.F", "minorSingle" => "Sene", "minorPlural" => "Sene", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"VND" => array("name" => "Vietnamese Dong", "demonym" => "Vietnamese", "majorSingle" => "Dong", "majorPlural" => "Dong", "ISOnum" => 704, "symbol" => "&#8363;", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"VUV" => array("name" => "Vanuatu Vatu", "demonym" => "Vanuatu", "majorSingle" => "Vatu", "majorPlural" => "Vatu", "ISOnum" => 548, "symbol" => "VT", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"WST" => array("name" => "Samoan Tala", "demonym" => "Samoan", "majorSingle" => "Tala", "majorPlural" => "Tala", "ISOnum" => 882, "symbol" => "T", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 2, "numToBasic" => 100), 
		"XAF" => array("name" => "Central African CFA Franc BEAC", "demonym" => "Central African CFA", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 950, "symbol" => "Fr", "minorSingle" => "Centime", "minorPlural" => "Centimes", "ISOdigits" => 0, "decimals" => 0, "numToBasic" => 100), 
		"XCD" => array("name" => "East Caribbean Dollar", "demonym" => "East Caribbean", "majorSingle" => "Dollar", "majorPlural" => "Dollars", "ISOnum" => 951, "symbol" => "$", "minorSingle" => "Fils", "minorPlural" => "Fils", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"XOF" => array("name" => "West African CFA Franc BCEAO", "demonym" => "West African CFA", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 952, "symbol" => "&#2047;", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"XPF" => array("name" => "CFP Franc (Franc Pacifique)", "demonym" => "CFP", "majorSingle" => "Franc", "majorPlural" => "Francs", "ISOnum" => 953, "symbol" => "&#8355;", "minorSingle" => "centime", "minorPlural" => "centime", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"YER" => array("name" => "Yemeni Rial", "demonym" => "Yemeni", "majorSingle" => "Rial", "majorPlural" => "Rials", "ISOnum" => 886, "symbol" => "YR", "minorSingle" => "", "minorPlural" => "", "ISOdigits" => 0, "decimals" => 0, "numToBasic" => null), 
		"ZAR" => array("name" => "South African Rand", "demonym" => "South African", "majorSingle" => "Rand", "majorPlural" => "Rand", "ISOnum" => 710, "symbol" => "R", "minorSingle" => "Cent", "minorPlural" => "Cents", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
		"ZMW" => array("name" => "Zambian Kwacha", "demonym" => "Zambian", "majorSingle" => "Kwacha", "majorPlural" => "Kwacha", "ISOnum" => 967, "symbol" => "ZK", "minorSingle" => "Ngwee", "minorPlural" => "Ngwee", "ISOdigits" => 2, "decimals" => 2, "numToBasic" => 100), 
	);
	if(!empty($isoselected) && isset($currencies[$isoselected])){
		return $currencies[$isoselected];
	}

return $currencies;
}
/*****************************************************************
	format price with decimals to minor currency
	@since 3.12.2
*****************************************************************/
function wppizza_format_minor_currency($amount){
	/*
		due to php precisions settings (i suspect) a decimal amount might be missing a penny/cent
		when converted to integer

		i.e ((int)(18.90*100)) actually results in 1889 - at least on some servers

		so lets make sure this does not happen with this function by using float and even round
		 - just to be sure
	*/
	$amount = round((float)($amount*100));


return $amount;
}
/*****************************************************************
	revert from minor currency back to major currency
	@since 3.13.4
*****************************************************************/
function wppizza_revert_minor_currency($amount, $decimals = 2){
	$amount = round((float)($amount / 100), $decimals);
return $amount;
}
/*****************************************************
* Validates ISO currency
* @str the input to check
/******************************************************/
function wppizza_validate_iso_currency($iso){
	$available_currencies = wppizza_currencies();
	$iso = strtoupper($iso);
	$iso = preg_replace("/[^A-Z]/", "", $iso);
	$iso = substr($iso,0,3);
	if(!isset($available_currencies[$iso])){
		return '';	
	}
return $str;
}
/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\*
#
#
#
#		PRICE FORMATTING
#
#
#
#
/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\/*\*/


/*****************************************************************
	i18n number price formatted with/out decimals
*****************************************************************/
function wppizza_output_format_price($str){
	global $wppizza_options;

	if(trim((string)$str)!=''){
		
		$decimals = wppizza_currency_precision();
		
		$str = number_format_i18n($str, $decimals);
	
	}
	/**allow filtering**/
	$str = apply_filters('wppizza_filter_output_format_price', $str);

	return $str;
}
/*****************************************************************
	i18n number price formatted with/out decimals and currrency
	$set_currency_position should be left or right if set
*****************************************************************/
function wppizza_format_price($value, $currency = false, $set_currency_position = false, $decimals = null){
	global $wppizza_options;

	//ignore anything that's an array here
	if(is_array($value)){
		return $value;
	}
	$value = trim((string)$value);
	if(!is_numeric($value) ){//$value == '' || $value === null || $value === false || 
		return '';	
	}

	if( WPPIZZA_VERSION == '4.0.0-BETA' ){
		
		if(is_string($value)){// alwasy convert to float
			$value = (float)$value;	
		}	
		
		//omit currency
		if($currency === null){
			//init formatter, with currency set as 3 letter iso currency in plugin order settings
			$formatter = wppizza_currency_formatter($wppizza_options['order_settings']['currency']);
			// Set currency symbol to empty string
			$formatter -> setSymbol(NumberFormatter::CURRENCY_SYMBOL, ''); 
			//i18n formatted without currency
			$price_formatted = $formatter ->formatCurrency($value, $wppizza_options['order_settings']['currency']);
			// Output: something like 1,234.56 or similar	
			return $price_formatted;
		}
		
		//currency empty, use default
		elseif(empty($currency)){
			//init formatter, with currency set as 3 letter iso currency in plugin order settings
			$formatter = wppizza_currency_formatter($wppizza_options['order_settings']['currency']);			
			//i18n formatted WITH currency
			$price_formatted = $formatter ->formatCurrency($value, $wppizza_options['order_settings']['currency']);
			// Output: something like $ 1,234.56 or similar	
			return $price_formatted;
		}
		//currency passed on as array (since v4) - extract iso
		elseif(is_array($currency) && isset($currency['iso'])){		
			//init formatter, with currency set as 3 letter iso currency in plugin order settings
			$formatter = wppizza_currency_formatter($currency['iso']);			
			//i18n formatted WITH currency
			$price_formatted = $formatter ->formatCurrency($value, $currency['iso']);
			// Output: something like $ 1,234.56 or similar	
			return $price_formatted;
		}
		// orders pre v4.x have the currency set as the currency symbol only so we force plugin settings
		else{
			//init formatter, with currency set as 3 letter iso currency in plugin order settings
			$formatter = wppizza_currency_formatter($wppizza_options['order_settings']['currency']);			
			//i18n formatted WITH currency
			$price_formatted = $formatter ->formatCurrency($value, $wppizza_options['order_settings']['currency']);
			// Output: something like $ 1,234.56 or similar	
			return $price_formatted;			
		}
	return;	
	}





	/*
		allow filtering of decimals to be displayed
		to  also support omitting any trailing zero's
		instead of hiding decimls for example (as that would also affect rounding !)
	*/
	$number_format_auto = apply_filters('wppizza_format_price_auto', false);


	/**
		omit currency entirely if null
	**/
	if($currency!==null){
		/*currency symbol*/
		$currency = empty($currency) ? $wppizza_options['order_settings']['currency_symbol'] : $currency;
		/*currency position*/
		$currency_position = ($set_currency_position === false) ? $wppizza_options['prices_format']['currency_symbol_position'] : $set_currency_position;
		/*currency symbol spacing*/
		$currency_spacing = empty($wppizza_options['prices_format']['currency_symbol_spacing']) ? '' : ' ';
	}

	if($value!=''){



		/*
			distinctly set decimal places
		*/
		if($decimals !== null){

			$value=number_format_i18n($value,(int)$decimals);

		}

		/*
			use decimal places as set for this blog
		*/
		else{
			/*
				set to hide
			*/
			if($wppizza_options['prices_format']['hide_decimals']){

				$value=number_format_i18n($value, 0);

			}
			else{
				/*
					set to 2 or distinctly by WPPIZZA_DECIMALS;
				*/
				$decimals=2;
				if(defined('WPPIZZA_DECIMALS')){
					$decimals=(int)WPPIZZA_DECIMALS;
				}

				//omit all/any trailing zerors with a max of defined
				if($number_format_auto){
					//decimals length
					$auto_decimals = strlen(substr(strrchr($value, "."), 1));
					$standard_decimals = $decimals;
					/* get lowest as we should never have more decimals than defined*/
					$decimals = min($auto_decimals, $standard_decimals);
					/* format  */
					$value = number_format_i18n($value,$decimals);
				}
				else{
					$value = number_format_i18n($value,$decimals);
				}


			}
		}

	}

	/**omit currency entirely if null**/
	if($currency !== null){
		if($currency_position === 'left'){
			$value = $currency . $currency_spacing . $value;
		}
		if($currency_position === 'right'){
			$value = $value . $currency_spacing . $currency;
		}
	}

	return $value;
}
/*****************************************************************
	format prices as float value. no currency, no localization
	usually a bit overkill, as the values passed should already be floats
	but let's rather be safe than sorry
*****************************************************************/
function wppizza_format_price_float($value, $round = true){

	if($value==''){return 0;}

	$value = trim($value);

	if($value !='' ){
		
		$value=preg_replace('/[^0-9.,]*/','',$value);/*first get  rid of all chrs that should definitely not be in there*/
		$value=str_replace(array('.',','),'#',$value);/*make string we can explode*/
		$floatArray=explode('#',$value);/*explode so we know the last bit might be decimals*/
		$exLength=count($floatArray);

		/**make a proper float**/
		$value_as_float='';
		for($i=0;$i<$exLength;$i++){
			if($i>0 && $i==($exLength-1)){
				$value_as_float.='.';//add decimal point if needed
			}
			$value_as_float.=''.$floatArray[$i].'';
		}
		$value_as_float=(float)$value_as_float;

		/**round if required*/
		if($round){	
			$decimals = wppizza_currency_precision();
			$value=round($value_as_float,$decimals);
		}else{
			$value = $value_as_float;
		}

	}
	return $value;
}
?>