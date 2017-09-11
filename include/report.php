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

if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	include("report_pdf.php");
}
$mode = GetParam ( 'mode', 'G', '' );
$modes = array (
		'sheet',
		'list' 
);
if (! in_array ( $mode, $modes ))
	$mode = 'sheet';
$smarty->assign ( 'mode', $mode );
$showpain = true;
// Medikamente laden
$sql = "SELECT * FROM `$db_drugs` ORDER BY med_name ASC"; // WHERE `user_id` = {$_SESSION['user']['user_id']}
$result = $sqldb->query ( $sql );
$medikamente = array ();
if ($result->num_rows > 0) {
	while ( $medikament = $result->fetch_assoc () ) {
		extract ( $medikament );
		$medikamente [$med_id] = array (
				'name' => $med_name,
				'short' => $med_shortname 
		);
	}
}
$smarty->assign ( "medikamente", $medikamente );

// Zeitraum
$monat = GetParam ( 'month', 'G', date ( 'm' ) ) + 0;
$jahr = GetParam ( 'year', 'G', date ( 'Y' ) ) + 0;
$tage = array ();
$start = $panel_month = mktime ( 0, 0, 0, $monat, 1, $jahr );
$nmonat = $panel_month = mktime ( 0, 0, 0, $monat+1, 1, $jahr );
$lmonat = $panel_month = mktime ( 0, 0, 0, $monat-1, 1, $jahr );
$ende = mktime ( 0, 0, 0, date ( 'm', $start ), date ( 't', $start ), date ( 'Y', $start ) );
$smarty->assign ( 'amonat', $start );
$smarty->assign ( 'lmonat', $lmonat );
$smarty->assign ( 'nmonat', $nmonat );

if ($mode == 'sheet') {
	$weekday_first = date ( 'w', $start );
	$weekday_last = date ( 'w', $ende );
	$add_beginn = ($weekday_first + 6) % 7;
	$add_end = 6 - ($weekday_last + 6) % 7;
	$start = $start - $add_beginn * 86400;
	$ende = $ende + $add_end * 86400;
}
for($t = $start; $t <= $ende; $t += (60 * 60 * 24)) {
	if (date ( 'H', $t ) == 23)
		$t += 3600;
	if (date ( 'H', $t ) == 1)
		$t -= 3600;
	$tage [$t] = array (
			'ks_art' => 128,
			'ks_medis' => array (),
			'ks_grad' => - 1,
			'ks_info' => '' 
	);
}
// Datenbank laden
$sql1 = sprintf ( "SELECT * FROM %s WHERE `user_id` = %s AND `pain_day` BETWEEN '%s' AND '%s' ORDER BY `ks_day` ASC;", $db_days, $_SESSION ['user'] ['user_id'], date ( 'Y-m-d H:i:s', $start ), date ( 'Y-m-d H:i:s', $ende ) );
$kstage = $sqldb->query ( $sql1 );
while ( $ks_tag = $kstage->fetch_assoc () ) {
	$ks_day = strtotime ( $ks_tag ['pain_day'] );
	$ks_art = $ks_tag ['ks_art'];
	$sql2 = sprintf ( "SELECT * FROM `$db_drugdays` WHERE `ks_id` = %s;", $ks_tag ['ks_id'] );
	$medistagdb = $sqldb->query ( $sql2 );
	$medis = array ();
	while ( $medistag = $medistagdb->fetch_assoc () ) {
		
		$medis [] = $medistag ['med_id'];
	}
	$tage [$ks_day] = array (
			'ks_id' => $ks_tag ['ks_id'],
			'ks_art' => $ks_art,
			'ks_medis' => $medis,
			'ks_grad' => $ks_tag ['ks_grad'],
			'ks_info' => $ks_tag ['ks_info'] 
	);
}
ksort ( $tage );
$smarty->assign ( 'tage', $tage );
$smarty->assign ( 'template', "report.tpl" );
// PDF Download
$pain_range = pain_range ();
$smarty->assign ( 'ekt', $pain_range ['first'] );
$smarty->assign ( 'lkt', $pain_range ['last'] );
$sme = array ();
$s1 = 0;
do {
	$monat = mktime ( 0, 0, 0, date ( 'm', $pain_range ['first'] ) + $s1, 1, date ( 'Y', $pain_range ['first'] ) );
	$sme [$monat] = utf8_encode ( strftime ( '%B %Y', $monat ) );
	$s1 ++;
} while ( mktime ( 0, 0, 0, date ( 'm', $pain_range ['first'] ) + $s1 + 5, 1, date ( 'Y', $pain_range ['first'] ) ) < $pain_range ['last'] );
$sme = array_reverse ( $sme, true );
$smarty->assign ( 'sme', $sme );

