<?php
session_start();
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ... | E_NOTICE)
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// setlocale ( LC_ALL, 'de_DE' ); // funktioniert nicht auf XAMPP-Server daher folgende Zeile
setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge'); // 'ge' nicht 'de'? 
require('include/funktionen.php');
if(!file_exists("config.php")) {
	include("kskinstall.php");
	exit();
}
require("config.php");

$footer_text = "Kopfschmerzkalender 1.2.0 &bull; &copy; 2014-2015 Lars Bleckwenn";

$stkstage = $table_prefix."kstage";
$stmedtag = $table_prefix."medtage";
$stmedis = $table_prefix."medis";
$stuser = $table_prefix."user";

$sqldb = @new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
require("include/smarty/Smarty.class.php");
require("include/Login.class.php");

//Manage Styles
$styles = array('initializr', 'desktop', 'mobil', 'bootstrap');
if(isset($_COOKIE['style']) && in_array($_COOKIE['style'], $styles)) {
	$style = $_COOKIE['style'];
} else {
	$style = 'initializr';
}

//Manage Seiten
$seiten = array('edit', 'monat', 'kalender', 'login', 'logout', 'auswertung', 'auswertung_pdfgen'); //  , 'import'
$seite = GetParam('seite','G',$seiten[0]);
$login = new loginCheck($sqldb, $table_prefix);
if(!$login->check_access(session_id())) $seite = 'login';
if($seite == 'logout') {
	$login->logout(session_id());
	setcookie('ksk_user','',time()- 3600);
	setcookie('ksk_pass','',time()- 3600);
}
if(!in_array($seite, $seiten)) $seite = $seiten[0];

// Template vorbereiten
$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->compile_dir = 'compile/';
$smarty->config_dir = "styles/".$style;
$smarty->template_dir = "styles/".$style."/templates/";
if($seite != 'logout') include("$seite.php");
$smarty->assign("seite", $seite);
$smarty->assign("style", $style);
$smarty->assign("footer_text", $footer_text);
$smarty->display('index.htpl',$style,$style);

?>
