<?php
class db {
	// This is the helper that will help you with the connection and communication to the database.
	// This helper is not tested!
	private static $instance = "";
	private $conn = "";
	private $config = array();
	
	function __construct()
	{
		$this->instance = &$this;
		require_once('config/db.php');
		$this->config = $db_config;
		unset($db_config);
		$this->conn = mysql_connect($this->config['db_host'], $this->config['db_user'], $this->config['db_password'])
    or die('Could not connect: ' . mysql_error());
    	mysql_select_db($this->config['db_dbname'], $this->conn) or die('Could not select database');
	}
	
	function open()
	{
		$this->conn = mysql_connect($this->config['db_host'], $this->config['db_user'], $this->config['db_password'])
    or die('Could not connect: ' . mysql_error());
    	mysql_select_db($this->config['db_dbname'], $this->conn) or die('Could not select database');
	}
	
	static function instance()
	{
		if (!isset(self::$instance)) {
            self::$instance = new db();
        }
        return self::$instance;
	}
	
	function query($string)
	{
		$result = mysql_query($string, $this->conn);
		return $result;
	}
	
	function get($tablename, $limit = null) {
		if($limit)
		{
			$result = mysql_query("SELECT * FROM ".$tablename." LIMIT ".$limit, $this->conn);
		}
		else {
			$result = mysql_query("SELECT * FROM ".$tablename, $this->conn);
		}
		return $result;
	}
	
	function close()
	{
		mysql_close($this->conn);
	}
	
	function __destruct()
	{
		mysql_close($this->conn);
	}
}
?>