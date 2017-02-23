<?php
/**
 * 
 * @todo case 'edit': Die POST Variabeln müssen noch überprüft werden
 * @todo Registrierungs- und Passwortwiederherstellungsprozess funktioniert noch nicht
 * 
 * http://www.html-seminar.de/html-css-php-forum/board40-themenbereiche/board18-php/4634-einfache-datenbankklasse-erstellen/
 * https://www.php-einfach.de/experte/php-codebeispiele/loginscript/
 * https://www.php-einfach.de/experte/php-sicherheit/sql-injections/
 * https://www.php-einfach.de/mysql-tutorial/php-prepared-statements/
 * http://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824
 * http://www.mywebsolution.de/workshops/2/page_2/show_PHP-Loginsystem-User-registrieren.html
 * 
 *  
 */
require ("./include/notice.php");

$mode = GetParam ( 'mode', 'G' );
$modes = array (
		'login',
		'register',
		'password',
		'edit',
		'logoff' 
);
if (! in_array ( $mode, $modes )) {
	$mode = 'login';
}

$success = true;
$error = false;

if (isset ( $_SESSION ['user'] )) {
	// eingeloggt
	if ($mode == 'logoff') {
		$login->logout ( session_id () );
		setcookie ( 'ksk_user', '', time () - 3600 );
		setcookie ( 'ksk_pass', '', time () - 3600 );
		$_SESSION = array ();
		session_destroy ();
		$mode = 'login';
	} else {
		$message = $update = '';
		$sql = sprintf ( "SELECT * FROM %s WHERE %s = '%s';", $db_users, 'user_id', $_SESSION ['user'] ['user_id'] );
		$result = $sqldb->query ( $sql );
		if ($result->num_rows == 1) {
			$user = $result->fetch_assoc ();
			if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
				$requestVars = checkVars ( array (
						'email1' => '204;5UNGB;noarray,trim,notempty,email',
						'email2' => '203;85UGU;noarray,trim',
						'passwd1' => '203;DD3X9;noarray,trim',
						'passwd1' => '203;L5FC3;noarray,trim',
						'inputRangeSlider' => '203;QKHZY;noarray,trim,notempty',
						'showPain' => '203;W44UZ;noarray,bolean',
						'userStyle' => '203;MADC4;noarray,int' 
				) );
				extract ( $requestVars );
				if ($error) {
					$message = '<div class="alert alert-danger"><strong>Fehler:</strong> ' . $error . '</div>';
				} else {
					if ($user ['user_email'] != $email1) {
						if ($email1 != $email2) {
							$success = false;
							$message = '<div class="alert alert-danger"><strong>Fehler:</strong> Die E-Mail-Adressen stimmen nicht überein.</div>';
						} else {
							$email1 = $sqldb->real_escape_string ( $email1 );
							$update .= "user_email = '$email1', ";
							$user ['user_email'] = $email1;
						}
					}
					if ($passwd1 != '') {
						if ($passwd1 != $passwd2) {
							$success = false;
							$message .= '<div class="alert alert-danger"><strong>Fehler:</strong> Die Passwörter stimmen nicht überein.</div>';
						} else {
							$passwd1 = $sqldb->real_escape_string ( $passwd1 );
							$update .= "user_password = '" . md5 ( $passwd1 ) . "', ";
						}
					}
					if ($user ['user_autowarn'] != $inputRangeSlider) {
						$inputRangeSlider = $sqldb->real_escape_string ( $inputRangeSlider );
						$update .= "user_autowarn = '$inputRangeSlider', ";
						$user ['user_autowarn'] = $inputRangeSlider;
					}
					if ($user ['user_showpain'] != $showPain) {
						$showPain = $sqldb->real_escape_string ( $showPain );
						$update .= "user_showpain = '$showPain', ";
						$_SESSION ['user'] ['user_showpain'] = $showPain;
						$user ['user_showpain'] = $showPain;
					}
					if ($user ['user_style'] != $userStyle) {
						$userStyle = $sqldb->real_escape_string ( $userStyle );
						$update .= "user_style = '$userStyle', ";
						$_SESSION ['user'] ['user_style'] = $userStyle;
						$user ['user_style'] = $userStyle;
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
				}
			}
			list ( $range1, $range2 ) = explode ( ',', $user ['user_autowarn'] );
			$user ['range1'] = $range1;
			$user ['range2'] = $range2;
			$smarty->assign ( 'user', $user );
		} else {
			$message = '<div class="alert alert-danger"><strong>Fehler:</strong> Benutzerdatenbank inkonsistent!</div>';
		}
		$smarty->assign ( 'message', $message );
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
	}
} else {
	switch ($mode) {
		case 'login' :
			if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
				$requestVars = checkVars ( array (
						'userName' => '201;8LJGU;noarray,trim,notempty',
						'userPass' => '202;4GHWB;noarray,trim,notempty',
						'autologin' => '203;K6NXE;noarray,bolean' 
				) );
				extract ( $requestVars );
				if (! $error) {
					$success = $login->login ( $userName, $userPass, session_id () );
					if (! $success)
						$error = getMessage ( 206, 'EV9M5' );
				}
				if ($success) {
					if ($autologin == 'on') {
						setcookie ( 'ksk_user', $user_name, time () + (60 * 60 * 24 * 31) );
						setcookie ( 'ksk_pass', md5 ( $user_pass ), time () + (60 * 60 * 24 * 31) );
					}
					// if (strncasecmp ( PHP_OS, 'WIN', 3 ) == 0) {
					$target = $_SERVER ['REQUEST_SCHEME'] . '://' . $_SERVER ['HTTP_HOST'] . rtrim ( dirname ( $_SERVER ['SCRIPT_NAME'] ), '/' ) . '/index.php?page=edit';
					header ( 'Location: ' . $target, true, $_SERVER ['SERVER_PROTOCOL'] == 'HTTP/1.1' ? 303 : 302 );
					/*
					 * } else {
					 * header ( 'Location: http://ksk2.bleckwenn.net/index.php?page=edit', true, $_SERVER ['SERVER_PROTOCOL'] == 'HTTP/1.1' ? 303 : 302 );
					 * }
					 */
					exit ();
				} else {
					$smarty->assign ( 'login_failure', "<strong>Fehler!</strong> $error" );
				}
			}
			break;
		case 'register' :
			if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
				$requestVars = checkVars ( array (
						'inputUser' => '201;29YHV;noarray,trim,notempty,alphanum',
						'inputPassword' => '202;YWP9X;noarray,trim,notempty',
						'inputEmail' => '204;XXVXP;noarray,trim,notempty,email' 
				) );
				extract ( $requestVars );
				if ($error) {
					// @todo: hier muss noch was passieren
					$message = '<div class="alert alert-danger"><strong>Fehler:</strong> ' . $error . '</div>';
				} else {
					$inputUser = $sqldb->real_escape_string ( $inputUser );
					$inputEmail = $sqldb->real_escape_string ( $inputEmail );
					$sql = sprintf ( "SELECT * FROM %s WHERE user_name = '%s' ", $db_users, $inputUser );
					$result = $sqldb->query ( $sql );
					$rows = 0;
					if ($result->num_rows > 0) {
						$message = '<div class="alert alert-danger"><strong>Fehler:</strong> ' . getMessage ( 205, 'WDZMQ' ) . '</div>';
						$rows ++;
					}
					$sql = sprintf ( "SELECT * FROM %s WHERE user_email = '%s'", $db_users, $inputEmail );
					$result = $sqldb->query ( $sql );
					if ($result->num_rows > 0) {
						$message = '<div class="alert alert-danger"><strong>Fehler:</strong> ' . getMessage ( 207, 'E87DB' ) . '</div>';
						$rows ++;
					}
					if ($rows == 0) {
						$inputPassword = password_hash ( $sqldb->real_escape_string ( $inputPassword ), PASSWORD_DEFAULT );
						$format = 'INSERT INTO %s (user_name, user_email,user_password) VALUES ("%s", "%s", "%s")';
						$sql = sprintf ( $format, $db_users, $inputUser, $inputEmail, $inputPassword );
						if (! $result = $sqldb->query ( $sql )) {
							dbstat ( $result, $sql );
						}
					}
				}
				$smarty->assign ( 'message', $message );
				// $smarty->assign ( 'splash_message', '<h1>Fast geschafft...</h1><p>Zum Abschluss der Registrierung wurde eine E-Mail an folgende Adresse versandt:</p><blockquote><p>test@test.test</p></blockquote><p>Bitte rufe die in der E-Mail angegebene Adresse in deinem Browser auf.</p>' );
			}
			break;
		case 'password' :
			if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
				$smarty->assign ( 'show_login', 'hide' );
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
						$splash_message = "<h1>E-Mail-Adresse existiert nicht&hellip;</h1><p>Die E-Mail-Adresse</p><blockquote><p>$email</p></blockquote><p>ist in keinem Benutzerkonto hinterlegt.</p>";
					}
				} else {
					$splash_message = "<h1>E-Mail-Adresse ungültig</h1><p>Die eingegebene E-Mail-Adresse ist ungültig. Bitte versuche es erneut.</p>";
				}
			}
			break;
	}
}
$smarty->assign ( 'mode', $mode );
$smarty->assign ( 'template', 'account.htpl' );
