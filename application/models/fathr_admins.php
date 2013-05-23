<?php
class Fathr_admins extends Model {
	
	function login($username = "", $password = "")
	{
		$query = $this->db->query("SELECT id from {$this->config['table_tag']}admins WHERE username='{$username}' and password='{$password}' LIMIT 1");
		$found = false;
		$row = $query->getArray();
		if(count($row) > 0 && $row[0]['id'] != "")
		{
			$found = true;
		}
		return $found;
	}
	
	function install($username, $password)
	{
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->config['table_tag']}admins` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");
		$this->db->query("INSERT INTO `{$this->config['table_tag']}admins` (`id`, `username`, `password`) VALUES
(1, '{$username}', '{$password}');");
		return $query;
	}
}
?>