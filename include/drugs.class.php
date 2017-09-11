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

class Drugs {
	public $drug_id;
	public $user_id;
	public $drug_name;
	public $drug_short_name;
	public $drug_type;
	public $drug_show;
	public $drug_doses;
	public static $allDrugs = array ();
	public static function numberOfDrugs() {
		return count ( self::$allDrugs );
	}
	public static function getDrugs() {
		return self::$allDrugs;
	}
	public static function createNewDrug() {
		
		
	}
}