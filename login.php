<?php
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	$user_name = GetParam ( 'user_name' );
	$user_pass = GetParam ( 'user_pass' );
	$autologin = GetParam ( 'autologin' );
	$success = $login->login ( $user_name, $user_pass, session_id () );
	if ($success) {
		if ($autologin == 'on') {
			setcookie ( 'ksk_user', $user_name, time () + (60 * 60 * 24 * 31) );
			setcookie ( 'ksk_pass', md5 ( $user_pass ), time () + (60 * 60 * 24 * 31) );
		}
		$seite = $seiten [0];
		$_SERVER ['REQUEST_METHOD'] = '';
		include ("$seite.php");
	} else {
		$smarty->assign ( 'error', true );
	}
}
if (isset ( $_COOKIE ['ksk_user'] )) {
	$user_name = $_COOKIE ['ksk_user'];
	$user_pass = $_COOKIE ['ksk_pass'];
	$success = $login->login ( $user_name, $user_pass, session_id (), true );
	if ($success) {
		$seite = $seiten [0];
		$_SERVER ['REQUEST_METHOD'] = '';
		include ("$seite.php");
	}
}