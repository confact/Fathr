<?php
class db {
	// This is the helper that will help you with the connection and communication to the database.
	// This helper is not tested!
	private static $instance = "";
	private $conn = "";
	private $mysqli = false;
	private $config = array();
	
	function __construct()
	{
		require_once('config/db.php');
		$this->config = $db_config;
		unset($db_config);
		$this->open();
	}
	
	
	/**
	 * open database connection function.
	 * 
	 * @access private
	 * @return void
	 */
	private function open()
	{
		if (function_exists('mysqli_connect') && $this->config['mysqli']) {
			$this->mysqli = true;
			$this->conn = mysqli_connect($this->config['db_host'], $this->config['db_user'], $this->config['db_password']);
			if (mysqli_connect_errno($this->conn)) {
				die('Could not connect: ' . mysqli_connect_error());
			}
			$this->conn->select_db($this->config['db_dbname']);
		}
		else {
			$this->conn = mysql_connect($this->config['db_host'], $this->config['db_user'], $this->config['db_password'])
    or die('Could not connect: ' . mysql_error());
    		mysql_select_db($this->config['db_dbname'], $this->conn) or die('Could not select database');
    	}
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
		$result = $this->do_query($string);
		if(!$result)
		{
			return false;
		}
		$result = new Databasemodel($result);
		return $result;
	}
	
	
	/**
	 * do_query function.
	 * 
	 * @access private
	 * @param mixed $string
	 * @return void
	 */
	private function do_query($string)
	{
		if($this->mysqli) {
			$result = $this->conn->query($string);
		}
		else {
			$result = mysql_query($string, $this->conn);
		}
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
		$result = $this->do_query("CREATE TABLE " . $tablename . " (" . $column_text . ");");
		
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
			$result = $this->do_query("SELECT * FROM ".$tablename." LIMIT ".$limit, $this->conn);
		}
		else {
			$result = $this->do_query("SELECT * FROM ".$tablename . ";", $this->conn);
		}
		if(!$result)
		{
			return false;
		}
		$result = new Databasemodel($result);
		return $result;
	}
	
	
	/**
	 * close database connection function.
	 * 
	 * @access private
	 * @return void
	 */
	private function close()
	{
		if($this->mysqli)
		{
			$this->conn->close();
		}
		else {
			mysql_close($this->conn);
		}
	}
	
	function __destruct()
	{
		$this->close();
	}
}
?>