<?php
$sql1 = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} ORDER BY `ks_day` ASC;";
$kstage = $sqldb->query ( $sql1 );
$ekt = $lkt = 0;
// Ersten und letzten Kopfschmerztag des Users ermitteln
while ( $ks_tag = $kstage->fetch_assoc () ) {
	if ($ekt == 0)
		$ekt = $ks_tag ['ks_day'];
	else {
		if ($ks_tag ['ks_day'] < $ekt)
			$ekt = $ks_tag ['ks_day'];
	}
	if ($lkt == 0)
		$lkt = $ks_tag ['ks_day'];
	else {
		if ($ks_tag ['ks_day'] > $lkt)
			$lkt = $ks_tag ['ks_day'];
	}
}
$smarty->assign ( 'ekt', $ekt );
$smarty->assign ( 'lkt', $lkt );
$sme = array ();
$s1 = 0;
do {
	$monat = mktime ( 0, 0, 0, date ( 'm', $ekt ) + $s1, 1, date ( 'Y', $ekt ) );
	$sme [$monat] = utf8_encode ( strftime ( '%B %Y', $monat ) );
	$s1 ++;
} while ( mktime ( 0, 0, 0, date ( 'm', $ekt ) + $s1 + 5, 1, date ( 'Y', $ekt ) ) < $lkt );
$sme = array_reverse ( $sme, true );
$smarty->assign ( 'sme', $sme );
$meditage = meditage ( time () );
$smarty->assign ( 'meditage', $meditage );
if ($meditage ['meditage'] >= 8)
	$smarty->assign ( 'warning', 1 );
else
	$smarty->assign ( 'warning', 0 );
