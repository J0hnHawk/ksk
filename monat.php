<?php
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
$smarty->assign ( "medikamente", $medikamente );

// Kopfschmerzarten & -grad
// $ks_arten = array('m' => 'Migräne', 's' => 'Spannungskopfschmerz', 'u' => 'unklar');
$ks_arten = array (
		'm' => '',
		's' => '',
		'u' => '' 
);
$smarty->assign ( 'ks_arten', $ks_arten );
for($s1 = 0; $s1 < 5; $s1 ++)
	$grad [$s1] = ''; // $grad[$s1] = $s1
$smarty->assign ( "grad", $grad );

// Zeitraum
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	$monat = GetParam ( 'monat' );
	$jahr = GetParam ( 'jahr' );
} else {
	$time = GetParam ( 'monat', 'G', time () );
	$monat = date ( 'm', $time );
	$jahr = date ( 'Y', $time );
}
$smarty->assign ( 'anzeige', array (
		'monat' => $monat,
		'jahr' => $jahr 
) );
$start = mktime ( 0, 0, 0, $monat, 1, $jahr );
$aside_date = $start;
$smarty->assign ( 'amonat', $start );
$smarty->assign ( 'vmonat', mktime ( 0, 0, 0, $monat - 1, 1, $jahr ) );
$smarty->assign ( 'nmonat', mktime ( 0, 0, 0, $monat + 1, 1, $jahr ) );
$ende = mktime ( 0, 0, 0, date ( 'm', $start ), date ( 't', $start ), date ( 'Y', $start ) );
$tage = array ();
for($t = 1; $t < date ( 't', $start ) + 1; $t ++)
	$tage [mktime ( 0, 0, 0, date ( 'm', $start ), $t, date ( 'Y', $start ) )] = array ();
	
	// Datenbank laden
$sql1 = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` BETWEEN $start AND $ende ORDER BY `ks_day` ASC;";
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
$smarty->assign ( 'tage', $tage );
$jahre = $monate = array ();
$sql = sprintf ( "SELECT * FROM $stuser WHERE `user_id` = '%s';", $_SESSION ['user_id'] );
$result = $sqldb->query ( $sql );
if ($result->num_rows == 1) {
	extract ( $result->fetch_assoc () );
}
for($j = date ( 'Y', $user_regdate ); $j < date ( 'Y' ) + 1; $j ++)
	$jahre [$j] = $j;
$smarty->assign ( 'jahre', $jahre );
for($m = 1; $m < 13; $m ++)
	$monate [$m] = $m;
$smarty->assign ( 'monate', $monate );
?>