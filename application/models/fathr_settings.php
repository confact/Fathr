<?php
class Fathr_settings extends Model {

	function getSettings()
	{
		$query = $this->db->get("{$this->config['table_tag']}settings");
		return $query;
	}
	function setSettings($sitename, $url, $theme, $blogy)
	{
		$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$sitename}' WHERE {$this->config['table_tag']}settings.key='sitename'");
			$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$url}' WHERE {$this->config['table_tag']}settings.key='url'");
			$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$theme}' WHERE {$this->config['table_tag']}settings.key='theme'");
			$this->db->query("UPDATE {$this->config['table_tag']}settings SET {$this->config['table_tag']}settings.value='{$blogy}' WHERE {$this->config['table_tag']}settings.key='blogyindex'");
	}
}
?>