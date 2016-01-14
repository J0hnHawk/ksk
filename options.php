<?php
$action = GetParam ( 'action', 'G', 'profil' );
$smarty->assign ( 'action', $action );
switch ($action) {
	case 'profil' :
		$sql = sprintf ( "SELECT * FROM %s WHERE %s = '%s';", 'ksk_user', 'user_id', $_SESSION ['user_id'] );
		$result = $sqldb->query ( $sql );
		$current_user = $result->fetch_assoc ();
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$error = $update = $success = false;
			// geänderter Benutzername?
			$user_name = GetParam ( 'user' );
			if ($user_name != $current_user ['user_name']) {
				$sql = sprintf ( "SELECT * FROM ksk_user WHERE user_name = '%s' AND user_id != %s;", $user_name, $_SESSION ['user_id'] );
				$result = $sqldb->query ( $sql );
				if ($result->num_rows == 1) {
					$error .= "Benutzername bereits vorhanden\n";
				} else {
					$update .= "user_name = '$user_name', ";
				}
			}
			// geänderte E-Mail Adresse?
			$user_email = GetParam ( 'user_email' );
			$email_confirm = GetParam ( 'email_confirm' );
			if ($user_email != $current_user ['user_email'] && $user_email == $email_confirm) {
				$update .= "user_email = '$user_email', ";
			} elseif ($email_confirm != '') {
				$error .= "E-Mail-Adressen stimmen nicht überein\n";
			}
			// geändertes Passwort
			$new_password = GetParam ( 'new_password' );
			$password_confirm = GetParam ( 'password_confirm' );
			if ($new_password != '' && $new_password == $password_confirm) {
				if (strlen ( $new_password ) < 7) {
					$error .= "Das Passwort ist zu kurz\n";
				} else {
					$update .= sprintf ( "user_password = '%s', ", md5 ( $new_password ) );
				}
			} elseif ($new_password != '') {
				$error .= "Passwörter stimmen nicht überein\n";
			}
			// Fehler ausgeben oder Änderungen speichern
			if (! $error) {
				if (! $update)
					$success = 'Es wurden keine Daten geändert.';
				else {
					$sql = sprintf ( "UPDATE %s SET %s WHERE user_id = '%s';", 'ksk_user', substr ( $update, 0, - 2 ), $_SESSION ['user_id'] );
					$result = $sqldb->query ( $sql );
					$success = 'Die Daten wurden erfolgreich geändert.';
				}
			}
		} else {
			$smarty->assign ( 'user', $current_user ['user_name'] );
			$smarty->assign ( 'user_email', $current_user ['user_email'] );
		}
		break;
	case 'medis' :
		// Medikamente laden
		$sql = "SELECT * FROM `$stmedis` ORDER BY med_name ASC";
		$result = $sqldb->query ( $sql );
		$medikamente = array ();
		if ($result->num_rows > 0) {
			while ( $medikament = $result->fetch_assoc () ) {
				extract ( $medikament );
				$sql = "SELECT * FROM `$stmedtag` WHERE med_id = $med_id";
				$medtag = $sqldb->query ( $sql );
				$medikament ['med_used'] = $medtag->num_rows;
				$medikamente [$med_id] = $medikament;
			}
		}
		$smarty->assign ( "medikamente", $medikamente );
		$todo = GetParam ( 'todo', 'G', '' );
		$smarty->assign ( 'todo', $todo );
		$med_id = GetParam ( 'med_id', 'G', '' );
		switch ($todo) {
			case 'edit' :
				$smarty->assign ( 'med', $medikamente [$med_id] );
			case 'new' :
				if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
					$med_form = GetParam ( 'med' );
					if ($med_form ['med_id']) {
						// update
						$sql = sprintf ( "UPDATE %s SET `med_name` = '%s', `med_dosis` = '%s', `med_type` = %s, `med_show` = %s, `med_user` = %s, `med_other` = 0 WHERE `med_id` = %s;", $stmedis, $med_form ['med_name'], $med_form ['med_dosis'], $med_form ['med_type'], $med_form ['med_show'], $_SESSION ['user_id'], $med_form ['med_id'] );
						$success = "Der Datenbankeintrag für das Medikament '{$med_form ['med_name']}' wurde geändert.<br>";
					} else {
						// insert
						$sql = sprintf ( "INSERT INTO `%s` (`med_name`, `med_dosis`, `med_type`, `med_show`, `med_user`) VALUES ('%s', '%s', %s, %s, %s);", $stmedis, $med_form ['med_name'], $med_form ['med_dosis'], $med_form ['med_type'], $med_form ['med_show'], $_SESSION ['user_id'] );
						$success = "Das Medikament '{$med_form ['med_name']}' wurde der Datenbank hinzugefügt.<br>";
					}
					if ($sqldb->query ( $sql )) {
						$success .= '<a href="index.php?seite=options&amp;action=medis">zurück</a>';
					} else {
						$success = '';
						$error = 'Das Speichern in der Datenbank schlug fehl!<br><a href="index.php?seite=options&amp;action=medis">zurück</a>';
					}
				}
				break;
			case 'del' :
				$confirm = GetParam ( 'confirm', 'G' );
				if ($confirm) {
					// Code zum Löschen
					$sql = "DELETE FROM `$stmedis` WHERE `med_id` = $med_id;";
					if ($sqldb->query ( $sql )) {
						$success = 'Das Medikament ' . $medikamente [$med_id] ['med_name'] . ' wurde aus der Datenbank gelöscht.<br>';
						$success .= '<a href="index.php?seite=options&amp;action=medis">zurück</a>';
					} else {
						$error = 'Das Löschen des Medikaments in der Datenbank schlug fehl!<br><a href="index.php?seite=options&amp;action=medis">zurück</a>';
					}
				} else {
					$error = 'Soll das Medikament "' . $medikamente [$med_id] ['med_name'] . '" wirklich aus der Datenbank gelöscht werden?<br>';
					$error .= '<a href="index.php?seite=options&amp;action=medis&amp;med_id=' . $med_id . '&amp;todo=del&amp;confirm=1">Ja</a> ';
					$error .= '<a href="index.php?seite=options&amp;action=medis">Nein</a>';
				}
				break;
		}
		break;
}
$smarty->assign ( 'error', nl2br ( $error ) );
$smarty->assign ( 'success', $success );
