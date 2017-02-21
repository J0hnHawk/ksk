<?php
require ("./config.php");
require ('./functions.php');

$stkstage = $table_prefix . "kstage";
$stmedtag = $table_prefix . "medtage";
$stmedis = $table_prefix . "medis";
$stuser = $table_prefix . "user";
$sqldb = @new mysqli ( $dbhost, $dbuser, $dbpasswd, $dbname );

switch (GetParam ( 'mode', 'G' )) {
	case 'savedrug' :
		var_dump ( $_POST );
		
		break;
	case 'getdrug' :
		$drug_id = GetParam ( 'drug_id', 'G' );
		$sql = "SELECT * FROM `ksk_medis` WHERE `med_id` = $drug_id";
		$result = $sqldb->query ( $sql );
		if ($result->num_rows > 0) {
			extract ( $result->fetch_assoc () );
			echo json_encode ( array (
					"error" => "0",
					"med_id" => $med_id,
					"med_name" => $med_name,
					"med_short" => $med_shortname,
					"med_doses" => explode ( ";", $med_doses ),
					"med_type" => $med_type,
					"med_show" => $med_show 
			) );
		} else {
			echo json_encode ( array (
					"error" => "1" 
			) );
		}
		break;
}