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

class DB {
	
	/**
	 * stores established database connection
	 * 
	 * @var mysqli connection
	 */
	public static $db = null;
	
	/**
	 * id of last inserted row
	 * 
	 * @var string
	 */
	public static $insertID;
	
	/**
	 * initialise db connection
	 * 
	 * @param string $dbHost
	 *        	db host
	 * @param string $dbUser
	 *        	db user
	 * @param string $dbPassword
	 *        	db password
	 * @param string $dbName
	 *        	db name
	 */
	public static function init($dbHost, $dbUser, $dbPassword, $dbName) {
		self::$db = new mysqli ( $dbHost, $dbUser, $dbPassword, $dbName );
		if (self::$db->connect_errno) {
			$_SESSION ['errors'] [] = "MySQL connection failed: " . self::$db->connect_error;
		}
		self::$db->query ( "SET NAMES utf8;" );
	}
	
	/**
	 * querys sql on database
	 * 
	 * @param string $sql
	 *        	sql to query
	 * @return mixed result set
	 */
	public static function query($sql, $debug = false) {
		$result = self::$db->query ( $sql );
		if ($debug == true) {
			$_SESSION ['debug'] [] = __FUNCTION__ . ': $sql is <strong>' . $sql . '</strong>';
		}
		if (self::$db->errno) {
			$_SESSION ['errors'] [] = "<p>insert failed: " . self::$db->error . "<br> statement was: <strong> $sql </strong></p>";
		}
		return $result;
	}
	
	/**
	 * insert an entry to the specified table
	 * 
	 * @param string $table
	 *        	database table to insert into
	 * @param array $data
	 *        	data to insert
	 */
	public static function insert($table, $data, $debug = false) {
		$keys = "";
		$values = "";
		foreach ( $data as $key => $value ) {
			$key = self::escape ( $key );
			$value = self::escape ( $value );
			$keys .= $key . ", ";
			if ($value == null) {
				$values .= "null, ";
			} else {
				$values .= "'" . $value . "', ";
			}
		}
		$keys = rtrim ( $keys, ', ' );
		$values = rtrim ( $values, ', ' );
		
		$sql = "INSERT INTO $table (" . $keys . ") VALUES (" . $values . ")";
		
		if ($debug == true) {
			$_SESSION ['debug'] [] = __FUNCTION__ . ': $sql is <strong>' . $sql . '</strong>';
		}
		
		self::$db->query ( $sql );
		
		if (self::$db->errno) {
			$_SESSION ['errors'] [] = '<p>' . __FUNCTION__ . ' failed: ' . self::$db->error . '<br> statement was: <strong> ' . $sql . '</strong></p>';
		}
		
		self::$insertID = self::$db->insert_id;
	}
	
	/**
	 * update an entry in specified table
	 * 
	 * @param string $table
	 *        	database table to update
	 * @param string $id
	 *        	id of dataset to update
	 * @param array $data
	 *        	updated data
	 */
	public static function update($table, $id, $data, $debug = false) {
		$sql = "UPDATE $table SET ";
		foreach ( $data as $key => $value ) {
			$key = self::escape ( $key );
			$value = self::escape ( $value );
			if ($value == null) {
				$sql .= "$key = null, ";
			} else {
				$sql .= "$key = '$value', ";
			}
		}
		
		$sql = rtrim ( $sql, ", " );
		
		$sql .= " WHERE " . self::getPrimaryKeyColumn ( $table ) . " = $id";
		
		if ($debug == true) {
			$_SESSION ['debug'] [] = __FUNCTION__ . ': $sql is <strong>' . $sql . '</strong>';
		}
		
		self::$db->query ( $sql );
		
		if (self::$db->errno) {
			$_SESSION ['errors'] [] = '<p>' . __FUNCTION__ . ' failed: ' . self::$db->error . '<br> statement was: <strong> ' . $sql . '</strong></p>';
		}
	}
	
	/**
	 * select data from specified table
	 * 
	 * @param string $table
	 *        	database table to select from
	 * @param array $columns
	 *        	colums to select, default all
	 * @param array $where
	 *        	where condition
	 * @param string $limit
	 *        	limit
	 * @return array fetched data
	 */
	public static function select($table, $columns = '*', $where = null, $limit = null, $debug = false) {
		$sql = "SELECT " . self::generateColumnList ( $columns ) . " FROM $table";
		if ($where != null) {
			$sql .= " WHERE " . $where;
		}
		if ($limit != null) {
			$sql .= " LIMIT " . $limit;
		}
		if ($debug == true) {
			$_SESSION ['debug'] [] = __FUNCTION__ . ': $sql is <strong>' . $sql . '</strong>';
		}
		
		$result = self::$db->query ( $sql );
		if (self::$db->errno) {
			$_SESSION ['errors'] [] = '<p>select failed: ' . self::$db->error . '<br> statement was: <strong>' . $sql . '</strong></p>';
			return array ();
		} else {
			$ret = array ();
			while ( $row = $result->fetch_assoc () ) {
				$ret [] = $row;
			}
			if (count ( $ret ) == 1) {
				return $ret [0];
			} else {
				return $ret;
			}
		}
	}
	
	/**
	 * delete data from specified table
	 * 
	 * @param string $table
	 *        	database table to delete from
	 * @param string $id
	 *        	id of dataset to delete
	 */
	public static function delete($table, $id, $debug = false) {
		$sql = "DELETE FROM $table WHERE " . self::getPrimaryKeyColumn ( $table ) . " = $id";
		
		if ($debug == true) {
			$_SESSION ['debug'] [] = __FUNCTION__ . ': $sql is <strong>' . $sql . '</strong>';
		}
		
		self::$db->query ( $sql );
		
		if (self::$db->errno) {
			$_SESSION ['errors'] [] = '<p>' . __FUNCTION__ . ' failed: ' . self::$db->error . '<br> statement was: <strong>' . $sql . '</strong></p>';
		}
	}
	
	/**
	 * escape given string
	 * 
	 * @param string $string
	 *        	string to escape
	 * @return string escaped string
	 */
	public static function escape($string) {
		return self::$db->real_escape_string ( $string );
	}
	
	/**
	 * get primary key column from given table
	 * 
	 * @param string $table
	 *        	table to get primary key from
	 * @return string primary key column name
	 */
	public static function getPrimaryKeyColumn($table, $debug = false) {
		$sql = "SHOW KEYS FROM $table WHERE key_name = 'PRIMARY'";
		
		if ($debug == true) {
			$_SESSION ['debug'] [] = __FUNCTION__ . ': $sql is <strong>' . $sql . '</strong>';
		}
		
		$result = self::$db->query ( $sql );
		
		while ( $row = $result->fetch_assoc () ) {
			return $row ['Column_name'];
		}
		
		if (self::$db->errno) {
			$_SESSION ['errors'] [] = '<p>' . __FUNCTION__ . ' failed: ' . self::$db->error . '<br> statement was: <strong>' . $sql . '</strong></p>';
		}
		
		return false;
	}
	
	/**
	 * generates list of columns from array
	 * 
	 * @param array $columns
	 *        	array of columns
	 * @return string imploded array
	 */
	private static function generateColumnList($columns) {
		if (is_array ( $columns )) {
			return implode ( ', ', $columns );
		} else {
			return $columns;
		}
	}
}
?>