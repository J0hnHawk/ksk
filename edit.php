<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	//Kopfschmerztag abfragen
	$fehler = '';
	$tag = GetParam('datum');
	if($tag=='') $fehler .= 'Es wurde kein Datum eingegeben.<br>';
	elseif(!check_date($tag,"dmY",".")) $fehler .= 'Es wurde ein ungültiges Datum eingegeben.<br>';
	//Welches Formular wurde abgeschickt
	$action = GetParam('forumlar', 'P', 'speichern');
	switch($action) {
		case 'datum':
			if($fehler) $smarty->assign('fehler', $fehler);
			else {
				$ks_arten = array('m' => 'Migräne', 's' => 'Spannungskopfschmerz', 'u' => 'unklar');
				$smarty->assign('ks_arten', $ks_arten);
				$sql = "SELECT * FROM `$stmedis` ORDER BY med_name ASC";
				$result = $sqldb->query($sql);
				$medikamente = array();
				while ($medikament = $result->fetch_assoc()) {
					extract($medikament);
					$medikamente[$med_id] = $med_name;
				}
				$smarty->assign("medikamente",$medikamente);
				for($s1=0;$s1<5;$s1++) $grad[$s1] = $s1;
				$smarty->assign("grad",$grad);
				list($d,$m,$y) = explode('.', $tag);
				$ks_day = mktime(0,0,0,$m,$d,$y);
				$smarty->assign('ks_day', $ks_day);
				$sql = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` = $ks_day;";
				$result = $sqldb->query($sql);
				if($result->num_rows == 1) {
					$ks_tag = $result->fetch_assoc();
					for($i=0;$i<strlen($ks_tag['ks_art']);$i++) {
						$ks_art[] = substr($ks_tag['ks_art'], $i, 1);
					}
					$smarty->assign('ks_art', $ks_art);
					$sql = sprintf("SELECT * FROM `$stmedtag` WHERE `ks_id` = %s;", $ks_tag['ks_id']);
					$result = $sqldb->query($sql);
					$medikamente = array();
					while ($medistag = $result->fetch_assoc()) {
						$medikamente[] = $medistag['med_id'];
					}
					$smarty->assign('ks_medis', $medikamente);
					$smarty->assign('ks_grad', $ks_tag['ks_grad']);
					$smarty->assign('ks_info', $ks_tag['ks_info']);
					$smarty->assign('ks_lastchange', $ks_tag['ks_lastchange']);
				}
			}
			break;
		case 'speichern':
			if(GetParam('button')=="Eintrag speichern") {
			//**** Formular auslesen
			//* 2. Kopfschmerzart
			$art = GetParam('art');
			//if(!is_array($art)) $fehler .= 'Die Kopfschmerzart wurde nicht angegeben.<br>';
			//* 3. Medikament(e)
			$med = GetParam('medikament');
			//* 4. Schmerzgrad
			$ks_grad = GetParam('graduierung','P',-1);
			//if($ks_grad=='') $fehler .= 'Es wurde keine Graduierung des Schmerzes angegeben.';
			//* 5. Zusätliche Informationen
			$ks_info = htmlentities(GetParam('info'),ENT_QUOTES);
			if($fehler) $smarty->assign('fehler', $fehler);
			else {
				//**** Daten zusammenstellen
				//* 2. KS-Tag als Unixtimestamp
				list($d,$m,$y) = explode('.', $tag);
				$ks_day = mktime(0,0,0,$m,$d,$y);
				//* 3. KS-Art(en) als String
				$ks_art = '';
				if(is_array($art)) foreach($art as $value) $ks_art .= $value;
				//* 4. Schon Daten für Tag & User vorhanden?
				$sql = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` = $ks_day;";
				$result = $sqldb->query($sql);
				//**** Daten in Datenbank eintragen/aktualisieren
				if($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					$ks_id = $row['ks_id'];
					$sql = sprintf("UPDATE $stkstage SET `ks_art` = '$ks_art', `ks_grad` = '$ks_grad', `ks_info` = '$ks_info', `ks_lastchange` = '%s' WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` = $ks_day;", time());
					$result = $sqldb->query($sql);
				} else {
					$sql = sprintf("INSERT INTO `$stkstage` (`user_id`, `ks_day`, `ks_art`, `ks_grad`, `ks_info`, `ks_lastchange`) VALUES ({$_SESSION['user_id']}, $ks_day, '$ks_art', $ks_grad, '$ks_info', %s);", time());
					$result = $sqldb->query($sql);
					$ks_id = $sqldb->insert_id;
				}
				$sql = "DELETE FROM `$stmedtag` WHERE `ks_id` = $ks_id;";
				$result = $sqldb->query($sql);
				if(is_array($med)) {
					$values = '';
					foreach($med as $med_id) $values .= "(NULL , $ks_id, $med_id), ";
					$values = substr($values, 0, -2);
					$sql = "INSERT INTO `$stmedtag` (`medtag_id`, `ks_id`, `med_id`) VALUES $values;";
					$result = $sqldb->query($sql);
				}
				$smarty->assign('success', "Daten erfolgreich gespeichert.");
			}
			} else {
				list($d,$m,$y) = explode('.', $tag);
				$ks_day = mktime(0,0,0,$m,$d,$y);
				$sql = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` = $ks_day;";
				$result = $sqldb->query($sql);
				if($result->num_rows == 1) {					
					$ks_tag = $result->fetch_assoc();
					$sql = sprintf("DELETE FROM $stkstage WHERE `ks_id` = %s;", $ks_tag['ks_id']);
					$result = $sqldb->query($sql);
					$sql = sprintf("DELETE FROM `$stmedtag` WHERE `ks_id` = %s;", $ks_tag['ks_id']);
					$result = $sqldb->query($sql);
				}
				$smarty->assign('success', "Daten erfolgreich gelöscht.");
				#DELETE FROM `ksk`.`ksk_kstage` WHERE `ksk_kstage`.`ks_id` = 144
			}
			break;
	}

} else {
	$ks_arten = array('m' => 'Migräne', 's' => 'Spannungskopfschmerz', 'u' => 'unklar');
	$smarty->assign('ks_arten', $ks_arten);
	$sql = "SELECT * FROM `$stmedis` ORDER BY med_name ASC";
	$result = $sqldb->query($sql);
	$medikamente = array();
	if($result->num_rows > 1) {
		while ($medikament = $result->fetch_assoc()) {
			extract($medikament);
			$medikamente[$med_id] = $med_name;
		}
	}
	$smarty->assign("medikamente",$medikamente);
	for($s1=0;$s1<5;$s1++) $grad[$s1] = $s1;
	$smarty->assign("grad",$grad);
	$ks_day = GetParam('date', 'G', mktime(0,0,0));
	$smarty->assign('amonat', $ks_day);
	$smarty->assign('ks_day', $ks_day);
	$sql = "SELECT * FROM $stkstage WHERE `user_id` = {$_SESSION['user_id']} AND `ks_day` = $ks_day;";
	$result = $sqldb->query($sql);
	if($result->num_rows == 1) {
		$ks_tag = $result->fetch_assoc();
		for($i=0;$i<strlen($ks_tag['ks_art']);$i++) {
			$ks_art[] = substr($ks_tag['ks_art'], $i, 1);
		}
		$smarty->assign('ks_art', $ks_art);
		$sql = sprintf("SELECT * FROM `$stmedtag` WHERE `ks_id` = %s;", $ks_tag['ks_id']);
		$result = $sqldb->query($sql);
		$medikamente = array();
		if($result->num_rows != 0) {
			while ($medistag = $result->fetch_assoc()) {
				$medikamente[] = $medistag['med_id'];
			}
		}
		$smarty->assign('ks_medis', $medikamente);
		$smarty->assign('ks_grad', $ks_tag['ks_grad']);
		$smarty->assign('ks_info', $ks_tag['ks_info']);
		$smarty->assign('ks_lastchange', $ks_tag['ks_lastchange']);
	}
}
$meditage = meditage($ks_day);
$smarty->assign('meditage', $meditage);
if($meditage['meditage'] > 8) $smarty->assign('warning', 1); else $smarty->assign('warning', 0);

?>