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

$startmonat = GetParam ( 'startmonat', 'P', mktime ( 0, 0, 0 ) );
error_reporting ( E_ERROR | E_WARNING | E_PARSE );

$showinfo = GetParam ( 'info', 'P', 0 );
$n = date ( 'n', $startmonat );
$Y = date ( 'Y', $startmonat );
require ('./include/fpdf/fpdf.php');
// Medikamente laden
$sql = "SELECT * FROM `$db_drugs` ORDER BY med_name ASC";
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
// Datenbank laden
$start = mktime ( 0, 0, 0, $n, 1, $Y );
$ende = mktime ( 0, 0, 0, $n + 6, 1, $Y );
// $format = "SELECT * FROM %s WHERE `user_id` = %s AND `ks_art` > 0 AND `pain_day` BETWEEN '%s' AND '%s' ORDER BY `ks_day` ASC;";
// $sql1 = sprintf ( $format, $db_days, $_SESSION ['user'] ['user_id'], date ( 'Y-m-d H:i:s', $start ), date ( 'Y-m-d H:i:s', $ende ) );
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
			'ks_art' => $ks_art,
			'ks_medis' => $medis,
			'ks_grad' => $ks_tag ['ks_grad'],
			'ks_info' => $ks_tag ['ks_info'] 
	);
}
$pdf = new FPDF ( 'L' );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->SetLeftMargin ( 10 );
$pdf->SetTopMargin ( 15 );
$pdf->AddPage ();
for($m = $n; $m < $n + 6; $m ++) {
	$pdf->Cell ( 46, 5, strftime ( '%B %Y', mktime ( 0, 0, 0, $m, 1, $Y ) ), 0, 0, 'C' );
}
$pdf->Ln ();
$pdf->SetFont ( 'Arial', '', 6 );
$pdf->SetFillColor ( 204, 212, 226 );
for($m = $n; $m < $n + 6; $m ++) {
	$pdf->Cell ( 6, 3, 'Tag', 'L', 0, 'C', 1 );
	$pdf->Cell ( 9, 3, 'Art', 0, 0, 'C', 1 );
	$pdf->Cell ( 16, 3, 'Medikament', 0, 0, 'C', 1 );
	$pdf->Cell ( 15, 3, 'Graduierung', 'R', 0, 'C', 1 );
}
$pdf->Ln ();
for($m = $n; $m < $n + 6; $m ++) {
	$pdf->Cell ( 6, 3, '', 'LB', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 'M', 'B', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 'S', 'B', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 'U', 'B', 0, 'C', 1 );
	$pdf->Cell ( 16, 3, '', 'B', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 0, 'B', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 1, 'B', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 2, 'B', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 3, 'B', 0, 'C', 1 );
	$pdf->Cell ( 3, 3, 4, 'BR', 0, 'C', 1 );
}
$height = 4.85;
$pdf->Ln ();
$pdf->SetFillColor ( 229, 233, 240 );
$sek = $sem = array ();
for($t = 1; $t < 32; $t ++) {
	for($m = $n; $m < $n + 6; $m ++) {
		if ($t > date ( 't', mktime ( 0, 0, 0, $m, 1, $Y ) )) {
			// $pdf->Cell ( 46, $height, '', ($m == $n) ? 0 : L );
			// //ursprünglich, ohne Summenzeile, sollte der Bereich unter den
			// Monaten mit weniger als 31 Tagen leer sein.
			$pdf->Cell ( 46, $height, '', 1, 0, 'C', $m % 2 );
		} else {
			$pdf->Cell ( 6, $height, $t, 1, 0, 'R', $m % 2 );
			$ks_day = mktime ( 0, 0, 0, $m, $t, $Y );
			if (isset ( $tage [$ks_day] )) {
				$ks_data = $tage [$ks_day];
				if (sizeof ( $ks_data ['ks_art'] ) > 0) {
					if (isset ( $sek [$m] )) {
						$sek [$m] ++;
					} else {
						$sek += array (
								$m => 1 
						);
					}
				}
				$pdf->Cell ( 3, $height, ($ks_data ['ks_art'] & 1) ? 'X' : '', 1, 0, 'C', $m % 2 );
				$pdf->Cell ( 3, $height, ($ks_data ['ks_art'] & 2) ? 'X' : '', 1, 0, 'C', $m % 2 );
				$pdf->Cell ( 3, $height, ($ks_data ['ks_art'] & 4) ? 'X' : '', 1, 0, 'C', $m % 2 );
				$mediliste = '';
				if (sizeof ( $ks_data ['ks_medis'] ) > 0)
					if (isset ( $sem [$m] )) {
						$sem [$m] ++;
					} else {
						$sem += array (
								$m => 1 
						);
					}
					// $sem [$m] ++;
				foreach ( $ks_data ['ks_medis'] as $medi ) {
					$med_name = $medikamente [$medi] ['name'];
					$med_short = $medikamente [$medi] ['short'];
					$mediliste .= $med_short . ', ';
					$legende [$med_short] = $med_name;
				}
				$pdf->Cell ( 16, $height, substr ( $mediliste, 0, - 2 ), 1, 0, 'L', $m % 2 );
				for($g = 0; $g < 5; $g ++)
					$pdf->Cell ( 3, $height, ($ks_data ['ks_grad'] == $g) ? 'X' : '', 1, 0, 'C', $m % 2 );
			} else {
				$pdf->Cell ( 3, $height, '', 1, 0, 'L', $m % 2 );
				$pdf->Cell ( 3, $height, '', 1, 0, 'L', $m % 2 );
				$pdf->Cell ( 3, $height, '', 1, 0, 'L', $m % 2 );
				$pdf->Cell ( 16, $height, '', 1, 0, 'L', $m % 2 );
				for($g = 0; $g < 5; $g ++)
					$pdf->Cell ( 3, $height, '', 1, 0, 'L', $m % 2 );
			}
		}
	}
	$pdf->Ln ();
}
for($m = $n; $m < $n + 6; $m ++) {
	$pdf->Cell ( 6, 5, 'Se.', 1, 0, 'C', $m % 2 );
	$pdf->Cell ( 9, 5, $sek [$m], 1, 0, 'C', $m % 2 );
	$pdf->Cell ( 16, 5, $sem [$m], 1, 0, 'C', $m % 2 );
	$pdf->Cell ( 15, 5, '', 1, 0, 'C', $m % 2 );
}
$pdf->Ln ();
$legende_text = '';
if (is_array ( $legende )) {
	foreach ( $legende as $kurz => $lang ) {
		$legende_text .= "$kurz = $lang, ";
	}
}
$pdf->Cell ( 0, 8, substr ( $legende_text, 0, - 2 ), 0, 0, 'C' );
if ($showinfo) {
	// $pdf->Ln ();
	$pdf->SetLeftMargin ( 15 );
	$pdf->SetTopMargin ( 15 );
	$pdf->SetFont ( 'Arial', 'B', 14 );
	$pdf->AddPage ( 'L' );
	$pdf->Cell ( 0, 10, 'Weitere Eintragungen zu den umseitigen Kopfschmerztagen' );
	$pdf->Ln ();
	$pdf->SetFont ( 'Arial', 'B', 12 );
	$pdf->Cell ( 30, 6, 'Datum', 'RB' );
	$pdf->Cell ( 0, 6, 'Information / Bemerkung', 'RB' );
	$pdf->Ln ();
	$pdf->SetFont ( 'Arial', '', 12 );
	foreach ( $tage as $tag => $data ) {
		if ($data ['ks_info'] == "")
			continue;
		$pdf->Cell ( 30, 6, date ( 'd.m.Y', $tag ), 'RB' );
		$pdf->Cell ( 0, 6, utf8_decode ( html_entity_decode ( $data ['ks_info'], ENT_QUOTES ) ), 'RB' );
		$pdf->Ln ();
	}
}
$sm = strftime ( '%b%y', mktime ( 0, 0, 0, $n, 1, $Y ) );
$em = strftime ( '%b%y', mktime ( 0, 0, 0, $n + 5, 1, $Y ) );
$pdf->Output ( "KSK_$sm-$em.pdf", 'I' );
exit ();