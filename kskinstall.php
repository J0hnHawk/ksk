<?php
// Bis Installationsprogramm fertig DB-Daten erstmal so
$dbhost = "db2586.1und1.de";
$dbport = "";
$dbname = "db333987688";
$dbuser = "dbo333987688";
$dbpasswd = "L@r$:6W!";
$table_prefix = "ksk_";

// Bis Installationsprogramm fertig DB-Daten erstmal so
// $dbhost = "127.0.0.1";
// $dbport = "";
// $dbname = "ksk";
// $dbuser = "root";
// $dbpasswd = "";
// $table_prefix = "ksk_";

// config.php schreiben
$fp = fopen ( "config.php", "w" );
fwrite ( $fp, "<?php\n" );
fwrite ( $fp, "// KSK auto-generated configuration file\n" );
fwrite ( $fp, "// Do not change anything in this file!\n" );
fwrite ( $fp, "\$dbhost = '$dbhost';\n" );
fwrite ( $fp, "\$dbport = '$dbport';\n" );
fwrite ( $fp, "\$dbname = '$dbname';\n" );
fwrite ( $fp, "\$dbuser = '$dbuser';\n" );
fwrite ( $fp, "\$dbpasswd = '$dbpasswd';\n" );
fwrite ( $fp, "\$table_prefix = '$table_prefix';\n" );
fclose ( $fp );

include ("config.php");

// Datenbankverbindung
$db = @new mysqli ( $dbhost, $dbuser, $dbpasswd, $dbname );

