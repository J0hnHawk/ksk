<?php
$mode = GetParam ( 'mode', 'G', '' );
$modes = array (
		'splash',
		'login',
		'logoff',
		'register',
		'password',
		'edit',
		'drugs' 
);
if (! in_array ( $mode, $modes ) || ! isset ( $_SESSION ['user'] ) && $mode != 'login' && $mode != 'register' && $mode != 'password')
	$mode = 'splash';
$smarty->assign ( 'mode', $mode );
switch ($mode) {
	case 'splash' :
		$_SESSION = array ();
		session_destroy ();
		$smarty->assign ( 'show_login', 'show' );
		$smarty->assign ( 'splash_message', '<h2>Kopfschmerzkalender<br><small>Bitte melde dich an.</small></h2>' );
		$template = "splash.htpl";
		break;
	case 'logoff' :
		$login->logout ( session_id () );
		setcookie ( 'ksk_user', '', time () - 3600 );
		setcookie ( 'ksk_pass', '', time () - 3600 );
		$_SESSION = array ();
		session_destroy ();
		$smarty->assign ( 'show_login', 'hide' );
		$smarty->assign ( 'splash_message', '<h1>Tschüss ;-)</h1>' );
		$template = "splash.htpl";
		break;
	case 'login' :
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$user_name = GetParam ( 'inputUser' );
			$user_pass = GetParam ( 'inputPassword' );
			$autologin = GetParam ( 'checkboxAutologin' );
			$success = $login->login ( $user_name, $user_pass, session_id () );
			if ($success) {
				if ($autologin == 'on') {
					setcookie ( 'ksk_user', $user_name, time () + (60 * 60 * 24 * 31) );
					setcookie ( 'ksk_pass', md5 ( $user_pass ), time () + (60 * 60 * 24 * 31) );
				}
				if (strncasecmp ( PHP_OS, 'WIN', 3 ) == 0) {
					$target = $_SERVER ['REQUEST_SCHEME'] . '://' . $_SERVER ['HTTP_HOST'] . rtrim ( dirname ( $_SERVER ['SCRIPT_NAME'] ), '/' ) . '/index.php?page=edit';
					header ( 'Location: ' . $target, true, $_SERVER ['SERVER_PROTOCOL'] == 'HTTP/1.1' ? 303 : 302 );
				} else {
					header ( 'Location: http://ksk2.bleckwenn.net/index.php?page=edit', true, $_SERVER ['SERVER_PROTOCOL'] == 'HTTP/1.1' ? 303 : 302 );
				}
				exit ();
			} else {
				$smarty->assign ( 'show_login', 'show' );
				$smarty->assign ( 'splash_message', '<h2>Kopfschmerzkalender<br><small>Bitte melde dich an.</small></h2>' );
				$smarty->assign ( 'login_failure', '<strong>Fehler!</strong> Der Benutzername oder das Passwort ist falsch!' );
				$template = "splash.htpl";
			}
		}
		break;
	case 'password' :
		// if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
		$smarty->assign ( 'show_login', 'hide' );
		$template = "splash.htpl";
		$email = GetParam ( 'inputEmail' );
		if (filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
			$format = "SELECT * FROM $db_users WHERE user_email = '%s';";
			$sql = sprintf ( $format, $email );
			$result = $sqldb->query ( $sql );
			if ($result->num_rows == 1) {
				$user = $result->fetch_assoc ();
				$empfaenger = $email;
				$betreff = "Neues Passwort für den Kopfschmerzkalender";
				$from = "From: KSK-Admin <admin@ksk.bleckwenn.net>\n";
				$from .= "Reply-To: admin@ksk.bleckwenn.net\n";
				$from .= "Content-Type: text/html\n";
				$format = '<p>Hallo %s!</p><p>Jemand hat kürzlich darum gebeten, dein Passwort für den Kopfschmerzkalender zurückzusetzen.</p><p><a href="%s">Klicke hier, um dein Passwort zu ändern.</a></p><p><b>Du hast diese Änderung nicht beantragt?</b><br>Falls du kein neues Passwort beantragt hast, <a href="%s">teile uns das umgehend mit.</a></p>';
				$text = sprintf ( $format, $user ['user_name'], md5 ( time () ), '#' );
				if (mail ( $empfaenger, $betreff, $text, $from )) {
					$splash_message = "<h1>E-Mail versandt&hellip;</h1><p>An die E-Mail-Adresse</p><blockquote><p>$email</p></blockquote><p>wurde eine E-Mail versandt. Bitte folge den Anweisungen in der E-Mail.</p>";
				} else {
					$splash_message = "<h1>E-Mail nicht versandt&hellip;</h1><p>Beim Versand an die E-Mail-Adresse</p><blockquote><p>$email</p></blockquote><p>traten Probleme auf. Bitte versuche es später noch einmal.</p>";
				}
			} else {
				$splash_message = "<h1>E-Mail existiert nicht&hellip;</h1><p>Die E-Mail-Adresse</p><blockquote><p>$email</p></blockquote><p>ist in keinem Benutzerkonto hinterlegt.</p>";
			}
		} else {
			$splash_message = "<h1>E-Mail-Adresse ungültig</h1><p>Die eingegebene E-Mail-Adresse ist ungültig. Bitte versuche es erneut.</p>";
		}
		$smarty->assign ( 'splash_message', $splash_message );
		// }
		break;
	case 'register' :
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			
			$smarty->assign ( 'show_login', 'hide' );
			$smarty->assign ( 'splash_message', '<h1>Fast geschafft...</h1><p>Zum Abschluss der Registrierung wurde eine E-Mail an folgende Adresse versandt:</p><blockquote><p>test@test.test</p></blockquote><p>Bitte rufe die in der E-Mail angegebene Adresse in deinem Browser auf.</p>' );
			$template = "splash.htpl";
		}
		break;
	case 'edit' :
		$sql = sprintf ( "SELECT * FROM %s WHERE %s = '%s';", $db_users, 'user_id', $_SESSION ['user'] ['user_id'] );
		$result = $sqldb->query ( $sql );
		if ($result->num_rows == 1)
			$user = $result->fetch_assoc ();
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$email1 = GetParam ( 'inputEmail' );
			$email2 = GetParam ( 'inputEmail2' );
			$passwd1 = GetParam ( 'inputPassword' );
			$passwd2 = GetParam ( 'inputPassword2' );
			$range = GetParam ( 'inputRangeSlider' );
			$showpain = GetParam ( 'radioShowPain' );
			$userstyle = GetParam ( 'selectStyle' );
			$success = true;
			$message = $update = '';
			if ($user ['user_email'] != $email1) {
				if ($email1 != $email2) {
					$success = false;
					$message = '<div class="alert alert-danger"><strong>Fehler:</strong> Die E-Mail-Adressen stimmen nicht überein.</div>';
				} else
					$update .= "user_email = '$email1', ";
			}
			if ($passwd1 != '') {
				if ($passwd1 != $passwd2) {
					$success = false;
					$message .= '<div class="alert alert-danger"><strong>Fehler:</strong> Die Passwörter stimmen nicht überein.</div>';
				} else
					$update .= "user_password = '" . md5 ( $passwd1 ) . "', ";
			}
			if ($user ['user_autowarn'] != $range)
				$update .= "user_autowarn = '$range', ";
			if ($user ['user_showpain'] != $showpain) {
				$update .= "user_showpain = '$showpain', ";
				$_SESSION ['user'] ['user_showpain'] = $showpain;
			}
			if ($user ['user_style'] != $userstyle) {
				$update .= "user_style = '$userstyle', ";
				$_SESSION ['user'] ['user_style'] = $userstyle;
			}
			if ($success) {
				if (! $update) {
					$message .= '<div class="alert alert-info"><strong>Info:</strong> Es wurden keine Daten geändert.</div>';
				} else {
					$sql = sprintf ( "UPDATE %s SET %s WHERE user_id = '%s';", $db_users, substr ( $update, 0, - 2 ), $_SESSION ['user'] ['user_id'] );
					$result = $sqldb->query ( $sql );
					$message .= '<div class="alert alert-success"><strong>Erfolg:</strong> Die geänderten Daten wurden gespeichert.</div>';
				}
			}
			$smarty->assign ( 'message', $message );
		}
		$sql = sprintf ( "SELECT * FROM %s WHERE %s = '%s';", $db_users,  'user_id', $_SESSION ['user'] ['user_id'] );
		$result = $sqldb->query ( $sql );
		if ($result->num_rows == 1)
			$user = $result->fetch_assoc ();
		list ( $range1, $range2 ) = explode ( ',', $user ['user_autowarn'] );
		$user ['range1'] = $range1;
		$user ['range2'] = $range2;
		$smarty->assign ( 'user', $user );
		$sql = "SELECT * FROM `$db_styles` ORDER BY style_name ASC";
		$result = $sqldb->query ( $sql );
		$styles = array ();
		if ($result->num_rows > 0) {
			while ( $style = $result->fetch_assoc () ) {
				$styles [$style ['style_id']] = $style ['style_name'];
			}
		}
		$smarty->assign ( 'styles', $styles );
		$smarty->assign ( 'default_style', getConfigValue ( 'override_user_style' ) );
		$template = "account.htpl";
		break;
}
$smarty->assign ( 'template', $template );
