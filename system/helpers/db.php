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
		global $db_config;
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
		return mysql_query($string, $this->conn);
	}
	
	function get($tablename, $limit = null) {
		if($limit)
		{
			return mysql_query("SELECT * FROM ".$tablename." LIMIT ".$limit, $this->conn);
		}
		else {
			return mysql_query("SELECT * FROM ".$tablename, $this->conn);
		}
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