// Tabellen erstellen & einrichten
$sql = "CREATE TABLE `" . $table_prefix . "kstage` (`ks_id` MEDIUMINT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY, `user_id` MEDIUMINT(8) NOT NULL, `ks_day` INT(11) NOT NULL, `ks_art` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, `ks_grad` INT NOT NULL, `ks_info` VARCHAR(2048) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, `ks_lastchange` INT(11) NOT NULL) ENGINE = MyISAM;";
$result = $db->query ( $sql );
dbstat ( $result, $sql );
$sql = "CREATE TABLE `" . $table_prefix . "user` (`user_id` MEDIUMINT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY, `user_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, `user_password` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, `user_email` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, `user_regdate` INT(11) NOT NULL, `user_lastvisit` INT(11) NOT NULL, `user_sessionid` VARCHAR( 254 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_bin;";
$result = $db->query ( $sql );
dbstat ( $result, $sql );
$sql = "CREATE TABLE `" . $table_prefix . "medis` (`med_id` MEDIUMINT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY, `med_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_bin;";
$result = $db->query ( $sql );
dbstat ( $result, $sql );
$sql = "INSERT INTO `" . $table_prefix . "medis` (`med_id`, `med_name`) VALUES (1, 'Allegro'), (3, 'Naproxen 500'), (2, 'Ibuprofen 600'), (4, 'Zolmi');";
$result = $db->query ( $sql );
dbstat ( $result, $sql );
$sql = "CREATE TABLE `" . $table_prefix . "medtage` (`medtag_id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,`ks_id` MEDIUMINT( 8 ) NOT NULL ,`med_id` MEDIUMINT( 8 ) NOT NULL) ENGINE = MYISAM ;";
$result = $db->query ( $sql );
dbstat ( $result, $sql );
$stkstage = $table_prefix . "kstage";
$stmedtag = $table_prefix . "medtage";
$data [] = array (
		'd' => 1,
		'm' => 6,
		'j' => 2013,
		'art' => 's',
		'medis' => 'I',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 2,
		'm' => 6,
		'j' => 2013,
		'art' => 's',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 3,
		'm' => 6,
		'j' => 2013,
		'art' => 's',
		'medis' => 'I',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 4,
		'm' => 6,
		'j' => 2013,
		'art' => 'u',
		'medis' => 'I',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 5,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 6,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 7,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 8,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 10,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 12,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'I',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 13,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 14,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 17,
		'm' => 6,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 19,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 21,
		'm' => 6,
		'j' => 2013,
		'art' => 'u',
		'medis' => 'I',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 22,
		'm' => 6,
		'j' => 2013,
		'art' => 's',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 23,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 24,
		'm' => 6,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 25,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 26,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 27,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 28,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 29,
		'm' => 6,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 2,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 3,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 6,
		'm' => 7,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 7,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 11,
		'm' => 7,
		'j' => 2013,
		'art' => 'u',
		'medis' => 'A',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 12,
		'm' => 7,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 14,
		'm' => 7,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 16,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 17,
		'm' => 7,
		'j' => 2013,
		'art' => 's',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 18,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 23,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 24,
		'm' => 7,
		'j' => 2013,
		'art' => 'u',
		'medis' => 'I',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 27,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 28,
		'm' => 7,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 29,
		'm' => 7,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 31,
		'm' => 7,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 1,
		'm' => 8,
		'j' => 2013,
		'art' => 'u',
		'medis' => 'A',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 2,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 8,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 9,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 10,
		'm' => 8,
		'j' => 2013,
		'art' => 's',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 13,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 14,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 15,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 16,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 18,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 19,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 20,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 22,
		'm' => 8,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 26,
		'm' => 8,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 2,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 3,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 4,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 5,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 9,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 10,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 11,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 13,
		'm' => 9,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 16,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 18,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => 'Schmerzklinik 2/14' 
);
$data [] = array (
		'd' => 23,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => 'Schmerzklinik 7/14' 
);
$data [] = array (
		'd' => 24,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'NZ',
		'grad' => 2,
		'info' => 'Schmerzklinik 8/14' 
);
$data [] = array (
		'd' => 25,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'NZ',
		'grad' => 4,
		'info' => 'Schmerzklinik 9/14' 
);
$data [] = array (
		'd' => 26,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'NZ',
		'grad' => 2,
		'info' => 'Schmerzklinik 10/14' 
);
$data [] = array (
		'd' => 27,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => 'Schmerzklinik 11/14' 
);
$data [] = array (
		'd' => 28,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 3,
		'info' => 'Schmerzklinik 12/14, Cortison 1/7' 
);
$data [] = array (
		'd' => 29,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => 'Schmerzklinik 13/14, Cortison 2/7' 
);
$data [] = array (
		'd' => 30,
		'm' => 9,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => 'Schmerzklinik 14/14, Cortison 3/7' 
);
$data [] = array (
		'd' => 2,
		'm' => 10,
		'j' => 2013,
		'art' => 's',
		'medis' => '',
		'grad' => 1,
		'info' => 'Cortison 5/7' 
);
$data [] = array (
		'd' => 3,
		'm' => 10,
		'j' => 2013,
		'art' => 's',
		'medis' => '',
		'grad' => 1,
		'info' => 'Cortison 6/7' 
);
$data [] = array (
		'd' => 4,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => 'Cortison 7/7' 
);
$data [] = array (
		'd' => 5,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 6,
		'm' => 10,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 9,
		'm' => 10,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 10,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 11,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AI',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 13,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 14,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 22,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 23,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 24,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 26,
		'm' => 10,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 27,
		'm' => 10,
		'j' => 2013,
		'art' => 'u',
		'medis' => 'N',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 30,
		'm' => 10,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 1,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 5,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 14,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 21,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 22,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 23,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 25,
		'm' => 11,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 27,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 28,
		'm' => 11,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 6,
		'm' => 12,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 9,
		'm' => 12,
		'j' => 2013,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => 'blockiert' 
);
$data [] = array (
		'd' => 10,
		'm' => 12,
		'j' => 2013,
		'art' => 'u',
		'medis' => 'N',
		'grad' => 2,
		'info' => 'blockiert' 
);
$data [] = array (
		'd' => 17,
		'm' => 12,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 18,
		'm' => 12,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'NZ',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 19,
		'm' => 12,
		'j' => 2013,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 27,
		'm' => 12,
		'j' => 2013,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 1,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 2,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 3,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 7,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 12,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 15,
		'm' => 1,
		'j' => 2014,
		'art' => 's',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 19,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 21,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 22,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 23,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 27,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 28,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 30,
		'm' => 1,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 8,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 9,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 10,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 11,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 14,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => 'Erkältung mit Fieber' 
);
$data [] = array (
		'd' => 15,
		'm' => 2,
		'j' => 2014,
		'art' => 'u',
		'medis' => 'I',
		'grad' => 2,
		'info' => 'Erkältung mit Fieber' 
);
$data [] = array (
		'd' => 16,
		'm' => 2,
		'j' => 2014,
		'art' => 'u',
		'medis' => 'I',
		'grad' => 2,
		'info' => 'Erkältung mit Fieber' 
);
$data [] = array (
		'd' => 17,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => 'Erkältung mit Fieber' 
);
$data [] = array (
		'd' => 18,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 19,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 24,
		'm' => 2,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 1,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 2,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 3,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 5,
		'm' => 3,
		'j' => 2014,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => 'Beginn Atkins' 
);
$data [] = array (
		'd' => 6,
		'm' => 3,
		'j' => 2014,
		'art' => 'u',
		'medis' => '',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 7,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 13,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 20,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 21,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 27,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => '',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 30,
		'm' => 3,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'NZ',
		'grad' => 4,
		'info' => '' 
);
$data [] = array (
		'd' => 6,
		'm' => 4,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'A',
		'grad' => 2,
		'info' => '' 
);
$data [] = array (
		'd' => 7,
		'm' => 4,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$data [] = array (
		'd' => 17,
		'm' => 4,
		'j' => 2014,
		'art' => 'u',
		'medis' => '',
		'grad' => 1,
		'info' => '' 
);
$data [] = array (
		'd' => 20,
		'm' => 4,
		'j' => 2014,
		'art' => 'm',
		'medis' => 'AN',
		'grad' => 3,
		'info' => '' 
);
$medisid = array (
		'A' => 1,
		'I' => 2,
		'N' => 3,
		'Z' => 4 
);
foreach ( $data as $import ) {
	extract ( $import );
	$ks_day = mktime ( 0, 0, 0, $m, $d, $j );
	$sql = sprintf ( "INSERT INTO `$stkstage` (`user_id`, `ks_day`, `ks_art`, `ks_grad`, `ks_info`, `ks_lastchange`) VALUES (1, $ks_day, '$art', $grad, '$info', %s);", time () );
	$result = $sqldb->query ( $sql );
	dbstat ( $result, $sql );
	$ks_id = $sqldb->insert_id;
	if ($medis) {
		$values = '';
		for($i = 0; $i < strlen ( $medis ); $i ++) {
			$values .= "(NULL , $ks_id, {$medisid[substr($medis, $i, 1)]}), ";
		}
		$values = substr ( $values, 0, - 2 );
		$sql = "INSERT INTO `$stmedtag` (`medtag_id`, `ks_id`, `med_id`) VALUES $values;";
		$result = $sqldb->query ( $sql );
		dbstat ( $result, $sql );
	}
}