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

/*
 * Für das Update auf Version 2.0 des Kopfschmerzkalenders müssen neue Tabellen
 * in der Datenbank angelegt werden und bestehende erweitert werden.
 */

/*
 * Änderung der Kopfschmerzart von String zu Binär
 * Umstellung von Unix-Timestamp auf MySQL-Datetime/Timestamp
 */
$sql = "UPDATE `ksk2_kstage` SET `ks_art`= 1 WHERE `ks_art` = 'm'";
$sql = "UPDATE `ksk2_kstage` SET `ks_art`= 2 WHERE `ks_art` = 's'";
$sql = "UPDATE `ksk2_kstage` SET `ks_art`= 3 WHERE `ks_art` = 'ms'";
$sql = "UPDATE `ksk2_kstage` SET `ks_art`= 4 WHERE `ks_art` = 'u'";
$sql = "UPDATE `ksk2_kstage` SET `ks_art`= 5 WHERE `ks_art` = 'mu'";
$sql = "UPDATE `ksk2_kstage` SET `ks_art`= 6 WHERE `ks_art` = 'su'";
$sql = "UPDATE `ksk2_kstage` SET `ks_art`= 7 WHERE `ks_art` = 'msu'";
$sql = "ALTER TABLE `ksk2_kstage` ADD `pain_day` DATETIME NOT NULL AFTER `ks_day`,  ADD `pain_lastchange` TIMESTAMP NOT NULL";
$sql = "UPDATE `ksk2_kstage` SET `pain_day` = FROM_UNIXTIME( `ks_day` ), `pain_lastchange` = FROM_UNIXTIME( `ks_lastchange` );";

/*
 * Erweiterung der Usertabelle
 */
$sql = "ALTER TABLE `ksk2_user` ADD `user_autowarn` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , ADD `user_showpain` INT(11) NOT NULL , ADD `user_style` INT(11) NOT NULL ;";
/*
 * Erweiterung der Medikamententabelle
 */
$sql = "ALTER TABLE `ksk2_medis` ADD `user_id` MEDIUMINT(8) NOT NULL AFTER `med_id`, ADD `med_type` MEDIUMINT(8) NOT NULL AFTER `med_name`, ADD `med_shortname` VARCHAR(10) NOT NULL AFTER `med_name`, ADD `med_show` BOOLEAN NOT NULL AFTER `med_type`, ADD `med_doses` VARCHAR(255) NOT NULL AFTER `med_show`";

/*
 * Erweiterung der Medikamententagetabelle
 */
$sql = "ALTER TABLE `ksk2_medtage` ADD INDEX(`ks_id`), ADD INDEX(`ks_id`), ADD `user_id` MEDIUMINT(8) NOT NULL AFTER `ks_id`,  ADD `med_dose` VARCHAR(255) NOT NULL AFTER `med_id`";

/*
 * Füllen der neuen Felder. Dabei wird davon ausgegangen, dass die Einträge in der
 * Medikamententabelle dubliziert und die ID-Nummer der dublizierten Medikamente
 * um 7 höher ist als der ursprüngliche Eintrag
 */
$sql = "SELECT * FROM `ksk2_kstage` WHERE `user_id` = 2 ";
$kstage = $sqldb->query ( $sql );
dbstat ( $kstage, $sql );
while ( $kstag = $kstage->fetch_assoc () ) {
	$ks_id = $kstag ['ks_id'];
	$sql = "SELECT * FROM `ksk2_medtage` WHERE `ks_id` = $ks_id ";
	$medtage = $sqldb->query ( $sql );
	dbstat ( $medtage, $sql );
	while ( $medtag = $medtage->fetch_assoc () ) {
		extract ( $medtag );
		$med_id += 7;
		$sql = "UPDATE `ksk2_medtage` SET `user_id` = '2', `med_id` = '$med_id' WHERE `ksk2_medtage`.`medtag_id` = $medtag_id ";
		$medtage2 = $sqldb->query ( $sql );
		dbstat ( $medtage, $sql );
	}
}
$sql = "UPDATE `ksk2_medtage` SET `user_id` = 1 WHERE `user_id` = 0;";
