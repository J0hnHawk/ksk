<?php
/**
 * This file is part of the "Kopfschmerzkalender" package.
 * Copyright (C) 2017 John Hawk <john.hawk@gmx.net>
 *
 * "NF Marsch Webstats" is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * "NF Marsch Webstats" is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Foobar. If not, see <http://www.gnu.org/licenses/>.
 */
session_start ();
define ( 'IN_KSK', true );
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
date_default_timezone_set('Europe/Lisbon');
// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ... | E_NOTICE)
error_reporting ( E_ERROR | E_WARNING | E_PARSE );
error_reporting ( E_ALL );
$ksk_version = "2.1.1";
setlocale ( LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge' );
require ("./config.php");
require ("./include/Login.class.php");
require ('./include/smarty/Smarty.class.php');
require ('./include/functions.php');

$db_days = $table_prefix . 'kstage';
$db_drugdays = $table_prefix . 'medtage';
$db_drugs = $table_prefix . 'medis';
$db_users = $table_prefix . 'user';
$db_styles = $table_prefix . 'styles';
$db_config = $table_prefix . 'config';
$sqldb = @new mysqli ( $dbhost, $dbuser, $dbpasswd, $dbname );

$smarty = new Smarty ();
// $smarty->setTemplateDir('./styles/bootstrap/templates');
// $smarty->setConfigDir('./styles/bootstrap/configs');
$smarty->debugging = false;

$smarty->assign ( 'ksk_version', $ksk_version );
$page = GetParam ( 'page', 'G', '' );
$pages = array (
		'account',
		'edit',
		'report',
		'report_pdf',
		'statistics',
		'u2p0',
		'drugs' 
);
$login = new loginCheck ( $sqldb, $table_prefix );

if ($login->check_access ( session_id () )) {
	if (! in_array ( $page, $pages ))
		$page = 'edit';
} else {
	if (isset ( $_COOKIE ['ksk_user'] )) {
		$user_name = $_COOKIE ['ksk_user'];
		$user_pass = $_COOKIE ['ksk_pass'];
		$success = $login->login ( $user_name, $user_pass, session_id (), true );
		if ($success) {
			$page = 'edit';
		} else
			$page = 'account';
	} else
		$page = 'account';
}
$smarty->assign ( 'page', $page );
$showpain = false;
include ('./include/' . $page . '.php');
// Seitenbanner Anfang
if (isset ( $_SESSION ['user'] )) {
	if ($_SESSION ['user'] ['user_showpain'])
		$showpain = true;
	$drugdays = drugdays ( isset ( $panel_month ) ? $panel_month : time () );
	$smarty->assign ( 'drugdays', $drugdays );
	if ($drugdays ['meditage'] >= $_SESSION ['user'] ['range2'])
		$showpain = true;
	$panel_color = 'panel-info';
	if ($drugdays ['meditage'] <= $_SESSION ['user'] ['range1'])
		$panel_color = 'panel-success';
	if ($drugdays ['meditage'] >= $_SESSION ['user'] ['range2'])
		$panel_color = 'panel-danger';
	$smarty->assign ( 'panel_type', $panel_color );
}
$smarty->assign ( 'showpain', $showpain );
// Seitenbanner Ende
$smarty->assign ( 'style', getStyle () );
$smarty->display ( 'index.tpl' );
//var_dump($_SESSION);