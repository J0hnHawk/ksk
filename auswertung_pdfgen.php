<?php
$startmonat = GetParam ( 'startmonat', 'P', mktime ( 0, 0, 0 ) );
$n = date ( 'n', $startmonat );
$Y = date ( 'Y', $startmonat );
require './include/fpdf/fpdf.php';
// Medikamente laden
$sql = "SELECT * FROM `$stmedis` ORDER BY med_name ASC";
$result = $sqldb->query ( $sql );
$medikamente = array ();
if ($result->num_rows > 0) {
	while ( $medikament = $result->fetch_assoc () ) {
		extract ( $medikament );
		$medikamente [$med_id] = $med_name;
	}
}
// Datenbank laden
$sql1 = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` BETWEEN " . mktime ( 0, 0, 0, $n, 1, $Y ) . " AND " . mktime ( 0, 0, 0, $n + 6, 1, $Y ) . " ORDER BY `ks_day` ASC;";
$kstage = $sqldb->query ( $sql1 );
while ( $ks_tag = $kstage->fetch_assoc () ) {
	$ks_day = $ks_tag ['ks_day'];
	$ks_art = array ();
	for($i = 0; $i < strlen ( $ks_tag ['ks_art'] ); $i ++) {
		$ks_art [] = substr ( $ks_tag ['ks_art'], $i, 1 );
	}
	$sql2 = sprintf ( "SELECT * FROM `$stmedtag` WHERE `ks_id` = %s;", $ks_tag ['ks_id'] );
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
	$pdf->Cell ( 46, 5, date ( 'F Y', mktime ( 0, 0, 0, $m, 1, $Y ) ), 0, 0, C );
}
$pdf->Ln ();
$pdf->SetFont ( 'Arial', '', 6 );
$pdf->SetFillColor ( 204, 212, 226 );
for($m = $n; $m < $n + 6; $m ++) {
	$pdf->Cell ( 6, 3, 'Tag', L, 0, C, 1 );
	$pdf->Cell ( 9, 3, 'Art', 0, 0, C, 1 );
	$pdf->Cell ( 16, 3, 'Medikament', 0, 0, C, 1 );
	$pdf->Cell ( 15, 3, 'Graduierung', R, 0, C, 1 );
}
$pdf->Ln ();
for($m = $n; $m < $n + 6; $m ++) {
	$pdf->Cell ( 6, 3, '', LB, 0, C, 1 );
	$pdf->Cell ( 3, 3, 'M', B, 0, C, 1 );
	$pdf->Cell ( 3, 3, 'S', B, 0, C, 1 );
	$pdf->Cell ( 3, 3, 'U', B, 0, C, 1 );
	$pdf->Cell ( 16, 3, '', B, 0, C, 1 );
	$pdf->Cell ( 3, 3, 0, B, 0, C, 1 );
	$pdf->Cell ( 3, 3, 1, B, 0, C, 1 );
	$pdf->Cell ( 3, 3, 2, B, 0, C, 1 );
	$pdf->Cell ( 3, 3, 3, B, 0, C, 1 );
	$pdf->Cell ( 3, 3, 4, BR, 0, C, 1 );
}
$pdf->Ln ();
$pdf->SetFillColor ( 229, 233, 240 );
for($t = 1; $t < 32; $t ++) {
	for($m = $n; $m < $n + 6; $m ++) {
		if ($t > date ( 't', mktime ( 0, 0, 0, $m, 1, $Y ) )) {
			$pdf->Cell ( 46, 5, '', ($m == $n) ? 0 : L );
		} else {
			$pdf->Cell ( 6, 5, $t, 1, 0, R, $m % 2 );
			$ks_day = mktime ( 0, 0, 0, $m, $t, $Y );
			if (isset ( $tage [$ks_day] )) {
				$ks_data = $tage [$ks_day];
				$pdf->Cell ( 3, 5, in_array ( 'm', $ks_data ['ks_art'] ) ? 'X' : '', 1, 0, C, $m % 2 );
				$pdf->Cell ( 3, 5, in_array ( 's', $ks_data ['ks_art'] ) ? 'X' : '', 1, 0, C, $m % 2 );
				$pdf->Cell ( 3, 5, in_array ( 'u', $ks_data ['ks_art'] ) ? 'X' : '', 1, 0, C, $m % 2 );
				$mediliste = '';
				foreach ( $ks_data ['ks_medis'] as $medi ) {
					$medi_name_kurz = kurzname ( $medikamente, $medi );
					$mediliste .= $medi_name_kurz . ', ';
					$legende [$medi_name_kurz] = $medikamente [$medi];
				}
				$pdf->Cell ( 16, 5, substr ( $mediliste, 0, - 2 ), 1, 0, L, $m % 2 );
				for($g = 0; $g < 5; $g ++)
					$pdf->Cell ( 3, 5, ($ks_data ['ks_grad'] == $g) ? 'X' : '', 1, 0, C, $m % 2 );
			} else {
				$pdf->Cell ( 3, 5, '', 1, 0, L, $m % 2 );
				$pdf->Cell ( 3, 5, '', 1, 0, L, $m % 2 );
				$pdf->Cell ( 3, 5, '', 1, 0, L, $m % 2 );
				$pdf->Cell ( 16, 5, '', 1, 0, L, $m % 2 );
				for($g = 0; $g < 5; $g ++)
					$pdf->Cell ( 3, 5, '', 1, 0, L, $m % 2 );
			}
		}
	}
	$pdf->Ln ();
}
if (is_array ( $legende )) {
	foreach ( $legende as $kurz => $lang ) {
		$legende_text .= "$kurz = $lang, ";
	}
}
$pdf->Cell ( 0, 8, substr ( $legende_text, 0, - 2 ), 0, 0, C );
$pdf->Ln ();

$pdf->SetLeftMargin ( 15 );
$pdf->SetTopMargin ( 15 );
$pdf->SetFont ( 'Arial', 'B', 14 );
$pdf->AddPage ( 'P' );
$pdf->Cell ( 0, 10, 'Weitere Eintragungen zu den umseitigen Kopfschmerztagen' );
$pdf->Ln ();
$pdf->SetFont ( 'Arial', 'B', 12 );
$pdf->Cell ( 30, 6, 'Datum', RB );
$pdf->Cell ( 0, 6, 'Information / Bemerkung', RB );
$pdf->Ln ();
$pdf->SetFont ( 'Arial', '', 12 );
foreach ( $tage as $tag => $data ) {
	if ($data ['ks_info'] == "")
		continue;
	$pdf->Cell ( 30, 6, date ( 'd.m.Y', $tag ), RB );
	$pdf->Cell ( 0, 6, html_entity_decode ( utf8_decode ( $data ['ks_info'] ), ENT_QUOTES ), RB );
	$pdf->Ln ();
}
// $smarty->assign ( "monate", $monate );
// $smarty->assign ( "tage", $tage );
$sm = date ( 'My', mktime ( 0, 0, 0, $n, 1, $Y ) );
$em = date ( 'My', mktime ( 0, 0, 0, $n + 5, 1, $Y ) );
$pdf->Output ( "KSK_$sm-$em", I );
$seite = "auswertung";
include ('auswertung.php');
function kurzname($medikamente, $med_id) {
	$medikament = $medikamente [$med_id];
	$laenge = 3;
	do {
		$dublikat = false;
		$kurzname = substr ( $medikament, 0, $laenge );
		foreach ( $medikamente as $med_name ) {
			if ($med_name == $medikament)
				continue;
			if (substr ( $med_name, 0, $laenge ) == $kurzname) {
				$dublikat = true;
				$laenge ++;
			}
		}
	} while ( $dublikat == true );
	return $kurzname;
}
