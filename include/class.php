<?php
class User {
	public $name;
	public static $allUsers = array ();
	public static function numberOfUsers() {
		return count ( self::$allUsers );
	}
	public static function createNewUser($name) {
		if (strlen ( $name ) < 10) {
			echo "Nur User mit langen Namen sind erlaubt!<br>";
			return null;
		} else {
			$user = new User ();
			$user->name = $name;
			
			self::$allUsers [] = $user;
			
			return $user;
		}
	}
}

$user = User::createNewUser ( "Max Mustermann" );

echo $user->name;
echo "Anzahl Nutzer: " . User::numberOfUsers () . "<br>";

User::createNewUser ( "Lisa Kurz" );
echo "Anzahl Nutzer: " . User::numberOfUsers () . "<br>";
?>