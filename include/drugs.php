<?php
require ("./include/notice.php");
$error = $info = $success = '';
$mode = GetParam ( 'mode', 'G', 'list' );
$modes = array (
		'list',
		'edit',
		'delete' 
);
if (! in_array ( $mode, $modes )) {
	$error .= get_message ( 'F14' );
	$mode = 'list';
}
$sql = "SELECT * FROM `$db_drugs` WHERE user_id='{$_SESSION['user']['user_id']}' ORDER BY med_name ASC";
$result = $sqldb->query ( $sql );
$medikamente = array ();
if ($result->num_rows > 0) {
	while ( $medikament = $result->fetch_assoc () ) {
		extract ( $medikament );
		$sql = "SELECT * FROM `$db_drugdays` WHERE med_id = $med_id";
		$medtag = $sqldb->query ( $sql );
		$medikament ['med_used'] = $medtag->num_rows;
		$medikamente [$med_id] = $medikament;
	}
}
switch ($mode) {
	case 'edit' :
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$med_id = GetParam ( 'hiddenId', 'P' );
			$med_name = GetParam ( 'inputName', 'P' );
			$med_shortname = GetParam ( 'inputShort', 'P' );
			$med_doses = GetParam ( 'hiddenDoses', 'P' );
			$med_type = GetParam ( 'radioType', 'P' );
			$med_show = GetParam ( 'radioShow', 'P' );
			$med_allfields = compact ( 'med_id', 'med_type', 'med_show', 'med_name', 'med_shortname', 'med_doses' );
			$med_numfields = compact ( 'med_id', 'med_type', 'med_show' );
			$oneisarray = $oneisnotnumeric = false;
			foreach ( $med_allfields as $field )
				if (is_array ( $field ))
					$oneisarray = true;
			foreach ( $med_numfields as $field )
				if (! is_numeric ( $field ))
					$oneisnotnumeric = true;
			if ($oneisarray || $oneisnotnumeric) {
				$error .= get_message ( 'F16' );
				$mode = 'list';
			}
			if (! $error) {
				$med_name = htmlspecialchars ( strip_tags ( $med_name ), ENT_QUOTES );
				$med_shortname = htmlspecialchars ( strip_tags ( $med_shortname ), ENT_QUOTES );
				$med_doses = htmlspecialchars ( strip_tags ( $med_doses ), ENT_QUOTES );
				$med_doses = substr ( $med_doses, 0, - 1 );
				$new_id = (($med_id == "-1") ? sizeof ( $medikamente ) : $med_id) + 0;
				$medikamente [$new_id] = compact ( 'med_type', 'med_show', 'med_name', 'med_shortname', 'med_doses' );
				$medikamente [$new_id] ['med_id'] = $new_id;
				if (empty ( $med_shortname )) {
					$med_shortname = kurzname ( $medikamente, $new_id );
				}
				foreach ( $medikamente as $key => $medikament ) {
					if ($medikament ['med_shortname'] == $med_shortname) {
						if ($key != $new_id) {
							$error .= get_message ( 'F19' );
						}
					}
				}
			}
			if (! $error) {
				$mode = 'list';
				if ($med_id != - 1) {
					$format = "UPDATE $db_drugs SET `med_name` = '%s', `med_shortname` = '%s', `med_type` = '%s', `med_show` = '%s', `med_doses` = '%s' WHERE `med_id` = %s;";
					$sql = sprintf ( $format, $med_name, $med_shortname, $med_type, $med_show, $med_doses, $med_id );
					if (! $result = $sqldb->query ( $sql )) {
						$error .= get_message ( 'F17' );
					}
				} else {
					$format = "INSERT INTO `$db_drugs` (`user_id`, `med_name`, `med_shortname`, `med_type`, `med_show`, `med_doses`) VALUES (%s,'%s','%s',%s,%s,'%s');";
					$sql = sprintf ( $format, $_SESSION ['user'] ['user_id'], $med_name, $med_shortname, $med_type, $med_show, $med_doses );
					if (! $result = $sqldb->query ( $sql )) {
						$error .= get_message ( 'F18' );
					}
				}
				$success .= "Medikament gespeichert.";
			}
			if ($error) {
				$dosen = explode ( ';', $med_doses );
				$medikament = compact ( 'med_id', 'med_type', 'med_show', 'med_name', 'med_shortname', 'med_doses' );
				$medikament ['med_doses'] = $dosen;
				$smarty->assign ( 'medikament', $medikament );
			}
		} else {
			$med_id = GetParam ( 'medid', 'G', - 1 );
			if (is_array ( $med_id ) || ! is_numeric ( $med_id )) {
				$error .= get_message ( 'F13' );
				$mode = 'list';
			}
			if (! $error && $med_id != - 1) {
				if (isset ( $medikamente [$med_id] )) {
					$medikament = $medikamente [$med_id];
					if ($medikament ['med_doses'])
						$dosen = explode ( ';', $medikament ['med_doses'] );
					else
						$dosen = array ();
					$medikament ['med_doses'] = $dosen;
					$smarty->assign ( 'medikament', $medikament );
				} else {
					$error .= get_message ( 'F15' );
					$mode = 'list';
				}
			}
		}
		break;
	case 'delete' :
		$mode = 'list';
		$med_id = GetParam ( 'medid', 'G' );
		if (is_array ( $med_id ))
			$error .= get_message ( 'F20' );
		if (! is_numeric ( $med_id ))
			$error .= get_message ( 'F21' );
		if (! $error)
			if (htmlspecialchars ( strip_tags ( $med_id ), ENT_QUOTES ) != $med_id)
				$error .= get_message ( 'F22' );
		if ($medikamente [$med_id] ['med_used'] > 0)
			$error .= get_message ( 'F24' );
		if (! $error) {
			$format = "SELECT * FROM $db_drugs WHERE `user_id` = %s AND `med_id` = %s;";
			$sql = sprintf ( $format, $_SESSION ['user'] ['user_id'], $med_id );
			$result = $sqldb->query ( $sql );
			if ($result->num_rows == 1) {
				$medikament = $result->fetch_assoc ();
				$sql = sprintf ( "DELETE FROM $db_drugs WHERE `med_id` = %s;", $med_id );
				$result = $sqldb->query ( $sql );
				$success .= "Das Medikament '{$medikament['med_name']}' wurde gelöscht";
				unset ( $medikamente [$med_id] );
			} else {
				$error .= get_message ( 'F23' );
			}
		}
		break;
}
$smarty->assign ( 'medikamente', $medikamente );
$smarty->assign ( 'mode', $mode );
if ($info)
	$smarty->assign ( 'info', $info );
if ($error)
	$smarty->assign ( 'error', $error );
elseif ($success)
	$smarty->assign ( 'success', $success );
$smarty->assign ( 'template', 'drugs.tpl' );