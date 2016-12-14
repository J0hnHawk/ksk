<?php
require ("./include/notice.php");

/*
 * ***********************************************************************************************************
 * ***
 * *** Auswerten und verarbeiten der Formulardaten
 * ***
 * ***********************************************************************************************************
 */
$error = $info = $success = '';
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	/*
	 * *******************************************************************************************************
	 * Formulardaten abfragen und auswerten
	 */
	/*
	 * *******************************************************************************************************
	 * Kopfschmerztag abfragen
	 */
	$tag = GetParam ( 'inputDate' );
	if (is_array ( $tag ) || $tag == '') {
		$error .= get_message ( 'F01' );
	} elseif (! check_date ( htmlentities ( $tag, ENT_QUOTES ), "dmY", "." )) {
		$error .= get_message ( 'F02', htmlentities ( $tag, ENT_QUOTES ) );
	}
	/*
	 * *******************************************************************************************************
	 * Kopfschmerzart überprüfen
	 */
	$paintype = 0;
	$checkboxPaintype = GetParam ( 'checkboxPaintype', 'P', array () );
	$dropdownPaintype = GetParam ( 'dropdownPaintype', 'P', array () );
	if (! is_array ( $checkboxPaintype ) || ! is_array ( $checkboxPaintype ))
		$error .= get_message ( 'F03' );
	foreach ( $dropdownPaintype as $type )
		$paintype = $paintype | ($type + 0);
	foreach ( $checkboxPaintype as $type ) {
		$paintype = $paintype | ($type + 0);
	}
	$ks_art = $paintype;
	/*
	 * *******************************************************************************************************
	 * Ausgewählte Medikamente überprüfen
	 */
	$checkboxDrugs = GetParam ( 'checkboxDrugs', 'P', array () );
	$dropdownDrugs = GetParam ( 'dropdownDrugs', 'P', array () );
	$drugs = GetParam ( 'medikament', 'P', array () );
	if (! is_array ( $checkboxDrugs ) || ! is_array ( $dropdownDrugs )) {
		$error .= get_message ( 'F04' );
		$drugs = array ();
	} else {
		$drugs = array ();
		$drugs_form = array_merge ( $checkboxDrugs, $dropdownDrugs );
		$drug_error = false;
		foreach ( $drugs_form as $drug ) {
			if ($drug + 0 != $drug) {
				$drug_error = true;
			} else {
				if (! in_array ( $drug, $drugs ))
					$drugs [] = $drug;
			}
		}
		if ($drug_error)
			$error .= get_message ( 'F05' );
	}
	/*
	 * *******************************************************************************************************
	 * Schmerzgrad überprüfen
	 */
	$ks_grad = GetParam ( 'inputGrad', 'P', - 1 );
	if (is_array ( $ks_grad )) {
		$error .= get_message ( 'F06' );
	} else {
		$ks_grad = htmlentities ( $ks_grad, ENT_QUOTES ) + 0;
	}
	// if($ks_grad=='') $fehler .= 'Es wurde keine Graduierung des Schmerzes angegeben.';
	/*
	 * *******************************************************************************************************
	 * Zusätliche Informationen
	 */
	$ks_info = GetParam ( 'textAreaInfo' );
	if (is_array ( $ks_info )) {
		$error .= get_message ( 'F07' );
	} else {
		$ks_info = htmlentities ( $ks_info, ENT_QUOTES );
	}
	/*
	 * *******************************************************************************************************
	 * Gibt es Fehler? Dann Skript abbrechen und Fehler anzeigen
	 */
	if ($error)
		$smarty->assign ( 'error', $error );
	else {
		/*
		 * ***************************************************************************************************
		 * KS-Tag als Unixtimestamp
		 */
		list ( $d, $m, $y ) = explode ( '.', $tag );
		$ks_day = mktime ( 0, 0, 0, $m, $d, $y );
		/*
		 * ***************************************************************************************************
		 * Hinweismeldungen wenn übermittelte Daten nicht vollständig sind
		 */
		if ($ks_grad > - 1 && $ks_art == 0) {
			$info .= get_message ( 'H01' );
		}
		if (sizeof ( $drugs ) == 0 && $ks_art == 0) {
			$info .= get_message ( 'H02' );
		}
		/*
		 * ***************************************************************************************************
		 * Schon Daten für Tag & User vorhanden?
		 */
		$sql = sprintf ( "SELECT * FROM %s WHERE `user_id` = %s AND `pain_day` = '%s';", $db_days, $_SESSION ['user'] ['user_id'], date ( 'Y-m-d H:i:s', $ks_day ) );
		// $sql = "SELECT * FROM $db_days WHERE `user_id` = 1 AND `ks_day` = $ks_day;";
		if (! $result = $sqldb->query ( $sql )) {
			$error .= get_message ( 'F12' );
		}
		/*
		 * ***************************************************************************************************
		 * Daten in Datenbank eintragen/aktualisieren
		 */
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc ();
			$ks_id = $row ['ks_id'];
			$sql = sprintf ( "UPDATE $db_days SET `ks_art` = '%s', `ks_grad` = '%s', `ks_info` = '%s' WHERE `user_id` = %s AND `ks_id` = %s;", $ks_art, $ks_grad, $ks_info, $_SESSION ['user'] ['user_id'], $ks_id );
			if (! $result = $sqldb->query ( $sql )) {
				$error .= get_message ( 'F11' );
			}
		} else {
			$sql = sprintf ( "INSERT INTO `%s` (`user_id`, `pain_day`, `ks_art`, `ks_grad`, `ks_info`) VALUES (%s, '%s', %s, %s, '%s');", $db_days, $_SESSION ['user'] ['user_id'], date ( 'Y-m-d H:i:s', $ks_day ), $ks_art, $ks_grad, $ks_info );
			if (! $result = $sqldb->query ( $sql )) {
				$error .= get_message ( 'F10' );
			}
			$ks_id = $sqldb->insert_id;
		}
		$pain_lastchange = time ();
		$format = "DELETE FROM `$db_drugdays` WHERE `ks_id` = %s AND `user_id` = %s;";
		$sql = sprintf ( $format, $ks_id, $_SESSION ['user'] ['user_id'] );
		if (! $result = $sqldb->query ( $sql )) {
			$error .= get_message ( 'F08' );
		}
		if (sizeof ( $drugs ) > 0) {
			$values = '';
			foreach ( $drugs as $med_id )
				$values .= "(NULL , $ks_id, {$_SESSION ['user'] ['user_id']}, $med_id), ";
			$values = substr ( $values, 0, - 2 );
			$sql = "INSERT INTO `$db_drugdays` (`medtag_id`, `ks_id`, `user_id`, `med_id`) VALUES $values;";
			if (! $result = $sqldb->query ( $sql )) {
				$error .= get_message ( 'F09' );
			}
		}
		if (! $error)
			$success .= 'Daten erfolgreich gespeichert.';
	}
}
/*
 * ***********************************************************************************************************
 * ***
 * *** Datenbank auslesen und Formular füllen wenn Daten vorhanden sind
 * ***
 * ***********************************************************************************************************
 */

