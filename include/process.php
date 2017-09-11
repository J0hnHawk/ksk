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

if (! defined ( 'IN_KSK' )) {
	exit ();
}

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