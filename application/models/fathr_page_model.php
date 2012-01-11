<?php
class Fathr_page_model extends Model {

	function getAllPagesIndexed()
	{
		$query = $this->db->query("SELECT title, headline, text, dated, date, id from {$this->config['table_tag']}pages WHERE indexed=true");
		return $query;
	}
	function getPageIndex()
	{
		$query = $this->db->query("SELECT title, headline, text, dated, date from {$this->config['table_tag']}pages WHERE indexed=true LIMIT 1");
		return $query;
	}
	function getSidebarIndex()
	{
		$query = $this->db->query("SELECT title, headline, text, dated, date, sidebarside from {$this->config['table_tag']}pages WHERE sidebar='index' LIMIT 1");
		return $query;
	}
	function getAllpages()
	{
		$query = $this->db->get("{$this->config['table_tag']}pages");
		return $query;
	}
	
	function getAllpagesSmall()
	{
		$query = $this->db->query("SELECT id,title from {$this->config['table_tag']}pages");
		return $query;
	}
	
	function getPage($id)
	{
		$query = $this->db->query("SELECT id,title, headline, text, dated, date, indexed, sidebar, sidebarside from {$this->config['table_tag']}pages WHERE id='{$id}' LIMIT 1");
		return $query;
	}
	function getSidebarsForPage($id)
	{
		$query = $this->db->query("SELECT title, headline, text, dated, date, sidebarside from {$this->config['table_tag']}pages WHERE sidebar='{$id}' LIMIT 2");
		return $query;
	}
	
	function addPage($title, $headline, $text, $sidebarid, $sidebarside, $indexed, $date, $dater = 0)
	{
		$dated = 0;
		if(isset($dater) AND $dater == 1)
		{
			$dated = 1;
			$this->db->query("INSERT INTO {$this->config['table_tag']}pages (title, headline, text, indexed, dated, date, sidebar, sidebarside) VALUES ('{$title}', '{$headline}', '{$text}', '{$indexed}', '{$dated}', '{$date}','{$sidebarid}', '{$sidebarside}');");
		}
		else {
			$this->db->query("INSERT INTO {$this->config['table_tag']}pages (title, headline, text, indexed, date, sidebar, sidebarside) VALUES ('{$title}', '{$headline}', '{$text}', '{$indexed}','{$date}','{$sidebarid}', '{$sidebarside}');");
		}
	}
	
	function updatePage($id, $title, $headline, $text, $sidebarid, $sidebarside, $indexed, $dater = 0)
	{
		$dated = 0;
		if(isset($dater) AND $dater == 1)
		{
			$dated = 1;
		}
		$this->db->query("UPDATE {$this->config['table_tag']}pages SET {$this->config['table_tag']}pages.title='{$title}', {$this->config['table_tag']}pages.headline='{$headline}', {$this->config['table_tag']}pages.text='{$text}', {$this->config['table_tag']}pages.indexed='{$indexed}', {$this->config['table_tag']}pages.dated='{$dated}', {$this->config['table_tag']}pages.sidebar='{$sidebarid}', {$this->config['table_tag']}pages.sidebarside='{$sidebarside}' WHERE {$this->config['table_tag']}pages.id='{$id}'");
	}
	function deletePage($id)
	{
		$this->db->query("DELETE FROM {$this->config['table_tag']}pages WHERE id={$id};");
	}
}
?>