<?php
class Fathr_menu extends Model {
	
	function getMenu()
	{
		$menuquery = $this->db->get("{$this->config['table_tag']}menu");
		return $menuquery;
	}
	function addMenu($name, $url)
	{
		$this->db->query("INSERT INTO {$this->config['table_tag']}menu (names, url) VALUES ('{$name}', '{$url}');");
	}
	function updateMenu($id, $name, $url)
	{
		$this->db->query("UPDATE {$this->config['table_tag']}menu SET {$this->config['table_tag']}menu.names='{$name}', {$this->config['table_tag']}menu.url='{$url}' WHERE {$this->config['table_tag']}menu.id='{$id}'");
	}
	
	function deleteMenu($id)
	{
		$this->db->query("DELETE FROM {$this->config['table_tag']}menu WHERE id={$id};");
	}
	
	function install($url)
	{
		$query = $this->db->query("CREATE TABLE IF NOT EXISTS `{$this->config['table_tag']}menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");
		$this->db->query("INSERT INTO `{$this->config['table_tag']}menu` (`id`, `names`, `url`) VALUES
(1, 'admin', '{$url}/fathr_admin/');");
		return $query;
	}
}
?>