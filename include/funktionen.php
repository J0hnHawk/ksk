<?php
function GetParam($ParamName, $Method = "P", $DefaultValue = "") {
	if ($Method == "P") {
		if (isset($_POST[$ParamName])) return $_POST[$ParamName]; else return $DefaultValue;
	} else if ($Method == "G") {
		if (isset($_GET[$ParamName])) return $_GET[$ParamName]; else return $DefaultValue;
	} else if ($Method == "S") {
		if (isset($_SERVER[$ParamName])) return $_SERVER[$ParamName]; else return $DefaultValue;
	} else if ($Method == "Z") {
		if (isset($_SESSION[$ParamName])) return $_SESSION[$ParamName]; else return $DefaultValue;
	}
}
function check_date($date,$format,$sep){
	$pos1    = strpos($format, 'd');
	$pos2    = strpos($format, 'm');
	$pos3    = strpos($format, 'Y');
	$check    = explode($sep,$date);
	return checkdate($check[$pos2],$check[$pos1],$check[$pos3]);
}
# Reportfunktion zur Fehlerfindung
function dbstat($result,$sql, $alles = true) {
	echo((($alles)?"\"".$sql."\"<br>":"")."verarbeitet? ".(($result)?"ja":"nein")."<br>");
}
function meditage($monat) {
	if(!$_SESSION['user_id']) return false;
	global $sqldb, $stkstage, $stmedtag;
	$start = mktime(0,0,0,date('m',$monat),1,date('Y',$monat));
	$ende = mktime(0,0,0,date('m',$start),date('t',$start),date('Y',$start));
	$sql1 = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` BETWEEN $start AND $ende ORDER BY `ks_day` ASC;";
	$result1 = $sqldb->query($sql1);
	$kstage = $meditage = 0;
	while ($ks_tag = $result1->fetch_assoc()) {
		$ks_day = $ks_tag['ks_day'];
		if($ks_tag['ks_art']!='') $kstage++;
		$sql2 = sprintf("SELECT * FROM `$stmedtag` WHERE `ks_id` = %s;", $ks_tag['ks_id']);
		$result2 = $sqldb->query($sql2);
		if($result2->num_rows > 0) $meditage++;
	}
	return array('kstage' => $kstage, 'meditage' => $meditage);
}

?>
