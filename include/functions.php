<?php
function GetParam($ParamName, $Method = "P", $DefaultValue = "") {
	if ($Method == "P") {
		if (isset ( $_POST [$ParamName] ))
			return $_POST [$ParamName];
		else
			return $DefaultValue;
	} else if ($Method == "G") {
		if (isset ( $_GET [$ParamName] ))
			return $_GET [$ParamName];
		else
			return $DefaultValue;
	} else if ($Method == "S") {
		if (isset ( $_SERVER [$ParamName] ))
			return $_SERVER [$ParamName];
		else
			return $DefaultValue;
	} else if ($Method == "Z") {
		if (isset ( $_SESSION [$ParamName] ))
			return $_SESSION [$ParamName];
		else
			return $DefaultValue;
	}
}
function checkVars($requestVars, $Method = 'P') {
	$errorText = '';
	foreach ( $requestVars as $varName => $codesAndChecks ) {
		$varValue = GetParam ( $varName, $Method, false );
		list ( $messageID, $errorCode, $checks2do ) = explode ( ';', $codesAndChecks );
		$checks2do = explode ( ',', $checks2do );
		$error = false;
		foreach ( $checks2do as $check ) {
			switch ($check) {
				case 'isset' :
					if (! $varValue) {
						$messageID = 203;
						$error = true;
					}
				case 'noarray' :
					if (is_array ( $varValue )) {
						$messageID = 203;
						$error = true;
					}
					break;
				case 'trim' :
					$varValue = trim ( $varValue );
					break;
				case 'notempty' :
					if ($varValue == '')
						$error = true;
					break;
				case 'bolean' :
					$varValue = filter_var ( $varValue, FILTER_VALIDATE_BOOLEAN );
					break;
				case 'email' :
					if (! filter_var ( $varValue, FILTER_VALIDATE_EMAIL ))
						$error = true;
					break;
				case 'int' :
					$varValue = (int) $varValue;
					break;
				case 'alphanum':
					if (! preg_match ( '/^\w+$/', trim ( $inputUser ) )) {
						$error =true;
					}
						break;
			}
			if ($error) {
				$errorText .= getMessage ( $messageID, $errorCode );
				break 2;
			}
		}
		$requestVars [$varName] = $varValue;
	}
	$requestVars += [ 
			'error' => $errorText 
	];
	return $requestVars;
}
function check_date($date, $format, $sep) {
	$pos1 = strpos ( $format, 'd' );
	$pos2 = strpos ( $format, 'm' );
	$pos3 = strpos ( $format, 'Y' );
	$check = explode ( $sep, $date );
	return checkdate ( $check [$pos2], $check [$pos1], $check [$pos3] );
}
function dbstat($result, $sql, $alles = true) {
	echo ((($alles) ? "\"" . $sql . "\"<br>" : "") . "verarbeitet? " . (($result) ? "ja" : "nein") . "<br>");
}
function drugdays($monat = mktime) {
	if (! $_SESSION ['user'] ['user_id'])
		return false;
	global $sqldb, $db_days, $db_drugdays;
	$start = mktime ( 0, 0, 0, date ( 'm', $monat ), 1, date ( 'Y', $monat ) );
	$ende = mktime ( 0, 0, 0, date ( 'm', $start ), date ( 't', $start ), date ( 'Y', $start ) );
	$sql1 = sprintf ( "SELECT * FROM %s WHERE `user_id` = %s AND `ks_art` > 0 AND `pain_day` BETWEEN '%s' AND '%s' ORDER BY `ks_day` ASC;", $db_days, $_SESSION ['user'] ['user_id'], date ( 'Y-m-d H:i:s', $start ), date ( 'Y-m-d H:i:s', $ende ) );
	$result1 = $sqldb->query ( $sql1 );
	$kstage = $meditage = 0;
	while ( $ks_tag = $result1->fetch_assoc () ) {
		$ks_day = $ks_tag ['ks_day'];
		if ($ks_tag ['ks_art'] != '')
			$kstage ++;
		$sql2 = sprintf ( "SELECT * FROM `$db_drugdays` WHERE `ks_id` = %s;", $ks_tag ['ks_id'] );
		$result2 = $sqldb->query ( $sql2 );
		if ($result2->num_rows > 0)
			$meditage ++;
	}
	return array (
			'kstage' => $kstage,
			'meditage' => $meditage,
			'monat' => $monat 
	);
}
function get_easter_datetime($year) {
	$days = easter_days ( $year );
	return mktime ( 0, 0, 0, 3, 21 + $days, $year );
}
function freiertag($timestamp) {
	// Wochentag berechnen
	$wochentag = date ( 'w', $timestamp );
	if ($wochentag == 0 || $wochentag == 6) {
		return true;
	}
	
	$jahr = date ( 'Y', $timestamp );
	// Feste Feiertage werden nach dem Schema ddmm eingetragen
	$feiertag = array ();
	$feiertage [] = "0101"; // Neujahrstag
	$feiertage [] = "0105"; // Tag der Arbeit
	$feiertage [] = "0310"; // Tag der Deutschen Einheit
	$feiertage [] = "2512"; // Erster Weihnachtstag
	$feiertage [] = "2612"; // Zweiter Weihnachtstag
	                        
	// Bewegliche Feiertage berechnen
	$tage = 60 * 60 * 24;
	$ostersonntag = get_easter_datetime ( $jahr );
	$feiertage [] = date ( "dm", $ostersonntag - 2 * $tage ); // Karfreitag
	$feiertage [] = date ( "dm", $ostersonntag + 1 * $tage ); // Ostermontag
	$feiertage [] = date ( "dm", $ostersonntag + 39 * $tage ); // Himmelfahrt
	$feiertage [] = date ( "dm", $ostersonntag + 50 * $tage ); // Pfingstmontag
	                                                           
	// Prüfen, ob Feiertag
	$code = date ( 'dm', $timestamp );
	if (in_array ( $code, $feiertage )) {
		return true;
	} else {
		return false;
	}
}
function pain_range() {
	global $sqldb, $db_days;
	$sql = sprintf ( "SELECT * FROM %s WHERE `user_id` = %s ORDER BY `pain_day` ASC;", $db_days, $_SESSION ['user'] ['user_id'] );
	$kstage = $sqldb->query ( $sql );
	$ekt = time ();
	$lkt = 0;
	// Ersten und letzten Kopfschmerztag des Users ermitteln
	while ( $ks_tag = $kstage->fetch_assoc () ) {
		$pain_day = strtotime ( $ks_tag ['pain_day'] );
		if ($pain_day < $ekt)
			$ekt = $pain_day;
		if ($pain_day > $lkt)
			$lkt = $pain_day;
	}
	return array (
			'first' => $ekt,
			'last' => $lkt 
	);
}
function getStyle() {
	global $db_styles, $sqldb;
	$sql = "SELECT * FROM `$db_styles` ORDER BY style_name ASC";
	$result = $sqldb->query ( $sql );
	$styles = array ();
	if ($result->num_rows > 0) {
		while ( $style = $result->fetch_assoc () ) {
			$styles [$style ['style_id']] = $style;
		}
		$style = getConfigValue ( 'default_style' );
		if (! getConfigValue ( 'override_user_style' ) && isset ( $_SESSION ['user'] ['user_style'] ))
			$style = $_SESSION ['user'] ['user_style'];
		if (isset ( $styles [$style] )) {
			return $styles [$style] ['style_path'];
		} else
			return 'bootstrap';
	} else {
		return 'bootstrap';
	}
}
function getConfigValue($config_name) {
	global $db_config, $sqldb;
	$sql = "SELECT config_value FROM `$db_config` WHERE config_name = '$config_name'";
	$result = $sqldb->query ( $sql );
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc ();
		return $row ['config_value'];
	} else
		return false;
}
function kurzname($medikamente, $med_id) {
	$medikament = $medikamente [$med_id] ['med_name'];
	$laenge = 3;
	do {
		$dublikat = false;
		$kurzname = substr ( $medikament, 0, $laenge );
		foreach ( $medikamente as $key => $med_name ) {
			if ($med_name ['med_name'] == $medikament)
				continue;
			if (substr ( $med_name ['med_name'], 0, $laenge ) == $kurzname) {
				$dublikat = true;
				$laenge ++;
			}
			if (! $dublikat) {
				foreach ( $medikamente as $key2 => $med_shortname ) {
					if ($med_name ['med_name'] == $medikament)
						continue;
					if ($med_name ['med_shortname'] == $kurzname) {
						$dublikat = true;
						$laenge ++;
					}
				}
			}
		}
	} while ( $dublikat == true );
	return $kurzname;
}