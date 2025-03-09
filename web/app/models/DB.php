<?php

class DB {
	private static $conn = null;
	
	public static function init($config) {
		global $uojMySQL;
		$uojMySQL = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
		if (!$uojMySQL) {
			die('DB connection failed.');
		}
		mysqli_set_charset($uojMySQL, 'utf8mb4');
		self::$conn = $uojMySQL;
	}
	
	public static function escape($str) {
		global $uojMySQL;
		return mysqli_real_escape_string($uojMySQL, $str);
	}
	
	public static function query($sql) {
		global $uojMySQL;
		if (!$uojMySQL) {
			error_log("DB not initialized when executing: " . $sql);
			return false;
		}
		
		error_log("Executing SQL: " . $sql);
		$ret = mysqli_query($uojMySQL, $sql);
		if ($ret === false) {
			error_log("Query failed: " . mysqli_error($uojMySQL));
			error_log("Failed SQL: " . $sql);
		}
		return $ret;
	}
	
	public static function fetch($r, $opt = MYSQLI_ASSOC) {
		return mysqli_fetch_array($r, $opt);
	}
	
	public static function update($q) {
		global $uojMySQL;
		return mysqli_query($uojMySQL, $q);
	}
	
	public static function insert($q) {
		global $uojMySQL;
		return mysqli_query($uojMySQL, $q);
	}
	
	public static function insert_id() {
		global $uojMySQL;
		return mysqli_insert_id($uojMySQL);
	}
	
	public static function delete($q) {
		global $uojMySQL;
		return mysqli_query($uojMySQL, $q);
	}
	
	public static function select($q) {
		global $uojMySQL;
		return mysqli_query($uojMySQL, $q);
	}
	
	public static function selectAll($q, $opt = MYSQLI_ASSOC) {
		global $uojMySQL;
		$res = array();
		$qr = mysqli_query($uojMySQL, $q);
		while ($row = mysqli_fetch_array($qr, $opt)) {
			$res[] = $row;
		}
		return $res;
	}
	
	public static function selectFirst($sql) {
		error_log("selectFirst executing: " . $sql);
		$res = self::query($sql);
		if ($res === false) {
			error_log("selectFirst query failed");
			return null;
		}
		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
		if ($row === null) {
			error_log("selectFirst: no rows found");
		} else {
			error_log("selectFirst: found row with data: " . print_r($row, true));
		}
		return $row;
	}
	
	public static function selectCount($q) {
		global $uojMySQL;
		list($cnt) = mysqli_fetch_array(mysqli_query($uojMySQL, $q), MYSQLI_NUM);
		return $cnt;
	}
	
	public static function checkTableExists($name) {
		global $uojMySQL;
		return DB::query("select 1 from $name") !== false;
	}
	
	public static function num_rows($r) {
		return mysqli_num_rows($r);
	}
	
	public static function affected_rows() {
		global $uojMySQL;
		return mysqli_affected_rows($uojMySQL);
	}
	
	public static function error() {
		global $uojMySQL;
		return mysqli_error($uojMySQL);
	}
}

DB::init([
	'host' => 'uoj-db',
	'username' => 'root',
	'password' => 'root',
	'database' => 'app_uoj233'
]);

function DB_init() {
	global $uojMySQL;
	
	$config = UOJConfig::$data['database'];
	$uojMySQL = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);
	
	if (!$uojMySQL) {
		error_log("DB connection failed: " . mysqli_connect_error());
	}
	
	if ($uojMySQL) {
		mysqli_set_charset($uojMySQL, 'utf8mb4');
	}
}