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
	 * @param string $user Username
	 * @param string $pass Userpasswort (hier noch kein MD5-Hash)
	 * @param string $sessid Session-ID
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
		if($md5) $this->pass = $pass;
		else $this->pass = md5($pass);
		$this->sessid = $sessid;

		$sql = sprintf("SELECT * FROM %s WHERE %s = '%s';", $this->prefi."user", 'user_name', $this->user);
		$result = $this->sqldb->query($sql);

		if($result->num_rows == 1) {
			extract($result->fetch_assoc());
			if ($user_password == $this->pass) {
				$_SESSION['user_id'] = $user_id;
				$_SESSION['user'] = $user_name; 
				$sql = sprintf("UPDATE %s SET %s = '%s', %s = '%s' WHERE user_id = '%s';", $this->prefi."user", 'user_sessionid', $this->sessid, 'user_lastvisit', time(), $user_id);
				$result = $this->sqldb->query($sql);
				return true;
			} else {
				// Passwort falsch
				return false;
			}
		} else {
			//User nicht gefunden
			return false;
		}
	}

	/**
	 * User ausloggen
	 *
	 * @param string $sessid Session-ID
	 * @return bool
	 */
	public function logout($sessid) {
		$this->sessid = $sessid;
		$sql = sprintf("SELECT * FROM %s WHERE %s = '%s';", $this->prefi."user", 'user_sessionid', $this->sessid);
		$result = $this->sqldb->query($sql);
		if($result->num_rows == 1) {
			unset($_SESSION['user_id']);
			$sql = sprintf("UPDATE %s SET %s = '' WHERE %s = '%s';", $this->prefi."user", 'user_sessionid', 'user_sessionid', $this->sessid);
			$result = $this->sqldb->query($sql);
			return true;
		} else {
			// Keine (oder mehrere???) Session zum Ausloggen gefunden
			return false;
		}
	}

	/**
	 * Zugriff des Users prüfen
	 *
	 * @param string $sessid Session-ID
	 * @return bool
	 */
	public function check_access($sessid) {
		$this->sessid = $sessid;
		$sql = sprintf("SELECT * FROM %s WHERE %s = '%s';", $this->prefi."user", 'user_sessionid', $this->sessid);
		$result = $this->sqldb->query($sql);
		if($result->num_rows == 1) {
			return true;
		} else {
			//Session nicht eingeloggt
			return false;
		}
	}
}