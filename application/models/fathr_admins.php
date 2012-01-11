<?php
class Fathr_admins extends Model {
	
	function login($username = "", $password = "")
	{
		$query = $this->db->query("SELECT id from {$this->config['table_tag']}admins WHERE username='{$username}' and password='{$password}' LIMIT 1");
		$found = false;
		$row = mysql_fetch_array($query);
		if($row['id'] != "")
		{
			$found = true;
		}
		return $found;
	}
}
?>