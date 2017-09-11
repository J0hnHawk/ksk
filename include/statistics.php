<?php
/**
 * This file is part of the "Kopfschmerzkalender" package.
 * Copyright (C) 2017 John Hawk <john.hawk@gmx.net>
 *
 * "NF Marsch Webstats" is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * "NF Marsch Webstats" is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Foobar. If not, see <http://www.gnu.org/licenses/>.
 */

if (! defined ( 'IN_KSK' )) {
	exit ();
}

/*
 * längste Phase ohne Kopfschmerzen
 * längste Phase mit durchgehenden Kopfschmerzen
 * Monat mit den wenigsten Schmerztage
 * Monat mit den meisten Schmerztage
 * Monat mit der meisten Schmerzintensivität
 * Monat mit den wenigsten Schmerzmitteln
 * Monat mit den meisten Schmerzmitteln
 * Schmerztage pro Wochentag
 *
 * SELECT COUNT(*), DATE_FORMAT(`pain_day`, '%Y-%m') FROM `ksk_kstage` WHERE `user_id` = 2 AND `ks_art` > 0 AND `ks_grad` > -1 GROUP BY DATE_FORMAT(`pain_day`, '%Y-%m')
 *
 */
$mode = GetParam ( 'mode', 'G', '' );
$modes = array (
		'ppw',
		'ppm',
		'ppie' 
);
if (! in_array ( $mode, $modes ))
	$mode = 'ppm';
$smarty->assign ( 'mode', $mode );
$smarty->assign ( 'template', "statistics.tpl" );
switch ($mode) {
	case 'ppw' :
		$daynames = array (
				'Montag',
				'Dienstag',
				'Mittwoch',
				'Donnerstag',
				'Freitag',
				'Samstag',
				'Sonntag' 
		);
		$googlechartarray = "[ 'Wochentag', 'Kopfschmerzen', 'Schmerzmittel' ],";
		for($s1 = 0; $s1 < 7; $s1 ++) {
			$sql = "SELECT * FROM `$db_days` WHERE WEEKDAY(`pain_day`) = $s1 AND `user_id`= {$_SESSION['user']['user_id']} AND `ks_art` > 0 AND `ks_grad` > -1";
			$result = $sqldb->query ( $sql );
			$drugdays = 0;
			if ($result->num_rows > 0) {
				while ( $ks_tag = $result->fetch_assoc () ) {
					$sql = sprintf ( "SELECT * FROM `$db_drugdays` WHERE `ks_id` = %d;", $ks_tag ['ks_id'] );
					$result_drugday = $sqldb->query ( $sql );
					if ($result_drugday->num_rows > 0)
						$drugdays ++;
				}
			}
			$googlechartarray .= sprintf ( "['%s', %d, %d],", $daynames [$s1], $result->num_rows, $drugdays );
		}
		$smarty->assign ( 'googlechartarray', $googlechartarray );
		$smarty->assign ( 'page_header', 'Kopfschmerzen pro Wochentag' );
		break;
	case 'ppm' :
		$googlechartarray = "[ 'Monat', 'Tage' ],";
		$sql = "SELECT COUNT(*) sum, DATE_FORMAT(`pain_day`, '%Y-%m') monat FROM `$db_days` WHERE `user_id` = {$_SESSION['user']['user_id']} AND `ks_art` > 0 AND `ks_grad` > -1 GROUP BY DATE_FORMAT(`pain_day`, '%Y-%m')";
		$result = $sqldb->query ( $sql );
		if ($result->num_rows > 0) {
			while ( $pain_days = $result->fetch_assoc () ) {
				$googlechartarray .= sprintf ( "['%s', %d],", $pain_days ['monat'], $pain_days ['sum'] );
			}
		}
		$smarty->assign ( 'googlechartarray', $googlechartarray );
		$smarty->assign ( 'page_header', 'Kopfschmerzen pro Monat' );
		break;
	case 'ppie' :
		$googlechartarray = "[ 'Kopfschmerzart', 'Anzahl Tage'],";
		$sql = "SELECT * FROM `$db_days` WHERE `user_id`= {$_SESSION['user']['user_id']} AND `ks_art` > 0 AND `ks_grad` > -1";
		$result = $sqldb->query ( $sql );
		$pain_type = array (
				1 => 0,
				2 => 0,
				4 => 0 
		);
		if ($result->num_rows > 0) {
			while ( $ks_tag = $result->fetch_assoc () ) {
				$pain_type [$ks_tag ['ks_art']] ++;
			}
			$googlechartarray .= sprintf ( "['%s', %d],", 'Migräne', $pain_type [1] );
			$googlechartarray .= sprintf ( "['%s', %d],", 'Spannungskopfschmerzen', $pain_type [2] );
			$googlechartarray .= sprintf ( "['%s', %d],", 'Undefiniert', $pain_type [4] );
		}
		$smarty->assign ( 'googlechartarray', $googlechartarray );
		$smarty->assign ( 'page_header', 'Kopfschmerzen nach Art' );
		break;
}