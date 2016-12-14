<?php
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