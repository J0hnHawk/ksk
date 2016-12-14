<?php
/**
 *
 * PHP-Klasse für den Nutzerlogin
 * @author H.-Peter Pfeufer (Originalcode)
 * @link http://ppfeufer.de/php-klasse-fuer-den-nutzerlogin/
 *
 * Angepasst für meine bedürfnisse
 */
class loginCheck {
	/**
	 * Userdaten prüfen und User einloggen
	 *
	 * @param string $user
	 *        	Username
	 * @param string $pass
	 *        	Userpasswort (hier noch kein MD5-Hash)
	 * @param string $sessid
	 *        	Session-ID
	 * @return bool
	 */
	var $sqldb = NULL;
	var $prefi = NULL;
	public function __construct($sqldb, $prefi) {
		$this->sqldb = $sqldb;
		$this->prefi = $prefi;
	}
	public function login($user, $pass, $sessid, $md5 = false) {
		$this->user = $user;
		if ($md5)
			$this->pass = $pass;
		else
			$this->pass = md5 ( $pass );
		$this->sessid = $sessid;
		
		$sql = sprintf ( "SELECT * FROM %s WHERE %s = '%s';", $this->prefi . "user", 'user_name', $this->user );
		$result = $this->sqldb->query ( $sql );
		
		if ($result->num_rows == 1) {
			$user = $result->fetch_assoc ();
			if ($user ['user_password'] == $this->pass) {
				list ( $range1, $range2 ) = explode ( ',', $user ['user_autowarn'] );
				$user ['range1'] = $range1;
				$user ['range2'] = $range2;
				$_SESSION ['user'] = $user;
				$sql = sprintf ( "UPDATE %s SET %s = '%s', %s = '%s' WHERE user_id = '%s';", $this->prefi . "user", 'user_sessionid', $this->sessid, 'user_lastvisit', time (), $user ['user_id'] );
				$result = $this->sqldb->query ( $sql );
				return true;
			} else {
				// Passwort falsch
				return false;
			}
		} else {
			// User nicht gefunden
			return false;
		}
	}
	
	/**
	 * User ausloggen
	 *
	 * @param string $sessid
	 *        	Session-ID
	 * @return bool
	 */
	public function logout($sessid) {
		$this->sessid = $sessid;
		$sql = sprintf ( "SELECT * FROM %s WHERE %s = '%s';", $this->prefi . "user", 'user_sessionid', $this->sessid );
		$result = $this->sqldb->query ( $sql );
		if ($result->num_rows == 1) {
			unset ( $_SESSION ['user'] );
			$sql = sprintf ( "UPDATE %s SET %s = '' WHERE %s = '%s';", $this->prefi . "user", 'user_sessionid', 'user_sessionid', $this->sessid );
			$result = $this->sqldb->query ( $sql );
			return true;
		} else {
			// Keine (oder mehrere???) Session zum Ausloggen gefunden
			return false;
		}
	}
	
	/**
	 * Zugriff des Users prüfen
	 *
	 * @param string $sessid
	 *        	Session-ID
	 * @return bool
	 */
	public function check_access($sessid) {
		$this->sessid = $sessid;
		$sql = sprintf ( "SELECT * FROM %s WHERE %s = '%s';", $this->prefi . "user", 'user_sessionid', $this->sessid );
		$result = $this->sqldb->query ( $sql );
		if ($result->num_rows == 1) {
			$user = $result->fetch_assoc ();
			// list führt zu notice wenn kein 2. argument vorhanden ist
			list ( $range1, $range2 ) = explode ( ',', $user ['user_autowarn'] );
			$user ['range1'] = $range1;
			$user ['range2'] = $range2;
			$_SESSION ['user'] = $user;
			return true;
		} else {
			// Session nicht eingeloggt
			return false;
		}
	}
}