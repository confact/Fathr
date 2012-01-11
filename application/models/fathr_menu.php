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
}
?>