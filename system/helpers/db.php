<?php
class db {
	// This is the helper that will help you with the connection and communication to the database.
	// This helper is not tested!
	private static $instance = "";
	private $conn = "";
	private $config = array();
	
	function __construct()
	{
		require_once('config/db.php');
		$this->config = $db_config;
		unset($db_config);
		$this->open();
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
	
	
	/**
	 * query function.
	 * 
	 * @access public
	 * @param mixed $string
	 * @return Databasemodel
	 */
	function query($string)
	{
		$result = mysql_query($string, $this->conn);
		$result = Databasemodel($result);
		return $result;
	}
	
	/**
	 * create table function.
	 * 
	 * @access public
	 * @param mixed $tablename
	 * @param array $columns ["columnname"] => "data_type" (default: array())
	 * @return boolean
	 */
	function create_table($tablename, $columns = array())
	{
		$column_text = "";
		foreach($columns as $key => $value)
		{
			$column_text += $key . " " . $value . ", 
			";
		}
		$result = mysql_query("CREATE TABLE " . $tablename . " (" . $column_text . ");");
		
		if($result)
		{
			return true;
		}
		else {
			return false;
		}
	}
	
	
	/**
	 * get function.
	 * 
	 * @access public
	 * @param mixed $tablename
	 * @param mixed $limit (default: null)
	 * @return Databasemodel
	 */
	function get($tablename, $limit = null) 
	{
		if(!is_null($limit))
		{
			$result = mysql_query("SELECT * FROM ".$tablename." LIMIT ".$limit, $this->conn);
		}
		else {
			$result = mysql_query("SELECT * FROM ".$tablename, $this->conn);
		}
		$result = Databasemodel($result);
		return $result;
	}
	
	function close()
	{
		mysql_close($this->conn);
	}
	
	function __destruct()
	{
		$this->close();
	}
}
?>