/*
 * ***************************************************************************************************
 * Kopfschmerzarten übergeben
 */
$ks_arten = array (
		'1' => 'Migräne',
		'2' => 'Spannungskopfschmerz',
		'4' => 'Undefiniert' 
);
$smarty->assign ( 'ks_arten', $ks_arten );
/*
 * ***************************************************************************************************
 * Medikamente des Benutzers laden
 */
$sql = "SELECT * FROM `$db_drugs` WHERE med_show = 1 AND med_type = 0 AND user_id = {$_SESSION['user']['user_id']} ORDER BY med_name ASC";
$result = $sqldb->query ( $sql );
$medikamente = array ();
if ($result->num_rows > 0) {
	while ( $medikament = $result->fetch_assoc () ) {
		extract ( $medikament );
		$medikamente [$med_id] = $med_name;
	}
}
$smarty->assign ( "medikamente", $medikamente );
/*
 * ***************************************************************************************************
 * Wurde in der URL ein Datum übergeben? Dann auswerten. Sonst Tagesdatum.
 */
if (! isset ( $ks_day )) {
	$ks_day = GetParam ( 'date', 'G', date ( 'd.m.Y' ) );
	if (is_array ( $ks_day ) || $ks_day == '') {
		$error .= get_message ( 'F01' );
	} elseif (! check_date ( htmlentities ( $ks_day, ENT_QUOTES ), "dmY", "." )) {
		$error .= get_message ( 'F02', htmlentities ( $ks_day, ENT_QUOTES ) );
	} else {
		list ( $d, $m, $y ) = explode ( '.', $ks_day );
		$ks_day = mktime ( 0, 0, 0, $m, $d, $y );
	}
	if ($error)
		$smarty->assign ( 'error', $error );
}
$smarty->assign ( 'ks_day', $ks_day );
/*
 * ***************************************************************************************************
 * Modus prüfen
 */
$mode = GetParam ( 'mode', 'G', '' );
if ($mode == 'delete') {
	/*
	 * ***************************************************************************************************
	 * Eintrag für das Datum löschen
	 */
	$sql = sprintf ( "SELECT * FROM %s WHERE `user_id` = %s AND `pain_day` = '%s';", $db_days, $_SESSION ['user'] ['user_id'], date ( 'Y-m-d H:i:s', $ks_day ) );
	$result = $sqldb->query ( $sql );
	if ($result->num_rows == 1) {
		$ks_tag = $result->fetch_assoc ();
		$sql = sprintf ( "DELETE FROM $db_days WHERE `ks_id` = %s;", $ks_tag ['ks_id'] );
		$result = $sqldb->query ( $sql );
		$sql = sprintf ( "DELETE FROM `$db_drugdays` WHERE `ks_id` = %s;", $ks_tag ['ks_id'] );
		$result = $sqldb->query ( $sql );
	}
	unset ( $ks_tag );
	$success .= 'Daten erfolgreich gelöscht.';
	// DELETE FROM `ksk`.`ksk_kstage` WHERE `ksk_kstage`.`ks_id` = 144
} else {
	/*
	 * ***************************************************************************************************
	 * Existiert ein Eintrag für das Datum? Dann inkl. eingenommenen Medikamente laden.
	 */
	$sql = sprintf ( "SELECT * FROM %s WHERE `user_id` = %s AND `pain_day` = '%s';", $db_days, $_SESSION ['user'] ['user_id'], date ( 'Y-m-d H:i:s', $ks_day ) );
	$result = $sqldb->query ( $sql );
	if ($result->num_rows == 1) {
		$ks_tag = $result->fetch_assoc ();
		$pain_lastchange = strtotime ( $ks_tag ['pain_lastchange'] );
		$sql = sprintf ( "SELECT * FROM `$db_drugdays` WHERE `ks_id` = %s;", $ks_tag ['ks_id'] );
		$result = $sqldb->query ( $sql );
		$drugstaken = array ();
		if ($result->num_rows != 0) {
			while ( $medistag = $result->fetch_assoc () ) {
				$drugstaken [] = $medistag ['med_id'];
			}
		}
	}
}
/*
 * ***************************************************************************************************
 * evtl. Daten an Formular übergeben
 */
if ($info)
	$smarty->assign ( 'info', $info );
if ($error)
	$smarty->assign ( 'error', $error );
elseif ($success)
	$smarty->assign ( 'success', $success );
$smarty->assign ( 'ks_art', isset ( $ks_tag ['ks_art'] ) ? $ks_tag ['ks_art'] : array () );
$smarty->assign ( 'ks_medis', isset ( $drugstaken ) ? $drugstaken : array () );
$smarty->assign ( 'ks_grad', isset ( $ks_tag ['ks_grad'] ) ? $ks_tag ['ks_grad'] : - 1 );
$smarty->assign ( 'ks_info', isset ( $ks_tag ['ks_info'] ) ? $ks_tag ['ks_info'] : '' );
$smarty->assign ( 'ks_lastchange', isset ( $pain_lastchange ) ? $pain_lastchange : '' );
$panel_month = $ks_day;
$smarty->assign ( 'template', "edit.htpl" );